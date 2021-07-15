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
    <h2><strong>Inventory Report</strong></h2>
    <hr style="border-top: 1px solid black">
  </div>
</div>

<div id="table_div">
  <?php if (count($inventory_record) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">S. No</th>
          <th scope="col">Material Name</th>
          <th scope="col">Quantity Available</th>
          <th scope="col">Total Price</th>
          <th scope="col">Unit</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($inventory_record as $data) { ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
            <td scope="row"><?= $data['Material_Name']; ?></td>
            <td scope="row"><?= $data['Material_Total_Quantity']; ?></td>
            <td scope="row">PKR. <?= $data['Material_Total_Price']; ?></td>
            <td scope="row"><?= $data['Unit']; ?></td>
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