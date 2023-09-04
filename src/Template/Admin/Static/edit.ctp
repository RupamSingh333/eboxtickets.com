 <?php echo $this->Flash->render(); ?>
 <?php echo $this->Form->create($static, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

 <div class="col-lg-12">
   <div class="card">
     <div class="card-header"><strong>Static Manager</strong></div>
     <div class="card-header">

       <?php if (isset($static['id'])) {
          echo '<small> Edit Static Detail</small>';
        } else {
          echo 'Add Static';
        } ?>
     </div>

     <div class="card-body card-block">
       <div class="col-sm-6">
         <div class="form-group">
           <label for="company" class=" form-control-label">Title</label>
           <?php echo $this->Form->input('title', array('class' =>
            'longinput form-control', 'placeholder' => 'Enter Title', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => $static['title'])); ?>
         </div>
       </div>

       <div class="col-sm-12">
         <div class="form-group">
           <label for="company" class=" form-control-label">Description</label>
           <script>
             var site_url = '<?php echo SITE_URL; ?>';

             $(document).ready(function() {
               $("#summernote").summernote({
                 placeholder: 'enter directions here...',
                 height: 300,
                 callbacks: {
                   onImageUpload: function(files, editor, welEditable) {

                     for (var i = files.length - 1; i >= 0; i--) {
                       sendFile(files[i], this);
                     }
                   }
                 },
                 toolbar: [
                   // [groupName, [list of button]]
                   ['style', ['bold', 'italic', 'underline', 'clear', 'fontname', 'fontsize', 'color', 'bold', 'italic', 'underline']],
                   ['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
                   ['fontsize', ['fontsize']],
                   ['color', ['color']],
                   ['para', ['ul', 'ol', 'paragraph']],
                   ['height', ['height']],
                   ['picture', ['picture']],
                   ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']]
                 ]
               });
             });

             function sendFile(file, el) {
               var form_data = new FormData();
               form_data.append('file', file);
               $.ajax({
                 data: form_data,
                 type: "POST",
                 url: '<?php echo ADMIN_URL; ?>Static/uploadimage',
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(url) {
                   //alert(url);
                   $(el).summernote('editor.insertImage', url);
                 }
               });
             }
           </script>

           <?php echo $this->Form->input('descr', array('class' =>
            'longinput form-control summernote', 'placeholder' => 'Course Duration', 'required', 'label' => false, 'type' => 'textarea', 'id' => 'summernote', 'autocomplete' => 'off')); ?>
         </div>
       </div>

     </div>

     <div class="content mt-3">
       <div class="row">
         <div class="col-sm-1">
           <a href="<?php echo SITE_URL ?>admin/static" class="btn btn-primary ">Back</a>
         </div>
         <div class="col-sm-1">
           <?php if (isset($transports['id'])) {
              echo $this->Form->submit('Update', array(
                'title' => 'Update', 'div' => false,
                'class' => array('btn btn-primary btn-sm')
              ));
            } else {  ?>
             <button type="submit" class="btn btn-success">Submit</button>
           <?php  } ?>
         </div>
       </div>
     </div>
   </div>
 </div>
 <?php echo $this->Form->end(); ?>