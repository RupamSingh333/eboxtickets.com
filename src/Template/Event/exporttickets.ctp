<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Export Tickets</h4>
                <h4>Total Tickets:(<?php echo $totalTicketCount . '/' . $totalScannedTicket; ?>)</h4>
                <a href="<?php echo SITE_URL; ?>event/exportticketcsv/<?php echo $id; ?>" class="btn export_icon mx-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Export Ticket">
                    <i class="bi bi-file-earmark-excel"></i>
                </a>
            </div>

            <hr>

            <div class="contant_bg">
                <div class="event_settings">
                    <?php echo $this->Form->create('', array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'event', 'action' => 'exportticketcsv'))); ?>
                    <!--  -->

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="inputState" class="form-label">Ticket Scan</label>
                            <select id="inputState" class="form-select" name="scanticket">
                                <option value>--Select ticket status--</option>
                                <option value="no">Active tickets</option>
                                <option value="yes">Inactive tickets</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-3">
                            <label for="inputCity" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="inputCity" placeholder="User Name">
                        </div> -->
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="inputState" class="form-label"><strong>Ticket Type</strong></label> <br>

                            <?php foreach ($alltickets as $value) { ?>
                                <div class="checksec">
                                    <input type="checkbox" name="tickets[]" value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                        </div>

                    </div>
                    <hr>
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn save" id="exportticket_submit">Submit</button>
                    </div>
                    </form>

                    <!--  -->
                </div>


            </div>

            <div class="contant_bg2" id="exampleevent_ticketexport">
                <div class="event_payment">
                    <section id="my_ticket">
                        <div class="event-list-container" id="Mycity">
                            <div class="event_detales">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-dark table_bg">
                                            <tr>
                                                <th style="width: 30%;" scope="col">Bar Code</th>
                                                <th style="width: 16%;" scope="col">Username</th>
                                                <th style="width: 6%;" scope="col">Email</th>
                                                <th style="width: 10%;" scope="col">Mobile</th>
                                                <th style="width: 6%;" scope="col">Type</th>
                                                <th style="width: 15%;" scope="col">Print Name</th>
                                                <th style="width: 5%;" scope="col">ScannedBy</th>
                                                <th style="width: 18%;" scope="col">Purchased Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody_bg">
                                            <?php if (!empty($ticket_data)) { ?>

                                                <?php foreach ($ticket_data as $key => $value) { //pr($value); die;
                                                    // if(!empty($value['scanner_id'])){
                                                    $getScannername = $this->Comman->getScannerName($value['scanner_id']);
                                                    // }
                                                    // pr($getScannername);exit;
                                                    // pr($value);exit;

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <div class="qr_code d-flex">

                                                                <div class="code_scanner">
                                                                    <?php if ($value['status'] == 0) { ?>
                                                                        <img src="<?php echo SITE_URL . 'qrimages/temp/' . $value['qrcode']; ?>">
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo SITE_URL . 'scannedQR-code.png'; ?>">
                                                                    <?php } ?>

                                                                    <div class="qr_pack">
                                                                        <p class="p_h">Package</p>
                                                                    </div>
                                                                    
                                                                    <div class="qr_pack">
                                                                        <p class="p_h">Package</p>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <button type="button" class="btn export_icon " data-bs-toggle="tooltip" data-bs-placement="right" title="Ticket Amount">
                                                                <i class="bi bi-cash"></i>
                                                                <?php echo $event_data['currency']['Currency']; ?> <?php echo $value['ticket']['amount']; ?>

                                                            </button>
                                                            <br>

                                                            <button type="button" class="btn export_icon " data-bs-toggle="tooltip" data-bs-placement="right" title="Ticket Type">
                                                                <i class="bi bi-ticket"></i>
                                                                <?php echo $value['ticket']['eventdetail']['title']; ?>
                                                            </button>


                                                        </td>
                                                        <td>
                                                            <p class="t_data"><?php echo $value['user']['name'] . " " . $value['user']['lname']; ?></p>
                                                        </td>

                                                        <td>
                                                            <p class="t_data"><?php echo $value['user']['email']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="t_data"><?php echo $value['user']['mobile']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="t_data"><?php echo (!empty($value['package_id'])) ? 'Package' : 'Ticket'; ?></p>
                                                        </td>

                                                        <td>
                                                            <p class="t_data"><?php echo $value['name']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="t_data"><?php echo $getScannername['name'] . ' ' . $getScannername['lname']; ?></p>
                                                        </td>

                                                        <td>
                                                            <p class="t_data"><?php echo date('d M Y', strtotime($value['created'])); ?></p>
                                                        </td>
                                                    </tr>
                                                <?php  } ?>

                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="7" style="text-align:center"><b>Search Tickets....</b></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php echo $this->element('admin/pagination'); ?>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>

        <!-- </div> -->
    </div>

</section>


<script>
    $(document).ready(function() {

        $("#sevice_form").bind("submit", function(event) {
            $(".preloader").show();
            $.ajax({
                async: true,
                data: $("#sevice_form").serialize(),
                dataType: "html",
                type: "POST",
                url: "<?php echo SITE_URL; ?>event/exportticketsdata",
                success: function(data) {
                    $(".tbody_bg").html(data);
                    $(".preloader").hide();

                },
            });
            return false;
        });
    });
    //]]>
</script>