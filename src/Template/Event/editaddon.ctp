
    <?php echo $this->Form->create($findaddon, array(
        'url' => array('controller' => 'event', 'action' => 'editaddon'),
        'class' => '',
        'id' => '',
        'enctype' => 'multipart/form-data',
        'validate',
        'autocomplete' => 'off'

    )); ?>
    <!-- <form method="post" action="event/edittickets" enctype="multipart/form-data" class="needs-validation"> -->
    <div class="row g-3 text-start">
    <div class="col-md-6 ">
        <label for="inputName" class="form-label">Name</label>
        <?php
        echo $this->Form->input(
            'name',
            ['required' => 'required', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter Ticket Name', 'label' => false]
        ); ?>
    </div>

    <div class="col-md-6 ">
        <label for="inputname" class="form-label">Price</label>
        <?php
        echo $this->Form->input(
            'price',
            ['required' => 'required', 'placeholder' => 'Price', 'class' => 'form-control', 'label' => false, 'onkeypress' => 'return isPrice()']
        ); ?>
    </div>

    <div class="col-md-6 ">
        <label for="inputname" class="form-label">Count</label>
        <?php
        echo $this->Form->input(
            'count',
            ['required' => 'required', 'placeholder' => 'Count', 'class' => 'form-control', 'label' => false, 'onkeypress' => 'return isPrice()']
        ); ?>
    </div>

    <div class="col-md-6 ">
        <label for="inputState" class="form-label">Visibility</label>
        <?php
        $hidden = ['Y' => 'Hidden', 'N' => 'Visible'];
        echo $this->Form->input(
            'hidden',
            ['empty' => 'Choose One', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => '', 'label' => false]
        ); ?>
    </div>

    <div class="col-md-12 ">
        <label for="inputname" class="form-label">Description</label>
        <?php echo $this->Form->input('description', array('class' => 'form-control price price_error', 'type' => 'textarea', 'label' => false, 'placeholder' => 'Enter description', 'required', 'autocomplete' => 'off')); ?>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn save">Update Addon</button>
    </div>
 
</div>
</form>
<!-- ================== -->

<script>
    function isPrice(e) {
        var e = e || window.event;
        var k = e.which || e.keyCode;
        var s = String.fromCharCode(k);
        if (/^[\\\"\'\;\:\.\,\[\]\>\<\/\?\=\+\_\|~`!@#\$%^&*\(\)a-z\A-Z]$/i.test(s)) {
            alert("Special characters not acceptable");
            return false;
        }
    }

</script>