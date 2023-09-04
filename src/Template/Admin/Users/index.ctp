<style>
    .chngpass {
        margin-left: 15px
    }
</style>
<?php echo $this->Flash->render(); ?>
<?php $role_id = $this->request->session()->read('Auth.User.role_id'); ?>
<?php echo $this->Form->create($Users, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Profile setting</strong></div>

        <div class="card-body card-block">
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Name</label>
                        <?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'first_name', 'label' => false)); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Mobile</label>
                        <?php echo $this->Form->input('mobile', array('class' => 'form-control', 'placeholder' => 'Mobile Number', 'id' => 'Mobile', 'label' => false)); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Contact Email</label>
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email Address', 'id' => 'Mobile', 'label' => false)); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Facebook URL</label>
                        <?php echo $this->Form->input('fburl', array('class' => 'form-control', 'placeholder' => 'Facebook URL', 'id' => 'Mobile', 'label' => false)); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Instagram URL</label>
                        <?php echo $this->Form->input('instaurl', array('class' => 'form-control', 'placeholder' => 'Instagram URL', 'id' => 'Mobile', 'label' => false)); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Twitter URL</label>
                        <?php echo $this->Form->input('Twitterurl', array('class' => 'form-control', 'placeholder' => 'Twitter URL', 'id' => 'Mobile', 'label' => false)); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Googleplus URL</label>
                        <?php echo $this->Form->input('googleplusurl', array('class' => 'form-control', 'placeholder' => 'Twitter URL', 'id' => 'Mobile', 'label' => false, 'type' => 'text')); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Linkdin URL</label>
                        <?php echo $this->Form->input('linkdinurl', array('class' => 'form-control', 'placeholder' => 'Twitter URL', 'id' => 'Mobile', 'label' => false, 'type' => 'text')); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">GooglePlay Store</label>
                        <?php echo $this->Form->input('googleplaystore', array('class' => 'form-control', 'placeholder' => 'GooglePlus Store', 'id' => 'Mobile', 'label' => false, 'type' => 'text')); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Apple Store</label>
                        <?php echo $this->Form->input('applestore', array('class' => 'form-control', 'placeholder' => 'Apple Store', 'id' => 'Mobile', 'label' => false, 'type' => 'text')); ?>
                    </div>
                </div>

                <?php /*if($this->request->session()->read('Auth.User.role_id')=='4'){ ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="company" class=" form-control-label">Exam Fees</label>
                        <?php echo $this->Form->input('fees',array('class'=>'form-control','placeholder'=>'Exam Fees','required','onkeypress'=>'return isNumber(event);','maxlength'=>'4','label' =>false)); ?>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="company" class=" form-control-label">Payment instruction</label>
                        <?php echo $this->Form->input('instruction',array('class'=>'form-control','placeholder'=>'Payment instruction','required','type'=>'textarea', 'id'=>'Mobile','label' =>false)); ?>
                        </div>
                        </div>
                <?php }*/ ?>

                <div class="col-sm-6">
                    <div class="form-group">
                        <a href="javascript:void(0)" style="background-color: yellow; color: red;" class="chngpassword">Do you want to change password ?</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php echo $this->Form->label('forFreeEvent', 'Required for Event Approvals', ['class' => 'form-control-label']) ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?php echo $this->Form->label('forFreeEvent', 'For Free Event', ['class' => 'form-control-label']) ?>
                            <?php echo $this->Form->checkbox('forFreeEvent', [
                                'label' => 'For Free Event',
                                'checked' => $Users['forFreeEvent'] == 'Y',
                                'value' => 'Y' // Set value to 'Y' when the checkbox is checked
                            ]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?php echo $this->Form->label('forPaidEvent', 'For Paid Event', ['class' => 'form-control-label']) ?>
                            <?php echo $this->Form->checkbox('forPaidEvent', [
                                'label' => 'For Paid Event',
                                'checked' => $Users['forPaidEvent'] == 'Y',
                                'value' => 'Y' // Set value to 'Y' when the checkbox is checked
                            ]) ?>
                        </div>

                    </div>
                </div>


                <div class="col-sm-12" style="padding-bottom: 15px;">
                    <div class="passdata" style="display:none;">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="inputEmail3" class="form-control-label">New Password</label>
                                <?php echo $this->Form->input('new_password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'New Password', 'id' => 'confirm_pass', 'label' => false, 'value' => $Users['confirm_pass'])); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="inputEmail3" class="form-control-label">Confirm Password</label>
                                <?php echo $this->Form->input('confirm_pass', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'id' => 'password', 'label' => false)); ?>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <!-- <div class="col-sm-12">
                <div class="form-group">
                    <a href="javascript:void(0)" class="chngpassword">Do you want to change password ?</a>
                </div>
            </div> -->

        </div>


    </div>
    <div class="col-lg-1">
        <div class="card-body">

            <?php if (isset($Users['id'])) {
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

</div>


<?php if ($role_id == '1') {
?>
    <script>
        $(document).ready(function() {
            $(".chngpassword").click(function() {
                $(".passdata").toggle();
            });
        });
    </script>

<?php } else { ?>
    <script>
        $(document).ready(function() {
            $(".passdata").toggle();
        });
    </script>

<?php } ?>




<script type="text/javascript">
    function check_pass() {
        //alert("check");
        var pass = $('#password').val();
        var cpas = $('#confirm_password').val();
        if (pass != cpas) {
            alert("Password and Confirm Password should be same");
            return false;
        }
        if (pass.length < 5) {
            alert("Password should be 5 characters long!!");
            return false;
        } else {
            return true;
        }

    }
</script>