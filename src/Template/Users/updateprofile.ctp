<link href="https://staging.eboxtickets.com/css/responsive.css" rel="stylesheet" type="text/css">
<section id="profile">
    <div class="container">
        <div class="heading">
            <h1>Profile</h1>
            <h2>Edit Profile</h2>
            <p class="mb-4">Your profile information is displayed below.</p>
        </div>
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create('User', array(
            'class' => 'dgdfg',
            'controller' => 'Users',
            'action' => 'updateprofile',
            'type' => 'file',
            'enctype' => 'multipart/form-data',
            'validate',
            // 'onsubmit' => 'return validate();'
        )); ?>
        <div class="profil_deaile">
            <div class="row">
                <div class="col-md-3">
                    <!--  -->


                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input name="profile_image" id="imageUpload" />
                            <label for="imageUpload" data-bs-toggle="modal" data-bs-target="#exampleModal">

                            </label>
                        </div>
                        <div class="avatar-preview">
                            <?php
                            $imagename =  $userdata['profile_image'];
                            if ($imagename) {
                                $image =  $imagename;
                            } else {
                                $image =  'noimage.jpg';
                            } ?>

                            <div id="imagePreview" style="background-image: url('<?php echo IMAGE_PATH . 'Usersprofile/' . $image; ?>');">

                            </div>
                        </div>
                        <h5 class="user-name"><?php echo $userdata['name'] . ' ' . $userdata['lname']; ?></h5>
                        <!-- <a class="edit" href="#">Upload Picture</a> -->
                    </div>

                    <!--  -->
                    <!-- <div class="user-profile">
            <div class="user-avatar">
              <img src="https://staging.eboxtickets.com//images/profile_img.jpg" alt="Maxwell Admin">
            </div>
            <h5 class="user-name">John husen</h5>
            <a class="edit" href="#">Upload Picture</a>
          </div> -->
                    <!--  -->
                </div>
                <!-- <div class="col-md-1">
                  
                </div> -->
                <div class="col-md-9">
                    <div class="profile-details">
                        <div class="row g-3">
                            <h6>Edit Your Profile</h6>

                            <p class="profile_subH">You can edit your profile below including updating your password.
                            </p>
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <label for="inputName" class="form-label">First Name</label>
                                <!-- <input type="text" class="form-control" id="inputEmail4" value="Marvin"> -->
                                <?php
                                $name = $userdata['name'];
                                echo $this->Form->input('fname', array('required', 'class' => 'form-control', 'placeholder' => 'First Name', 'value' => isset($name) ? $name : '', 'label' => false)); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputName" class="form-label">Last Name</label>
                                <!-- <input type="text" class="form-control" id="inputEmail4" value="Marvin"> -->
                                <?php
                                $lname = $userdata['lname'];
                                // pr($userdata['dob']);exit;
                                echo $this->Form->input('lname', array('required', 'class' => 'form-control', 'placeholder' => 'Last Name', 'value' => isset($lname) ? $lname : '', 'label' => false)); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputName" class="form-label">Email</label>
                                <?php echo $this->Form->input('email', array('required', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => isset($userdata['email']) ? $userdata['email'] : '', 'label' => false, 'readonly')); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputState" class="form-label">Gender</label>
                                <?php
                                $gender = ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'];
                                echo $this->Form->input(
                                    'gender',
                                    ['empty' => 'Choose Gender', 'options' => $gender, 'default' => ($userdata['gender']) ? $userdata['gender'] : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                ); ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputName" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" id="inputEmail4" value="<?php echo date('Y-m-d', strtotime($userdata['dob'])) ?>">

                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputName" class="form-label">Phone Number</label>
                                <?php
                                if ($userdata['mobile']) {
                                    echo $this->Form->input('mob', array('class' => 'form-control', 'placeholder' => 'Phone Number', 'value' => isset($userdata['mobile']) ? $userdata['mobile'] : '', 'label' => false, 'readonly'));
                                } else { ?>
                                    <a class="form-control" href="<?php echo SITE_URL; ?>users/authorize">Verify Phone
                                        Number</a>
                                <?php } ?>

                            </div>

                            <h6 class="mt-4">Change Password</h6>

                            <p class="profile_subH">Leave blank if you do not wish to change your password.</p>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputPassword4" class="form-label">Old Password</label>
                                <input type="password" name="oldpass" placeholder="Old Password" class="form-control" id="inputPassword4" autocomplete="off">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="inputPassword4" class="form-label">New Password</label>
                                <input type="password" name="new_pass" placeholder="New Password" class="form-control" id="inputPassword4" autocomplete="off">
                            </div>

                            <h6 class="mt-4">Email Notifications</h6>

                            <p class="profile_subH">You can manage the notifications you recieve via email.</p>




                            <div class="col-12 d-flex cheak">
                                <div class="form-check me-4">
                                    <input class="form-check-input" name="emailNewsLetter" value="Y" <?php echo ($userdata['emailNewsLetter'] == 'Y') ? 'checked' : ''; ?> type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Email Newsletter
                                    </label>
                                </div>
                                <div class="form-check me-4">
                                    <input class="form-check-input" name="emailRelatedEvents" <?php echo ($userdata['emailRelatedEvents'] == 'Y') ? 'checked' : ''; ?> value="Y" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Email Related Events
                                    </label>
                                </div>

                            </div>
                            <hr class="mt-2">
                            <div class="col-12 text-end">

                                <!-- <a class="save" type="submit">Save</a> -->
                                <a class="back" href="<?php echo SITE_URL . 'users/viewprofile'; ?>">View Profile</a>
                                <button class="save">Save</button>
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Picture Guidlines</p>
                <p>Please ensure that you have complied with the following Site Rules to avoid your profile from being
                    deleted:</p>

                <ol type="1">
                    <li>1. Your face must be clearly visible.</li>
                    <li>2. The photo uploaded MUST be YOU.</li>
                    <li>3. The background of the photo must be clear with no other obsured objects.</li>
                    <li>4. You can use only your picture for one account.</li>

                </ol>

                <p>We have some methods of determining the above but they're not absolute. We review your uploads
                    manually and can reject submissions that we find doesn't match the aforementioned criteria.</p>
                <br>
                <?php echo $this->Form->create('User', array(
                    'class' => 'dgdfg',
                    'controller' => 'Users',
                    'action' => 'updateprofileimage',
                    'type' => 'file',
                    'enctype' => 'multipart/form-data',
                    'validate',
                    // 'onsubmit' => 'return validate();'
                )); ?>
                <input type="file" id="myImg" name="profile_image" accept="image/png, image/gif, image/jpeg" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>

</div>



<!-- =========================================== -->


<script>
    var _URL = window.URL || window.webkitURL;
    $("#myImg").change(function(e) {
        var file, img, Extension;
        Extension = this.files[0]['name'].split('.').pop();

        if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
            // To Display
            var img = document.getElementById("myImg");
            if (img.files[0]) // validation according to file size
            {
                uploadimage(img);

            }
        } else {
            document.getElementById("myImg").value = "";
            $('#imagenamexx').html('');
            alert('Uploaded file is not a valid image. Only JPG, PNG and JPEG files are allowed.')
            return false;
        }

        // if ((file = this.files[0])) {
        //   img = new Image();
        //   var objectUrl = _URL.createObjectURL(file);
        //   img.onload = function() {
        //     if (this.width < 200 || this.height < 200) {
        //       alert(`Image dimensions are too small. Minimum (Size 200*200)*. Uploaded image (Size ${this.height} px * ${this.width})`);
        //       document.getElementById("myImg").value = "";
        //     }
        //     _URL.revokeObjectURL(objectUrl);
        //   };
        //   img.src = objectUrl;
        // }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
<!-- ================================= -->