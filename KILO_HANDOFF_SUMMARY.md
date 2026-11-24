# Kilo Handoff: JNRC Five Modules

## Project context

- Repository: [JNRC](./)
- Framework: CodeIgniter 3
- Local environment: XAMPP/MySQL, database `jnrc_db`; local PHP is 8.5. Production target is PHP 7.4.
- Read the current [implementation plan](./plan.md) and [change log](./changelog.md) before continuing.
- Preserve existing worktree changes. Do not reset or overwrite unrelated edits.
- Feature migrations have been applied locally. Review migration state and back up the target database before applying migrations in another environment.

## Module status

### Module 1 - Admit cards

**Implemented locally:** Admin release/withdrawal and exam-center assignment; institution-scoped released-card downloads; individual and current-page ZIP downloads; per-card QR verification and audit tracking.

The PDF reads candidate photo/signature filenames from `exam_form_tb.img1` and `exam_form_tb.img2` under `uploads/exam_form/{ref_no}/`. It reads the Registrar signature from `uploads/signatures/registrarsignature.png` when available. Placeholder artwork has been removed. Missing candidate images are labeled rather than replaced with dummy images.

**Key files:**

- [Admit_cards.php](./application/controllers/Admit_cards.php)
- [Admit_card_model.php](./application/models/Admit_card_model.php)
- [admit_card_layout.php](./application/views/admin/admit_card_layout.php)
- [admit_card_release.php](./application/views/admin/admit_card_release.php)
- [admit_cards.php](./application/views/institution/admit_cards.php)
- [admit_card_verify.php](./application/views/frontend/admit_card_verify.php)
- [release schema migration](./database/migrations/202610270001_create_admit_card_release_tables.sql)
- [center and QR migration](./database/migrations/202610270002_add_admit_card_center_qr.sql)
- [Admit-card image assets folder](./assets_admin/img/)

**Remaining:**

- Test authenticated Admin release, center assignment, Institution download, QR verification, and withdrawal/revocation end to end.
- Render a card using deployed, real `img1`/`img2` uploads and the approved Registrar signature. The local sample student folders have QR images but no candidate photo/signature files; the local Registrar signature file is also absent.
- Consider select-all across all filtered results, exam-wide bulk downloads, and release-history/detail screens.
- Confirm whether the release identity needs a separate exam/event key beyond session, course, and subject schedule.

### Module 2 - Grading

**Status: Not started.**

**Remaining:**

- Confirm score ranges, grade labels, boundary rules, and how changes to grade bands affect historical grades.
- Build Admin grade-band management with validation for overlaps and boundaries.
- Add institution score entry with grades calculated server-side, plus session filters, sorting, and history.
- Add auditing and tests for boundaries, authorization, history, and band changes.

No Module 2 implementation files have been created.

### Module 3 - Passed-out registration

**Implemented locally:** Institution registration and document uploads; Admin-managed sessions and review; approval, rejection, correction requests, and resubmission; date-filtered export.

**Key files:**

- [Passed_out.php](./application/controllers/Passed_out.php)
- [Passed_out_model.php](./application/models/Passed_out_model.php)
- [passed_out_form.php](./application/views/institution/passed_out_form.php)
- [passed_out_records.php](./application/views/institution/passed_out_records.php)
- [institution passed_out_record.php](./application/views/institution/passed_out_record.php)
- [passed_out_sessions.php](./application/views/admin/passed_out_sessions.php)
- [passed_out_review.php](./application/views/admin/passed_out_review.php)
- [Admin passed_out_record.php](./application/views/admin/passed_out_record.php)
- [base registration migration](./database/migrations/202611030001_create_passed_out_registration_tables.sql)
- [academic and document migration](./database/migrations/202611030002_add_passed_out_academics_documents.sql)
- [passing month migration](./database/migrations/202611030003_change_passing_date_to_month.sql)
- [private storage controls](./application/storage/)

**Remaining:**

- Verify migrations and the complete workflow against the target database.
- Run authenticated end-to-end tests for submission, review, correction, document access, and export.
- Verify spreadsheet output and decide whether spreadsheet import is required; import is not part of the current implementation.

### Module 4 - Session backups

**Status: Not started.**

**Remaining:**

- Define which database records and files are included and how session ownership is determined.
- Add an Admin job-request/history screen and a background worker with pending, processing, ready, and failed states.
- Generate session spreadsheets and ZIP archives in private storage outside the public web root.
- Add retries, sanitized errors, retention/cleanup, checksums, and authorized downloads.
- Test large sessions, disk space, permissions, timeouts, and worker scheduling.

No Module 4 implementation files have been created.

### Module 5 - Internal marks

**Implemented locally:** Admin assessment/window configuration; institution-scoped entry for eligible ANM/GNM exam-form students; Present/Absent; drafts and final submission; Admin edits/reopening with reasons; audit history and filtered CSV export. The Institution list presents entry-window and submission states separately.

**Key files:**

- [Internal_marks.php](./application/controllers/Internal_marks.php)
- [Internal_marks_model.php](./application/models/Internal_marks_model.php)
- [Admin internal_marks.php](./application/views/admin/internal_marks.php)
- [internal_marks_configure.php](./application/views/admin/internal_marks_configure.php)
- [internal_marks_configure_window.php](./application/views/admin/internal_marks_configure_window.php)
- [internal_marks_submission.php](./application/views/admin/internal_marks_submission.php)
- [Institution internal_marks.php](./application/views/institution/internal_marks.php)
- [internal_marks_entry.php](./application/views/institution/internal_marks_entry.php)
- [internal marks migration](./database/migrations/202611090001_create_internal_marks_tables.sql)

**Remaining:**

- Run authenticated end-to-end tests for configuration, institution isolation, eligibility, deadlines, marks validation, draft/final submission, Admin reopen/edit, audit, and export.
- Verify the migration and workflow in each deployment environment.

## Shared integration files

- [routes.php](./application/config/routes.php)
- [Admin sidebar](./application/views/admin/include/sidebar.php)
- [Institution navigation](./application/views/institution/include/header.php)
- [plan.md](./plan.md)
- [changelog.md](./changelog.md)

Admit-card runtime compatibility files:

- [composer.json](./composer.json)
- [composer.lock](./composer.lock)
- [Dompdf Style.php](./application/third_party/dompdf/src/Css/Style.php)
- [Dompdf Inline.php](./application/third_party/dompdf/src/Renderer/Inline.php)

## Recent admit-card validation

- PHP lint passed for the admit-card controller and PDF layout.
- `git diff --check` passed.
- Photo/signature path lookup was smoke-tested against an existing image in a student upload folder; missing paths correctly return no image.
- Dompdf rendered a valid PDF with the real logo and QR image and explicit missing-photo/signature labels.
- Actual candidate photo/signature and Registrar-signature rendering remains unverified until the approved files are available.
