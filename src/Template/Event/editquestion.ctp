<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<?php echo $this->Form->create($findquestion, array(
    'url' => array('controller' => 'event', 'action' => 'editquestion'),
    'class' => '',
    'enctype' => 'multipart/form-data',
    'validate',
    'autocomplete' => 'off'

)); ?>
<!-- =============== -->
<div class="row g-3 text-start">

    <div class="col-md-12">
        <label for="inputName" class="form-label">Type</label>
        <?php
        // 'Multiple' => 'Multiple',
        $type = ['Select' => 'Select', 'Text' => 'Text', 'Agree' => 'Agree'];

        echo $this->Form->input(
            'type',
            ['empty' => 'Choose Type', 'options' => $type, 'class' => 'form-select', 'label' => false, 'required', 'disabled' => 'disabled']
        ); ?>
    </div>
    <div class="col-md-12">
        <label for="inputname" class="form-label">Question Name</label>

        <?php
        echo $this->Form->input(
            'name',
            ['required', 'placeholder' => 'Question Name', 'class' => 'form-control', 'label' => false]
        ); ?>
    </div>

    <div class="col-md-12">
        <label for="inputname" class="form-label">Question</label>

        <?php echo $this->Form->input('question', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Question', 'required', 'autocomplete' => 'off')); ?>
    </div>
    

    <div class="col-md-10" id="iterupam">
        <label for="inputname" class="form-label">Items</label>
        <?php

        $finditems = $this->Comman->questionitems($findquestion['id']);

        foreach ($finditems as $key => $value) { ?>
            <input type="text" name="items[]" class="form-control itemnew" id="<?php echo 'remove' . $key; ?>" value="<?php echo $value['items']; ?>" placeholder="Item" required> &nbsp
            <!-- <a href="#" type="button" id="<?php //echo 'remove'.$key;
                                                ?>" class="remove">remove</a> -->
        <?php  } ?>
        

    </div>
    <div class="col-md-2 text-end" id="itemmain_add">
        <button class="btn add_items" type='button' id='additem'><i class="bi bi-plus"></i></button>
    </div>

    

</div>
<!-- ================== -->
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn save">Update Question</button>
</div>
</form>


<script>
    $(document).ready(function() {
        
        $("#additem").click(function() {
            $("#iterupam").append(`<div id="removeaddon">
             <input type="text" name="items[]" class="form-control" placeholder="Item" required="required" autocomplete="off">
             <a href="javascript:void(0);" type="button" class="btn remove"><i class="bi bi-dash"></i></a></div>&nbsp`);
        });


        // $('a.remove').click(function(e) {
        //     e.preventDefault();
        //     var id = $(this).attr('id');
        //     $("#"+id).remove();
        //     $(this).remove();

        // });


    });
</script>