<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>">
                        <?php echo html_escape($message); ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Admit Card Release</h4>
                        <p class="card-category">Release or withdraw cards for the selected applicants.</p>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?php echo base_url('admin/admit-cards'); ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="session">Session</label>
                                    <select class="form-control" id="session" name="session">
                                        <option value="">All sessions</option>
                                        <?php foreach ($options['sessions'] as $option): ?>
                                            <option value="<?php echo html_escape($option['batch_session']); ?>" <?php echo $filters['session'] === $option['batch_session'] ? 'selected' : ''; ?>>
                                                <?php echo html_escape($option['batch_session']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="course">Course</label>
                                    <select class="form-control" id="course" name="course">
                                        <option value="">All courses</option>
                                        <?php foreach ($options['courses'] as $option): ?>
                                            <option value="<?php echo html_escape($option['course']); ?>" <?php echo $filters['course'] === $option['course'] ? 'selected' : ''; ?>>
                                                <?php echo html_escape($option['course']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="institution">Institution</label>
                                    <select class="form-control" id="institution" name="institution">
                                        <option value="">All institutions</option>
                                        <?php foreach ($options['institutions'] as $option): ?>
                                            <option value="<?php echo html_escape($option['school_code']); ?>" <?php echo $filters['institution'] === $option['school_code'] ? 'selected' : ''; ?>>
                                                <?php echo html_escape($option['school_name'] ?: $option['school_code']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">All statuses</option>
                                        <?php foreach (array('pending', 'released', 'downloaded', 'withdrawn') as $status): ?>
                                            <option value="<?php echo $status; ?>" <?php echo $filters['status'] === $status ? 'selected' : ''; ?>>
                                                <?php echo ucfirst($status); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="search">Student / reference</label>
                                    <input class="form-control" id="search" name="search" value="<?php echo html_escape($filters['search']); ?>">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </form>

                        <p><?php echo (int) $total_rows; ?> applicant(s)</p>

                        <?php echo form_open('admit_card_release'); ?>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="center_id">Exam center for selected releases</label>
                                    <select class="form-control" id="center_id" name="center_id">
                                        <option value="">Choose exam center</option>
                                        <?php foreach ($options['centers'] as $center): ?>
                                            <option value="<?php echo (int) $center['id']; ?>">
                                                <?php echo html_escape($center['name_center']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-page" aria-label="Select all students on this page"></th>
                                            <th>SN</th>
                                            <th>Student</th>
                                            <th>Reference</th>
                                            <th>Roll number</th>
                                            <th>Institution</th>
                                            <th>Course</th>
                                            <th>Session</th>
                                            <th>Exam center</th>
                                            <th>Status</th>
                                            <th>Downloads</th>
                                            <th>Admit card</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($students)): ?>
                                            <tr><td colspan="12">No exam applicants match these filters.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($students as $index => $student): ?>
                                                <?php
                                                    $release_status = $student['release_status'] ?: 'pending';
                                                    $display_status = $release_status === 'released' && (int) $student['download_count'] > 0
                                                        ? 'downloaded'
                                                        : $release_status;
                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" name="student_ids[]" value="<?php echo (int) $student['id']; ?>" class="student-select" aria-label="Select applicant"></td>
                                                    <td><?php echo (int) (($page - 1) * 50 + $index + 1); ?></td>
                                                    <td><?php echo html_escape($student['name']); ?></td>
                                                    <td><?php echo html_escape($student['ref_no']); ?></td>
                                                    <td><?php echo html_escape($student['admit_card_roll_no']); ?></td>
                                                    <td><?php echo html_escape($student['school_name'] ?: $student['issue_by']); ?></td>
                                                    <td><?php echo html_escape($student['course']); ?></td>
                                                    <td><?php echo html_escape($student['batch_session']); ?></td>
                                                    <td><?php echo html_escape($student['name_center'] ?: 'Not assigned'); ?></td>
                                                    <td><?php echo html_escape(ucfirst($display_status)); ?></td>
                                                    <td><?php echo (int) $student['download_count']; ?></td>
                                                    <td>
                                                        <?php if ($release_status === 'released'): ?>
                                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                                href="<?php echo base_url('admin/admit-card/' . (int) $student['id']); ?>">View PDF</a>
                                                            <a class="btn btn-sm btn-primary"
                                                                href="<?php echo base_url('admin/admit-card-download/' . (int) $student['id']); ?>">Download PDF</a>
                                                        <?php else: ?>
                                                            <span class="text-muted">Release first</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success" type="submit" name="action" value="release"
                                onclick="return document.getElementById('center_id').value !== '' || (alert('Choose an exam center before releasing.'), false);">Release selected</button>
                            <button class="btn btn-warning" type="submit" name="action" value="withdraw"
                                onclick="return confirm('Withdraw the selected admit cards?');">Withdraw selected</button>
                        <?php echo form_close(); ?>

                        <?php if ($total_pages > 1): ?>
                            <nav aria-label="Applicant pages">
                                <?php for ($page_number = 1; $page_number <= $total_pages; $page_number++): ?>
                                    <?php $page_query = $filters; $page_query['page'] = $page_number; ?>
                                    <a class="btn btn-sm <?php echo $page_number === $page ? 'btn-primary' : 'btn-outline-primary'; ?>"
                                        href="<?php echo base_url('admin/admit-cards?' . http_build_query($page_query)); ?>">
                                        <?php echo $page_number; ?>
                                    </a>
                                <?php endfor; ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('select-page').addEventListener('change', function () {
    document.querySelectorAll('.student-select').forEach(function (checkbox) {
        checkbox.checked = this.checked;
    }, this);
});
</script>
