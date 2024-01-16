<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MHelper extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function get_client_ip()
  {
    if (getenv('HTTP_CLIENT_IP')) {
      $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
      $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
      $ip = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
      $ip = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
      $ip = getenv('HTTP_FORWARDED');
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  public function userPlatform()
  {
    $this->load->library('user_agent');
    if ($this->agent->is_mobile()) {
      $agent = $this->agent->mobile() . ', ' . $this->agent->browser() . ' ' . $this->agent->version();
    } elseif ($this->agent->is_browser()) {
      $agent = $this->agent->browser() . ' ' . $this->agent->version();
    } elseif ($this->agent->is_robot()) {
      $agent = $this->agent->robot();
    } else {
      $agent = $this->agent->agent_string();
    }
    return $agent . ', ' . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
  }


  /*
  |----------------------------------------------------------
  | CURL Request Maker
  |----------------------------------------------------------
  | Required Parameters
  | URL
  | Optional Parameters
  | params = [data,request,header] 
  |
  */
  public function curlRequest($URL, $options = [])
  {
    // get data
    $body_data = ((isset($options['data'])) ? $options['data'] : '');
    $request_method = ((isset($options['request']) && $options['request'] != "") ? strtoupper($options['request']) : 'GET');
    $link_query = ((isset($options['link_query'])) ? $options['link_query'] : false);

    //link query builder
    if ($link_query != false && !empty($link_query)) $URL = $URL . '?' . $this->buildQueryString($link_query);

    //set headers
    $headerArray = [];
    if (isset($options['headers']) && !empty($options['headers'])) foreach ($options['headers'] as $k => $val) $headerArray[] = $k . ":" . $val;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $URL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $request_method,
    ));
    if (!empty($body_data)) curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data);
    if (!empty($headerArray)) curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return $response;
  }

  public function buildQueryString($query)
  {
    $query_array = array();
    foreach ($query as $key => $key_value) $query_array[] = urlencode($key) . '=' . urlencode($key_value);
    return (count($query_array) > 0) ? implode('&', $query_array) : '';
  }

  public function mime2ext($params = [])
  {
    if (isset($params['mime']) && !empty($params['mime'])) {
      $mime = $params['mime'];

      $all_mimes_json = '{"hqx":["application\/mac-binhex40","application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],"cpt":["application\/mac-compactpro"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/octet-stream","application\/vnd.ms-excel","application\/x-csv","text\/x-csv","text\/csv","application\/csv","application\/excel","application\/vnd.msexcel","text\/plain"],"bin":["application\/macbinary","application\/mac-binary","application\/octet-stream","application\/x-binary","application\/x-macbinary"],"dms":["application\/octet-stream"],"lha":["application\/octet-stream"],"lzh":["application\/octet-stream"],"exe":["application\/octet-stream","application\/x-msdownload"],"class":["application\/octet-stream"],"psd":["application\/x-photoshop","image\/vnd.adobe.photoshop"],"so":["application\/octet-stream"],"sea":["application\/octet-stream"],"dll":["application\/octet-stream"],"oda":["application\/oda"],"pdf":["application\/pdf","application\/force-download","application\/x-download","binary\/octet-stream"],"ai":["application\/pdf","application\/postscript"],"eps":["application\/postscript"],"ps":["application\/postscript"],"smi":["application\/smil"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],"xls":["application\/vnd.ms-excel","application\/msexcel","application\/x-msexcel","application\/x-ms-excel","application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls","application\/excel","application\/download","application\/vnd.ms-office","application\/msword"],"ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office","application\/msword"],"pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation","application\/x-zip","application\/zip"],"wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],"dir":["application\/x-director"],"dxr":["application\/x-director"],"dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"gz":["application\/x-gzip"],"gzip":["application\/x-gzip"],"php":["application\/x-httpd-php","application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],"php4":["application\/x-httpd-php"],"php3":["application\/x-httpd-php"],"phtml":["application\/x-httpd-php"],"phps":["application\/x-httpd-php-source"],"js":["application\/x-javascript","text\/plain"],"swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"tar":["application\/x-tar"],"tgz":["application\/x-tar","application\/x-gzip-compressed"],"z":["application\/x-compress"],"xhtml":["application\/xhtml+xml"],"xht":["application\/xhtml+xml"],"zip":["application\/x-zip","application\/zip","application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],"rar":["application\/x-rar","application\/rar","application\/x-rar-compressed"],"mid":["audio\/midi"],"midi":["audio\/midi"],"mpga":["audio\/mpeg"],"mp2":["audio\/mpeg"],"mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"aif":["audio\/x-aiff","audio\/aiff"],"aiff":["audio\/x-aiff","audio\/aiff"],"aifc":["audio\/x-aiff"],"ram":["audio\/x-pn-realaudio"],"rm":["audio\/x-pn-realaudio"],"rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],"wav":["audio\/x-wav","audio\/wave","audio\/wav"],"bmp":["image\/bmp","image\/x-bmp","image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp","image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp","application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg","image\/pjpeg"],"jpg":["image\/jpeg","image\/pjpeg"],"jpe":["image\/jpeg","image\/pjpeg"],"jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"j2k":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"jpf":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"jpg2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"jpx":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"jpm":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"mj2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"mjp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"png":["image\/png","image\/x-png"],"tiff":["image\/tiff"],"tif":["image\/tiff"],"css":["text\/css","text\/plain"],"html":["text\/html","text\/plain"],"htm":["text\/html","text\/plain"],"shtml":["text\/html","text\/plain"],"txt":["text\/plain"],"text":["text\/plain"],"log":["text\/plain","text\/x-log"],"rtx":["text\/richtext"],"rtf":["text\/rtf"],"xml":["application\/xml","text\/xml","text\/plain"],"xsl":["application\/xml","text\/xsl","text\/xml"],"mpeg":["video\/mpeg"],"mpg":["video\/mpeg"],"mpe":["video\/mpeg"],"qt":["video\/quicktime"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo","video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],"doc":["application\/msword","application\/vnd.ms-office"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document","application\/zip","application\/msword","application\/x-zip"],"dot":["application\/msword","application\/vnd.ms-office"],"dotx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document","application\/zip","application\/msword"],"xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/zip","application\/vnd.ms-excel","application\/msword","application\/x-zip"],"word":["application\/msword","application\/octet-stream"],"xl":["application\/excel"],"eml":["message\/rfc822"],"json":["application\/json","text\/json"],"pem":["application\/x-x509-user-cert","application\/x-pem-file","application\/octet-stream"],"p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],"p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7m":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/x-x509-user-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"der":["application\/x-x509-ca-cert"],"kdb":["application\/octet-stream"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"sst":["application\/octet-stream"],"csr":["application\/octet-stream"],"rsa":["application\/x-pkcs7"],"cer":["application\/pkix-cert","application\/x-x509-ca-cert"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],"mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/mp4","video\/x-f4v"],"flv":["video\/x-flv"],"webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],"m3u":["text\/plain"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],"wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],"ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg","video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz","application\/zip","application\/x-zip"],"kml":["application\/vnd.google-earth.kml+xml","application\/xml","text\/xml"],"ics":["text\/calendar"],"ical":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"7z":["application\/x-7z-compressed","application\/x-compressed","application\/x-zip-compressed","application\/zip","multipart\/x-zip"],"7zip":["application\/x-7z-compressed","application\/x-compressed","application\/x-zip-compressed","application\/zip","multipart\/x-zip"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma","video\/x-ms-asf"],"jar":["application\/java-archive","application\/x-java-application","application\/x-jar","application\/x-compressed"],"svg":["image\/svg+xml","application\/xml","text\/xml"],"vcf":["text\/x-vcard"],"srt":["text\/srt","text\/plain"],"vtt":["text\/vtt","text\/plain"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"odc":["application\/vnd.oasis.opendocument.chart"],"otc":["application\/vnd.oasis.opendocument.chart-template"],"odf":["application\/vnd.oasis.opendocument.formula"],"otf":["application\/vnd.oasis.opendocument.formula-template"],"odg":["application\/vnd.oasis.opendocument.graphics"],"otg":["application\/vnd.oasis.opendocument.graphics-template"],"odi":["application\/vnd.oasis.opendocument.image"],"oti":["application\/vnd.oasis.opendocument.image-template"],"odp":["application\/vnd.oasis.opendocument.presentation"],"otp":["application\/vnd.oasis.opendocument.presentation-template"],"ods":["application\/vnd.oasis.opendocument.spreadsheet"],"ots":["application\/vnd.oasis.opendocument.spreadsheet-template"],"odt":["application\/vnd.oasis.opendocument.text"],"odm":["application\/vnd.oasis.opendocument.text-master"],"ott":["application\/vnd.oasis.opendocument.text-template"],"oth":["application\/vnd.oasis.opendocument.text-web"]}';
      $all_mimes = json_decode($all_mimes_json, true);
      foreach ($all_mimes as $key => $value) {
        if (array_search($mime, $value) !== false) return $key;
      }
    }
    return false;
  }

  public function amount_filter($amt)
  {
    return number_format($amt, 2, ".", "");
    /* if (is_int(strpos($amt, "."))) {
      $e = explode(".", $amt);
      if (isset($e[1])) {
        $t = "";
        $s = str_split($e[1]);
        for ($i = 0; $i < sizeof($s); $i++) {
          if ($i < 2) ($t .= $s[$i]);
          else break;
        }
        $amt = $e[0] . "." . $t;
      }
    }
    return sprintf('%0.2f', $amt); */
  }

  public function save_login_details($user_type, $id)
  {
    $iData = [
      "user_id" => $id,
      "ip" => $this->get_client_ip(),
      "device" => $this->userPlatform(),
      "login_at" => date("Y-m-d H:i:s")
    ];
    if (in_array(strtolower($user_type), ["user", "admin"])) {
      $iData["user_type"] = strtolower($user_type);
      $DB = $this->load->database("default", true);
      $DB->insert(TABLE_LOGIN_HISTORY, $iData);
      $DB->close();
      return true;
    }
    return false;
  }

  public function generate_slug($string)
  {
    $string = strtolower($string);
    $string = preg_replace('/[^\p{L}\p{M}\s\p{Nd}]/u', '', $string);
    // $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
    $string = preg_replace('!\s+!', ' ', $string);
    $string = trim($string);
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return $string;
  }

  public function get_time_difference($datetime){
    $datetime1 = new DateTime();
    $datetime2 = new DateTime( $datetime );
    $interval = $datetime1->diff( $datetime2 );
    if( $interval->days > 30){
      return date('d M Y h:i A');
    } else if( $interval->days > 0 ) {
      return $interval->days.' days ago';
    } else if( $interval->h > 0 ) {
      return $interval->h.' hours ago ';
    } else if( $interval->i > 0 ) {
      return $interval->i.' minutes ago ';
    } else if( $interval->s > 0 ) {
      return $interval->s.' seconds ago ';
    } else {
      return date('d M Y h:i A');
    }
  }

  public function getUploadImageName($fileName, $size = 100)
  {
    return strtolower(str_replace(" ", "-", substr(trim(pathinfo($fileName, PATHINFO_FILENAME)), 0, $size))) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
  }
}
