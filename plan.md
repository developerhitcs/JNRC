# JNRC Module Implementation Plan

## Goal

Add the five requested modules to the existing CodeIgniter application while
keeping the current public site, admin panel, and institution panel working.
The new features must use the existing authentication and navigation patterns,
but enforce permissions on every server-side request.

This is an implementation plan, not a database migration. Do not execute SQL
from this document or change production data until the decisions and migration
steps have been reviewed.

## Existing project foundation

- The application uses CodeIgniter 3 with controllers, models, views, and
  explicit routes under `application/`.
- The existing three user-facing areas are the architecture boundary for these
  features: public website, JNRC Admin, and Institution. Keep feature screens
  inside their existing view areas rather than creating a separate portal.
- Existing admin routes and navigation are in
  `application/config/routes.php` and `application/views/admin/include/sidebar.php`.
- Institution routes and navigation are in
  `application/config/routes.php` and
  `application/views/institution/include/header.php`.
- Admin access commonly uses `role_admin = admin` in the session.
- Institution login sets `school_id`, `school_code`, `school_course`,
  `school_name`, `role = institute`, and `loginstatus`.
- Existing exam applicants are primarily in `exam_form_tb`. It has
  `batch_session`, `course`, `issue_by`, `ref_no`, `name`, `father_name`,
  `img1`, `admit_card_roll_no`, and other exam-form fields. Verify which image
  field is the approved photo before using it on a card or verification page.
- `college_list` identifies institutions by `id`, `school_code`, and
  `course_type`. Institution session `school_id` maps to `college_list.id`;
  confirm this mapping for every supported login type.
- `batch_session_tb` holds current examination-session information.
  `subjects_details_tb` holds course, year, subject, exam date, and time.
- Legacy PDF generation uses Dompdf, and legacy spreadsheet exports use
  PHPExcel. Check the installed PHP version and required extensions before
  relying on either in new background work.
- The current sample SQL export is for seed data, not a schema migration.
  Feature schema changes must use reviewed, additive, versioned migrations;
  never drop or recreate existing production tables to deploy these modules.

## Recommended implementation order

Build one small, testable vertical slice at a time. Shared access-control,
audit, and migration groundwork comes first; backups come after the other
modules because they must include their finalized records and files.

## Where each module belongs

| Existing area | Responsibilities for these modules | View location |
|---|---|---|
| Public website | Read-only admit-card verification page. No admin controls, student search, or private-data browsing. | `application/views/frontend/` |
| JNRC Admin | Admit-card release/withdrawal and release tracking; grade-band and institute-grade management; passed-out submission review, correction, reopening, search, and export; backup job request, status, history, and secure download; internal-mark configuration, entry-window management, review, reopening, and export. | `application/views/admin/` |
| Institution | Download only its own released admit cards; enter passed-out students and manage drafts/submissions; enter and submit its own internal marks. | `application/views/institution/` |

Keep the corresponding actions in the existing application/controllers and
application/models structure and register them in the existing routes. A public
QR-verification action may use a small focused controller, but its only view
belongs in the public `frontend/` area and it must return only the approved
verification fields. Reuse the current admin and institution headers, sidebars,
sessions, and visual design.

Before feature-specific controllers are added, strengthen and test the shared
server-side admin/institution authorization boundary; the current institution
login session includes both `school_id` and `school_code`, and feature requests
must resolve ownership from the authenticated session on the server.

### Phase 0 - Confirm requirements and prepare safe deployment

Before feature development:

1. Confirm production backup and rollback procedures, database engine/version,
   PHP version, available extensions, upload limits, storage capacity, and
   HTTPS/reverse-proxy setup.
2. Record authoritative definitions for exam identity, academic/exam session,
   course identifiers, grading bands, passed-out fields, internal assessments,
   and retention rules.
3. Inventory the existing tables, field meanings, indexes, student image
   storage, institute IDs, session values, exam schedules, and current export
   formats. Do not infer field meaning from a column name alone.
4. Create a versioned migration/rollback process for **new tables only**.
   Back up and test against a copy of the database before applying migrations.
