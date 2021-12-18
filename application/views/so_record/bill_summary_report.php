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
    <h2><strong>Bills Summary of</strong></h2>
    <h2><strong><?= $projects['Name'] ?></strong></h2>
    <hr style="border-top: 1px solid black">
  </div>
</div>

<p><br>Following are the bill summary of the project:</p>
<hr>

<div id="table_div">
  <?php
  $total_contract_amount = 0;
  $total_paid_till_last_bill = 0;
  $total_payment_made = 0;
  $total_claim_amount = 0;
  $total_verified_amount = 0;
  $total_total_verified_amount = 0;
  if (count($project_record) > 0) { ?>
    <table id="datatable" class="table table-bordered" style="color:black;font-size:xx-small;">
      <thead style="background-color:lightgray">
        <tr>
          <th scope="col">S. No.</th>
          <th scope="col">Description</th>
          <th scope="col">Contract Amount</th>
          <th scope="col">Paid till Last Running Bill</th>
          <th scope="col">Payment Made</th>
          <th scope="col">Amount Claim in this Bill</th>
          <th scope="col">Amount Verified in this Bill</th>
          <th scope="col">Total Verified Amount</th>
        </tr>
      </thead>
      <tbody id="table_rows_project">
        <?php $count = 0;
        foreach ($project_record as $data) {
          $total_contract_amount = $total_contract_amount +  $data['contract_amount'];
          $total_paid_till_last_bill = $total_paid_till_last_bill +  $data['paid_till_last_bill'];
          $total_payment_made = $total_payment_made +  $data['payment_made'];
          $total_claim_amount = $total_claim_amount +  $data['claim_amount'];
          $total_verified_amount = $total_verified_amount +  $data['verified_amount'];
          $total_total_verified_amount = $total_total_verified_amount +  $data['verified_amount'];
        ?>
          <tr>
            <td scope="row"><?= ++$count; ?></td>
            <td scope="row"><?= $data['bill_description']; ?></td>
            <td scope="row">PKR <?php echo number_format($data['contract_amount'], 2); ?></td>
            <td scope="row">PKR <?php echo number_format($data['paid_till_last_bill'], 2); ?></td>
            <td scope="row">PKR <?php echo number_format($data['payment_made'], 2); ?></td>
            <td scope="row">PKR <?php echo number_format($data['claim_amount'], 2); ?></td>
            <td scope="row"><?php echo number_format($data['verified_amount'], 2); ?></td>
            <td scope="row">PKR <?php echo number_format($total_verified_amount, 2); ?></td>
          </tr>
        <?php } ?>
        <tr>
          <th scope="col" colspan="2">Total:</th>
          <th scope="col">PKR. <?php echo number_format($total_contract_amount, 2); ?></th>
          <th scope="col">PKR. <?php echo number_format($total_paid_till_last_bill, 2); ?></th>
          <th scope="col">PKR. <?php echo number_format($total_payment_made, 2); ?></th>
          <th scope="col">PKR. <?php echo number_format($total_claim_amount, 2); ?></th>
          <th scope="col">PKR. <?php echo number_format($total_verified_amount, 2); ?></th>
          <th scope="col">PKR. <?php echo number_format($total_total_verified_amount, 2); ?></th>
        </tr>
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