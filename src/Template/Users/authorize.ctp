<section id="profile">
    <div class="container">
        <div class="heading">
            <h1>Verification</h1>
            <h2>Phone Number Verification</h2>
            <p class="mb-4">To further protect ourselves, our clients and our customers, we require you verify your phone number via SMS. Enter your country and phone number below. YOU CAN ONLY VERIFY ONE PHONE NUMBER PER ACCOUNT!.</p>
        </div>
        <?php echo $this->Flash->render(); ?>

        <?php echo $this->Form->create('User', array(
            // 'class' => 'form-control',
            'controller' => 'Users',
            'action' => 'authorize',
            'type' => 'file',
            'enctype' => 'multipart/form-data',
            'validate',
            // 'onsubmit' => 'return validate();'
        )); ?>
        <div class="profil_deaile">
            <div class="row">
                <!-- <div class="col-md-3">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?php
                            $imagename =  $userdata['profile_image'];
                            if ($imagename) {
                                $image =  $imagename;
                            } else {
                                $image =  'profile_img.jpg';
                            } ?>

                            <img src="<?php //echo IMAGE_PATH . 'Usersprofile/' . $image; 
                                        ?>" alt="Maxwell Admin">

                        </div>
                        <h5 class="user-name">John husen</h5>
                        <a class="edit" href="<?php //echo SITE_URL; 
                                                ?>/users/updateprofile"><i class="fas fa-edit"></i> Edit Profile</a>



                    </div>
                </div> -->
                <!-- <div class="col-md-1">
                  
                </div> -->
                <div class="col-md-12">
                    <div class="profile-details">
                        <div class="row g-3">
                            <h6>Verification</h6>

                            <p class="profile_subH">You can edit your profile below including updating your password.</p>
                            <div class="col-md-4">
                                <!-- <label for="inputName" class="form-label">First Name</label> -->
                                <!-- <input type="text" class="form-control" id="inputEmail4" value="Marvin"> -->
                                <label for="inputName">Country<strong style="color:red;">*</strong></label>

                                <?php
                                echo $this->Form->input(
                                    'country_id',
                                    ['empty' => 'Choose Country', 'options' => $country,'required' => 'required', 'class' => 'form-select', 'label' => false, 'id' => 'countryy']
                                ); ?>
                            </div>


                            <div class="col-md-8">
                                <label for="validationDefault08">Phone Number (Please Enter Phone Number Without Country Code)</label>

                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend"></span>
                                    <?php
                                    /* echo $this->Form->input(
                                        'mobile',
                                        ['required' => 'required', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Phone Number', 'min' => '15', 'max' => '15', 'label' => false]
                                    ); */ ?>
                                    <input type="text" name="mobile" required="required" class="form-control" placeholder="Phone Number" min="15" max="15" id="mobile">

                                </div>




                                <div class="col-12 text-end mt-3">
                                    <button class="save">Send Verification Code</button>
                                    <a class="back" href="<?php echo SITE_URL . 'users/activate'; ?>">I got a code already</a>
                                    <!-- <a class="save" type="submit">Save</a> -->
                                    <a class="back" href="<?php echo SITE_URL . 'users/viewprofile'; ?>">View Profile</a>
                                </div>
                            </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>

<script type="text/javascript">
    $('#countryy').bind('change', function() {
        $.ajax({
            async: true,
            type: 'post',
            success: function(data) {
                obj = JSON.parse(data);
                $('#inputGroupPrepend').text(obj.words);
            },
            url: "<?php echo SITE_URL; ?>users/getcountrycode",
            data: $('#countryy').serialize()
        })
    })
</script>