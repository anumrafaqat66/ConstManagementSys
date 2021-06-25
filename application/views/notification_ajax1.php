<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    <!-- Counter - Alerts -->
    <?php if (count($notification_data) != 0) { ?>
        <span id="badge_count_activity" class="badge badge-danger badge-counter"><?= count($notification_data) ?> </span>
    <?php }  ?>

</a>
<!-- Dropdown - Alerts -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
        Notifications
    </h6>
    <?php if (count($notification_data) > 0) { ?>
        <?php foreach ($notification_data as $data) { ?>
            <a class="dropdown-item d-flex align-items-center"  href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500"><?= date("D-H:i", strtotime($data['activity_date'])) ?></div>
                    <span class="font-weight-bold"><?= $data['activity_detail'] ?></span>
                </div>
            </a>
        <?php }
    } else { ?>
        <div>
            <div style="padding:10px">
                <b>No New Notifications </b>
            </div>
        </div>
    <?php } ?>
    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications </a>
</div>