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
    <h2><strong><?= $project_name['Name']; ?> Schedule Report</strong></h2>
    <hr style="border-top: 1px solid black">
  </div>
</div>

<div id="table_div">
  <?php if (count($project_schedule) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">S. No</th>
          <th scope="col">Project Name</th>
          <th scope="col">Schedule Date</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
           <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
             <th scope="col">Cost</th>
            <th scope="col">Region</th>
            <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_schedule as $data) { ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
            <td scope="row"><?= $project_name['Name']; ?></td>
            <td scope="row"><?= $data['schedule_date']; ?></td>
            <td scope="row">PKR. <?= $data['schedule_name']; ?></td>
            <td scope="row"><?= $data['schedule_description']; ?></td>
            <td scope="row"><?= $data['schedule_start_date']; ?></td>
            <td scope="row"><?= $data['schedule_end_date']; ?></td>
             <td scope="row"><?= $data['schedule_cost']; ?></td>
            <td scope="row"><?= $data['region']; ?></td>
              <td scope="row"><?= $data['Status']; ?></td>
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

<!-- <div class="card-body">
  <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
  <div id="nodata" style="display:none"> There are no tasks scheduled yet.</div>
</div> -->



<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="fixed-bottom" style="float:left;font-size:small">
  This document is auto genarated, it do not require signature.
</div>

</html>