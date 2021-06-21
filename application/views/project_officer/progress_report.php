<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">


<div class="container my-3">
  <div style="height:100px">
    <h1><strong>Project Complete Report</strong></h1>
    <hr style="border-top: 1px solid black">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Project Name:</th>
        <th><?= $project_record['Name'] ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Project Start Date:</th>
        <th><?= $project_record['Start_date'] ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Project Status</th>
        <th><?= $project_record['Status'] ?></th>
      </tr>
    </thead>
  </table>
</div>

<hr>

<!-- <h5>Dear <?= $user_data['name'] . ' ' . $user_data['surname']; ?></h5> -->
<p><br>Following are the current progress details of the project:</p>


<div id="table_div">
  <?php if (count($project_progress) > 0) { ?>
    <table id="datatable" class="table table-striped" style="color:black">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col" style="width:140px">Progress Date</th>
          <th scope="col" style="width:140px">Task Name</th>
          <th scope="col" style="width:120px">Progress %</th>
          <th scope="col">Details</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_progress as $data) { ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $data['id'];; ?></td>
            <td scope="row"><?= $data['progress_date']; ?></td>
            <td scope="row"><?= $data['schedule_name']; ?></td>
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



<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="fixed-bottom" style="float:left;">
  This document is auto genarated, it do not require signature.
</div>

</html>