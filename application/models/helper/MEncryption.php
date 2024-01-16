<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MEncryption extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function _encrypt($data)
  {
    $this->load->library('encryption');
    return $this->encryption->encrypt($data);
  }
  public function _decrypt($data)
  {
    $this->load->library('encryption');
    return $this->encryption->decrypt($data);
  }
}
