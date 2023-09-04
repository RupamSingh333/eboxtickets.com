<?php $name=$this->request->session()->read('Auth.User.name');?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo SITE_URL ;?></title>

<style>
   .fade {
    opacity: 1 !important;
  }
/*=======================================All Searching input designs=============================
 * ================================================================================================
 * ===================================================================================================*/
 
 #myUL2, #myUL1, #myUL{
    position: relative !important;
    z-index: 999 !important;
  }
  #myUL2 ul, #myUL1 ul, #myUL ul {
    list-style-type: none;
    overflow-y: scroll;
    margin: 0;
    padding: 0;
    max-height:150px !important;
    position: absolute;
    width: 100% !important;
    background-color: #eaeaea !important;
  }

  #myUL2 li, #myUL1 li, #myUL li {
    font-size:13px !important;
    border-bottom: 0px solid #ccc !important;
margin-left: 0px !important;
    margin-top: 0px !important;
    
  }

  #myUL2 li  li:last-child {
    border: none;

  }

  #myUL1 li  li:last-child {
    border: none;
  }

  #myUL li  li:last-child {
    border: none;
  }
  
  #myUL2 li  a, #myUL1 li a, #myUL li a {
    text-decoration: none;
    color: #000;
    display: block;
    padding:  8px 13px !important;
    width: 100% !important;
    height: auto !important;

    -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
    -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
    -o-transition: font-size 0.3s ease, background-color 0.3s ease;
    -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
    transition: font-size 0.3s ease, background-color 0.3s ease;
  }

   #myUL2 li  a:hover, #myUL1 li a:hover, #myUL li a:hover {
background-color: #ddd;
}
</style>

<!---------bootstrap-------------------->
<link href="<?php echo SITE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL; ?>css/fontawesome-all.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL; ?>css/fonts.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!------------font-awesome------------------>

<!------------Poppins-font------------------>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<!---------------genral------------------
<script src="<?php //echo SITE_URL ?>js/jquery.min.js" type="text/javascript"></script> ---->
<link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.theme.default.min.css">
<link href="<?php echo SITE_URL; ?>css/style.css" rel="stylesheet" type="text/css">

<link href="<?php echo SITE_URL; ?>css/responsive.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
 <script src="<?php echo SITE_URL ?>datepicker/jquery-3.2.1.min.js"></script>
   <link href="<?php echo SITE_URL; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

  


         <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
    var uluru = {lat: 26.9620727, lng: 75.7816225};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: uluru,
          zoom: 15
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
          var curinput = document.getElementById('pac-inputss');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var autocompletecurrent = new google.maps.places.Autocomplete(curinput);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);
        autocompletecurrent.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
      position: uluru,
          map: map,
    anchorPoint: new google.maps.Point(0, -29)

        });
        autocomplete.addListener('place_changed', function() { 
          infowindow.open();
          marker.setVisible(false);
          var place = autocomplete.getPlace(); 
           changelatlong(place.geometry.location);
         // alert(place);
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

         infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
         infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
        });

//current location 
 autocompletecurrent.addListener('place_changed', function() { 
          infowindow.open();
          marker.setVisible(false);
          var place = autocompletecurrent.getPlace(); 
           changelatlongcurrent(place.geometry.location);
         // alert(place);
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

         infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
         infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
        });

function changelatlongcurrent(location)
        {
          latitudecurrent = location.lat(); 
          longitudecurrent = location.lng(); 
          if(document.getElementById('latitudecurrent')!=undefined)
          {
            document.getElementById('latitudecurrent').value = latitudecurrent; 
          }
          if(document.getElementById('longitudecurrent')!=undefined)
          {
            document.getElementById('longitudecurrent').value = longitudecurrent; 
          }
        }

        function changelatlong(location)
        {
          latitude = location.lat(); 
          longitude = location.lng(); 
          if(document.getElementById('latitude')!=undefined)
          {
            document.getElementById('latitude').value = latitude; 
          }
          if(document.getElementById('longitude')!=undefined)
          {
            document.getElementById('longitude').value = longitude; 
          }
        }


        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC27M5hfywTEJa5_l-g0KHWe8m8lxu-rSI&libraries=places&callback=initMap"
        async defer></script>
  
