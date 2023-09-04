<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eboxtickets</title>
  <meta name="description" content="Sufee Admin - HTML5 Admin Template">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <!-- <link rel="shortcut icon" href="favicon.ico">-->
  <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL; ?>images/favicon.png">
  <link href="<?php echo SITE_URL; ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/normalize.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/responsive.css">
  <link href="<?php echo SITE_URL; ?>datepicker/bootstrap-formhelpers.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/scss/style.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/admin/css/newstyle.css">
  <link href="<?php echo SITE_URL; ?>css/admin/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <link href="<?php echo SITE_URL; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
  <script src="<?php echo SITE_URL; ?>datepicker/jquery-3.2.1.min.js"></script>
  <script src="<?php echo SITE_URL; ?>js/admin/main.js"></script>
  <script src="<?php echo SITE_URL; ?>js/admin/vendor/jquery-2.1.4.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

  <style type="text/css">
    .imgg {
      display: inline-block;
    }

    .form-control {
      font-size: 13px !important;
      border-radius: 0px !important;
      padding: 8px 4px !important;

    }

    body {
      font-size: 12px !important;
    }

    .page-header {
      font-size: 16px !important;
    }
  </style>

  <script>
    function initMap() {


      var uluru = {
        lat: 26.9620727,
        lng: 75.7816225
      };
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
          map.setZoom(17); // Why 17? Because it looks good.
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
          map.setZoom(17); // Why 17? Because it looks good.
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

      function changelatlongcurrent(location) {
        latitudecurrent = location.lat();
        longitudecurrent = location.lng();
        if (document.getElementById('latitudecurrent') != undefined) {
          document.getElementById('latitudecurrent').value = latitudecurrent;
        }
        if (document.getElementById('longitudecurrent') != undefined) {
          document.getElementById('longitudecurrent').value = longitudecurrent;
        }
      }

      function changelatlong(location) {
        latitude = location.lat();
        longitude = location.lng();
        if (document.getElementById('latitude') != undefined) {
          document.getElementById('latitude').value = latitude;
        }
        if (document.getElementById('longitude') != undefined) {
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
          autocomplete.setOptions({
            strictBounds: this.checked
          });
        });
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC27M5hfywTEJa5_l-g0KHWe8m8lxu-rSI&libraries=places&callback=initMap" async defer></script>

</head>

<body class="open">


  <!-- Left Panel -->
  <?php echo $this->element('admin/left'); ?>

  <div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

      <div class="header-menu">

        <div class="col-sm-7">
          <!-- <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a> -->
          <div class="row">
            <div class="col-sm-3">
              <img class="" src="<?php echo SITE_URL; ?>images/Logoblack.png" />
            </div>

          </div>

        </div>

        <div class="col-sm-5">
          <div class="user-area dropdown float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="user-avatar rounded-circle" src="<?php echo SITE_URL ?>images/admin.jpg" />
            </a>

            <div class="user-menu dropdown-menu">

              <a class="nav-link" href="<?php echo SITE_URL; ?>admin/users/index/1"><i class="fa fa -cog"></i>Settings</a>

              <a class="nav-link" href="<?php echo SITE_URL; ?>logins/logout/"><i class="fa fa-power -off"></i>Logout</a>
            </div>
          </div>

          <div class="language-select dropdown" id="language-select">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true" aria-expanded="true">
              <i class="flag-icon flag-icon-us"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="language">
              <div class="dropdown-item">
                <span class="flag-icon flag-icon-fr"></span>
              </div>
              <div class="dropdown-item">
                <i class="flag-icon flag-icon-es"></i>
              </div>
              <div class="dropdown-item">
                <i class="flag-icon flag-icon-us"></i>
              </div>
              <div class="dropdown-item">
                <i class="flag-icon flag-icon-it"></i>
              </div>
            </div>
          </div>

        </div>
      </div>

    </header><!-- /header -->
    <!-- Header-->