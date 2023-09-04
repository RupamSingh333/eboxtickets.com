<div class="row g-3 text-start">
    



    <div class="col-md-12">
        <label for="inputname" class="form-label">Choose Ticket Report</label>
        <?php echo $this->Form->input('image', array('class' => 'form-control price price_error', 'type' => 'file', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => '')); ?>
    </div>

    <div class="col-md-12">
        <label for="inputState" class="form-label">Remark</label>
        <?php
        echo $this->Form->input('remark',['required' => 'required', 'class' => 'form-control', 'default' => '', 'label' => false,'type'=>'textarea']
        ); ?>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn save">Submit</button>
    </div>
</div>
<!-- ================== -->