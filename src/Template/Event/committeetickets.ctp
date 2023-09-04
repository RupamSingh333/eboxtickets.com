<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<section id="Dashboard_section">
    <div class="d-flex">
        <?php

        use App\View\Helper\CommanHelper;

        echo $this->element('organizerdashboard');
        ?>

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

            <h4>Committee Ticket Distribution</h4>
            <hr>
            <p>You can add users to manage your events here. 'Add' adds the number to the total ticket count for the user. 'Replace' replaces the amount of tickets the user has available for purchase and will not affect tickets sold so far.</p>
            <?php echo $this->Flash->render(); ?>

            <ul class="tabes d-flex">
                <li><a href="<?php echo SITE_URL . 'event/committee/' . $id; ?>">Manage</a></li>
                <li><a class="active" href="">Tickets</a></li>
                <li><a href="<?php echo SITE_URL . 'event/committeegroups/' . $id; ?>">Groups</a></li>
            </ul>
            <div class="contant_bg">
                <div class="event_settings">



                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Total Tickets Alotted</h5>

                                    <div class="table-responsive">
                                        <div class="scroll_tab2">

                                            <div class="table committee-table">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <?php foreach ($ticketstype as $key => $value) { ?>
                                                                <th><?php echo $value['title'] . ' ($' . sprintf('%.2f', $value['price']) . ')'; ?></th>
                                                            <?php } ?>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php
                                                            $total = 0;
                                                            $getcomps = $this->Comman->ticketcount($id, 0);
                                                            //echo $getcomps[0]['sum']; 
                                                            ?>
                                                            <?php foreach ($ticketstype as $key => $value) { ?>
                                                                <td>
                                                                    <?php
                                                                    $getcount = $this->Comman->ticketcount($id, $value['id']);
                                                                    $total += $getcount[0]['sum'];
                                                                    echo $getcount[0]['sum'];
                                                                    ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td><?php echo $total + $getcomps[0]['sum']; ?></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Search</h5>
                                    <div class="form-group row">
                                        <div class="input-group">
                                            <div class="input-group">
                                            </div>
                                            <input type="text" class="form-control search committee-typeahead mx-2" name="emaqueryil" placeholder="Search by name or email" autocomplete="off" value="">
                                            <input type="hidden" name="event_id" value="270544">
                                        </div>
                                    </div>
                                    <hr>

                                    <?php
                                    $numItems = count($findgroupmember);
                                    $memeberid = array();
                                    if (!empty($findgroupmember)) {
                                        foreach ($findgroupmember as $keyvalue => $value) {
                                            $getallmembers = $this->Comman->groupmembers($value['group_id']); ?>

                                            <h5 class="card-title"><?php echo $value['committee_group']['name']; ?></h5>

                                            <div class="table-responsive">
                                                <div class="scroll_tab2">
                                                    <div class="table committee-table">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <div class="form-check">
                                                                            Sr.no
                                                                        </div>
                                                                    </th>
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <?php foreach ($ticketstype as $type) { ?>
                                                                        <th>
                                                                            <span data-toggle="tooltip" title="" data-original-title="Gold">
                                                                                <?php echo $type['title']; ?> <br>
                                                                                ($<?php echo sprintf('%.2f', $type['price']); ?> )
                                                                            </span>
                                                                        </th>
                                                                    <?php } ?>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $sr = 1;
                                                                foreach ($getallmembers as $srno => $memberdetails) {
                                                                    $memeberid[] = $memberdetails['user']['id'];

                                                                ?>

                                                                    <tr class="visible">
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <?php echo $sr; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="dropdown">
                                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="bi bi-gear"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                                    <li> <a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/assigncommtickets/<?php echo $memberdetails['user_id'] . '/' . $memberdetails['group_id'] . '/' . $id; ?>" title="Edit Tickets"> Edit</a> </li>

                                                                                    <li><a class="dropdown-item" href="#">Hide</a></li>

                                                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/sales/<?php echo $id; ?>">Sale Summary</a></li>
                                                                                </ul>
                                                                            </div>


                                                                        </td>

                                                                        <td>
                                                                            <?php echo ucfirst(strtolower($memberdetails['user']['name'])) . ' ' . ucfirst(strtolower($memberdetails['user']['lname'])); ?><br>
                                                                            <i class="bi bi-envelope"></i> <?php echo ($memberdetails['user']['email']) ? $memberdetails['user']['email'] : 'N/A'; ?><br>
                                                                            <i class="bi bi-telephone-fill"></i> <?php echo ($memberdetails['user']['mobile']) ? $memberdetails['user']['mobile'] : 'N/A'; ?>
                                                                        </td>
                                                                        <!-- <td class="count"> -->
                                                                        <?php
                                                                        // $compstickets = $this->Comman->findticketdetails($memberdetails['user_id'], 0, $memberdetails['group_id'],$id);
                                                                        // if ($compstickets) {
                                                                        //     echo $compstickets['count'];
                                                                        // } else {
                                                                        //     echo '';
                                                                        // }
                                                                        ?>
                                                                        <!-- </td> -->

                                                                        <?php foreach ($ticketstype as $type) {
                                                                            $findticketdetails = $this->Comman->findticketdetails($memberdetails['user_id'], $type['id'], $memberdetails['group_id'], $id);
                                                                        ?>
                                                                            <td class="count">
                                                                                <?php if (!empty($findticketdetails)) {
                                                                                    echo $findticketdetails['count'];
                                                                                } else {
                                                                                    // echo '';
                                                                                } ?>
                                                                            </td>


                                                                        <?php } ?>

                                                                    </tr>

                                                                <?php $sr++;
                                                                } ?>
                                                            </tbody>


                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- for ungrouped member start -->
                                            <?php if ($keyvalue === $numItems - 1) { ?>

                                                <h5 class="card-title">Ungrouped</h5>

                                                <div class="table-responsive">
                                                    <div class="scroll_tab2">

                                                        <div class="table committee-table">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div class="form-check">
                                                                                Sr.no
                                                                            </div>
                                                                        </th>
                                                                        <th></th>
                                                                        <th>Name</th>

                                                                        <?php foreach ($ticketstype as $key => $type) { ?>
                                                                            <th>
                                                                                <span data-toggle="tooltip" title="" data-original-title="Gold">
                                                                                    <?php echo $type['title']; ?> <br>
                                                                                    ($<?php echo sprintf('%.2f', $type['price']); ?> )
                                                                                </span>
                                                                            </th>
                                                                        <?php } ?>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php $srno2 = 1;
                                                                    foreach ($findcommember as $key => $ungroupmember) {
                                                                        if (in_array($ungroupmember['user']['id'], $memeberid)) {
                                                                            continue;
                                                                        }

                                                                    ?>

                                                                        <tr class="visible">
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <?php echo $srno2; ?>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="dropdown">
                                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                        <i class="bi bi-gear"></i>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                                        <li> <a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/assigncommtickets/<?php echo $ungroupmember['user']['id'] . '/' . 'N/' . $id; ?>" title="Edit Tickets"> Edit</a> </li>

                                                                                        <li><a class="dropdown-item" href="#">Hide</a></li>

                                                                                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/sales/<?php echo $id; ?>">Sale Summary</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>

                                                                            <td align="left">
                                                                                <i class="bi bi-person me-1"></i><?php echo ucfirst(strtolower($ungroupmember['user']['name'])) . ' ' . ucfirst(strtolower($ungroupmember['user']['lname'])); ?><br>
                                                                                <i class="bi bi-envelope me-1"></i> <?php echo ($ungroupmember['user']['email']) ? $ungroupmember['user']['email'] : 'N/A'; ?><br>
                                                                                <i class="bi bi-phone me-1"></i> <?php echo ($ungroupmember['user']['mobile']) ? $ungroupmember['user']['mobile'] : 'N/A'; ?>
                                                                            </td>

                                                                            <?php foreach ($ticketstype as $type) {

                                                                                $ungroupticket = $this->Comman->findticketdetails($ungroupmember['user']['id'], $type['id'], 0, $id);

                                                                            ?>
                                                                                <td class="count">
                                                                                    <?php
                                                                                    if ($ungroupticket) {
                                                                                        echo $ungroupticket['count'];
                                                                                    } else {
                                                                                        echo '';
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>
                                                                    <?php $srno2++;
                                                                    } ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php }
                                        }
                                    } else { ?>

                                        <!-- for no any member in group start -->
                                        <h5 class="card-title">Ungrouped</h5>

                                        <div class="table-responsive">
                                            <div class="scroll_tab2">

                                                <div class="table committee-table">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <div class="form-check">
                                                                        Sr.no
                                                                    </div>
                                                                </th>
                                                                <th></th>
                                                                <th>Name</th>
                                                                <?php foreach ($ticketstype as $key => $type) { ?>
                                                                    <th>
                                                                        <span data-toggle="tooltip" title="" data-original-title="Gold">
                                                                            <?php echo $type['title']; ?> <br>
                                                                            ($<?php echo sprintf('%.2f', $type['price']); ?> )
                                                                        </span>
                                                                    </th>
                                                                <?php } ?>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $count = 1;
                                                            if (!empty($findcommember)) {
                                                                foreach ($findcommember as $key => $ungroupmember) {  ?>

                                                                    <tr class="visible">
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <?php echo $count; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="bi bi-gear"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                                    <li> <a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/assigncommtickets/<?php echo $ungroupmember['user']['id'] . '/' . 'N/' . $id; ?>" title="Edit Tickets"> Edit</a> </li>

                                                                                    <li><a class="dropdown-item" href="#">Hide</a></li>

                                                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/sales/<?php echo $id; ?>">Sale Summary</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>

                                                                        <td align="left">
                                                                            <i class="bi bi-person me-1"></i> <?php echo ucfirst(strtolower($ungroupmember['user']['name'])) . ' ' . ucfirst(strtolower($ungroupmember['user']['lname'])); ?><br>
                                                                            <i class="bi bi-envelope me-1"></i> <?php echo ($ungroupmember['user']['email']) ? $ungroupmember['user']['email'] : 'N/A'; ?><br>

                                                                            <i class="bi bi-telephone me-1"></i> <?php echo ($ungroupmember['user']['mobile']) ? $ungroupmember['user']['mobile'] : 'N/A'; ?>
                                                                            <?php //echo $ungroupmember['user']['name']; 
                                                                            ?>
                                                                        </td>
                                                                        <!-- <td class="count"> -->
                                                                        <!-- Complementory tickets  -->
                                                                        <?php
                                                                        // $ungroupcompstic = $this->Comman->findticketdetails($ungroupmember['user']['id'], 0, 0,$id);

                                                                        // if ($ungroupcompstic) {
                                                                        //     echo $ungroupcompstic['count'];
                                                                        // } else {
                                                                        //     echo '';
                                                                        // }
                                                                        ?>
                                                                        <!-- </td> -->

                                                                        <?php foreach ($ticketstype as $type) {

                                                                            $ungroupticket = $this->Comman->findticketdetails($ungroupmember['user']['id'], $type['id'], 0, $id);

                                                                        ?>
                                                                            <td class="count">
                                                                                <?php
                                                                                if ($ungroupticket) {
                                                                                    echo $ungroupticket['count'];
                                                                                } else {
                                                                                    echo '';
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        <?php } ?>

                                                                    </tr>
                                                                <?php $count++;
                                                                }
                                                            } else { ?>

                                                                <tr>
                                                                    <td colspan="5">
                                                                        <center>
                                                                            <p><i>no member added in committee</i></p>
                                                                        </center>
                                                                    </td>
                                                                </tr>

                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- for no any member in group end -->
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="next_prew_btn d-flex justify-content-between">
                        <!-- <a class="prew" href="https://eboxtickets.com/event/manage/21">Prew</a>
                            <a class="next" href="https://eboxtickets.com/event/generalsetting/21">Next</a> -->
                        <a class="prew" href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Next</a>
                    </div>

                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>

<script>
    $(document).on('click', '.globalModalssbid', function(e) {
        $('#modifieddatebid').modal('show').find('.modal-content').html('<h6 style="color:red;">Loading....Please Wait</h6>');
        e.preventDefault();
        $('#modifieddatebid').modal('show').find('.modal-content').load($(this).attr('href'));
    });
</script>

<div class="modal fade" id="modifieddatebid">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>