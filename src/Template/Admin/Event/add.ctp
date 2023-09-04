<section id="post_event">
        <div class="container-fluid">

            <!-- <div class="heading">
                <h1>Policy </h1>
                <h2>Terms and Conditions</h2>
            </div> -->


            <ul class="nav nav-pills mb-3 nav-tab" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-code" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Create Event</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-policy_rpt" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Event Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-remuneratiuon" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Image</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-risk" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Tickets</button>
                </li>
              
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-code" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="create_event">
                        <!--  -->
                        <div class="event_info_box">
                            <h3>Choose or Create Company</h3>
                            <p>Each event must belong to a company. It's a great way to let users know who is having the event and you can group like events under a single company.</p>

                                 <!--  -->
                         <div class="row">
                            <div class="col-sm-6">
                              <form class="" action="" method="POST">
                                <div class="form-group row">
                                    <div class="input-group col-sm-12">
                                        
                                     <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                       </svg></div>
                                    <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username">
                                   </div>
                                      
                                </div>
                              </form>
                            </div>


                           <div class="col-sm-6">
                             OR &nbsp; &nbsp;
                              <button type="button" class="btn company" data-toggle="modal" data-target="#exampleModal">
                                Create Company
                              </button>
                           </div>
                          </div>
                         <!-- =============== -->
                        </div>
                        <!--  -->
                        <div class="event_info_box">
                            <h3>Basic Event Info</h3>
                       <!--  -->

                       <form class="row g-0 mt-3">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Event Name</label>
    <input type="text" class="form-control">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Location</label>
    <input type="text" class="form-control" >
  </div>
  <div class="col-md-6">
    <label for="inputAddress" class="form-label">Event start</label>
    <input type="date" class="form-control"  >
  </div>
  
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Event End</label>
    <input type="date" class="form-control">
  </div>
  

  <div class="col-12">
    <div class="form-check d-flex align-items-center">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
      Click to confirm that you agree to the eboxtickets <a href="#"> Merchant Service Agreement?</a>
      </label>
    </div>
  </div>
  <div class="col-12">
  <button type="submit" class="btn save">Save</button>
    <!-- <button type="submit" class="btn btn-primary">Save</button> -->
  </div>
</form>
                       <!--  -->
                         
                        
                        </div>
                        <!--  -->

                    </div>
                </div>


                <div class="tab-pane fade" id="pills-policy_rpt" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="create_event">
                        <div class="event_info_box">
                            <h3>Event Settings</h3>
                            <!-- <p>Each event must belong to a company. It's a great way to let users know who is having the event and you can group like events under a single company.</p> -->

                                 <!--  -->
                                 <form class="row g-0 mt-3">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Sunset Weekend</label>
    <input type="text" class="form-control" placeholder="Disabled input">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Company</label>
    <select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Location</label>
    <input type="text" class="form-control" >
  </div>
  <div class="col-md-6">
    <label for="inputAddress" class="form-label">Event start</label>
    <input type="date" class="form-control"  >
  </div>
  
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Event End</label>
    <input type="date" class="form-control">
  </div>
  

  <div class="col-12">
    <div class="form-check d-flex align-items-center">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
      Click to confirm that you agree to the eboxtickets <a href="#"> Merchant Service Agreement?</a>
      </label>
    </div>
  </div>
  <div class="col-12">
  <button type="submit" class="btn save">Save</button>
    <!-- <button type="submit" class="btn btn-primary">Save</button> -->
  </div>
</form>

                                 <!--  -->
                         

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-remuneratiuon" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="">
                        bfnh
                    </div>
                </div>

            </div>


        </div>
        
</section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
