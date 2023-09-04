<link href="https://staging.eboxtickets.com/css/responsive.css" rel="stylesheet" type="text/css">
<section id="profile">

    <div class="container">
        <div class="heading">
            <h1>Profile</h1>
            <h2>My Profile</h2>
            <p class="mb-4">Your profile information is displayed below.</p>
        </div>
        <?php echo $this->Flash->render(); ?>
        <div class="profil_deaile">
            <div class="row">
                <div class="col-md-3">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?php
                            // pr($userdata['name']); die;
                            $imagename =  $userData['profile_image'];
                            if ($imagename) {
                                $image =  $imagename;
                            } else {
                                $image =  'noimage.jpg';
                            } ?>

                            <img src="<?php echo IMAGE_PATH . 'Usersprofile/' . $image; ?>" alt="Maxwell Admin">

                        </div>
                        <h5 class="user-name"><?php echo $userData['name'] . ' ' . $userData['lname']; ?></h5>
                        <a class="edit" href="<?php echo SITE_URL; ?>users/updateprofile"><i class="fas fa-edit"></i>
                            Edit Profile</a>

                    </div>
                </div>
                <!-- <div class="col-md-1">
                  
                </div> -->
                <div class="col-md-9">
                    <div class="profile-details">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $userData['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Registered On</td>
                                    <td><?php echo  date('D, dS M Y h:i A', strtotime($userData['created'])); ?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td><?php echo $userData['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo $userData['lname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td><?php echo date('d-m-Y', strtotime($userData['dob'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $userData['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>
                                        <?php if ($userData['is_mob_verify'] == 'Y') {
                                            echo $userData['mobile']; ?>
                                        <button type="button" class="btn verified_btn" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Verified">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </button>

                                        <?php } else { ?>

                                        <a class="edit" href="<?php echo SITE_URL; ?>users/authorize">Verify Phone
                                            Number</a>
                                        <?php }  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email Related Events</td>
                                    <td>
                                        Yes </td>
                                </tr>
                                <tr>
                                    <td>Email Newsletter</td>
                                    <td> Yes </td>
                                </tr>
                                <!-- <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <a href="https://staging.eboxtickets.com/users/updateprofile" class="btn btn-primary">Edit Profile</a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- =========================================== -->
<!-- ================================= -->