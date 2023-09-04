<?php
$controller = $this->request->params['controller'];
$action = $this->request->params['action'];
$check_eventoffice = $this->Comman->checkeventoffice($id);
$singleeventdetail = $this->Comman->singleeventdetail($id);
?>

<div class="sidebar ">

    <div class="side_menu_icon ">
        <i class="bi bi-arrow-left-short"></i>
    </div>

    <ul class="list-unstyled components2">
        <li class="mb-3"> <a style="background-color:#ff9800; " href="<?php echo SITE_URL; ?>event/postevent"><i class="bi bi-calendar2-event"></i><span> Create Event </span></a></li>
        <?php if (!empty($id)) {  ?>
            <?php $event_detail_single = $this->Comman->findeventdetail($id);  ?>
            <li> <a href="<?php echo SITE_URL; ?>event/<?php echo $event_detail_single['slug']; ?>" target="_blank"><i class="bi bi-eye-fill"></i><span> View Event </span></a></li>
        <?php } ?>
    </ul>
    <ul class="list-unstyled components">
        <li> <a href="<?php echo SITE_URL; ?>event/myevent" id="menu-group-dashboard"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span> </a></li>
        <?php if (!empty($id)) { ?>
            <li class="<?= ($controller == "Event" && $action == "settings" || $action == "generalsetting") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-sliders"></i><span> Settings</span></a></li>
            
            <li class="menu_line"></li>
            <?php if ($singleeventdetail['is_free'] == 'Y') { ?>
                <li class="<?= ($controller == "Event" && $action == "attendees") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/attendees/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-ticket-perforated"></i> <span>Manage Attendees</span></a></li>
            <?php } ?>
            
            <li class="<?= ($controller == "Event" && $action == "payments") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/payments/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-credit-card"></i> <span>Payments</span></a></li>
            <li class="<?= ($controller == "Event" && $action == "analytics") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/analytics/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-bar-chart"></i> <span>Analytics</span></a></li>
            <li class="<?= ($controller == "Event" && $action == "payouts") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/payouts/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-wallet2"></i> <span>Payouts</span></a></li>
            <li class="<?= ($controller == "Event" && $action == "exporttickets") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/exporttickets/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-wallet2"></i> <span>Export Tickets</span></a></li>
            <!-- <li class="menu_line"></li> -->
            <?php if ($singleeventdetail['is_free'] == 'N') { ?>
                <li class="<?= ($controller == "Event" && $action == "committee" || $action == "committeetickets" || $action == "committeegroups") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-people"></i> <span>Committee</span></a></li>

                <li class="<?= ($controller == "Event" && $action == "manage" || $action == "addons" || $action == "questions" || $action == "generalsetting") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-ticket-perforated"></i> <span> Tickets</span></a></li>

            <?php } ?>
            <li class="<?= ($controller == "Reports" && $action == "ticketreports") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>reports/ticketreports/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-ticket-perforated"></i> <span>Ticket Reports</span></a></li>
            <?php if ($check_eventoffice) { ?>
                <li class="<?= ($controller == "Eventoffice" && $action == "index") ? "active" : "" ?>"> <a href="<?php echo SITE_URL; ?>eventoffice/index/<?php echo $id; ?>" id="menu-group-dashboard"> <i class="bi bi-postage"></i> <span>Event Office</span></a></li>
            <?php } ?>

        <?php } ?>
        <li class="menu_line"></li>

        <li>
            <nav class="navbar navbar-expand-lg navbar-dark sidmenub w-100">
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span> Account</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>tickets/myticket"><i class="bi bi-ticket-perforated"></i><span>My Tickets</span></a></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>users/viewprofile"><i class="bi bi-person"></i><span>Profile</span></a></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>logins/frontlogout"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </li>

    </ul>


</div>