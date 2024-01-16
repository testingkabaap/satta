<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CAuth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		/* BEGIN:: ADMIN LOGIN MANAGEMENT */
		if (!$this->session->userdata(SESSION_ADMIN_DETAILS)) {
			$this->load->model("helper/MCookie");
			$checkAdminLoginCookie = json_decode($this->MCookie->_get_encrypt_cookie(ADMIN_LOGIN_COOKIE), true);
			if (!empty($checkAdminLoginCookie)) {
				if (isset($checkAdminLoginCookie["id"])) {
					$DB = $this->load->database("default", true);
					$checkAdmin = $DB->where("id", $checkAdminLoginCookie["id"])->where("password", md5($_POST["password"]))->get(TABLE_ADMIN)->row_array();
					$DB->close();
					if ($checkAdmin && $checkAdmin["status"] == 1) {
						$this->session->set_userdata(SESSION_ADMIN_DETAILS, $checkAdmin);
					} else {
						$this->MCookie->_delete_cookie(ADMIN_LOGIN_COOKIE);
					}
				} else {
					$this->MCookie->_delete_cookie(ADMIN_LOGIN_COOKIE);
				}
			}
		}
		/* END:: ADMIN LOGIN MANAGEMENT */
	}

	public function login()
	{
		if (!$this->session->userdata(SESSION_ADMIN_DETAILS)) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$this->load->library("form_validation");
				$this->form_validation->set_rules('admin_email', '<b>Email</b>', 'required|valid_email|max_length[100]');
				$this->form_validation->set_rules('password', '<b>Password</b>', 'required|min_length[8]|max_length[20]');
				$this->form_validation->set_error_delimiters('', '');
				if ($this->form_validation->run()) {
					$_POST["admin_email"] = strtolower($_POST["admin_email"]);
					$DB = $this->load->database("default", true);
					$checkAdmin = $DB->where("admin_email", $_POST["admin_email"])->where("password", md5($_POST["password"]))->get(TABLE_ADMIN)->row_array();
					if ($checkAdmin) {
						if ($checkAdmin["status"] == 1) {
							$this->session->set_userdata(SESSION_ADMIN_DETAILS, $checkAdmin);
							$this->load->model("helper/MCookie");
							$this->MCookie->_set_encrypt_cookie(ADMIN_LOGIN_COOKIE, json_encode($checkAdmin));

							/* BEGIN:: UPDATE LOGIN IP DETAILS */
							$this->load->model("helper/MHelper");
							$this->MHelper->save_login_details("admin", $checkAdmin["id"]);
							$DB->update(TABLE_ADMIN, ["last_login" => date("Y-m-d H:i:s"), "login_ip" => $this->MHelper->get_client_ip()], ["id" => $checkAdmin["id"]]);
							/* END:: UPDATE LOGIN IP DETAILS */

							$RES = ["status" => true, "status_code" => 200, "status_key" => "success", "message" => "Login Successful", "data" => [
								"reload" => true,
								"reload_time" => 500,
								"clear_form" => true
							]];
						} else $RES = ["status" => false, "status_code" => 400, "status_key" => "error", "message" => "Your account is blocked."];
					} else $RES = ["status" => false, "status_code" => 400, "status_key" => "error", "message" => "Invalid Email or Password."];
					$DB->close();
				} else $RES = ["status" => false, "status_code" => 400, "status_key" => "error", "message" => validation_errors()];
				echo json_encode($RES);
				exit();
			}
			$DATA["page_name"] = "page/1";
			$this->load->view('admin/auth/login', $DATA);
		} else {
			$this->load->library('user_agent');
			if ($this->agent->is_referral()) {
				$refer =  $this->agent->referrer();
				redirect($refer);
			} else redirect(ADMIN_SLUG);
		}
	}

	public function forgot_password()
	{
		if (!$this->session->userdata(SESSION_ADMIN_DETAILS)) {
			$DATA["page_name"] = "page/1";
			$this->load->view('admin/auth/forgot-password', $DATA);
		} else {
			$this->load->library('user_agent');
			if ($this->agent->is_referral()) {
				$refer =  $this->agent->referrer();
				redirect($refer);
			} else redirect(ADMIN_SLUG);
		}
	}

	public function logout()
	{
		$this->load->model("helper/MCookie");
		$this->session->unset_userdata(SESSION_ADMIN_DETAILS);
		$this->MCookie->_delete_cookie(ADMIN_LOGIN_COOKIE);
		redirect(ADMIN_SLUG . "/login");
	}
}
