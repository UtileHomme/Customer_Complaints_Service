<?php
include_once 'customer_complaints_header.php';
?>

<div class="container">
    <div class="row">

        <div class="col-lg-8">
            <?= form_open('customercomplaintsdashboard/search',['class'=>'form-horizontal','role'=>'search']) ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Filter by Department or status" />
                </div>
            </div>

            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <?= form_close() ?>
            <!-- show the errors from query box -->
            <?= form_error('query', '<p class="text-danger">', '</p>')?>
        </div>

        <div class="col-lg-4">
            <?= anchor('customercomplaintsdashboard/add_complaint','Add Complaint',['class'=>'btn btn-lg btn-primary pull-right']) ?>
        </div>
    </div>
    <?php if($feedback = $this->session->flashdata('feedback')):
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
</div>

<div class="container">
    <table class="table">
        <thead>
            <th class="text-center">Sr. No</th>
            <th class="text-center">Complaint id</th>
            <th class="text-center">Complaint Body</th>
            <th class="text-center">Department</th>
            <th class="text-center">Status</th>
        </thead>
        <tbody>
            <?php
            if(count($complaints)):

                // Take the third uri segment and if it isn't there, then take 0 by default
                $count = $this->uri->segment(3);
                foreach($complaints as $complaint):
                    ?>
                    <tr class="text-center">
                        <td><?= ++$count; ?></td>
                        <td><?= $complaint->complaint_id ?></td>
                        <td><pre><?= $complaint->complaint_body ?></pre></td>
                        <td><?= $complaint->dept ?></td>
                        <td><?= $complaint->status ?></td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="3">
                        <h3 class="text-danger">No records Found</h3>
                    </td>
                </tr>
                <?php
            endif;
            ?>
        </tbody>
    </table>
</div>
