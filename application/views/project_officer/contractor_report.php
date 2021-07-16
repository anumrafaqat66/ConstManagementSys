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
    <h2><strong>Contractor List Report</strong></h2>
    <hr style="border-top: 1px solid black">
  </div>
</div>

<div id="table_div">
  <?php if (count($contractor_records) > 0) { ?>
    <table id="datatable" class="table table-striped" style="color:black">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Full Name</th>
          <th scope="col">Contact No</th>
          <th scope="col">Email</th>
          <th scope="col">Register Date</th>
          <!-- <th scope="col">Assigned Projects</th> -->
          <!-- <th scope="col">Completed Projects</th> -->
          <?php if ($this->session->userdata('region') == "admin_super") { ?>
            <th scope="col">Region</th>
          <?php } ?>

        </tr>
      </thead>
      <tbody id="table_rows_cont">
        <?php $count = 0;
        foreach ($contractor_records as $data) { ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $data['ID']; ?></td>
            <td scope="row"><?= $data['Name']; ?></td>
            <td id="quant<?= $data['ID']; ?>" class="quant" scope="row"><?= $data['Contact_no']; ?></td>
            <td scope="row"><?= $data['Email_id']; ?></td>
            <td scope="row" style="white-space:nowrap"><?= $data['Start_date']; ?></td>
            <!-- <td scope="row" id="assigned_project<?= $count; ?>" style="text-align:center; background-color:darksalmon; cursor: pointer;" data-toggle="modal" data-target="#assigned_projects"><?= $data['Assigned_Projects']; ?></td> -->
            <!-- <td scope="row" id="completed_project<?= $count; ?>" style="text-align:center; background-color:darksalmon; cursor: pointer;" data-toggle="modal" data-target="#completed_projects"><?= $data['Completed_Projects']; ?></td> -->
            <?php if ($this->session->userdata('region') == "admin_super") { ?>
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



<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="fixed-bottom" style="float:left;font-size:small">
  This document is auto genarated, it do not require signature.
</div>

</html>