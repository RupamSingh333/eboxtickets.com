        <!-- Left Panel -->

        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <a class="navbar-brand" style="padding: 10px;" href="<?php echo SITE_URL; ?>" target="_blank"><img src="<?php echo SITE_URL ?>images/Logoblack.png" /></a>
                    <a class="navbar-brand hidden" href="./dashboard"><img style="width: 30px; height: 30px;" src="<?php echo SITE_URL ?>images/favicon.png" /></a>
                </div>

                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/dashboard" title="Dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/eventorganiser" title="Event Organiser"> <i class="menu-icon fa fa-user"></i>Event Organiser </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/customer" title="Customer Manager"> <i class="menu-icon fa fa-users"></i>Customer Manager </a>
                        </li>
                        <!--<li class="menu-item-has-children active dropdown">
        					<a href="<?php //echo SITE_URL; 
                                        ?>admin/exam" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Test Manager"> 
        						<i class="menu-icon fa fa-pencil-square-o"></i>Test Manager</a>
        						<ul class="sub-menu children dropdown-menu">
        							<li>
        								<i class="fa fa-file-word-o"></i>
        								<a href="<?php //echo SITE_URL; 
                                                    ?>admin/examcategory">Test Category</a>
        							</li>
        							<li>
        								<i class="fa fa-puzzle-piece"></i>
        								<a href="<?php //echo SITE_URL; 
                                                    ?>admin/examtype">Test Type</a>
        							</li>

        						</ul>
        					</li>-->

                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/event"> <i class="menu-icon fa fa-calendar-o" title="Event Manager"></i>Event Manager </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/ticket"> <i class="menu-icon fa fa-ticket" title="Ticket Manager"></i>Ticket Manager </a>
                        </li>

                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/static"> <i class="menu-icon fa fa-stack-exchange" title="Static Manager"></i>Static Manager </a>
                        </li>

                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/contact_us"> <i class="menu-icon fa fa-envelope-open" title="Contact Us Manager"></i>Contact Us </a>
                        </li>

                        <li class="active">
                            <a href="<?php echo SITE_URL; ?>admin/emailtemplate"> <i class="menu-icon fa fa-envelope" title="Email Template Manager"></i>Email Template Manager </a>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel -->

        <!-- Left Panel -->