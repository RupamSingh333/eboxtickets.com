<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">





<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Ticket Reports</h4>
                <a class="export_Report" href="<?php echo SITE_URL; ?>reports/exportreport/<?php echo $id; ?>"><i class="bi bi-file-earmark-excel"></i></a>
            </div>



            <hr>
            <!-- <div class="contant_bg">
                    <div class="event_settings">

                        <h6>Filters</h6>
                        <hr>

                        <form class="row g-3">
                            <div class="col-md-4">                                
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Name, Email or Order">
                            </div>

                            <div class="col-md-4">
                            
                                <select id="inputState" class="form-select">
                                    <option selected>Choose Payment Type</option>
                                    <option value="online">Online</option>
                                    <option value="box_office">Box Office</option>
                                    <option value="committee">Committee</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                             
                                <select id="inputState" class="form-select">
                                    <option value="">Choose Seller</option>
                                    <option value="80719">Marvin Marcelle</option>
                                </select>
                                </select>
                            </div>
                            <div class="col-md-4">                                
                                <input type="date" class="form-control" id="inputEmail4" placeholder="From">
                            </div>
                            <div class="col-md-4">                                
                                <input type="date" class="form-control" id="inputEmail4" placeholder="To">
                            </div>
                           
                            <div class="col-4">
                                <button type="submit" class="btn save"> <a href="#">Filter</a> </button>
                            </div>
                        </form>


                    </div>
                </div> -->




            <?php echo $this->Flash->render(); ?>
            <div class="contant_bg2">
                <div class="event_payment">
                    <section id="my_ticket">
                        <div class="event-list-container" id="Mycity">
                            <div class="event_detales">

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark table_bg">
                                                <tr>
                                                    <th style="width: 10%;" scope="col">S.No</th>
                                                    <th style="width: 45%;" scope="col">Title</th>
                                                    <th style="width: 15%;" scope="col">Date</th>
                                                    <th style="width: 15%;" scope="col">Export Report</th>
                                                    <th style="width: 15%;" scope="col">Import Report</th>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody_bg">

                                                <?php if (!empty($ticket_data)) { ?>

                                                    <?php $i = 1;
                                                    foreach ($ticket_data as $key => $value) { //pr($value); 
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['title']; ?>
                                                            </td>
                                                            <td>

                                                                <p class="t_data"><?php echo date('d-m-Y', strtotime($value['export_date'])); ?></p>
                                                            </td>
                                                            <td>
                                                                <p class="t_data"><a href="<?php echo SITE_URL; ?>reports/exporttickets/<?php echo $value['id']; ?>/<?php echo $id; ?>"><i class="bi bi-cloud-arrow-down-fill"></i> Export Ticket</a></p>
                                                            </td>
                                                            <td>



                                                                <p class="t_data"><a class="globalModalssbid" href="<?php echo SITE_URL; ?>reports/importtickets/<?php echo $value['id']; ?>"><i class="bi bi-cloud-arrow-up-fill"></i> Import Ticket</a></p>
                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    } ?>

                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align:center"><b>No Ticket Report</b></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
    $(document).on('click', '.globalModalssbid', function(e) {
        $('#modifieddatebid').modal('show').find('.modal-body').html('<h6 style="color:red;">Loading....Please Wait</h6>');
        e.preventDefault();
        $('#modifieddatebid').modal('show').find('.modal-body').load($(this).attr('href'));
    });
</script>

<div class="modal fade" id="modifieddatebid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>