</head>
<body>
<div id="page-wrapper">
<header id="header" class="inner_header"><!--Header Start-->
        <nav class="navbar">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<?php if(empty($this->request->session()->read('Auth.User.id'))){ ?>
    <div class="" id="myNavbar">
      <ul class="nav navbar-nav">
		   
         <input type="hidden" id="location_ids">
        <li class="head_search"> <form action="<?php echo SITE_URL  ?>homes/usersearch">
              <input class="secrh-loc" type="text" placeholder="Search Event" autocomplete="off"  name="search" required>
             <button type="submit" style="background-color: transparent; position: absolute; right: 10px;top: 13px;"><i class="fas fa-search" style="position: absolute;top: 0px;right: 0px;"></i></button></form>
       <div id="myUL2"><ul></ul></div> 
        </li>
        
        <li><a href="<?php echo SITE_URL; ?>home">Home</a></li>
        <li class="active"><a href="<?php echo SITE_URL; ?>signup">Login</a></li>

        <!--
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Event Organiser
          <span class="caret"></span> </a>
          <ul class="dropdown-menu">
          <li><a href="<?php //echo SITE_URL; ?>dashboardmyevent">My Event</a></li>
          <li><a href="<?php //echo SITE_URL; ?>postevent">Post Event</a></li>
          <li><a href="#">Logout</a></li>
          </ul>
          </li>
          -->
        <!--<li><a href="<?php //echo SITE_URL; ?>checkticket">Check Ticket </a></li>-->
        <ul class="second_menu">
           <!--<li><a href="<?php echo SITE_URL; ?>event/upcomingevent">Upcoming Events</a></li>-->
          <!--<li><a href="Past event.html">Past Events</a></li>-->
        </ul>
      </ul>
     <div class="clearfix"></div>
        
    </div>
<?php } else {?>
	
	
	
	

<div class="" id="myNavbar">
      <ul class="nav navbar-nav dashboard_menu">
        
         <input type="hidden" id="location_ids">
        <li class="head_search"> <form action="<?php echo SITE_URL  ?>homes/usersearch">
              <input class="secrh-loc" type="text" placeholder="Search Event" autocomplete="off"  name="search" required>
             <button type="submit" style="background-color: transparent; position: absolute; right: 10px;top: 13px;"><i class="fas fa-search" style="position: absolute;top: 0px;right: 0px;"></i></button></form>
       <div id="myUL2"><ul></ul></div> 
        </li>
             <!--   <li><a href="<?php //echo SITE_URL; ?>checkticket">Check Ticket </a></li>-->

        <li class="profile_menu"><a href="#"><span>Welcome <?php echo $this->request->session()->read('Auth.User.name');?><i class="fas fa-angle-down"></i></span></a>
        <ul class="profile_menu_opetion">
                <li><a href="<?php echo $this->Url->build('/users/updateprofile'); ?>"><i class="fas fa-user"></i> Edit Profile</a></li>


<?php if ($this->request->session()->read('Auth.User.status')=='Y' && $this->request->session()->read('Auth.User.role_id')==3){ ?>
<li><a href="<?php echo SITE_URL; ?>tickets/myticket"><i class="fas fa-calendar" aria-hidden="true"></i>My Ticket</a></li>
<?php } ?>

<?php if ($this->request->session()->read('Auth.User.status')=='Y' && $this->request->session()->read('Auth.User.role_id')==2){ ?>
<li><a href="<?php echo SITE_URL; ?>users/employee"><i class="fas fa-user" aria-hidden="true"></i>My Employee</a></li>
        <li><a href="<?php echo SITE_URL; ?>homes/myevent"><i class="fas fa-calendar" aria-hidden="true"></i>My Event</a></li>
        <li><a href="<?php echo SITE_URL; ?>tickets/myticket"><i class="fas fa-calendar" aria-hidden="true"></i>My Ticket</a></li>
        
          <li><a href="<?php echo SITE_URL; ?>homes/postevent"><i class="fas fa-calendar" aria-hidden="true"></i>Post Event</a></li>
          <?php } ?>
              <!--<li><a href="<?php //echo SITE_URL; ?>event/upcomingevent">Upcoming Events</a></li>-->

        <li><a href="<?php echo $this->Url->build('/logins/frontlogout'); ?>"><i class="fas fa-power-off"></i> Logout</a></li>
        </ul>
        </li>
     
        <!--<ul class="second_menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="upcoming List.html">Upcoming Events</a></li>
          <li><a href="Past event.html">Past Events</a></li>
        </ul>-->
      </ul>
     <div class="clearfix"></div>
        
    </div>
  
   
<?php } ?>
</div>

  <div class="container">
    <div class="navbar-header">
      <span style="font-size:30px;cursor:pointer; color:#fff;" onclick="openNav()">&#9776;</span>
      <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL ?>images/logo.png" alt="logo";></a>
    </div>


  <?php if(empty($this->request->session()->read('Auth.User.id'))){ ?>
       <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
     <input type="hidden" id="location_ids">
        <li class="head_search"> <form action="<?php echo SITE_URL  ?>homes/usersearch">
              <input class="secrh-loc" type="text" placeholder="Search Event" autocomplete="off"  name="search" required>
             <button type="submit" style="background-color: transparent; position: absolute; right: 10px;top: 13px;"><i class="fas fa-search" style="position: absolute;top: 0px;right: 0px;"></i></button></form>
       <div id="myUL2"><ul></ul></div> 
        </li>
        <li><a href="<?php echo SITE_URL; ?>home">Home</a></li>
 <li><a href="<?php echo SITE_URL; ?>event/upcomingevent">Upcoming Events</a></li>
        <li class="active "><a href="<?php echo SITE_URL; ?>signup">Login</a></li>

        <!--
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Event Organiser
          <span class="caret"></span> </a>
          <ul class="dropdown-menu">
          <li><a href="<?php //echo SITE_URL; ?>dashboardmyevent">My Event</a></li>

          <li><a href="<?php //echo SITE_URL; ?>postevent">Post Event</a></li>
          <li><a href="#">Logout</a></li>
          </ul>
          </li>
          -->
        <!--<li><a href="<?php //echo SITE_URL; ?>checkticket">Check Ticket </a></li>-->
        <ul class="second_menu">
<!--<li><a href="<?php echo SITE_URL; ?>event/upcomingevent">Upcoming Events</a></li>-->
          <!--<li><a href="Past event.html">Past Events</a></li>-->
        </ul>
      </ul>
     <div class="clearfix"></div>
        
    </div>
<?php } else {?>
	
	
	
	

<div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav dashboard_menu">
         
        <input type="hidden" id="location_ids">
        <li class="head_search"> <form action="<?php echo SITE_URL  ?>homes/usersearch">
              <input class="secrh-loc" type="text" placeholder="Search Event" autocomplete="off"  name="search" required>
             <button type="submit" style="background-color: transparent; position: absolute; right: 10px;top: 13px;"><i class="fas fa-search" style="position: absolute;top: 0px;right: 0px;"></i></button></form>
       <div id="myUL2"><ul></ul></div> 
        </li>
                              
       <!-- <li><input type="text" placeholder="Search Event"><i class="fas fa-search"></i></li>-->
             <!--   <li><a href="<?php //echo SITE_URL; ?>checkticket">Check Ticket </a></li>-->

        <li class="profile_menu"><a href="#"><span>Welcome <?php echo $name;?><i class="fas fa-angle-down"></i></span></a>
        <ul class="profile_menu_opetion">
        <li><a href="<?php echo $this->Url->build('/users/updateprofile'); ?>"><i class="fas fa-user"></i> Edit Profile</a></li>

<?php if ($this->request->session()->read('Auth.User.status')=='Y' && $this->request->session()->read('Auth.User.role_id')==3){ ?>

<li><a href="<?php echo SITE_URL; ?>tickets/myticket"><i class="fas fa-calendar" aria-hidden="true"></i>My Ticket</a></li>
<?php } ?>
        
         <?php if ($this->request->session()->read('Auth.User.status')=='Y' && $this->request->session()->read('Auth.User.role_id')==2){ ?>
	<li><a href="<?php echo SITE_URL; ?>users/employee"><i class="fas fa-user" aria-hidden="true"></i>My Employee</a></li>



        <li><a href="<?php echo SITE_URL; ?>homes/myevent"><i class="fas fa-calendar" aria-hidden="true"></i>My Event</a></li>
        
       <li><a href="<?php echo SITE_URL; ?>tickets/myticket"><i class="fas fa-calendar" aria-hidden="true"></i>My Ticket</a></li>
          <li><a href="<?php echo SITE_URL; ?>homes/postevent"><i class="fas fa-calendar" aria-hidden="true"></i>Post Event</a></li>
          <?php } ?>
               <!--<li><a href="<?php //echo SITE_URL; ?>event/upcomingevent">Upcoming Events</a></li>-->

        <li><a href="<?php echo $this->Url->build('/logins/frontlogout'); ?>"><i class="fas fa-power-off"></i> Logout</a></li>
        </ul>
        </li>
      
        <!--<ul class="second_menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="upcoming List.html">Upcoming Events</a></li>
          <li><a href="Past event.html">Past Events</a></li>
        </ul>-->
      </ul>
     <div class="clearfix"></div>
        
    </div>
  
   
<?php } ?>
  </div>
</nav>
        <script>

 setTimeout(function(){
 $('.alert').remove();
}, 3000);

</script>
        
    </header><!--Header-End--> 


   <script type="text/javascript">
 
   function cllbck(id,cid) {
       $('.secrh-loc').val(id);
       $('#location_ids').val(cid);
       $('#myUL2' ).hide();
   }
   $( function() {
       $('.secrh-loc').bind('keyup',function(){  
           var pos=$(this).val();

           $( '#myUL2' ).show();
           $( '#location_ids' ).val('');
           var count=pos.length;
          
           if(count > 0)
           {
               $.ajax({
                   type: 'POST',
                   url: '<?php echo SITE_URL; ?>homes/loctions',
                   data: {'fetch':pos},
                   success: function(data){  console.log(data);
                       $('#myUL2 ul').html(data);
                   },    
               });
           }else{
               $( '#myUL2' ).hide();  
           }  
       });    
   });
</script>
