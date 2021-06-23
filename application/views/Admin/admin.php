<?php $this->load->view('Admin/common/header'); ?>


<div class="container-fluid my-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-black-800"><strong>Welcome to Admin Dashboard</strong></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Projects</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Projects: <?= $projects['total_project']?></div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                            <i class="fas fa-project-diagram fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Contractors</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Contractors: <?= $contractors['total_contractors']?></div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-file-signature fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Inventory
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Available: <?= $quantity['sum_qty']; ?></div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-dolly-flatbed fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Material Used</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Cost: PKR. <?= $price['sum_price']; ?></div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-tools fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Allotment Records</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Records: 8900</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="far fa-clipboard fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Running Bids</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Active Bids: 45</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-file-alt fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

</div>

</div>

<?php $this->load->view('common/footer'); ?>