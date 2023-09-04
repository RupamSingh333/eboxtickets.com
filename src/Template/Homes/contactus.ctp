<section id="contact_us">
  <div class="container">
    <div class="heading">
      <h1>Contact us</h1>
      <h2>Contact us</h2>
      <?php echo $this->Flash->render(); ?>
      <p class="mb-4 heading_p">Any question or remarks? Just write us a message!</p>
    </div>

    <div class="contact_map">
      <!-- <img src="images/contact_map_bg.png" alt="service"> -->

    </div>
    <!--  -->


    <div class="row no-gutters">
      <div class="col-sm-6">
        <div class=" content_inf">
          <div class="info">
            <ul>
              <li class="d-flex ">
                <i class="fas fa-mobile-alt mr-1 mr-2"></i>
                <div>
                  <h6>Office </h6><span>868-222-2534</span>
                </div>
              </li>

              <li class="d-flex ">
                <!-- <i class="fas fa-phone-alt mr-1 mr-2"></i> -->
                <i class="bi bi-whatsapp whatsapp_icon mr-1 mr-2"></i>

                <div>
                  <h6>Whatsapp </h6><span>868-778-6837</span>
                </div>
              </li>

              <li class="d-flex ">
                <i class="far fa-envelope mr-1 mr-2"></i>
                <div>
                  <h6>Email id </h6><span>info@eboxtickets.com</span>
                </div>
              </li>

              <li class="d-flex ">
                <i class="fas fa-map-marker-alt mr-1 mr-2"></i>
                <div>
                  <h6>Address</h6><span>Unit#5 Courtyard, <br> Government Campus Plaza<br> Nos 1-3 Richmond Street<br> Port of Spain</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="contact_form">
          <h3>Get In Touch</h3>
          <div class="form-group">
            <?php echo $this->Form->create($userDatas, array(
              'class' => 'form-horizontal',
              'controller' => 'logins',
              'action' => 'contactus',
              'enctype' => 'multipart/form-data',
              'autocomplete' => 'on',
              'validate'
            )); ?>
            <div class="form-group">
              <?php
              echo $this->Form->input(
                'name',
                ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Name', 'label' => false]
              ); ?>
            </div>

            <div class="form-group">
              <?php
              echo $this->Form->input(
                'email',
                ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Email', 'label' => false]
              ); ?>
            </div>
            <div class="form-group">
              <?php
              echo $this->Form->input(
                'event',
                ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Event', 'label' => false]
              ); ?>
            </div>
            <div class="form-group">

              <?php
              $service = ['acc_activation' => 'Account Activation', 'scanning_resources' => 'Scanning Resources', 'printed_tickets' => 'Printed Tickets', 'payment_issue' => 'Payment Issue', 'groups' => 'Groups', 'customer_support' => 'Customer Support', 'other' => 'Other'];
              echo $this->Form->input(
                'subject',
                ['empty' => 'Choose Subject', 'options' => $service, 'default' => ($userdata['gender']) ? $userdata['gender'] : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
              ); ?>
            </div>
            <div class="form-group">
              <textarea name="description" placeholder="Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div id="html_element" class="login_capcher"></div>
            <button type="submit" class="btn btn subtn btn-primary">Submit <i class="fas fa-angle-double-right"></i></button>
          </div>
          </form>
        </div>
      </div>

    </div>

    <!--  -->



  </div>
</section>
<!-- =========================================== -->

<style>
  #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
  }
</style>

<!-- ================================= -->
<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('html_element', {
      'sitekey': '6LeB9HAiAAAAACkicqxER3FNn7DzH0shkLfYvGk1'
    });
  };

  window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');
    if ($recaptcha) {
      $recaptcha.setAttribute("required", "required");
    }
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>