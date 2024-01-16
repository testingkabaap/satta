<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CDashboard extends CI_Controller
{

  private $ADMIN_TYPE = "D";
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    if (!$this->session->userdata(SESSION_ADMIN_DETAILS)) {
      redirect(ADMIN_SLUG . "/login");
    } else {
      $this->ADMIN_TYPE = $this->session->userdata(SESSION_ADMIN_DETAILS)["admin_type"];
    }
  }


  public function index()
  {
    redirect(ADMIN_SLUG . '/satta-records');
    // $DATA["META_TITLE"] = "Admin Dashboard";
    // $this->load->view("admin/dashboard/dashboard", $DATA);
  }

  public function action_get_data()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $this->load->library("form_validation");
      $this->form_validation->set_rules('id', '<b>ID</b>', 'required');
      $this->form_validation->set_rules('table_name', '<b>Table Name</b>', 'required');
      $this->form_validation->set_error_delimiters('', '');
      if ($this->form_validation->run()) {
        $DB = $this->load->database("default", true);
        $record = $DB->where("id", $_POST["id"])->get($_POST["table_name"])->row_array();
        $DB->close();
        if ($record) {
          $RES = ["status" => true, "status_code" => 200, "status_key" => "SUCCESS", "message" => "Record Found", "data" => [
            "record" => $record
          ]];
        } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "No Record Found"];
      } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => validation_errors()];
    } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "Invalid Request Method"];
    echo json_encode($RES);
    exit();
  }

  public function action_delete_data()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $this->load->library("form_validation");
      $this->form_validation->set_rules('id', '<b>ID</b>', 'required');
      $this->form_validation->set_rules('table_name', '<b>Table Name</b>', 'required');
      $this->form_validation->set_error_delimiters('', '');
      if ($this->form_validation->run()) {
        if (in_array($this->ADMIN_TYPE, ["S"])) {
          $DB = $this->load->database("default", true);
          $DB->where("id", $_POST["id"])->delete($_POST["table_name"]);
          $affectedRow = $DB->affected_rows();
          $DB->close();
          if ($affectedRow > 0) {
            $RES = ["status" => true, "status_code" => 200, "status_key" => "SUCCESS", "message" => "Deleted Successfully", "data" => []];
          } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "No Data Affected"];
        } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "You do not have permission to delete data"];
      } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => validation_errors()];
    } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "Invalid Request Method"];
    echo json_encode($RES);
    exit();
  }

  public function satta_records()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $this->load->library("form_validation");
      $this->form_validation->set_rules('record_date', '<b>Satta Date</b>', 'required');
      $this->form_validation->set_rules('time_slot', '<b>Time Slot</b>', 'required');
      $this->form_validation->set_rules('satta_number', '<b>Satta Number</b>', 'required');

      $new_entry = true;
      if (isset($_POST["edit_data"])) {
        $new_entry = false;
        $this->form_validation->set_rules('id', '<b>ID</b>', 'required');
      }
      $this->form_validation->set_error_delimiters('', '');
      if ($this->form_validation->run()) {
        if (!isset($_POST["status"])) $_POST["status"] = 0;
        $iData = [
          "record_date" => $_POST["record_date"],
          "time_slot" => $_POST["time_slot"],
          "satta_number" => $_POST["satta_number"],
        ];
        $DB = $this->load->database("default", true);
        if ($new_entry) {
          if (in_array($this->ADMIN_TYPE, ["S", "A", "J"])) {
            $checkAlready = $DB->where("record_date", $_POST["record_date"])->where("time_slot", $_POST["time_slot"])->get(TABLE_SATTA_RECORDS)->row_array();
            if (!$checkAlready) {
              $DB->insert(TABLE_SATTA_RECORDS, $iData);
              $RES = ["status" => true, "status_code" => 200, "status_key" => "SUCCESS", "message" => "Added Successfully", "data" => [
                "reload" => true
              ]];
            } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "Record Already Exists with the id " . $checkAlready["id"]];
          } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "You do not have permission to add data"];
        } else {
          if (in_array($this->ADMIN_TYPE, ["S", "A"])) {
            $checkAlready = $DB->where("record_date", $_POST["record_date"])->where("time_slot", $_POST["time_slot"])->where("id !=", $_POST["id"])->get(TABLE_SATTA_RECORDS)->row_array();
            if (!$checkAlready) {
              $DB->update(TABLE_SATTA_RECORDS, $iData, ["id" => $_POST["id"]]);
              $RES = ["status" => true, "status_code" => 200, "status_key" => "SUCCESS", "message" => "Updated Successfully", "data" => [
                "reload" => true
              ]];
            } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "Record Already Exists with the id " . $checkAlready["id"]];
          } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => "You do not have permission to update data"];
        }
        $DB->close();
      } else $RES = ["status" => false, "status_code" => 400, "status_key" => "ERROR", "message" => validation_errors()];
      echo json_encode($RES);
      exit();
    }

    $colArr = ["id", "record_date", "time_slot", "satta_number"];
    $whereCon = [];
    foreach ($_GET as $k => $v) if (in_array($k, $colArr)) $whereCon[$k] = $v;

    $DB = $this->load->database("default", true);
    if (isset($_GET["limit"]) && $_GET["limit"] > 0) $DB->limit($_GET["limit"]);
    if (!empty($whereCon)) $DB->where($whereCon);
    $TABLE_DATA = $DB->get(TABLE_SATTA_RECORDS)->result_array();
    $DB->close();
    $DATA["TABLE_DATA"] = $TABLE_DATA;
    $DATA["TABLE_NAME"] = TABLE_SATTA_RECORDS;

    $DATA["META_TITLE"] = "Satta Records";
    $this->load->view("admin/records/satta-records", $DATA);
  }
}
