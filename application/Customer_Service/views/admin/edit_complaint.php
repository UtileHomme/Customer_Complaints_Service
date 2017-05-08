<?php
include_once 'assistant_complaints_header.php';
?>

<div class="container">
    <!-- we are redirecting to the url ensuring that the session id of the updated complaint is sent in the url -->
    <?php echo form_open("assistantcomplaintsdashboard/update_status/".$complaints->complaint_id, ['class'=>'form-horizontal']); ?>

    <fieldset>
        <legend>Edit Complaint Status</legend>

        <div class="row">

            <div class="col-lg-6">
                <div class="form-group">
                    <!-- <label for="inputEmail" class="col-lg-4 control-label" style="padding:0px;">Complaint Body</label> -->
                    <div class="col-lg-12">
                        <?php echo form_textarea(['name'=>'complaint_body','class'=>'form-control','placeholder'=>'Complaint Body','value'=>set_value('complaint_body', $complaints->complaint_body)]); ?>
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
                    echo form_fieldset('Present Status');
                    $options = array(
                        'open'=>'Open',
                        'working'=>'Working',
                        'closed'=>'Closed'
                    );
                    echo form_fieldset_close();
                    echo form_dropdown('status', $options,$complaints->status);
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
</form>
</div>
