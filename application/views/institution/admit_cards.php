<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Released Admit Cards</h4>
                        <p class="card-category">Only cards released by JNRC for your institution are shown.</p>
                    </div>
                    <div class="card-body">
                        <p>Select individual cards or use the checkbox in the table heading to select this page (up to 100 cards), then download them together as a ZIP.</p>
                        <?php echo form_open('institution_admit_cards/bulk'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-page" aria-label="Select all admit cards on this page"></th>
                                        <th>SN</th>
                                        <th>Student</th>
                                        <th>Reference</th>
                                        <th>Course</th>
                                        <th>Session</th>
                                        <th>Downloads</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($students)): ?>
                                        <tr><td colspan="8">There are no released admit cards for your institution.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($students as $index => $student): ?>
                                            <tr>
                                                <td><input type="checkbox" name="student_ids[]" value="<?php echo (int) $student['id']; ?>" class="student-select" aria-label="Select admit card"></td>
                                                <td><?php echo (int) (($page - 1) * 100 + $index + 1); ?></td>
                                                <td><?php echo html_escape($student['name']); ?></td>
                                                <td><?php echo html_escape($student['ref_no']); ?></td>
                                                <td><?php echo html_escape($student['course']); ?></td>
                                                <td><?php echo html_escape($student['batch_session']); ?></td>
                                                <td><?php echo (int) $student['download_count']; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="<?php echo base_url('institution_admit_card/' . (int) $student['id']); ?>">
                                                        Download PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-success" type="submit"
                            onclick="return document.querySelector('.student-select:checked') !== null || (alert('Select at least one admit card to download.'), false);">
                            Download selected as ZIP
                        </button>
                        <?php echo form_close(); ?>
                        <?php if ($page > 1): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('institution_admit_cards?page=' . ($page - 1)); ?>">Previous</a>
                        <?php endif; ?>
                        <?php if ($has_more): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('institution_admit_cards?page=' . ($page + 1)); ?>">Next</a>
                        <?php endif; ?>
                    </div>
                    <script>
                    document.getElementById('select-page').addEventListener('change', function () {
                        document.querySelectorAll('.student-select').forEach(function (checkbox) {
                            checkbox.checked = this.checked;
                        }, this);
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