5. Add a deployment environment configuration strategy so localhost database
   credentials and URLs are not copied to production.

**Exit criteria:** approved field/data mappings, decisions recorded below,
working database backup/restore test, and a tested additive migration workflow.

### Phase 1 - Shared authorization and audit foundation

1. Add reusable server-side guards for administrator and institution actions.
   Check the role and session on every controller action, not just when
   rendering a page.
2. Resolve the logged-in institute from the authenticated session on the
   server. Never accept an institute ID from a request as proof of access.
3. Define shared audit-event conventions: actor type/ID, action, entity,
   before/after values where needed, timestamp, and request context. Avoid
   storing passwords, CAPTCHA answers, access tokens, or unnecessary personal
   data in logs.
4. Add additive migrations, transaction helpers, input validation patterns,
   CSRF-protected forms, pagination/filter conventions, and authorization tests.
5. Review the existing cookie/session configuration for both local HTTP and
   production HTTPS. Production should use HTTPS and secure cookies.

**Exit criteria:** automated checks show an institution cannot read or modify
another institution's records through list, detail, update, export, or download
requests.

### Phase 2 - Admit-card release, downloads, and QR verification

**Admin workflow**

1. Build an applicant list backed by `exam_form_tb`, with server-side filters
   for the agreed exam, session, course, and institution fields.
2. Add pagination, explicit selection and deselection, and a clearly scoped
   “select all matching filters” action. The server must reapply filters and
   validate every selected applicant; do not trust browser-supplied bulk lists.
3. Add release and withdrawal actions for single applicants and bulk
   selections. Record each change in an audit log and expose pending, released,
   and downloaded status.
4. Ensure withdrawal/re-lock takes effect immediately, including for previously
   released students and newly requested downloads.

**Institute workflow**

1. Show only the authenticated institute's eligible applicants.
2. Show released/pending state and permit download only after an active release.
3. Provide a single-card download and an institute/exam-scoped batch download.
4. Log successful downloads with the institution, applicant, exam/session,
   actor, and timestamp. Avoid logging sensitive URL tokens.

**PDF and verification**

1. Reuse the approved JNRC design and existing student/exam fields. Confirm the
   official layout before generating cards.
2. Add a cryptographically random verification token per issued card. Store a
   hash of the token, not the raw token. QR codes must contain only the public
   verification URL and token.
3. Add a read-only public verification route that returns only the approved
   valid/invalid status, student name, father's name, reference number, and
   approved photo. Use generic invalid responses and rate limits; do not expose
   internal IDs, contact information, addresses, marks, or institution-only
   data.
4. Select and test a maintained QR-code library suitable for the deployment
   PHP version. Generate QR images locally; do not depend on a public QR
   generation API that receives student or verification data.

**Candidate additive tables**

- `admit_card_release`: one release state per applicant/exam identity, including
  status, actor, timestamps, and token hash.
- `admit_card_download_log`: append-only successful download events.
- Extend the shared audit log for release/withdrawal events.

Choose stable foreign keys and unique constraints only after confirming the
legacy data types and existing duplicate records.

**Exit criteria:** test release/withdrawal permissions, filters, bulk selection,
PDF generation, token revocation, QR verification data minimization, download
logging, and cross-institute denial.

### Phase 3 - Institute grading

1. Add an administrator-maintained grading-band screen with validation for
   non-overlapping score ranges, boundary inclusivity, grade labels, ordering,
   and active dates if required.
2. Add session-wise score entry for an institute, deriving the grade from the
   configured band in server-side code.
3. Show grade and score in the institute list with session filters, sorting,
   history, and appropriate admin-only permissions.
4. Write an audit event for every create, correction, and band change, including
   previous and new values.
5. Define behavior when an admin changes grade bands after scores already
   exist: keep a grade snapshot, recalculate historical grades, or require an
   explicit recalculation action.

**Candidate additive tables:** `institute_grade_band`,
`institute_session_grade`, and audit entries.

**Exit criteria:** boundary and overlap tests, historical behavior tests, score
authorization tests, and institute-list filter/sort tests.

### Phase 4 - Passed-out student entry

