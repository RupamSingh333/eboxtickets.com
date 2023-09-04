<div class="row g-3 text-start">
    <div class="col-md-12">
        <label for="inputName" class="form-label">33131</label>
        <?php

        echo $this->Form->input(
            'title',
            ['required' => 'required', 'class' => 'form-control', 'default' => '', 'placeholder' => 'Enter Ticket Name', 'label' => false]
        ); ?>
    </div>
    <div class="col-md-12">
        <label for="inputState" class="form-label">Type</label>
        <?php
        $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
        echo $this->Form->input(
            'type',
            ['empty' => 'Choose Type', 'options' => $type, 'default' => '', 'required' => 'required', 'class' => 'form-select', 'label' => false]
        ); ?>
    </div>
    <div class="col-md-12">
        <label for="inputname" class="form-label">Price</label>

        <?php
        echo $this->Form->input(
            'price',
            ['required' => 'required', 'placeholder' => 'Price', 'class' => 'form-control', 'label' => false, 'onkeypress' => 'return isPrice()']
        ); ?>
    </div>

    <div class="col-md-12">
        <label for="inputname" class="form-label">Count</label>
        <?php echo $this->Form->input('count', array('class' => 'form-control price price_error', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => '')); ?>
    </div>

    <div class="col-md-12">
        <label for="inputState" class="form-label">Visibility</label>
        <?php
        $hidden = ['Y' => 'Visible', 'N' => 'Hidden'];
        echo $this->Form->input(
            'hidden',
            ['empty' => 'Choose One', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => '', 'label' => false]
        ); ?>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn save">Add Ticket</button>
    </div>
</div>
<!-- ================== -->