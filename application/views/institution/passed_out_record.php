<?php
$fields = array(
    'Form No.' => 'form_number',
    'Registration No.' => 'registration_number',
    'Passed-out batch/session' => 'session_label_snapshot',
    'Status' => 'status',
    'Applicant name' => 'full_name',
    "Father's name" => 'father_name',
    'Marital status' => 'marital_status',
    'Age' => 'age',
    'Date of birth' => 'date_of_birth',
    'Identification mark' => 'identification',
    'Permanent address' => 'permanent_address',
    'Present address' => 'present_address',
    'Educational qualification' => 'educational_qualification',
    'Roll No.' => 'roll_number',
    'Professional qualification' => 'professional_qualification',
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
    'Training from' => 'training_from',
    'Training to' => 'training_to',
    'Passing month and year' => 'passing_date',
    'Category' => 'category',
    'Institution' => 'institution_name_snapshot',
    'Qualifying institution' => 'qualifying_institution',
    'Council / University' => 'qualifying_council',
    'Registration required as' => 'registration_type',
    'Declaration accepted' => 'declaration_accepted',
    'Declaration date' => 'declaration_date',
    'Place' => 'declaration_place',
    'Contact No.' => 'contact_number',
    'Email' => 'email',
    'Aadhaar No.' => 'aadhaar_number',
);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Registration Form</h4>
                        <p class="card-category"><?php echo html_escape($record['full_name']); ?></p>
                    </div>
                    <div class="card-body">
                        <p>
                            Status: <strong><?php echo html_escape(ucwords(str_replace('_', ' ', $record['status']))); ?></strong>
                            <?php if ($record['status'] === 'submitted'): ?>
                                <span class="text-muted">- locked while awaiting JNRC review</span>
                            <?php elseif ($record['status'] === 'approved'): ?>
                                <span class="text-muted">- approved and locked</span>
                            <?php endif; ?>
                        </p>
                        <?php if (!empty($record['review_remark'])): ?>
                            <div class="alert alert-warning"><strong>JNRC remark:</strong> <?php echo html_escape($record['review_remark']); ?></div>
                        <?php endif; ?>
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
                        <h5>Attachments</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>Document</th><th>File</th><th>Uploaded</th></tr></thead>
                                <tbody>
                                <?php if (empty($documents)): ?>
                                    <tr><td colspan="3">No documents uploaded.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($documents as $document): ?>
                                        <tr>
                                            <td><?php echo html_escape(isset($document_fields[$document['document_type']]['label']) ? $document_fields[$document['document_type']]['label'] : $document['document_type']); ?></td>
                                            <td><a href="<?php echo base_url('institution/passed-out/document/' . (int) $record['id'] . '/' . (int) $document['id']); ?>"><?php echo html_escape($document['original_filename']); ?></a></td>
                                            <td><?php echo html_escape($document['uploaded_at']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-outline-primary" href="<?php echo base_url('institution/passed-out'); ?>">Back to forms</a>
                        <?php if (in_array($record['status'], array('draft', 'rejected', 'revision_requested'), TRUE)): ?>
                            <a class="btn btn-warning" href="<?php echo base_url('institution/passed-out/edit/' . (int) $record['id']); ?>">Edit Form</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
