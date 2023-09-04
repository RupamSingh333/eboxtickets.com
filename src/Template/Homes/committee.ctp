<!-- 
<link rel="stylesheet" href="https://ssl.uh.edu/css/uh-main.css?v=20141216" type="text/css"> -->
<section id="dashboard_pg">
  <div class="container">

    <div class="dashboard_pg_btm">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between dash_menutog align-items-center">
            <!--  -->
            <nav class="navbar navbar-expand-lg navbar-light p-0">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">Dashboard</a>
                </div>
              </div>
            </nav>
            <!--  -->
            <ul class="list-inline dash_ulbtn">
              <li class="list-inline-item ">

                <a href="<?php echo SITE_URL; ?>homes/myevent"> <button type="submit" class="btn save">View Event</button></a>
              </li>
            </ul>
            <!--  -->
          </div>
        </div>

        <div class="form">
          <h2><i class="far fa-calendar-plus"></i>Post Event</h2>
          <div class="form_inner">
            <!--  -->
            <ul id="progressbar">
              <li class="active">Event Info</li>
              <li class="active">Manage Tickets & Addons</li>
              <li class="active">Questions</li>
              <li class="active">Committee</li>
              <li>Settings</li>
              <!-- <li>View Event</li> -->
            </ul>
            <!--  -->

            <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">

              <div style="display:none;">

              </div>
              <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">
                <fieldset>
                  <h4>Choose Committee</h4>

                  <section id="register">
                    <div class="register_contant">
                      <!-- -------------------- -->
                      <div class="addone">
                        <!-- <form method="post"> -->
                        <div class="row">


                          <!-- ========================================= -->

                          <div class="col-md-8">
                            <div class="Committee">

                              <h6 class="">Current Committee (1)</h6>

                              <form class="g-3">
                                <div class="row">
                                  <div class="col-10">
                                    <div class="input-group">
                                      <div class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                      </div>
                                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    </div>
                                  </div>
                                  <div class="col-2">
                                    <button type="button" class="btn btn-primary Add_com" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      Add
                                    </button>

                                  </div>
                                </div>

                              </form>





                              <!-- <form class="row g-3 align-items-center">
                                <div class="col-9">
                                  <div class="input-group">
                                    <div class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                      </svg>
                                    </div>
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                  </div>
                                </div>
                                <div class="col-3">
                                  Add
                                </div>
                              </form> -->
                              <hr>

                              <div class="row Current_heading">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-7">
                                  <p> Name</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>Status</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>Remove</p>
                                </div>
                              </div>

                              <div class="row item_list align-items-center">
                                <div class="col-sm-1 item-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="checked">
                                  </div>
                                </div>

                                <div class="col-sm-7">
                                  <p>Games in the Park Single Tech Game play</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                      </svg></a>
                                  </p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></a>
                                </div>
                              </div>

                              <div class="row item_list align-items-center">
                                <div class="col-sm-1 item-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="checked">
                                  </div>
                                </div>

                                <div class="col-sm-7">
                                  <p>Games in the Park Single Tech Game play</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                      </svg></a>
                                  </p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></a>
                                </div>
                              </div>

                              <div class="row item_list align-items-center">
                                <div class="col-sm-1 item-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="checked">
                                  </div>
                                </div>

                                <div class="col-sm-7">
                                  <p>Games in the Park Single Tech Game play</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                      </svg></a>
                                  </p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></a>
                                </div>
                              </div>

                              <div class="row item_list align-items-center">
                                <div class="col-sm-1 item-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="checked">
                                  </div>
                                </div>

                                <div class="col-sm-7">
                                  <p>Games in the Park Single Tech Game play</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                      </svg></a>
                                  </p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></a>
                                </div>
                              </div>

                              <div class="row item_list align-items-center">
                                <div class="col-sm-1 item-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="checked">
                                  </div>
                                </div>

                                <div class="col-sm-7">
                                  <p>Games in the Park Single Tech Game play</p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <p>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                      </svg></a>
                                  </p>
                                </div>
                                <div class="col-sm-2 item-center">
                                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></a>
                                </div>
                              </div>





                            </div>
                          </div>
                          <!-- <div class="col-md-1">
                  
                </div> -->
                          <div class="col-md-4">
                            <div class="import_committee">
                              <h6>Import Committee</h6>
                              <form class="row g-3 align-items-center">
                                <div class="col-12">
                                  <!-- <label class="visually-hidden" for="inlineFormInputGroupUsername">search</label> -->
                                  <div class="input-group">
                                    <div class="input-group-text">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                      </svg>
                                    </div>
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                  </div>
                                </div>

                                <div class="col-12">
                                  <a href="#"><button type="submit" class="btn save">Proceed</button></a>
                                </div>

                              </form>

                              <div class="cart_price ">

                              </div>

                            </div>
                          </div>


                          <!-- <div class="col-md-4 mb-3">
                            <label for="firstname">Name<strong style="color:red;">*</strong></label>
                            <?php
                            //echo $this->Form->input('email', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Search', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off','required'=>"required", 'value' => ($addon_name) ? $addon_name : "")); 
                            ?>
                          </div>
                          <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Add" />
                          </div> -->

                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <!-- <a class="close " href="<?php echo SITE_URL; ?>homes/questions<?php echo isset($getId) ? '/' . $getId : '' ?>">Previous</a> -->

                      </div>
                  </section>

                </fieldset>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('.spinner').hide();
    $(".search_sec").on("keyup", function(e) {
      var pos = e.target.value;
      $('.spinner').show();
      $.ajax({
        async: true,
        data: {
          'search': pos
        },
        type: "post",
        url: "<?php echo SITE_URL; ?>homes/usersearch",
        success: function(data) {
          $("#Mycity").html(data);
          $('.spinner').hide();

        },
      });
      return false;
    });
  });
</script>