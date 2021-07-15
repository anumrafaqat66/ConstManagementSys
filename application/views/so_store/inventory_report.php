<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container my-3" style="font-size:small">
  <div style="height:100px">
    <h1><strong>Inventory  Report</strong></h1>
    <hr style="border-top: 1px solid black">
  </div>
  <table class="table table-bordered" style="color:black">
    <thead style="background-color:lightgray">
      <tr>
        <th scope="col">Material Name:</th>
        <th><?= $inventory_record['Material_Name'] ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col"> Total Qantity:</th>
        <td><?= $inventory_record['Material_Total_Quantity'] ?></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Total Price</th>
        <td><?= $inventory_record['Material_Total_Price'] ?></td>
      </tr>
    </thead>
 
    <thead>
      <tr>
        <th scope="col">Unit</th>
        <td><?= $inventory_record['Unit'] ?></td>
      </tr>
    </thead>
         <thead>
      <tr>
        <th scope="col">Cost Per Unit </th>
        <td><?= $inventory_record['cost_per_unit'] ?></td>
      </tr>
    </thead>
         <thead>
      <tr>
        <th scope="col">Stock Date </th>
        <td><?= $inventory_record['stock_date'] ?></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col">Region</th>
        <td>PKR. <?= $inventory_record['region'] ?>/-</td>
      </tr>
    </thead>
        <thead>
      <tr>
        <th scope="col">Satus</th>
        <td>PKR. <?= $inventory_record['status'] ?>/-</td>
      </tr>
    </thead>
  
  </table>
</div>

<!-- <p><br>Following are the current progress details of the project:</p>
<hr>
 -->
<!-- <div id="table_div">
  <?php if (count($project_progress) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:small; width: auto !important;table-layout: auto !important;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">ID</th> -->
          <!-- <th scope="col" style="width:140px">Progress Date</th> -->
         <!--  <th scope="col">Task Name</th>
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
            <td scope="row" id="cont<?= $count; ?>"><?= $data['id'];; ?></td> -->
            <!-- <td scope="row"><?= $data['progress_date']; ?></td> -->
           <!--  <td scope="row"><?= $data['schedule_name']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['schedule_start_date']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['schedule_end_date']; ?></td>
            <td scope="row"><?php echo $diff->format('%d days'); ?></td>
            <td scope="row"><?= $data['progress_percentage']; ?>%</td>
            <td scope="row"><?= $data['progress_description']; ?></td>
            <td scope="row" style="display:none"><?= $data['task_id']; ?></td>
          </tr> -->
       <!--  <?php
          $count++;
        } ?>
      </tbody>
    </table> -->
  <!-- <?php } else { ?>
    <a> No Data Available yet </a>
  <?php } ?>
</div> -->

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


