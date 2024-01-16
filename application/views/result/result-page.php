<!DOCTYPE html>
<html lang="en"><!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <title>BBL Satta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/new.css') ?>">
  <meta name="robots" content="noindex, nofollow">
  <style>
    body {
      background-color: #f5f9d0 !important;
    }
  </style>
</head>

<body style="background-color:#a7c9168c !important">

  <style>
    .form_styling {
      display: flex;
      justify-content: center;
    }

    .date_button_style {
      width: 130px;
      margin-right: 10px;
    }
  </style>

  <section class="marquee_wrapper" style="background:#0f3562;">
    <div class="satta_banner_heading">
      <h2 style="color:red;">BBL Real Satta</h2>
    </div>
  </section>
  <section class="phli_news">
    <div class="container">
      <p id="phliNewsTime"><?php echo date("D, d-m-Y", strtotime($RESULT_DATE)) ?></p>
      <img src="https://bblsatta.com/profile_asset/images/down.gif">
      <p class="hindi_text" style="color:#24a699;">!! हाँ भाई यहीं आती हे सबसे पहले खबर रूको और देखो !!</p>
      <h2>BBL SATTA</h2>
      <form method="POST">
        <div class="form_styling">
          <input class="form-control date_button_style" type="date" name="result_date" min="<?php echo date("Y-m-d", strtotime("-1 month")) ?>" value="<?php echo date("Y-m-d", strtotime($RESULT_DATE)) ?>" max="<?php echo date("Y-m-d") ?>">
          <input class="btn btn-primary" type="submit" value="Submit">
        </div>
      </form>
    </div>
  </section>

  <section class="octoberresultchart">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Result Chart of <?php echo date("d M Y", strtotime($RESULT_DATE)) ?></h1>
        </div>
      </div>
    </div>
  </section>

  <section class="newtable">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="p-0">
          <tr>
            <th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
              <strong class="fon">Date</strong>
            </th>
            <?php
            $begin = new DateTime(date('Y-m-d 09:00:00'));
            $end = new DateTime(date('Y-m-d 12:00:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              echo '<th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
                <strong class="fon">' . $i->format("h:i A") . '</strong>
              </th>';
            }
            ?>
          </tr>
        </thead>
        <tbody class="colorchange">
          <tr>
            <td class="text-center forfirtcolor" style="background:#0f3562;"><?php echo date("d-m-Y", strtotime($RESULT_DATE)) ?></td>
            <?php
            $begin = new DateTime(date('Y-m-d 09:00:00'));
            $end = new DateTime(date('Y-m-d 12:00:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              $tResult = "XX";
              if (isset($RECORDS[$i->format("H:i")])) $tResult = $RECORDS[$i->format("H:i")];
              echo '<td class="text-center" style="background:red; color:#fff; border:1px solid #fff;">' . $tResult . '</td>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <section class="newtable">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="p-0">
          <tr>
            <th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
              <strong class="fon">Date</strong>
            </th>
            <?php
            $begin = new DateTime(date('Y-m-d 12:20:00'));
            $end = new DateTime(date('Y-m-d 15:20:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              echo '<th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
                <strong class="fon">' . $i->format("h:i A") . '</strong>
              </th>';
            }
            ?>
          </tr>
        </thead>
        <tbody class="colorchange">
          <tr>
            <td class="text-center forfirtcolor" style="background:#0f3562;"><?php echo date("d-m-Y", strtotime($RESULT_DATE)) ?></td>
            <?php
            $begin = new DateTime(date('Y-m-d 12:20:00'));
            $end = new DateTime(date('Y-m-d 15:20:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              $tResult = "XX";
              if (isset($RECORDS[$i->format("H:i")])) $tResult = $RECORDS[$i->format("H:i")];
              echo '<td class="text-center" style="background:red; color:#fff; border:1px solid #fff;">' . $tResult . '</td>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <section class="newtable">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="p-0">
          <tr>
            <th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
              <strong class="fon">Date</strong>
            </th>
            <?php
            $begin = new DateTime(date('Y-m-d 15:40:00'));
            $end = new DateTime(date('Y-m-d 18:40:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              echo '<th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
                <strong class="fon">' . $i->format("h:i A") . '</strong>
              </th>';
            }
            ?>
          </tr>
        </thead>
        <tbody class="colorchange">
          <tr>
            <td class="text-center forfirtcolor" style="background:#0f3562;"><?php echo date("d-m-Y", strtotime($RESULT_DATE)) ?></td>
            <?php
            $begin = new DateTime(date('Y-m-d 15:40:00'));
            $end = new DateTime(date('Y-m-d 18:40:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              $tResult = "XX";
              if (isset($RECORDS[$i->format("H:i")])) $tResult = $RECORDS[$i->format("H:i")];
              echo '<td class="text-center" style="background:red; color:#fff; border:1px solid #fff;">' . $tResult . '</td>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <section class="newtable">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="p-0">
          <tr>
            <th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
              <strong class="fon">Date</strong>
            </th>
            <?php
            $begin = new DateTime(date('Y-m-d 19:00:00'));
            $end = new DateTime(date('Y-m-d 22:00:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              echo '<th class="table_chart_section_01 forfirtcolor text-center" style="background:#0f3562; color:#fff;">
                <strong class="fon">' . $i->format("h:i A") . '</strong>
              </th>';
            }
            ?>
          </tr>
        </thead>
        <tbody class="colorchange">
          <tr>
            <td class="text-center forfirtcolor" style="background:#0f3562;"><?php echo date("d-m-Y", strtotime($RESULT_DATE)) ?></td>
            <?php
            $begin = new DateTime(date('Y-m-d 19:00:00'));
            $end = new DateTime(date('Y-m-d 22:00:00'));
            for ($i = $begin; $i <= $end; $i->modify("+20 minutes")) {
              $tResult = "XX";
              if (isset($RECORDS[$i->format("H:i")])) $tResult = $RECORDS[$i->format("H:i")];
              echo '<td class="text-center" style="background:red; color:#fff; border:1px solid #fff;">' . $tResult . '</td>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

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