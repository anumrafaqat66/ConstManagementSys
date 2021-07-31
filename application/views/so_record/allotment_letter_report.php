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
    <h2><strong>Project Allotment Letters</strong></h2>
    <!-- <h2><strong><?= $project_name['Name'] ?></strong></h2> -->
    <hr style="border-top: 1px solid black">
  </div>
</div>

<p><br>Following are the List of project allotment Letters:</p>
<hr>

<div id="table_div">
  <?php if (count($project_record) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:small;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col" style="white-space:nowrap">Project Name</th>
          <th scope="col" style="white-space:nowrap">Received Date</th>
          <th scope="col" style="white-space:nowrap">Dispatched Date</th>
          <th scope="col" style="white-space:nowrap">Officer Name</th>
          <th scope="col">File Name</th>
          <!-- <th scope="col">View</th> -->
          <?php if ($this->session->userdata('acct_type') == "admin_super") { ?>
            <th scope="col">Region</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_record as $data) {
          //$diff = date_diff(date_create($data['schedule_start_date']), date_create($data['schedule_end_date'])); 
        ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
            <td scope="row" style="white-space:nowrap"><b><?= $data['Name']; ?></b></td>
            <td scope="row" style="white-space:nowrap"><?= $data['received_date']; ?></td>
            <td scope="row" style="white-space:nowrap"><?= $data['dispatch_date']; ?></td>
            <td scope="row" style="white-space:nowrap"><?= $data['officer_name']; ?></td>
            <td scope="row"><?= $data['file_name']; ?></td>
            <!-- <td type="button" class="edit" scope="row"><a style="color:black;" href="<?= base_url(); ?>uploads/project_allotment_letter/<?= $data['file_name']; ?>"><i style="margin-left: 10px;" class="fas fa-eye"></i></a></td> -->
            <?php if ($this->session->userdata('acct_type') == "admin_super") { ?>
              <td scope="row"><?= $data['region']; ?></td>
            <?php } ?>
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

<!-- <div class="clearfix"></div> -->
<!-- <div class="clearfix"></div> -->
<!-- <div class="fixed-bottom" style="float:left;font-size:small">
  This document is auto genarated, it do not require signature.
</div> -->

</html>