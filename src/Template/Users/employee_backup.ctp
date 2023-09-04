 <section id="my_ticket_page">
   <!--event_detail_page-->
   <div class="container">
     <hgroup class="innerpageheading">
       <h2>My Employee</h2>
       <ul>
         <li><a href="http://flashticket.co-opselfservice.com/">Home</a></li>
         <li><i class="fas fa-angle-double-right"></i></li>
         <li>My Employee</li>
       </ul>

       <a data-toggle="modal" data-target="#myemployeemodal" class="pull-right" href="#" style="width: 15%;background-color: #ec118b;color: #fff;padding: 8px 15px;border-radius: 0px;font-size: 16px;"> Add Employee</a>

     </hgroup>



     <?php echo $this->Flash->render(); ?>


     <div class="my_ticket_content">
       <div class="my_ticket_form">
         <div class="tab-content">
           <div id="event_tab_1" class="tab-pane fade in active">
             <div id="exampleevent" class="table-responsive">

               <?php if ($employee) { ?>
                 <table class="table">
                   <thead>
                     <tr>
                       <th>S.No</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Mobile</th>
                       <th>Created</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $s = 1;
                      foreach ($employee as $key => $values) {  //pr($value);die;
                      ?>

                       <tr>
                         <td><?php echo $s; ?></td>
                         <td><?php echo $values['name']; ?></td>
                         <td><?php echo $values['email']; ?></td>
                         <td><?php echo $values['mobile']; ?></td>
                         <td><?php echo date('d M Y H:i', strtotime($values['created'])); ?></td>
                         <td>
                           <a data-toggle="modal" class='employeeedit btn btn-success ' href="<?php echo SITE_URL; ?>users/employeedit/<?php echo $values['id']; ?>"><i class="fas fa-edit"></i></a>

                           <a href="<?php echo SITE_URL; ?>/users/employeedelete/<?php echo $values['id']; ?>"><i class="fas fa-trash"></i></a>
                         </td>
                       </tr>
                     <?php $s++;
                      } ?>
                   </tbody>
                 </table>
               <?php } else {
                  echo  "No Records";
                } ?>

             </div>
           </div>




         </div>

       </div>

 </section>
 <!--upcoming Event End-->


 <script>
   $('.employeeedit').click(function(e) {
     e.preventDefault();
     $('#myModalempedit').modal('show').find('.modal-body').load($(this).attr('href'));
   });
 </script>


 <div id="myModalempedit" class="modal fade">
   <div class="modal-dialog">

     <div class="modal-content">
       <div class="modal-body"></div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->

 </div>


 <!-- Modal -->
 <div class="modal fade" id="myemployeemodal" role="dialog">
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header" style="
    background-color: #ec118b;
">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add Employee</h4>
       </div>
       <div class="modal-body">
         <form id="empform" action="<?php echo SITE_URL; ?>users/employee" method="post">

           <div class="form-group row">
             <label for="inputEmail3" class="col-sm-1 col-form-label"><strong>Name</strong></label>
             <div class="col-sm-8">
               <input type="text" name="name" class="form-control" id="inputEmail2" placeholder="Name" required>
             </div>
             <div class="col-sm-3"></div>
           </div>

           <div class="form-group row">
             <label for="inputEmail3" class="col-sm-1 col-form-label"><strong>Email</strong></label>
             <div class="col-sm-8">
               <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" required>
               <span id="empemval" style="display: none; color: red; text-align: left;">Email already exist!!</span>
             </div>
             <div class="col-sm-3"></div>
           </div>

           <div class="form-group row">
             <label for="inputEmail3" class="col-sm-1 col-form-label"><strong>Mobile</strong></label>
             <div class="col-sm-8">
               <input type="text" name="mobile" class="form-control" id="inputEmail4" placeholder="Mobile" minlength="10" maxlength="12" required>
               <span id="empmoval" style="display: none; color: red; text-align: left;">Mobile number already exist!!</span>
             </div>
             <div class="col-sm-3"></div>
           </div>



           <div class="form-group row">
             <div class="col-sm-10">
               <button type="submit" class="btn btn-primary" id="empdata">Submit</button>
             </div>
           </div>
         </form>
       </div>

     </div>

   </div>
 </div>

 <script>
   $(document).ready(function() { //alert();
     $("#empform").submit(function(e) {
       e.preventDefault();
       var name = $('#inputEmail2').val();
       var email = $('#inputEmail3').val();
       var mobile = $('#inputEmail4').val();



       $.ajax({
         type: 'POST',
         url: '<?php echo SITE_URL; ?>/users/checkempdata',
         data: {
           email: email,
           mobile: mobile
         },
         success: function(data) { //alert(data);

           obj = JSON.parse(data);
           //alert(obj.mobile);		
           if (obj.email == 1) {
             $("#empemval").css("display", "block");
             $("#empmoval").css("display", "none");

             return false;
           } else if (obj.mobile == 1) {
             $("#empemval").css("display", "none");
             $("#empmoval").css("display", "block");
             return false;
           } else {
             document.getElementById("empform").submit();
           }

         }

       });



     });
   });
 </script>