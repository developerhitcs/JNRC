<?php
$fields = array(
    'Form No.' => 'form_number',
    'Registration No.' => 'registration_number',
    'Passed-out batch/session' => 'session_label_snapshot',
    'Status' => 'status',
    'Institution' => 'institution_name_snapshot',
    'Institution code' => 'school_code',
    'Name in full' => 'full_name',
    "Father's Name" => 'father_name',
    'Marital Status' => 'marital_status',
    'Age' => 'age',
    'Date of Birth' => 'date_of_birth',
    'Identification mark' => 'identification',
    'Permanent Address' => 'permanent_address',
    'Present Address' => 'present_address',
    'Educational Qualification' => 'educational_qualification',
    'Roll No.' => 'roll_number',
    'Professional Qualification' => 'professional_qualification',
    '10th School' => 'tenth_school',
    '10th Board' => 'tenth_board',
    '10th Roll No.' => 'tenth_roll_number',
    '10th Passing Year' => 'tenth_passing_year',
    '10th Marks' => 'tenth_marks_obtained',
    '10th Total Marks' => 'tenth_total_marks',
    '12th School / College' => 'twelfth_school',
    '12th Board' => 'twelfth_board',
    '12th Roll No.' => 'twelfth_roll_number',
    '12th Passing Year' => 'twelfth_passing_year',
    '12th Marks' => 'twelfth_marks_obtained',
    '12th Total Marks' => 'twelfth_total_marks',
    'Nursing Institution' => 'nursing_institution',
    'Nursing Council' => 'nursing_council',
    'Nursing Roll No.' => 'nursing_roll_number',
    'Nursing Enrollment No.' => 'nursing_enrollment_number',
    'Nursing Passing Year' => 'nursing_passing_year',
    'Nursing Marks' => 'nursing_marks_obtained',
    'Nursing Total Marks' => 'nursing_total_marks',
    'Last Year / Semester' => 'nursing_last_semester',
    'Nationality' => 'nationality',
    'Religion' => 'religion',
    'Training From' => 'training_from',
    'Training To' => 'training_to',
    'Passing Month and Year' => 'passing_date',
    'Category' => 'category',
    'Qualifying Institution' => 'qualifying_institution',
    'Council / University' => 'qualifying_council',
    'Registration required as' => 'registration_type',
    'Declaration accepted' => 'declaration_accepted',
    'Declaration Date' => 'declaration_date',
    'Place' => 'declaration_place',
    'Contact No.' => 'contact_number',
    'Email' => 'email',
    'Aadhaar No.' => 'aadhaar_number'
);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Review Registration Form</h4>
                        <p class="card-category"><?php echo html_escape($record['full_name']); ?> — <?php echo html_escape($record['session_label_snapshot']); ?></p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('admin/passed-out'); ?>">Back to submissions</a></p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <?php foreach ($fields as $label => $key): ?>
                                    <?php
                                    $value = isset($record[$key]) ? $record[$key] : '';
                                    if ($key === 'declaration_accepted') {
                                        $value = $value ? 'Yes' : 'No';
                                    } elseif ($key === 'status') {
                                        $value = ucwords(str_replace('_', ' ', $value));
                                    }
                                    ?>
                                    <tr>
                                        <th style="width: 28%;"><?php echo html_escape($label); ?></th>
                                        <td><?php echo nl2br(html_escape($value !== '' ? $value : '-')); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr><th>JNRC remark</th><td><?php echo nl2br(html_escape($record['review_remark'] ?: '-')); ?></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h5>Attachments</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>Document</th><th>File</th><th>Size</th><th>Uploaded</th></tr></thead>
                                <tbody>
                                <?php if (empty($documents)): ?>
                                    <tr><td colspan="4">No documents uploaded.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($documents as $document): ?>
                                        <tr>
                                            <td><?php echo html_escape(isset($document_fields[$document['document_type']]['label']) ? $document_fields[$document['document_type']]['label'] : $document['document_type']); ?></td>
                                            <td><a href="<?php echo base_url('admin/passed-out/document/' . (int) $record['id'] . '/' . (int) $document['id']); ?>"><?php echo html_escape($document['original_filename']); ?></a></td>
                                            <td><?php echo number_format($document['file_size'] / 1048576, 2); ?> MB</td>
                                            <td><?php echo html_escape($document['uploaded_at']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($record['status'] === 'submitted'): ?>
                            <h5>Decision</h5>
                            <?php echo form_open('admin/passed-out/review/' . (int) $record['id']); ?>
                                <div class="form-group">
                                    <label for="review_remark">Remark (required for rejection or corrections)</label>
                                    <textarea class="form-control" id="review_remark" name="review_remark" maxlength="4000" rows="4"></textarea>
                                </div>
                                <button class="btn btn-success" name="decision" value="approved" type="submit">Approve</button>
                                <button class="btn btn-warning" name="decision" value="revision_requested" type="submit">Request Correction</button>
                                <button class="btn btn-danger" name="decision" value="rejected" type="submit">Reject</button>
                            <?php echo form_close(); ?>
                        <?php elseif ($record['status'] === 'approved'): ?>
                            <div class="alert alert-success">Approved. The institution cannot edit this form.</div>
                        <?php elseif (in_array($record['status'], array('rejected', 'revision_requested'), TRUE)): ?>
                            <div class="alert alert-warning">The institution may edit and resubmit this form.</div>
                        <?php else: ?>
                            <div class="alert alert-info">This form is a draft and has not been submitted for review.</div>
                        <?php endif; ?>
                        <hr>
                        <h5>History</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>When</th><th>Actor</th><th>Action</th><th>Status</th><th>Remark</th></tr></thead>
                                <tbody>
                                <?php if (empty($audit)): ?>
                                    <tr><td colspan="5">No history available.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($audit as $event): ?>
                                        <tr>
                                            <td><?php echo html_escape($event['created_at']); ?></td>
                                            <td><?php echo html_escape(ucfirst($event['actor_type'])); ?></td>
                                            <td><?php echo html_escape(ucwords(str_replace('_', ' ', $event['action']))); ?></td>
                                            <td><?php echo html_escape(trim((string) $event['status_from'] . ' to ' . (string) $event['status_to'])); ?></td>
                                            <td><?php echo nl2br(html_escape($event['remark'] ?: '-')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
