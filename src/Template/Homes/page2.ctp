 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
 <section id="Dashboard_section">
     <div class="row g-0">

         <div class="col-sm-3">
             <div class="sidebar">
                 <ul class="list-unstyled components">
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-speedometer2"></i> Dashboard</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-sliders"></i> Settings</a></li>
                     <li class="active"> <a href="#" id="menu-group-dashboard"> <i class="bi bi-ticket-perforated"></i> Tickets</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-card-list"></i> Lists</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-credit-card"></i> Payments</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-bar-chart"></i> Analytics</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-wallet2"></i> Payouts</a></li>
                     <li> <a href="#" id="menu-group-dashboard"> <i class="bi bi-people"></i> Committee</a></li>
                 </ul>
             </div>
         </div>
         <div class="col-sm-9">
             <div class="dsa_contant">
                 <h4>Manage Tickets</h4>
                 <hr>
                 <p>You can manage all your tickets here.</p>
                 <div class="row">
                     <div class="col-sm-10">


                         <ul class="tabes d-flex">
                             <li><a href="#">Settings</a></li>
                             <li><a class="active" href="#">Manage</a></li>
                             <li><a href="#">Addons</a></li>
                             <li><a href="#">Questions</a></li>

                         </ul>
                         <!-- <hr> -->
                     </div>
                     <div class="col-sm-2 text-end">
                         <!-- Button trigger modal -->
                         <button type="button" class="btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                             <i class="bi bi-plus"></i>
                         </button>

                         <!-- Modal -->
                         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <!-- =============== -->

                                         <form class="row g-3 text-start">
                                             <div class="col-md-12">
                                                 <label for="inputName" class="form-label">Name</label>
                                                 <input type="text" class="form-control" id="inputEmail4">
                                             </div>
                                             <div class="col-md-12">
                                                 <label for="inputState" class="form-label">Type</label>
                                                 <select id="inputState" class="form-select">
                                                     <option value="public">Open Sales</option>
                                                     <option value="private" selected="">Committee Sales</option>
                                                 </select>
                                             </div>
                                             <div class="col-md-12">
                                                 <label for="inputname" class="form-label">Price</label>
                                                 <input type="text" class="form-control" id="inputPassword4">
                                             </div>
                                             <div class="col-md-12">
                                                 <label for="inputState" class="form-label">Visibility</label>
                                                 <select id="inputState" class="form-select">
                                                     <option value="1">Hidden</option>
                                                     <option value="0">Visible</option>
                                                 </select>
                                             </div>
                                            
                                         </form>
                                         <!-- ================== -->
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                         <button type="button" class="btn save">Add Ticket</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>



                 <div class="contant_bg">
                     <div class="event_settings">

                         <h6>Name</h6>
                         <hr>
                         <div class="row d-flex justify-content-end align-items-center item_bg">
                             <div class="col-sm-10 hidden">
                                 <p>
                                     <strong>Comps</strong> ($0.00 USD) <br>
                                     Sold: 3 / 0
                                 </p>

                                 <div class="row d-flex justify-content-end align-items-center">
                                     <div class="col-md-4">
                                         <p class="d-flex"><i class="bi bi-lock-fill"></i></i>Committee Sales</p>

                                     </div>
                                     <div class="col-md-3">
                                         <p> <i class="bi bi-eye-slash-fill"></i> Hidden </p>

                                     </div>
                                     <div class="col-md-3">

                                         <!-- <p class="status_Active"> Open Sales </p>                                 -->
                                     </div>


                                     <div class="col-md-2">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-2">

                                 <!-- <div class="dropdown">
                                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="bi bi-gear"></i>
                                     </button>
                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Committee Sales</a></li>
                                         <li><a class="dropdown-item" href="#">Hide</a></li>
                                         <li><a class="dropdown-item" href="#">Sold Out</a></li>
                                     </ul>
                                 </div> -->
                             </div>
                         </div>

                         <div class="row d-flex justify-content-end align-items-center item_bg">
                             <div class="col-sm-10 on_sale">
                                 <p>
                                     <strong>Comps</strong> ($0.00 USD) <br>
                                     Sold: 3 / 0
                                  
                                 </p>

                                 <div class="row d-flex justify-content-end align-items-center">
                                     <div class="col-md-4">
                                         <p class="d-flex"><i class="bi bi-unlock-fill"></i> Open Sales</p>

                                     </div>
                                     <div class="col-md-3">
                                         <p> <i class="bi bi-eye-fill"></i> Visible </p>

                                     </div>
                                     <div class="col-md-3">
                                         <!-- <p class="status_Active"></p>      -->
                                         <p class="status_Active"> Open Sales </p>
                                     </div>


                                     <div class="col-md-2">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-2 text-end">

                                 <div class="dropdown">
                                     <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="bi bi-gear"></i>
                                     </button>
                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Committee Sales</a></li>
                                         <li><a class="dropdown-item" href="#">Hide</a></li>
                                         <li><a class="dropdown-item" href="#">Sold Out</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>

                         <div class="row d-flex justify-content-end align-items-center item_bg">
                             <div class="col-sm-10 on_sale">
                                 <p>
                                     <strong>Comps</strong> ($0.00 USD) <br>
                                     Sold: 3 / 0
                                 </p>

                                 <div class="row d-flex justify-content-end align-items-center">
                                     <div class="col-md-4">
                                         <p class="d-flex"><i class="bi bi-unlock-fill"></i> Open Sales</p>

                                     </div>
                                     <div class="col-md-3">
                                         <p> <i class="bi bi-eye-fill"></i> Visible </p>

                                     </div>
                                     <div class="col-md-3">
                                         <!-- <p class="status_Active"></p>      -->
                                         <p class="status_Active"> Open Sales </p>
                                     </div>


                                     <div class="col-md-2">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-2 text-end">

                                 <div class="dropdown">
                                     <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="bi bi-gear"></i>
                                     </button>
                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Committee Sales</a></li>
                                         <li><a class="dropdown-item" href="#">Hide</a></li>
                                         <li><a class="dropdown-item" href="#">Sold Out</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>

                         <div class="row d-flex justify-content-end align-items-center item_bg">
                             <div class="col-sm-10 on_sale">
                                 <p>
                                     <strong>Comps</strong> ($0.00 USD) <br>
                                     Sold: 3 / 0
                                 </p>

                                 <div class="row d-flex justify-content-end align-items-center">
                                     <div class="col-md-4">
                                         <p class="d-flex"><i class="bi bi-unlock-fill"></i> Open Sales</p>

                                     </div>
                                     <div class="col-md-3">
                                         <p> <i class="bi bi-eye-fill"></i> Visible </p>

                                     </div>
                                     <div class="col-md-3">
                                         <!-- <p class="status_Active"></p>      -->
                                         <p class="status_Active"> Open Sales </p>
                                     </div>


                                     <div class="col-md-2">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-2 text-end">

                                 <div class="dropdown">
                                     <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="bi bi-gear"></i>
                                     </button>
                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                         <li><a class="dropdown-item" href="#">Edit</a></li>
                                         <li><a class="dropdown-item" href="#">Committee Sales</a></li>
                                         <li><a class="dropdown-item" href="#">Hide</a></li>
                                         <li><a class="dropdown-item" href="#">Sold Out</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>


                     </div>
                 </div>

             </div>
         </div>
     </div>
 </section>











 <!-- =========================================== -->





 <!-- =========================================== -->



 <!-- ================================= -->

 <!-- ================================= -->