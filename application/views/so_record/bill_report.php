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


<p><br>Following are the Billing details of the project:</p>
<hr>

<div id="table_div">
  <?php if (count($project_record) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:small; width: auto !important;table-layout: auto !important;">
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
                                            <th scope="col">Files</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 1;
        foreach ($project_record as $data) {
          //$diff = date_diff(date_create($data['schedule_start_date']), date_create($data['schedule_end_date'])); ?>
          <tr>
            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
            <!-- <td scope="row"><?= $data['progress_date']; ?></td> -->
            <td scope="row"><?= $data['date_added']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['bill_no']; ?></td>
            <td scope="row" style='white-space: nowrap;'><?= $data['gross_work_done']; ?></td>
            <td scope="row"><?= $data['wd_in_bill']; ?>%</td>
            <td scope="row"><?= $data['rm_deducted']; ?></td>
            <td scope="row" style=""><?= $data['checque_no']; ?></td>
             <td scope="row"><?= $data['it_deducted']; ?>%</td>
            <td scope="row"><?= $data['bill_file_attach_1']; ?></td>
          
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