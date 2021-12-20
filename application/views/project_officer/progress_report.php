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
    /* float:left; */
  }
</style>

<link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">



<div class="container my-3" style="font-size:small">
  <div style="height:150px; text-align:center">
    <img class="img-logo" src="<?= base_url() ?>assets/img/navy_logo.png" alt="">
    <h1><strong>NHS PMS</strong></h1>
    <h3><strong>Project Complete Report</strong></h3>
    <hr style="border-top: 1px solid black">
  </div>

  <table class="table table-bordered" style="color:black">
    <thead style="background-color:lightgray">
      <tr>
        <th scope="col">Project Name:</th>
        <th><?php if(isset($project_record['Name'])) {echo $project_record['Name']; } else {echo '';} ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Project Start Date:</th>
        <td><?php if(isset($project_record['Start_date'])) {echo $project_record['Start_date'];} else { echo ''; } ?></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Project Status</th>
        <td><?php if(isset($project_record['Status'])) {echo $project_record['Status'];} else { echo ''; } ?></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Assigned Contractor</th>
        <td><?php if(isset($project_record['contractor_name'])) {echo $project_record['contractor_name'];} else { echo ''; } ?></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Assigned Bid</th>
        <td>PKR. <?php if(isset($project_record['bid_amount'])) {echo $project_record['bid_amount'];} else { echo '0.00'; } ?>/-</td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Overall Progress</th>

        <?php if (isset($project_record['total_rows'])) {
          if ($project_record['total_rows'] == 0) {
            $num = 1;
          } else {
            $num = $project_record['total_rows'];
          }
        } ?>
        <td><?php if(isset($project_record['total_percentage'])) {echo round($project_record['total_percentage'] / $num, 2);} else { echo '0.00'; } ?></td>
      </tr>
    </thead>
  </table>

</div>

<p><br>Following are the current progress details of the project:</p>
<hr>

<div id="table_div">
  <?php if (count($project_progress) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:small; width: auto !important;table-layout: auto !important;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">ID</th>
          <!-- <th scope="col" style="width:140px">Progress Date</th> -->
          <th scope="col">Task Name</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Duration</th>
          <th scope="col">Progress %</th>
          <th scope="col">Details</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_progress as $data) {
          $diff = date_diff(date_create($data['schedule_start_date']), date_create($data['schedule_end_date'])); ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $data['id'];; ?></td>
            <!-- <td scope="row"><?= $data['progress_date']; ?></td> -->
            <td scope="row"><?= $data['schedule_name']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['schedule_start_date']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['schedule_end_date']; ?></td>
            <td scope="row"><?php echo $diff->format('%d days'); ?></td>
            <td scope="row"><?= $data['progress_percentage']; ?>%</td>
            <td scope="row"><?= $data['progress_description']; ?></td>
            <td scope="row" style="display:none"><?= $data['task_id']; ?></td>
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