<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <div class="pro_section">
                <!--  -->
                <div class="table-responsive">
                    <div class="scroll_tab">
                        <ul id="progressbar">
                            <!-- <li class="active"><a href="#">Post Event</a> </li>
                        <li class="active"><a href="#">Event Details</a> </li>
                        <li class="active"><a href="#">Manage Tickets</a></li> -->
                            <!-- <li class="active"> <a href="#ee/4">Manage Committee</a></li> -->
                            <!-- <li><a href="#">Publish Event</a></li> -->
                            <!-- <li>View Event</li> -->

                            <li class="active"><a href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Manage Event</a> </li>
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Manage Committee</a> </li>
                            <!-- <li> <a href="#e/4">Manage Committee</a></li> -->
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <h4>Committee Groups Distribution</h4>
            <hr>
            <p>Committee groups persist across events. This is a convenient way to manage different lists of committee members for different events or the even same event.</p>

            <ul class="tabes d-flex">
                <li><a href="<?php echo SITE_URL . 'event/committee/' . $id; ?>">Manage</a></li>
                <li><a href="<?php echo SITE_URL . 'event/committeetickets/' . $id; ?>">Tickets</a></li>
                <li><a class="active" href="<?php echo SITE_URL . 'event/committeegroups/' . $id; ?>">Groups</a></li>
            </ul>

            <div class="contant_bg">
                <div class="event_settings">
                    <?php echo $this->Flash->render(); ?>

                    <div class="row g-3">
                        <!-- committee add here -->
                        <div class="col-md-12">
                            <div class="Committee">

                                <h6 class="">Add New Groups</h6>

                                <div class="row">
                                    <div class="col-sm-10 col-8">
                                        <form action="#" method="post">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                </div>
                                                <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                                                <input class="form-control me-2" name="name" type="text" required placeholder="Enter Group Name" aria-label="Search" autocomplete="off">
                                            </div>

                                    </div>
                                    <div class="col-sm-2 col-4">
                                        <button type="submit" class="btn btn-primary Add_com">
                                            Add
                                        </button>

                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="event_settings">
                        <div class="row g-3">
                            <!-- committee add here -->
                            <div class="col-md-12">
                                <div class="Committee">

                                    <h6 class="">Groups Name</h6>

                                    <?php foreach ($findgroup as $key => $value) { ?>

                                        <div class="row d-flex justify-content-end align-items-center item_bg">

                                            <div class="col-sm-6 hidden">
                                                <p>
                                                    <a href="<?php echo SITE_URL . 'event/addgroupmember/' . $value['id']; ?>"> <?php echo $value['name']; ?></a>
                                                </p>

                                            </div>
                                            <div class="col-sm-6">
                                                <a href="" class="btn save">
                                                    import into <?php echo $value['event']['name']; ?>
                                                </a>
                                            </div>
                                        </div>


                                    <?php } ?>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="next_prew_btn d-flex justify-content-between">
                        <a class="prew" href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Next</a>
                    </div>
                </div>
            </div>

            <!-- </div> -->
        </div>
    </div>
</section>