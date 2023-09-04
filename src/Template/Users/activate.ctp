<section id="profile">
    <div class="container">
        <div class="in_heading">
            <h1>Activation</h1>
            <h2>Activation</h2>
            <p class="mb-4">Enter the Activation Code you would have received via SMS. If you haven't recieved your code you can try again.</p>
        </div>
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->Form->create('User', array(
            'class' => 'form-control',
            'controller' => 'Users',
            'action' => 'activate',
            'type' => 'file',
            'enctype' => 'multipart/form-data',
            'validate',
            // 'onsubmit' => 'return validate();'
        )); ?>
        <div class="profil_deaile">
            <div class="row">

                <div class="col-md-12">
                    <div class="profile-details">
                        <div class="row g-3">
                            <h6>Activation</h6>

                            <p class="profile_subH">Enter the Activation Code you would have received via SMS. If you haven't recieved your code you can try again</p>
                            <div class="col-md-6">

                                <label for="inputName">Activation Code<strong style="color:red;">*</strong></label>

                                <?php
                                echo $this->Form->input(
                                    'is_mob_verify',
                                    ['required' => 'required','placeholder' => 'Enter Activation Code', 'class' => 'form-control', 'label' => false]
                                ); ?>
                            </div>

                            <div class="col-12">
                                <button class="save">Activate</button>
                                <a class="back" href="<?php echo SITE_URL . 'users/authorize'; ?>">Resend</a>
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>