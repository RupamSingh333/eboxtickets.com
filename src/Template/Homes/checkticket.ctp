<section id="chick_tickte"><!--event_detail_page-->
<div class="container">
<hgroup class="innerpageheading">
<h2>Check Tickte</h2>
<ul>
<li><a href="#">Home</a></li>
<li><i class="fas fa-angle-double-right"></i></li>
<li>Check Ticket</li>
</ul>
</hgroup>

<div class="chick_tickte_form">
  <form class="form-horizontal" action="">
  <div class="form-group">
    <div class="col-sm-4">
    <label>E-Mail Id</label>
    <input type="text" class="form-control" id="" placeholder="Enter E-Mail Id">
    </div>
    <div class="col-sm-4">
    <label>Phone No.</label>
    <input id="phone" name="phone" class="form-control" type="tel">
    </div>
    <div class="col-sm-4">
    <label>Order Id</label>
    <input type="text" class="form-control" id="" placeholder="Order Id">
    </div>
    </div>
    <div class="form-group"> 
    <div class="col-sm-12">
      <button type="submit" class="main_button">Upload</button>
    </div>
  </div>
  </form>


</div>

</div> 
<div class="footer_buildings"></div>
</section><!--upcoming Event End-->

<script>
    $("#phone").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js"
    });
</script>   