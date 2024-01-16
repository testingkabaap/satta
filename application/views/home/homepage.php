<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>BBL Satta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/new.css') ?>">
  <meta name="robots" content="">
  <style>
    body {
      background-color: #f5f9d0 !important;
    }
  </style>
</head>







<body style="background-color:#eef2009e !important;">

  <section class="head_marquee home">
    <img class="ban_img" src="<?php echo base_url('assets/images/sattaBanner.jpg') ?>">
    <div class="container-fluid">
      <div class="heading">
        <h2>
          WELCOME
          <br>
          TO
          <br>
          <strong>
            BBL Lottry Satta
          </strong>
        </h2>

      </div>
      <marquee onmouseover="this.stop();" onmouseout="this.start();">
        <h2>
          बी.बी.एल रियल सट्टा में आपका स्वागत है
        </h2>

      </marquee>
      <h3 id="demo"></h3>
    </div>

  </section>

  <?php if (isset($TODAY_RECORDS) && !empty($TODAY_RECORDS)) {
    $lastIndex = array_key_last($TODAY_RECORDS);
  ?>
    <div class="latest_result">
      <div>
        <h2>Today Latest Result</h2>
        <h3>BBL Lottry Satta</h3>
        <p>(Time: <?php echo date("h:i A", strtotime($lastIndex)) ?>)</p>
        <div class="d-flex justify-content-center">
          <div>
            <center><img src="<?php echo base_url('assets/images/down.gif'); ?>"></center>
            <div class="number_lottry align-items-center" style="font-size: 40px; font-weight: bold; background: red; color: #fff;">
              <span><?php echo $TODAY_RECORDS[$lastIndex]; ?></span>
            </div>
            <center><img src="<?php echo base_url('assets/images/new2.gif'); ?>" width="30%"></center>
          </div>
        </div>
        <!-- <p>Result out in <strong id="current-time"></strong></p> -->
      </div>
    </div>
  <?php } ?>
  

  <div class="card-row" id="cardContainer">
    <?php
    $begin = new DateTime(date('Y-m-d 09:00:00'));
    $end = new DateTime(date('Y-m-d 22:00:00'));
    for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
      $tResult = "XX";
      $pResult = "XX";

      if (isset($TODAY_RECORDS[$i->format("H:i")])) $tResult = $TODAY_RECORDS[$i->format("H:i")];
      if (isset($PREV_RECORDS[$i->format("H:i")])) $pResult = $PREV_RECORDS[$i->format("H:i")];
      echo '<div class="result_box_card">
                  <div>
                    <h2>BBL SATTA</h2>
                    <p>(Time: ' . $i->format("h:i A") . ')</p>
                    <div class="time">
                      <span id="yesterday">' . $pResult . '</span>
                      <img src="' . base_url('assets/images/new2.gif') . '">
                      <span id="today" class="new">' . $tResult . '</span>
                    </div>
                    <a href="' . site_url('result') . '" class="view_chart">View Chart</a>
                  </div>
                </div>';
    }
    ?>
  </div>

  <section class="news_letter">
    <marquee>
      <div class="emai_wrap">
        <a href="https://api.whatsapp.com/send?phone=Only%20for%20WhatsApp" class="whatsapp_icon" target="_blank" rel="noopener noreferrer">
          Contact Us : +91-Only for WhatsApp (Only Whatsaap)
        </a>
        <a href="#" target="_blank">
          Email : bblsattalottarysatta@gmail.com </a>
      </div>
    </marquee>

  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="<?php echo site_url() ?>" target="_blank">BBL SATTA</a>
        </div>
        <div class="col-md-3">
          <a href="<?php echo site_url() ?>" target="_blank">BBL SATTA</a>
        </div>
        <div class="col-md-3">
          <a href="<?php echo site_url() ?>" target="_blank">BBL SATTA</a>
        </div>
        <div class="col-md-3">
          <a href="<?php echo site_url() ?>" target="_blank">BBL SATTA</a>
        </div>
      </div>
    </div>
  </section>
</body>

</html>