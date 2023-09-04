<?php echo $this->Flash->render(); ?>
<?php echo $this->Form->create($newpack, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><strong>Edit Email Template</strong></div>
    <!-- <div class="content-wrapper"> -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <?php echo $this->Flash->render(); ?>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">EDIT EMAIL TEMPLATE</h3>
            </div> -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title*</label>
                  <?php echo $this->Form->input('title', array('class' =>
                  'form-control', 'id' => 'exampleInputEmail1', 'placeholder' => 'Title', 'label' => false, 'autocomplete' => 'off', 'required')); ?>

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">From Email*</label>
                  <?php echo $this->Form->input('fromemail', array('class' =>
                  'form-control', 'id' => 'exampleInputEmail1', 'type' => 'email', 'placeholder' => 'From Email', 'label' => false, 'autocomplete' => 'off', 'required')); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject*</label>
                  <?php echo $this->Form->input('subject', array('class' =>
                  'form-control', 'id' => 'exampleInputEmail1', 'placeholder' => 'Subject', 'label' => false, 'autocomplete' => 'off', 'required')); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">From Name</label>
                  <?php echo $this->Form->input('fromname', array('class' =>
                  'form-control', 'id' => 'exampleInputEmail1', 'type' => 'text', 'placeholder' => 'From Name', 'label' => false, 'autocomplete' => 'off')); 
                  ?>
                </div>
                <div class="form-group" style="width:100%;">
                  <label for="exampleInputPassword1">Format Description*</label>
                  <script>
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
                  </script>
                  <?php

                  echo $this->Form->input('description', array('class' =>
                  'form-control', 'placeholder' => 'Format Description', 'required', 'label' => false, 'type' => 'textarea', 'autocomplete' => 'off', 'id' => 'summernote')); ?>
                </div>
                <div class="box-footer">
                  <button type="submit" onClick="return validationDefault();" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </section>
    <!-- </div> -->
  </div>
</div>