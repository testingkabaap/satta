<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$DB = $this->load->database("default", true);
		$fetchTodayRecords = $DB->where('record_date', date("Y-m-d"))->order_by('time_slot', 'ASC')->get(TABLE_SATTA_RECORDS)->result_array();
		$fetchPrevRecords = $DB->where('record_date', date("Y-m-d", strtotime("-1 day")))->order_by('time_slot', 'ASC')->get(TABLE_SATTA_RECORDS)->result_array();
		$TODAY_RECORDS = [];
		$PREV_RECORDS = [];
		if ($fetchTodayRecords) {
			foreach ($fetchTodayRecords as $k => $v) $TODAY_RECORDS[date("H:i", strtotime($v["time_slot"]))] = $v['satta_number'];
		}
		if ($fetchPrevRecords) {
			foreach ($fetchPrevRecords as $k => $v) $PREV_RECORDS[date("H:i", strtotime($v["time_slot"]))] = $v['satta_number'];
		}
		$DATA['TODAY_RECORDS'] = $TODAY_RECORDS;
		$DATA['PREV_RECORDS'] = $PREV_RECORDS;
		// echo "<pre>";
		// print_r($DATA);
		// die();
		$this->load->view('home/homepage', $DATA);
	}

	public function result()
	{
		$rDate = date("Y-m-d");
		if (isset($_POST["result_date"])) $rDate = date("Y-m-d", strtotime($_POST["result_date"]));

		if (strtotime($rDate) > strtotime(date("Y-m-d")) || strtotime($rDate) < strtotime(date("Y-m-d", strtotime("-1 month")))) $rDate = date("Y-m-d");

		$DB = $this->load->database("default", true);
		$fetchTodayRecords = $DB->where('record_date', $rDate)->order_by('time_slot', 'ASC')->get(TABLE_SATTA_RECORDS)->result_array();
		$RECORDS = [];
		if ($fetchTodayRecords) {
			foreach ($fetchTodayRecords as $k => $v) $RECORDS[date("H:i", strtotime($v["time_slot"]))] = $v['satta_number'];
		}
		$DATA['RECORDS'] = $RECORDS;
		$DATA['RESULT_DATE'] = $rDate;
		// echo "<pre>";
		// print_r($DATA);
		// die();
		$this->load->view('result/result-page', $DATA);
	}
}
