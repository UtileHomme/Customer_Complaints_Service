<?php
include ('customer_header.php');
?>

<div class="container">

    <!-- the next line acts like the action of the form method..
    as soon as submit button is clicked, it will go the the customerlogin controller and access
    the customer_login function of that controller -->
    <?php
    echo form_open('customerlogin/customer_login', ['class'=>'form-horizontal']);
    ?>
    <fieldset>
        <legend>Customer Login</legend>

        <?php if($feedback = $this->session->flashdata('feedback1')):
            $feedback_class = $this->session->flashdata('feedback_class');
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-dismissible <?= $feedback_class ?>">
                        <?= $feedback ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Displaying the invalid username password error out here
        if the error has occurred and flashdata has been set    -->
        <?php if($error = $this->session->flashdata('login_failed')): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-dismissible alert-danger">
                        <?= $error ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <!-- Using form helper class for creating text field -->
                        <?php
                        echo form_input(['name'=>'username', 'class'=>'form-control', 'placeholder'=>'Enter your username','value'=>set_value('username')]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- This will display the username errors beside it -->
                <?php
                echo form_error('username');
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">

                        <!-- Using form helper class for creating password field -->
                        <?php
                        echo form_password(['name'=>'password', 'class'=>'form-control', 'placeholder'=>'Enter your password']);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php
                echo form_error('password');
                ?>
            </div>
        </div>
        <br />
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2" style="padding-left:30px;">
                <?php
                echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']);
                echo form_submit(['name'=>'submit','value'=>'Login','class'=>'btn btn-primary']);
                ?>
            </div>
        </div>
    </fieldset>
<?= form_close() ?>

</div>
