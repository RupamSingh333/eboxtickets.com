<section id="Committee">
    <div class="container">

        <div class="heading">
            <h1>Committee</h1>
            <h2>Committee</h2>
            <p class=" text-center mb-4">If you belong to any committees for events on eboxtickets, you can manage
                ticket requests here.</p>
            <?php echo $this->Flash->render(); ?>
        </div>


        <div class="Committee_nav d-flex align-items-end ">
            <?php echo $this->element('committeeheader'); ?>

            <div>
                <!-- <form action="#" method="post">
                    <div class="input-group">
                        <div class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                            </svg>
                        </div>
                        <input type="hidden" name="user_id" id="retail_ids">
                        <input class="form-control me-2 usersearch" name="email" type="search" required placeholder="Search" aria-label="Search" autocomplete="off">
                    </div>
                    <div id="testUL" style="display:none;" class="list-group">
                        <ul></ul>
                    </div>
                </form> -->
            </div>

        </div>


        <!--  -->
        <div class="table-responsive">
            <div class="scroll_Com_Table">
                <div class="ignored mt-4">
                    <div class="ignored_ditals">
                        <div class="container-fluid">

                            <div class="row item_heading2">
                                <div class="col-2">Image</div>
                                <div class="col-4">Name</div>
                                <div class="col-4">Ticket</div>
                                <div class="col-2"></div>
                            </div>

                            <?php
                        if (!empty($cart_data_comitee)) {
                            foreach ($cart_data_comitee as $key => $value) {
                                // pr($value);exit;

                                if ($value['user']['profile_image']) {
                                    $profile_image = $value['user']['profile_image'];
                                } else {
                                    $profile_image = 'noimage.jpg';
                                }
                        ?>

                            <div class="row item_list align-items-center mb-3">

                                <div class="col-2">
                                    <img class="event_img"
                                        src="<?php echo IMAGE_PATH . 'Usersprofile/' . $profile_image; ?>"
                                        alt="profile">
                                </div>
                                <div class="col-4">
                                    <h6 class="padding_itams">
                                        <?php echo $value['user']['name'] . ' ' . $value['user']['lname']; ?></h6>
                                    <p><?php echo ucwords(strtolower($value['event']['name'])) ?></p>
                                    <!-- <p class="padding_by">Requested from: <span>Dheerendra Solanki</span></p> -->
                                </div>
                                <div class="col-3">
                                    <p><?php echo $value['eventdetail']['title']; ?> </p>
                                    <!-- <p> $150.00 USD</p> -->
                                    <p><?php echo $value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $value['eventdetail']['price']); ?>
                                        <?php echo $value['event']['currency']['Currency']; ?> </p>
                                    <!-- Button trigger modal -->
                                    <?php if (!empty($value['description'])) { ?>
                                    <button type="button" class="btn e-mail-btn_A " data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop<?php echo $value['id']; ?>">
                                        <i class="bi bi-envelope"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop<?php echo $value['id']; ?>"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Message from
                                                        <?php echo $value['user']['name']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $value['description']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                                    <button data-bs-dismiss="modal" type="button"
                                                        class="btn btn-primary">Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-3">
                                    <a class="btn cancel btn-sm btn approvalrequest"
                                        href="<?php echo SITE_URL; ?>committee/approvalreq/<?php echo $value['id']; ?>">Approve</a>
                                    <a class="btn cancel_b btn-sm btn"
                                        href="<?php echo SITE_URL; ?>committee/approvalreq/<?php echo $value['id']; ?>/I"
                                        onclick="javascript: return confirm('Are you sure you want to Ignore this request?')">Ignore</a>
                                </div>

                            </div>

                            <?php  }
                        } else { ?>

                            <center>No pending requests</center>

                            <?php   } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).on('click', '.approvalrequest', function(e) {
    $('#approvalrequest').modal('show').find('.modal-body').html(
        '<h6 style="color:red;">Loading....Please Wait</h6>');
    e.preventDefault();
    $('#approvalrequest').modal('show').find('.modal-body').load($(this).attr('href'));
});
</script>

<div class="modal fade" id="approvalrequest">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>