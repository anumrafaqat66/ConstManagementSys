<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<style>
  .img-logo {
    background: url('<?= base_url() ?>assets/img/navy_logo.png');
    background-size: cover;
    height: 50px;
    width: 39px;
  }
</style>

<link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container my-3" style="font-size:small">
  <div style="height:200px; text-align:center">
    <img class="img-logo" src="<?= base_url() ?>assets/img/navy_logo.png" alt="">
    <h1><strong>NHS PMS</strong></h1>
    <h2><strong>Billing Detail of</strong></h2>
    <h2><strong><?= $project_name['Name'] ?></strong></h2>
    <hr style="border-top: 1px solid black">
  </div>
</div>

<p><br>Following are the Billing details of the project:</p>
<hr>

<div id="table_div">
  <?php if (count($project_record) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:small; width: 100% !important;table-layout: auto !important;white-space:nowrap">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Bill No.</th>
          <th scope="col">Gross Work Done</th>
          <th scope="col">WD in Bill</th>
          <th scope="col">R/M Deducted</th>
          <th scope="col">Payment Made</th>
          <th scope="col">Cheque No.</th>
          <th scope="col">IT Deducted</th>
          <!-- <th scope="col">Files</th> -->
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_record as $data) {
          //$diff = date_diff(date_create($data['schedule_start_date']), date_create($data['schedule_end_date'])); 
        ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
            <td scope="row"><?= $data['date_added']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['bill_name']; ?></td>
            <td scope="row" style='white-space: nowrap;'>PKR. <?= $data['gross_work_done']; ?></td>
            <td scope="row">PKR. <?= $data['wd_in_bill']; ?></td>
            <td scope="row">PKR. <?= $data['rm_deducted']; ?></td>
            <td scope="row">PKR. <?= $data['payment_made']; ?></td>
            <td scope="row" style=""><?= $data['cheque_no']; ?></td>
            <td scope="row">PKR. <?= $data['it_deducted']; ?></td>
          </tr>
        <?php
          $count++;
        } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <a> No Data Available yet </a>
  <?php } ?>
</div>

<div class="card-body">
  <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
  <div id="nodata" style="display:none"> There are no tasks scheduled yet.</div>
</div>



<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="fixed-bottom" style="float:left;font-size:small">
  This document is auto genarated, it do not require signature.
</div>

</html>