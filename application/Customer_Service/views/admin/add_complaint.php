<?php
include_once 'customer_complaints_header.php';
?>

<div class="container">
    <?php echo form_open('customercomplaintsdashboard/store_complaint', ['class'=>'form-horizontal']); ?>

    <!-- we wish to send the user id along with form when the submit button is clicked
    so that the user_id field of complaints table can be updated -->
    <?php echo form_hidden('user_id',$this->session->userdata('c_user_id')); ?>

    <fieldset>
        <legend>Add Complaint</legend>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="col-lg-12">
                        <?php echo form_textarea(['name'=>'complaint_body','class'=>'form-control','placeholder'=>'Complaint Body','value'=>set_value('complaint_body')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php echo form_error('complaint_body'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <?php
                    echo form_fieldset('Choose the Department');
                    $options = array(
                        'med'=>'Medical',
                        'admin'=>'Admin',
                        'transport'=>'Transport'
                    );
                    echo form_dropdown('dept', $options, 'med');
                    echo form_fieldset_close();
                    echo br();
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-10">
                <?php
                echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']);
                echo form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);
                ?>
            </div>
        </div>
    </fieldset>

    <?php echo form_close(); ?>
</div>
