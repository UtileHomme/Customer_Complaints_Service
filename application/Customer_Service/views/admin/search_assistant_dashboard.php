<?php
include 'assistant_complaints_header.php';
?>

<div class="container">
    <table class="table">
        <thead>
            <th class="text-center">Sr. No</th>
            <th class="text-center">Complaint id</th>
            <th class="text-center">Complaint Body</th>
            <th class="text-center">Department</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
            <?php
            if(count($searchcomplaints)):

                // Take the third uri segment and if it isn't there, then take 0 by default
                $count = $this->uri->segment(3);
                foreach($searchcomplaints as $searchcomplaint):
                    ?>
                    <tr class="text-center">
                        <td><?= ++$count; ?></td>
                        <td><?= $searchcomplaint->complaint_id ?></td>
                        <td><pre><?= $searchcomplaint->complaint_body ?></pre></td>
                        <td><?= $searchcomplaint->dept ?></td>
                        <td><?= $searchcomplaint->status ?></td>
                        <td class="text-center">
                           <div class="row text-center">
                               <div class="col-lg-6">
                                   <!-- This will give the url with the end value as id of the article which is to be edited -->
                                   <?= anchor("assistantcomplaintsdashboard/edit_status/{$searchcomplaint->complaint_id}",'Edit Status',['class'=>'btn btn-primary']); ?>
                               </div>
                           </div>
                       </td>
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
