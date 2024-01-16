<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MCookie extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('cookie');
  }

  public function _set_encrypt_cookie($cookieName, $data, $params = [])
  {
    $this->load->model("helper/MEncryption");
    $encData = $this->MEncryption->_encrypt($data);
    $cookieExpireTime = DEFAULT_COOKIE_EXPIRE_TIME;
    if (isset($params["cookie_expire_time"]) && $params["cookie_expire_time"] > 0) {
      $cookieExpireTime = $params["cookie_expire_time"];
    }
    if (set_cookie($cookieName, $encData, $cookieExpireTime)) {
      return true;
    } else {
      return false;
    }
  }

  public function _set_cookie($cookieName, $data, $params = [])
  {
    $cookieExpireTime = DEFAULT_COOKIE_EXPIRE_TIME;
    if (isset($params["cookie_expire_time"]) && $params["cookie_expire_time"] > 0) {
      $cookieExpireTime = $params["cookie_expire_time"];
    }
    if (set_cookie($cookieName, $data, $cookieExpireTime)) {
      return true;
    } else {
      return false;
    }
  }

  public function _get_encrypt_cookie($cookieName, $params = [])
  {
    if (get_cookie($cookieName)) {
      $this->load->model("helper/MEncryption");
      return $this->MEncryption->_decrypt(get_cookie($cookieName));
    }
    return false;
  }

  public function _get_cookie($cookieName, $params = [])
  {
    if (get_cookie($cookieName)) return get_cookie($cookieName);
    return false;
  }

  public function _delete_cookie($cookieName, $params = [])
  {
    if (get_cookie($cookieName)) {
      delete_cookie($cookieName);
      return true;
    }
    return false;
  }
}
