
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
                 
                  <a href="#"> <button type="submit" class="btn save">View Event</button></a>
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
                  <li style="" class="active">Event Info</li>
                  <li style="">Manage Tickets & Addons</li>
                  <li style="">Questions</li>
                  <li style="">Settings</li>
                  <li style="">View Event</li>
                </ul>
                <!--  -->
             
                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation" novalidate="novalidate" action="/pages/addtender"><div style="display:none;"><input type="hidden" name="_method" value="POST"><input type="hidden" name="_csrfToken" autocomplete="off" value="5ba881f62319ca60f04d912bdb9cc3b1478c8332a4a98b16d7c1b6611bc58033357eb57902ce02be639a1cbcc043f83c0e451d18cbea70e087c5ea8645b84519">
              </div>                
              
              <fieldset>
                  <h4>Manage Tickets</h4>

    <section id="register">
       <div class="register_contant">
<!-- -------------------- -->

        <div class="property-fields__rows">
         <div id="property-fields__row-1" class="property-fields__row property-fields__row-item">

            <div class="row">
                <div class="col-md-2  mb-3">
                    <label for="firstname">Name</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-2  mb-3">
                    <label for="lastname">Type</label>
                    <select id="inputState" class="form-select">
                      <option value="717">Open Sales</option>
                      <option value="732" selected="selected">Committee Sales</option>
                     
                    </select>
                </div>
                <div class="col-md-2  mb-3">
                    <label for="firstname">Price</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-2  mb-3">
                    <label for="firstname">Count</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-3  mb-3">
                    <label for="lastname">Visibility</label>
                    <select id="inputState" class="form-select">
                      <option value="717">Hidden</option>
                      <option value="732" selected="selected">Visible</option>
                     
                    </select>
                </div>
           </div>
           
  </div>
  <div class="line-item-property__actions">
      <input type="button" id="btnAdd" value="+" />
      <input type="button" id="btnDel" value="-" />
    </div>
  

</div>



<!-- ------------------- -->
              
        </div>
</section>


<hr>
<!--  -->
<h4>Addons</h4>
<div class="addone">
<form method="post"> <div class="row">
                <div class="col-md-6  mb-3">
                    <label for="firstname">Name</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-6  mb-3">
                    <label for="firstname">Price</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-6  mb-3">
                    <label for="firstname">Count</label>
                    <input type="text" class="form-control" name="name" required="" value="">
                </div>
                <div class="col-md-6  mb-3">
                    <label for="lastname">Visibility</label>
                    <select id="inputState" class="form-select">
                      <option value="717">Hide</option>
                      <option value="732" selected="selected">Show</option>
                     
                    </select>
                </div>
                <div class="col-md-12  mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
                              
           <hr>
            <a class="close" href="#"> Close</a>
            <a class="save" href="#"> Add Addon</a>
           
          
  </form> 
 </div>
<!--  -->

                

           </form>
          
        </div>
     </div>
    </section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

$(document).ready(function () {
  var num = $('.property-fields__row').length;
  if (num - 1 == 0)
    $('#btnDel').attr('disabled', 'disabled');

  $('#btnAdd').click(function () {

    var num = $('.property-fields__row').length;
    var newNum = num + 1;
    var newElem = $('#property-fields__row-1').clone().attr('id', 'property-fields__row-' + newNum);


    newElem.find('.line-item-property__year label').attr('for', 'year_' + newNum).val('');
    newElem.find('.line-item-property__year input').attr('id', 'year_' + newNum).attr('name', 'properties[YEAR '  + newNum + ']').val('');

    newElem.find('.line-item-property__team label').attr('for', 'team-name_' + newNum).val('');
    newElem.find('.line-item-property__team input').attr('id', 'team-name_' + newNum).attr('name', 'properties[TEAM NAME '  + newNum + ']').val('');

    newElem.find('.line-item-property__name label').attr('for', 'winner-name_' + newNum).val('');
    newElem.find('.line-item-property__name input').attr('id', 'winner-name_' + newNum).attr('name', 'properties[WINNER NAME '  + newNum + ']').val('');


    $('#property-fields__row-' + num).after(newElem);

    $('#btnDel').attr('disabled', false);

    if (newNum == 19)

      $('#btnAdd').attr('disabled', 'disabled');

  });

  $('#btnDel').click(function () {
    var num = $('.property-fields__row').length; 

    $('#property-fields__row-' + num).remove();

    $('#btnAdd').attr('disabled', false);

    if (num - 1 == 1)

      $('#btnDel').attr('disabled', 'disabled');

  });
});


</script>
    

          
        