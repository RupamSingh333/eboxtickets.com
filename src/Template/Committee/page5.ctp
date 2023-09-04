<style>
    .input_fields_wrap .form-control {
        margin-bottom: 15px;
    }

    #testUL ul {
        z-index: 999;
        overflow: scroll;
        height: 150px;
        list-style-type: none;
        background-color: #ffffff;
        margin: auto;
        padding: 2px 0px;
        width: 99%;
    }

    #searchevent ul {
        z-index: 999;
        overflow: scroll;
        height: 137px;
        list-style-type: none;
        background-color: #ffffff;
        margin: auto;
        padding: 2px 0px;
        width: 97%;
    }

    #testUL ul li a {
        color: black;
    }

    #searchevent ul li a {
        color: black;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<section id="Dashboard_section">
    <div class="row g-0">
        <?php echo $this->element('organizerdashboard'); ?>


        <div class="col-sm-9">
            <div class="dsa_contant">
                <h4>Order: BrAqRpOovojNzdzO</h4>
                <hr>

                <div class="contant_bg">
                    <div class="pay_settings">
                        <?php echo $this->Flash->render(); ?>

                        <div class="row g-3">
                            <!-- committee add here -->
                            <div class="col-md-8">
                                <div class="Committee">


                                    <div class="row Current_heading">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div class="col-sm-3">
                                            <p>Item</p>
                                        </div>
                                        <div class="col-sm-4 ">
                                            <p>Amount</p>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <p>Name</p>
                                        </div>
                                        <div class="col-sm-2 ">

                                        </div>
                                    </div>


                                    <div class="mb-4">

                                        <div class="pay_detalis">
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="my-1 icons">Comps</p>

                                                </div>
                                                <div class="col-sm-4 ">
                                                    <p>$0.00 USD </p>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <p>Rupam</p>
                                                </div>
                                                <div class="col-sm-2 text-end">
                                                    <div class="dropdown">
                                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModal"> Rename </a></li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa2"> Edit Answers</a> </li>
                                                            <li> <a class="dropdown-item" href="https://islandetickets.com/event_manager/code/print_ticket/660169" title="Edit Tickets"> Print</a> </li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa3"> Cancel</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rename Ticket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">Ticket Name</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" placeholder="Ticket Name">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Edit Answers</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">State</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="inputState" class="form-select">
                                                                            <option selected>Choose One</option>
                                                                            <option>India</option>
                                                                            <option>Pakistan</option>
                                                                            <option>Russia</option>
                                                                            <option>Japan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa3" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Confirm Action</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to refund this order?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Yes</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="pay_detalis2">
                                            <div class="d-flex">
                                                <span class="info_heading">Approved by </span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">Marvin Marcelle.</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Scanned</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"> No</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Answers</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">select your country : india</span>
                                            </div>


                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="mb-4">

                                        <div class="pay_detalis">
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="my-1 icons">Comps</p>

                                                </div>
                                                <div class="col-sm-4 ">
                                                    <p>$0.00 USD </p>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <p>Rupam</p>
                                                </div>
                                                <div class="col-sm-2 text-end">
                                                    <div class="dropdown">
                                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModal"> Rename </a></li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa2"> Edit Answers</a> </li>
                                                            <li> <a class="dropdown-item" href="https://islandetickets.com/event_manager/code/print_ticket/660169" title="Edit Tickets"> Print</a> </li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa3"> Cancel</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rename Ticket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">Ticket Name</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" placeholder="Ticket Name">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Edit Answers</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">State</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="inputState" class="form-select">
                                                                            <option selected>Choose One</option>
                                                                            <option>India</option>
                                                                            <option>Pakistan</option>
                                                                            <option>Russia</option>
                                                                            <option>Japan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa3" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Confirm Action</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to refund this order?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Yes</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="pay_detalis2">
                                            <div class="d-flex">
                                                <span class="info_heading">Approved by </span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">Marvin Marcelle.</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Scanned</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"> No</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Answers</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">select your country : india</span>
                                            </div>


                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="mb-4">

                                        <div class="pay_detalis">
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="my-1 icons">Comps</p>

                                                </div>
                                                <div class="col-sm-4 ">
                                                    <p>$0.00 USD </p>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <p>Rupam</p>
                                                </div>
                                                <div class="col-sm-2 text-end">
                                                    <div class="dropdown">
                                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModal"> Rename </a></li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa2"> Edit Answers</a> </li>
                                                            <li> <a class="dropdown-item" href="https://islandetickets.com/event_manager/code/print_ticket/660169" title="Edit Tickets"> Print</a> </li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa3"> Cancel</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rename Ticket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">Ticket Name</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" placeholder="Ticket Name">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Edit Answers</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">State</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="inputState" class="form-select">
                                                                            <option selected>Choose One</option>
                                                                            <option>India</option>
                                                                            <option>Pakistan</option>
                                                                            <option>Russia</option>
                                                                            <option>Japan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa3" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Confirm Action</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to refund this order?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Yes</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="pay_detalis2">
                                            <div class="d-flex">
                                                <span class="info_heading">Approved by </span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">Marvin Marcelle.</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Scanned</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"> No</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Answers</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">select your country : india</span>
                                            </div>


                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="mb-4">

                                        <div class="pay_detalis">
                                            <div class="row align-items-center">
                                                <div class="col-sm-3">
                                                    <p class="my-1 icons">Comps</p>

                                                </div>
                                                <div class="col-sm-4 ">
                                                    <p>$0.00 USD </p>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <p>Rupam</p>
                                                </div>
                                                <div class="col-sm-2 text-end">
                                                    <div class="dropdown">
                                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModal"> Rename </a></li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa2"> Edit Answers</a> </li>
                                                            <li> <a class="dropdown-item" href="https://islandetickets.com/event_manager/code/print_ticket/660169" title="Edit Tickets"> Print</a> </li>
                                                            <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa3"> Cancel</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Rename Ticket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">Ticket Name</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" placeholder="Ticket Name">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Edit Answers</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form>
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label for="exampleInputEmail1" class="form-label mt-1">State</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="inputState" class="form-select">
                                                                            <option selected>Choose One</option>
                                                                            <option>India</option>
                                                                            <option>Pakistan</option>
                                                                            <option>Russia</option>
                                                                            <option>Japan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Save</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModa3" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabe1">Confirm Action</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to refund this order?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn save">Yes</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="pay_detalis2">
                                            <div class="d-flex">
                                                <span class="info_heading">Approved by </span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">Marvin Marcelle.</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Scanned</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"> No</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="info_heading">Answers</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant">select your country : india</span>
                                            </div>


                                        </div>
                                    </div>

                                    <!--  -->


                                    <div class="row Current_heading">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div class="col-sm-3">
                                            <p>TOTAL</p>
                                        </div>
                                        <div class="col-sm-7 ">
                                            <p>$150.00 USD</p>
                                        </div>

                                        <div class="col-sm-2 text-end">
                                            <a class="print_icon" href="https://staging.eboxtickets.com/tickets/ticketdetails/4"> <i class="bi bi-printer"></i></a>

                                        </div>
                                    </div>



                                </div>
                            </div>

                            <!-- import committee -->
                            <div class="col-md-4">
                                <div class="import_committee">
                                    <div class="row">
                                        <div class="col-sm-3 img_style">
                                            <img src="https://4f14f3f2b2e5fd1c43c0-19fdc616b209d38d8f477bc6e666e66f.ssl.cf1.rackcdn.com/profiles/163462.jpg" alt="" class="img-fluid mb-3 ">
                                        </div>
                                        <div class="col-sm-9">
                                            <h5 class="card-title">
                                                Dheerendra Solanki </h5>
                                            <p class="info">
                                                dheerendra@doomshell.com <br>
                                                29 years old<br>
                                                Male </p>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <div class="table_data">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Order Number</td>
                                                            <td>1MHZIye76ckYANmL</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>August 22nd 2022</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time</td>
                                                            <td>10:17 am</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Payment Type</td>
                                                            <td>Cash</td>
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
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    // for searching user start 
    $(document).ready(function() {
        $(function() {
            $('.usersearch').bind('keyup', function() {
                var pos = $(this).val();
                var check = 0;
                $('#testUL').show();
                $('#retail_ids').val('');
                var count = pos.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo SITE_URL; ?>event/getusersname',
                        data: {
                            'fetch': pos,
                            'check': check
                        },
                        success: function(data) {
                            $('#testUL ul').html(data);
                        },
                    });
                } else {
                    $('#testUL').hide();
                }
            });
        });


    });

    function selectsearch(name, id) {
        $('.usersearch').val(name);
        $('#testUL').hide();
        $('#retail_ids').val(id);
    }
    // end 


    // for import committee member - start 
    $(document).ready(function() {
        $(function() {
            $('.eventserach').bind('keyup', function() {
                var searchdata = $(this).val();
                var check = 0;
                var user_id = "<?php echo $user_id; ?>";
                $('#searchevent').show();
                $('#import_event_id').val('');
                var count = searchdata.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo SITE_URL; ?>event/geteventcommittee',
                        data: {
                            'fetch': searchdata,
                            'check': check,
                            'user_id': user_id
                        },
                        success: function(data) {
                            $('#searchevent ul').html(data);
                        },
                    });
                } else {
                    $('#searchevent').hide();
                }
            });
        });


    });

    function selectevent(name, id) {
        $('.eventserach').val(name);
        $('#searchevent').hide();
        $('#import_event_id').val(id);
    }

    // end 
</script>