1. Confirm the required fields for each supported course (B.Sc, M.Sc, Post
   Basic, and any others), session naming, and duplicate identity rules.
2. Build course/session-specific forms and server-side validation.
3. Add a submission state machine: draft -> submitted -> reopened by admin ->
   submitted. Submitted records are read-only to institutions until admin
   reopens them.
4. Add duplicate checks backed by appropriate unique keys. Define how
   corrections, retries, and duplicates from older imports are handled.
5. Add an optional template download and Excel import using the repository's
   spreadsheet library only if it can safely parse the approved template.
   Return row-level validation errors and do not partially commit invalid
   uploads.
6. Add the admin college/session view, search, filters, correction history,
   submission-completeness view, and Excel export.

**Candidate additive tables:** submission header, course-neutral student
records with approved fields, import job/error records, and audit entries.
Keep uploaded source files outside the public web root where possible.

**Exit criteria:** course-specific required-field tests, duplicate tests,
draft/submit/reopen permissions, malformed/oversized spreadsheet tests,
row-error reporting, and export authorization tests.

### Phase 5 - Internal marks

1. Agree on subjects, assessment components, maximum marks, decimal precision,
   absent/not-applicable codes, and the relationship to existing
   `subjects_details_tb`.
2. Add admin assessment configuration by session/course/subject and an entry
   window with deadlines.
3. Add institute entry by logged-in institute, course, session, subject, and
   eligible student. Validate marks against the configured maximum on the
   server.
4. Support draft and final submission with locking. Admin may reopen a
   submission with a required reason and audit record.
5. Add the admin review screen and Excel export, with institute/session/course
   filters.
6. Audit inserts, edits, final submissions, administrative corrections,
   reopen actions, and window changes.

**Candidate additive tables:** assessment/window configuration, marks
submission headers, student-subject-assessment entries, and audit entries.

**Exit criteria:** maximum/boundary tests, absence handling, draft/final lock
tests, deadline enforcement, reopen and audit tests, and institution-isolation
tests.

### Phase 6 - Session backup jobs

1. Define exactly which tables and file directories count as “all student
   data,” and how session ownership is identified for every record/file.
2. Add an admin-only backup history and job-request screen.
3. Create a queue/job state machine: pending -> processing -> ready/failed.
   Process work in a CLI worker or scheduler appropriate to the host. On local
   XAMPP, document how to run/test the worker; on production, configure and
   monitor a scheduled worker. Do not hold an HTTP request open while building
   a large archive.
4. Generate the session spreadsheet, collect related student files using
   explicit database mappings, and create a ZIP in private storage outside
   the public web root.
5. Add retry/error reporting, cleanup/retention rules, archive size/checksum,
   and an authenticated admin download endpoint that verifies ownership on
   every request.
6. Test PHP `ZipArchive`, spreadsheet export support, disk space, timeouts, file
   permissions, and behavior for large sessions before choosing batch sizes.

**Candidate additive table:** `session_backup_job`, with requester/admin,
session, status, timestamps, private archive path, size, checksum, and sanitized
failure details.

**Exit criteria:** background processing does not block the site; failed jobs
are visible/retryable; unauthorized users cannot list/download archives; archive
contents match the approved session scope.

## Shared design and security requirements

- Follow the existing admin/institution layouts and responsive patterns.
- Add admin navigation for configuration, release/status, review, exports, and
  history; add institution navigation for cards, passed-out records, and marks.
- Apply role and ownership checks in controllers/models for every request,
  including AJAX, exports, batch actions, generated PDFs, and file downloads.
- Use CodeIgniter query builder/bindings, allowlisted sort columns, CSRF
  protection, output escaping, validation, transaction boundaries, and
  database constraints. Never build SQL from user-controlled identifiers.
- Do not put protected files or backup archives in a directly browseable public
  directory. Validate upload type/size/content and randomize stored filenames.
- Use append-only audit events for important changes. Consider how retention,
  access, correction, and export of sensitive student data will be controlled.
- Avoid logging passwords, full CAPTCHA values, raw QR tokens, or unnecessary
  student personal data.

