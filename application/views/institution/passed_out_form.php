<?php
$record = is_array($record) ? $record : array();
$value = function ($key) use ($record) {
    return isset($record[$key]) ? (string) $record[$key] : '';
};
$document_map = array();
foreach ($documents as $document) {
    $document_map[$document['document_type']] = $document;
}
?>
<style>
    .registration-type-option {
        display: inline-flex;
        align-items: center;
        margin: 0 18px 8px 0;
        cursor: pointer;
    }
    .registration-type-radio {
        position: static !important;
        display: inline-block !important;
        width: 16px;
        height: 16px;
        margin: 0 6px 0 0 !important;
        opacity: 1 !important;
        appearance: auto !important;
        -webkit-appearance: radio !important;
        vertical-align: middle;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <?php if (!empty($record['review_remark']) && in_array($record['status'], array('rejected', 'revision_requested'), TRUE)): ?>
                    <div class="alert alert-warning"><strong>JNRC feedback:</strong> <?php echo html_escape($record['review_remark']); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"><?php echo html_escape($title); ?></h4>
                        <p class="card-category">Complete the applicant details, verify them with the student, and submit to JNRC.</p>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart('institution/passed-out/save'); ?>
                        <input type="hidden" name="record_id" value="<?php echo isset($record['id']) ? (int) $record['id'] : 0; ?>">
                        <div class="alert alert-info">
                            <strong>Institution address on JNRC records:</strong>
                            <?php echo nl2br(html_escape(isset($institution['address']) && $institution['address'] !== '' ? $institution['address'] : 'No address is currently recorded.')); ?>
                            <br>If this address needs to be added or updated, please request the change from JNRC. This form does not update institution details.
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Form No. (if available; duplicates allowed)</label>
                                <input class="form-control" name="form_number" maxlength="50" value="<?php echo html_escape($value('form_number')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Registration No. (optional)</label>
                                <input class="form-control" name="registration_number" maxlength="100" value="<?php echo html_escape($value('registration_number')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Passed-out Batch / Session <span class="text-danger">*</span></label>
                                <select class="form-control" name="session_label_snapshot" required>
                                    <option value="">Select batch/session</option>
                                    <?php foreach ($sessions as $session): ?>
                                        <option value="<?php echo html_escape($session['session_label']); ?>" <?php echo $value('session_label_snapshot') === $session['session_label'] ? 'selected' : ''; ?>>
                                            <?php echo html_escape($session['session_label']); ?><?php echo empty($session['is_visible']) ? ' (closed session)' : ''; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h5>Applicant details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name in full <span class="text-danger">*</span></label>
                                <input class="form-control" name="full_name" maxlength="150" required value="<?php echo html_escape($value('full_name')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Father's Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="father_name" maxlength="150" required value="<?php echo html_escape($value('father_name')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Marital Status</label>
                                <select class="form-control" name="marital_status">
                                    <option value="">Select</option>
                                    <?php foreach ($marital_statuses as $option): ?>
                                        <option value="<?php echo html_escape($option); ?>" <?php echo $value('marital_status') === $option ? 'selected' : ''; ?>><?php echo html_escape($option); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Age</label>
                                <input class="form-control" type="number" min="1" max="120" name="age" value="<?php echo html_escape($value('age')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" name="date_of_birth" value="<?php echo html_escape($value('date_of_birth')); ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Identification mark</label>
                                <input class="form-control" name="identification" maxlength="2000" value="<?php echo html_escape($value('identification')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Permanent Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="permanent_address" maxlength="2000" rows="3" required><?php echo html_escape($value('permanent_address')); ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Present Address</label>
                                <textarea class="form-control" name="present_address" maxlength="2000" rows="3"><?php echo html_escape($value('present_address')); ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <h5>Page 1 of 2 - Education and training</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Educational Qualification</label>
                                <textarea class="form-control" name="educational_qualification" maxlength="2000" rows="2"><?php echo html_escape($value('educational_qualification')); ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Professional Qualification</label>
                                <textarea class="form-control" name="professional_qualification" maxlength="2000" rows="2"><?php echo html_escape($value('professional_qualification')); ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Roll No.</label>
                                <input class="form-control" name="roll_number" maxlength="100" value="<?php echo html_escape($value('roll_number')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Nationality</label>
                                <input class="form-control" name="nationality" maxlength="100" value="<?php echo html_escape($value('nationality')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Religion</label>
                                <input class="form-control" name="religion" maxlength="100" value="<?php echo html_escape($value('religion')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Training From</label>
                                <input class="form-control" name="training_from" maxlength="30" value="<?php echo html_escape($value('training_from')); ?>" placeholder="e.g. 2020">
                            </div>
                            <div class="col-md-4">
                                <label>Training To</label>
                                <input class="form-control" name="training_to" maxlength="30" value="<?php echo html_escape($value('training_to')); ?>" placeholder="e.g. 2022">
                            </div>
                            <div class="col-md-4">
                                <label>Month and Year of Passing Examination</label>
                                <input class="form-control" type="month" name="passing_date" value="<?php echo html_escape(substr($value('passing_date'), 0, 7)); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option value="">Select</option>
                                    <?php foreach ($categories as $option): ?>
                                        <option value="<?php echo html_escape($option); ?>" <?php echo $value('category') === $option ? 'selected' : ''; ?>><?php echo html_escape($option); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Institution</label>
                                <input class="form-control" readonly value="<?php echo html_escape($institution['school_name']); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Qualifying Institution (if different)</label>
                                <input class="form-control" name="qualifying_institution" maxlength="255" value="<?php echo html_escape($value('qualifying_institution')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Examination / Council / University from which qualified</label>
                                <input class="form-control" name="qualifying_council" maxlength="255" value="<?php echo html_escape($value('qualifying_council')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Registration required as <span class="text-danger">*</span></label>
                                <div>
                                    <?php foreach ($registration_types as $option): ?>
                                        <label class="registration-type-option">
                                            <input class="registration-type-radio" type="radio" name="registration_type" value="<?php echo html_escape($option); ?>" required <?php echo $value('registration_type') === $option ? 'checked' : ''; ?>>
                                            <span><?php echo html_escape($option); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>10th standard details</h5>
                        <div class="row">
                            <div class="col-md-4"><label>School</label><input class="form-control" name="tenth_school" maxlength="255" value="<?php echo html_escape($value('tenth_school')); ?>"></div>
                            <div class="col-md-4"><label>Board</label><input class="form-control" name="tenth_board" maxlength="255" value="<?php echo html_escape($value('tenth_board')); ?>"></div>
                            <div class="col-md-4"><label>Roll No.</label><input class="form-control" name="tenth_roll_number" maxlength="100" value="<?php echo html_escape($value('tenth_roll_number')); ?>"></div>
                            <div class="col-md-4"><label>Passing Year</label><input class="form-control" name="tenth_passing_year" maxlength="10" value="<?php echo html_escape($value('tenth_passing_year')); ?>"></div>
                            <div class="col-md-4"><label>Marks Obtained</label><input class="form-control" name="tenth_marks_obtained" maxlength="30" value="<?php echo html_escape($value('tenth_marks_obtained')); ?>"></div>
                            <div class="col-md-4"><label>Total Marks</label><input class="form-control" name="tenth_total_marks" maxlength="30" value="<?php echo html_escape($value('tenth_total_marks')); ?>"></div>
                        </div>
                        <hr>
                        <h5>12th standard details</h5>
                        <div class="row">
                            <div class="col-md-4"><label>School / College</label><input class="form-control" name="twelfth_school" maxlength="255" value="<?php echo html_escape($value('twelfth_school')); ?>"></div>
                            <div class="col-md-4"><label>Board</label><input class="form-control" name="twelfth_board" maxlength="255" value="<?php echo html_escape($value('twelfth_board')); ?>"></div>
                            <div class="col-md-4"><label>Roll No.</label><input class="form-control" name="twelfth_roll_number" maxlength="100" value="<?php echo html_escape($value('twelfth_roll_number')); ?>"></div>
                            <div class="col-md-4"><label>Passing Year</label><input class="form-control" name="twelfth_passing_year" maxlength="10" value="<?php echo html_escape($value('twelfth_passing_year')); ?>"></div>
                            <div class="col-md-4"><label>Marks Obtained</label><input class="form-control" name="twelfth_marks_obtained" maxlength="30" value="<?php echo html_escape($value('twelfth_marks_obtained')); ?>"></div>
                            <div class="col-md-4"><label>Total Marks</label><input class="form-control" name="twelfth_total_marks" maxlength="30" value="<?php echo html_escape($value('twelfth_total_marks')); ?>"></div>
                        </div>
                        <hr>
                        <h5>Nursing course details (ANM / GNM / B.Sc Nursing / Post Basic B.Sc Nursing / M.Sc Nursing)</h5>
                        <div class="row">
                            <div class="col-md-4"><label>Nursing Institution</label><input class="form-control" name="nursing_institution" maxlength="255" value="<?php echo html_escape($value('nursing_institution')); ?>"></div>
                            <div class="col-md-4"><label>Nursing Council</label><input class="form-control" name="nursing_council" maxlength="255" value="<?php echo html_escape($value('nursing_council')); ?>"></div>
                            <div class="col-md-4"><label>Roll No.</label><input class="form-control" name="nursing_roll_number" maxlength="100" value="<?php echo html_escape($value('nursing_roll_number')); ?>"></div>
                            <div class="col-md-3"><label>Enrollment No.</label><input class="form-control" name="nursing_enrollment_number" maxlength="100" value="<?php echo html_escape($value('nursing_enrollment_number')); ?>"></div>
                            <div class="col-md-3"><label>Passing Year</label><input class="form-control" name="nursing_passing_year" maxlength="10" value="<?php echo html_escape($value('nursing_passing_year')); ?>"></div>
                            <div class="col-md-3"><label>Marks Obtained</label><input class="form-control" name="nursing_marks_obtained" maxlength="30" value="<?php echo html_escape($value('nursing_marks_obtained')); ?>"></div>
                            <div class="col-md-3"><label>Total Marks</label><input class="form-control" name="nursing_total_marks" maxlength="30" value="<?php echo html_escape($value('nursing_total_marks')); ?>"></div>
                            <div class="col-md-4"><label>Last Year / Semester</label><input class="form-control" name="nursing_last_semester" maxlength="100" value="<?php echo html_escape($value('nursing_last_semester')); ?>"></div>
                        </div>
                        <hr>
                        <h5>Declaration and contact</h5>
                        <p>I confirm that the applicant has reviewed these details and that the information is true to the best of our knowledge.</p>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Declaration Date</label>
                                <input class="form-control" type="date" name="declaration_date" value="<?php echo html_escape($value('declaration_date')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label>Place</label>
                                <input class="form-control" name="declaration_place" maxlength="150" value="<?php echo html_escape($value('declaration_place')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label>Contact No.</label>
                                <input class="form-control" name="contact_number" maxlength="30" value="<?php echo html_escape($value('contact_number')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" maxlength="190" value="<?php echo html_escape($value('email')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Aadhaar No. (12 digits)</label>
                                <input class="form-control" inputmode="numeric" name="aadhaar_number" maxlength="12" value="<?php echo html_escape($value('aadhaar_number')); ?>">
                            </div>
                        </div>
                        <hr>
                        <h5>Page 2 of 2 - Required attachments</h5>
                        <p>Upload a clear image or PDF for each required document. For all nursing admit cards or marksheets, combine all pages into one PDF. Other supporting documents are optional. Maximum size: 5 MB per file.</p>
                        <div class="row">
                            <?php foreach ($document_fields as $document_type => $definition): ?>
                                <?php $existing_document = isset($document_map[$document_type]) ? $document_map[$document_type] : NULL; ?>
                                <div class="col-md-6">
                                    <label for="document-<?php echo html_escape($document_type); ?>">
                                        <?php echo html_escape($definition['label']); ?>
                                        <?php if ($definition['required'] && !$existing_document): ?><span class="text-danger">*</span><?php endif; ?>
                                    </label>
                                    <?php if ($existing_document): ?>
                                        <div class="mb-2">
                                            Existing file:
                                            <a href="<?php echo base_url('institution/passed-out/document/' . (int) $record['id'] . '/' . (int) $existing_document['id']); ?>">
                                                <?php echo html_escape($existing_document['original_filename']); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <input
                                        class="form-control"
                                        id="document-<?php echo html_escape($document_type); ?>"
                                        type="file"
                                        name="<?php echo html_escape($definition['field']); ?>"
                                        accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-check mt-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="declaration_accepted" value="1" <?php echo !empty($record['declaration_accepted']) ? 'checked' : ''; ?>>
                                Applicant details have been verified with the student.
                                <span class="form-check-sign"><span class="check"></span></span>
                            </label>
                        </div>
                        <button class="btn btn-secondary" type="submit" name="submit_action" value="draft">Save Draft</button>
                        <button class="btn btn-success" type="submit" name="submit_action" value="submit">Verify &amp; Submit </button>
                        <a class="btn btn-outline-secondary" href="<?php echo base_url('institution/passed-out'); ?>">Cancel</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