## Proposed repository organization

Follow current CodeIgniter 3 conventions and existing naming:

- Controllers: focused admin and institution controllers per feature; a narrow
  public verification controller for admit-card checks.
- Models: feature-specific models with query builder access and transaction
  boundaries.
- Views: `application/views/admin/`, `application/views/institution/`, and a
  minimal public verification view.
- Routes and navigation: add explicit routes in
  `application/config/routes.php` and links in the existing admin and
  institution navigation.
- Database: versioned additive migration files with reviewed rollback notes;
  keep schema definitions separate from `sample_database.sql`.
- Tests: exercise permission boundaries, state transitions, validations,
  exports/downloads, and representative controller/model behavior.

## Confirmed decisions for the first admit-card slice

- Reuse the approved JNRC layout in
  `application/views/admin/admit_card_pdf_course.php`.
- Production PHP is 7.4; Composer is configured to resolve dependencies for
  that runtime.
- Admin selects an exam center before releasing selected cards. The center is
  stored with the release and appears on the admit-card PDF.
- The existing photo mapping is `exam_form_tb.img1` under
  `uploads/exam_form/{ref_no}/{img1}`. Keep the matching upload directories
  available/readable in production.
- Withdrawing a release invalidates its QR token immediately.

## Decisions still required for later work

1. **Exam identity:** Is a release tied to a separate exam/event, or to the
   existing combination of `batch_session`, `course`, and subject schedule?
   Can a student have more than one admit card per session/course?
2. **Download state:** Should “downloaded” mean the first successful card
   request, every request, or a bulk archive request?
3. **Institute grades:** What score range/maximum applies, what initial grade
   bands should be configured, and should changing bands recalculate historical
   grades?
4. **Passed-out records:** Which fields and duplicate key apply per course?
   Is there an existing official Excel template to match?
5. **Internal marks:** Which assessment types, subjects, maximum marks,
   absence codes, precision rules, and deadlines apply?
6. **Session backups:** Which records/files must be included, how long should
   archives be retained, and what is the maximum expected session size?
7. **Operational deployment:** Which production database versions and
   background scheduler are available? Can PHP extensions/packages be enabled
   where needed?

## First implementation milestone

Start with **Phase 0 and Phase 1**, then build the smallest end-to-end
**admit-card release** slice using the confirmed existing `exam_form_tb` fields:
admin lists and releases one applicant, the correct institute sees and downloads
that released card only, and the download is audited. The initial Admin,
Institution, PDF, and public QR verification slice is now in place; extend its
bulk scope and complete authenticated authorization tests before moving on.

This sequence exercises the most important shared security boundary early and
reuses the existing applicant and institute data before expanding to the other
modules.

## Implementation progress

- **Completed first slice:** additive release, audit, download-log, center, and
  token schema; Admin-filtered applicant list with current-page bulk
  release/withdraw; required exam-center assignment; institution-scoped
  released-card list/download; reuse of the approved JNRC PDF layout; QR
  generation and public, minimal-data verification. Both migrations are
  applied locally to `jnrc_db`.
- **Still required for Module 1:** select-all across every filtered result
  (rather than only the current page), institute/exam-wise bulk PDF downloads,
  release history/detail screens, and authenticated end-to-end tests for Admin
  and Institution actions. The local sample database does not include the
  uploaded image files, so production photo rendering still needs a deployment
  check.
- **Compatibility fixes:** bundled Dompdf's PHP 8.5 `z-index: auto` and
  non-numeric child-height failures were corrected. QR codes are rasterized to
  PNG with GD for compatibility with the bundled Dompdf version.
- **Not started:** configurable grading; passed-out student entry/import;
  background session backups; internal-mark configuration and entry.
- The first slice treats one row in `exam_form_tb` as one exam application and
  uses its `batch_session`, `course`, `issue_by`, `ref_no`, `img1`, and
  `admit_card_roll_no` fields. Confirm whether another exam-identity field is
  required before expanding the release workflow.
- The SQL migration creates new feature tables only. Back up the target
  database, review the migration, and apply it once in each environment; do not
  run it again after its tables already exist.
