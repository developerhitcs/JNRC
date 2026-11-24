# JNRC Manual Testing Guide

This guide covers the three implemented workflows:

1. **Admit Cards** (Module 1)
2. **Passed-out Registration** (Module 3)
3. **Internal Marks** (Module 5)

It explains the workflow, how to prepare test data, what to do, and what must
happen for a test to pass.

> **Use a local or staging copy only.** These tests create, submit, approve,
> reject, release, withdraw, and edit records. Do not run them against
> production or real student records. Back up the test database first. Use
> clearly marked test records and follow the database owner's cleanup policy.

## 1. Understand the workflows

### Admit Cards

An Admin finds exam applicants, assigns an exam center, and releases their
cards. An institution can see and download only released cards belonging to
that institution. A download creates a PDF with a QR verification link.
Withdrawing a card removes institution access and invalidates its verification
token.

Candidate photos/signatures are read from
`uploads/exam_form/{ref_no}/{img1,img2}`. The Registrar signature is read from
`uploads/signatures/registrarsignature.png` when present. Missing candidate
files should be labeled unavailable, never replaced with dummy images.

### Passed-out Registration

Admin creates and makes a passed-out session visible. An institution fills a
registration form and can save a draft. To submit, required fields and
documents must be complete and the applicant declaration accepted. Admin
reviews submitted forms: approve, reject with a remark, or request corrections
with a remark. Rejected and correction-requested forms may be edited and
resubmitted. Submitted and approved forms are locked to the institution.

Documents may be PDF, JPEG, or PNG, up to 5 MB each. They are kept in private
application storage. All listed documents except “Other Supporting Document”
are required for submission.

### Internal Marks

Admin configures an entry window and enables theory/practical assessment
components with maximum and pass marks for a session/course. Institutions find
eligible students by exam roll number or reference number and enter marks only
for configured components. Attendance is Present or Absent; Absent has no
numeric mark.

Institutions may save drafts while the entry window is open. Final submission
locks the marks immediately, even if the window remains open. Submission
requires attendance/marks for every enabled component for every eligible
student. Admin may edit marks with a reason or reopen the submission with a
reason; institution resubmission locks it again.

## 2. Prepare to test

### Environment and accounts

- [ ] Use local XAMPP at `http://localhost/JNRC/` or an isolated staging copy.
- [ ] Confirm the application loads and CSS is present.
- [ ] Confirm feature migrations exist in the database. Do not re-run a
  migration that has already been applied.
- [ ] Have one Admin login.
- [ ] Have two institution logins from **different institutions** for
  ownership checks. At least one must be ANM or GNM for Internal Marks.
- [ ] Use test exam-form applicants for each institution. Admit Card test data
  should have a reference, roll, session, course, institution, and selectable
  exam center.
- [ ] For Internal Marks, choose an existing session/course with eligible exam
  forms and assigned rolls. Prefer a small roster so final submission can be
  completed.
- [ ] For Passed-out Registration, prepare fake test data and safe PDF/JPEG/PNG
  files under 5 MB. Do not upload real identity documents.
- [ ] Record test record IDs/references and statuses. Never record passwords,
  real Aadhaar values, QR tokens, or real personal data.

### Main routes

Append these paths to the base URL. Panel navigation links may be used instead.

| Area | Route |
|---|---|
| Admin Admit Cards | `admin/admit-cards` |
| Institution Admit Cards | `institution_admit_cards` |
| Public Admit Card verification | Scan the PDF QR; it opens `verify/admit-card/{token}` |
| Admin Passed-out review | `admin/passed-out` |
| Admin Passed-out sessions | `admin/passed-out/sessions` |
| Institution Passed-out list | `institution/passed-out` |
| New Passed-out form | `institution/passed-out/new` |
| Admin Internal Marks | `admin/internal-marks` |
| Admin Internal Marks configuration | `admin/internal-marks/configure` |
| Institution Internal Marks | `institution/internal-marks` |

### How to record a result

For each test, record **Pass**, **Fail**, or **Blocked**, the date/time, tester
role, record ID/reference, and a short note. Do not include passwords or
sensitive data in screenshots. If a test fails, note the exact page, action,
and visible error. Do not repeat a destructive action until you understand the
record's current state.

## 3. Shared access tests

### SH-01 — Navigation by role

1. Sign in as Admin and open all three Admin modules from the sidebar.
2. Sign out and sign in as an institution.
3. Open all three Institution modules from its navigation.

**Pass when:** pages load without HTTP 500 errors; each role sees its own
actions and data, not the other role's controls.

### SH-02 — Unauthenticated users cannot view protected pages

1. Sign out completely.
2. Open the protected Admin and Institution routes in the table above. Skip
   the Public Admit Card verification route, which is intentionally public
   but requires a valid token.

**Pass when:** protected pages redirect to login or deny access; no applicant,
document, or marks data is shown.

### SH-03 — Institution cannot use Admin pages

1. Sign in as an institution.
2. Open the Admin module routes and Admin configuration/review pages directly.

**Pass when:** access is denied or redirected and no Admin information or
actions are available.

### SH-04 — State-changing actions require POST

1. While signed in, open action routes directly in the address bar, for
   example `admit_card_release`, `institution/passed-out/save`,
   `admin/passed-out/review/{record-id}`, or
   `institution/internal-marks/save`.

**Pass when:** a GET request does not execute the action and no data changes.

## 4. Module 1 — Admit Card tests

### AD-01 — Filters and pagination

1. As Admin, open `admin/admit-cards`.
2. Test session, course, institution, status, and student/reference search
   individually, then combine multiple filters.
3. Move between pages if pagination is available.

**Pass when:** only matching applicants are shown, combined filters work, and
the filters remain applied when changing pages.

### AD-02 — Release requires a center

1. Select one test applicant and choose **Release selected** without a center.
2. Confirm the warning and check the applicant remains unreleased.
3. Select a valid center and release the same applicant.

**Pass when:** release without a center is rejected; release with a valid
center succeeds and shows that center.

### AD-03 — Release selected applicants

1. Select two or more test applicants on the current page.
2. Choose a valid center and release them.
3. Refresh and inspect selected and unselected applicants.

**Pass when:** selected applicants are released with the center; unselected
applicants are unchanged.

### AD-04 — Admin preview/download PDF

1. Use **View PDF**, then **Download PDF**, for a released applicant.
2. Check name, reference/roll, session, course, center, and subject/date/time.

**Pass when:** both actions return a readable PDF for the right applicant,
with the assigned center and scheduled subjects.

### AD-05 — Candidate and Registrar image paths

1. For a test applicant with actual `img1`/`img2` files in
   `uploads/exam_form/{ref_no}/`, download the PDF.
2. Confirm those candidate images are used.
3. If present, confirm the approved
   `uploads/signatures/registrarsignature.png` is used.
4. If candidate files are intentionally missing, confirm the PDF labels them
   unavailable.

**Pass when:** actual images are used when present; missing files are labeled;
no sample candidate or dummy signature appears.

### AD-06 — Institution list is scoped to its own applicants

1. Release one test card for Institution A and one for Institution B.
2. Sign in separately as A and B; open `institution_admit_cards`.

**Pass when:** each institution sees only its own released cards.

### AD-07 — Institution downloads a single card

1. As the owning institution, download one released card.
2. Open the PDF and inspect its identity, center, schedule, and QR.
3. Refresh the Admin list and inspect status/download count.

**Pass when:** the correct PDF is downloaded and the Admin list records the
successful download.

### AD-08 — QR verification displays limited data

1. Scan a released test card's QR or open its URL.
2. Inspect the result and photo, if one is available.

**Pass when:** it reports Valid and displays only validity, name, father's
name, reference number, and approved photo. It must not reveal internal IDs,
contact details, addresses, marks, or institution-only data.

### AD-09 — Invalid QR token

1. Change one character in the test card's token URL and open it.
2. Try the corresponding verification-photo route with the changed token.

**Pass when:** the altered token is invalid and reveals no student identity
or photo.

### AD-10 — Institution cannot fetch another institution's card

1. While signed in as Institution A, use Institution B's test applicant ID
   in `institution_admit_card/{id}`.
2. If testing bulk download, include B's ID with an A-owned ID.

**Pass when:** no PDF/ZIP containing B's card is returned.

### AD-11 — Withdrawal revokes card and old QR

1. Save a released test card's verification URL.
2. As Admin, withdraw that test card.
3. Refresh Admin and Institution lists; open the old verification URL and try
   the old institution download URL.

**Pass when:** Admin shows Withdrawn; the institution cannot download it; the
old QR is invalid.

### AD-12 — Bulk ZIP download

1. As an institution, select two released cards on the current page and
   choose **Download selected as ZIP**.
2. Extract into a temporary test folder and open both PDFs.
3. Repeat with no selection.

**Pass when:** the ZIP contains exactly the selected cards with the correct
applicants/QRs; empty selection is rejected. Bulk is limited to the selected
cards on the current page (up to 100).

### AD-13 — Invalid release inputs

1. In the UI, try release with no selected applicant or without a center.
2. Only if you are comfortable testing requests, use a local/staging request
   tool to submit an invalid applicant ID or an oversized selection. Preserve
   the logged-in test session and CSRF token if CSRF is enabled.
3. Do not send oversized requests against real data.

**Pass when:** invalid input produces a visible error and no unintended
release or withdrawal occurs.

## 5. Module 3 — Passed-out Registration tests

### PO-01 — Create and show/hide a session

1. As Admin, open `admin/passed-out/sessions`.
2. Add a unique `TEST-PO-...` session and make it visible.
3. As an institution, confirm it appears on a new form.
4. Hide it and confirm it is not offered for a new form.

**Pass when:** visibility controls the choices for new forms.

### PO-02 — Session snapshot does not change on existing forms

1. Create a test draft using the visible session.
2. As Admin, hide or rename that session.
3. Reopen the existing draft.

**Pass when:** the draft retains its saved session label.

### PO-03 — Save draft with partial documents

1. As Institution A, start a new form.
2. Enter required core fields: applicant name, father's name, session,
   permanent address, registration type.
3. Enter clearly fake test data and upload only some required documents.
4. Choose **Save Draft** and reopen the form.

**Pass when:** it is listed as Draft; fields and uploaded files persist; the
institution can continue editing.

### PO-04 — Required core field validation

Try to save/submit test forms with each required field omitted in turn:
applicant name, father's name, session, permanent address, and registration
type.

**Pass when:** the missing field is rejected with a useful message.

### PO-05 — Missing required documents prevent submission

1. Complete core fields but omit one or more required documents.
2. Accept the declaration and choose **Verify & Submit**.
3. Inspect the status and message.

**Pass when:** it is not Submitted; it remains a Draft and identifies missing
uploads. “Other Supporting Document” is optional.

Required uploads: applicant photograph/signature, 10th marksheet and passing
certificate, 12th marksheet and passing certificate, Aadhaar card, provisional
degree/diploma, all nursing admit cards, all nursing marksheets, verification
report, transfer certificate, and course completion certificate. Combine
multiple nursing admit cards/marksheets into one PDF per field.

### PO-06 — Complete form submits for review

1. Complete required fields, all required documents, and accept the
   declaration.
2. Choose **Verify & Submit**.
3. Refresh the institution list and open the record.

**Pass when:** status is Submitted; Admin can see it; the institution can no
longer edit it.

### PO-07 — Declaration and field validation

In separate attempts, submit without accepting the declaration; try ages
below 1/above 120; malformed email; invalid phone; Aadhaar not exactly 12
digits; invalid calendar date; and invalid passing month/year.

**Pass when:** invalid submissions are rejected server-side and are not marked
Submitted. Valid values are accepted.

### PO-08 — Form and registration numbers are not unique

Create two distinct test forms with the same form number, and (if available)
the same registration number.

**Pass when:** both records are kept separate; neither number blocks saving.

### PO-09 — Upload format and size validation

1. Upload valid PDF, JPEG, and PNG test files, each under 5 MB.
2. Separately try an unsupported type, mismatched extension/content, and a
   file larger than 5 MB.

**Pass when:** valid files are accepted; invalid/oversized files are rejected
and not attached. The visible error should explain the failure.

### PO-10 — Authorized document downloads

1. Download an attached test file as its owning institution.
2. Download it as Admin from the review page.

**Pass when:** both authorized downloads return the correct file; files are
served through the app's access-checked document route, not a public uploads
URL.

### PO-11 — Record/document ownership

As Institution B, try Institution A's record URL and its document URL.

**Pass when:** the record/document is denied or not found and no private data
is exposed.

### PO-12 — Admin filters and review data

1. As Admin, open `admin/passed-out`.
2. Filter by status, session, and applicant/form-number search, separately
   and combined.
3. Open a Submitted test record; inspect fields, attachments, and history.

**Pass when:** filters match the records; review shows saved details, document
links/metadata, status, and history.

### PO-13 — Correction request and resubmission

1. On a Submitted test form, request correction with no remark.
2. Repeat with a test remark.
3. As the owning institution, confirm the remark, edit, and resubmit.

**Pass when:** blank remark is rejected; valid request sets
`revision_requested`; institution can edit/resubmit; status returns to
Submitted and history records the actions.

### PO-14 — Reject with remark and resubmit

1. Reject a different Submitted test form without a remark, then with one.
2. As the owning institution, edit and resubmit the rejected form.

**Pass when:** rejection without a remark is refused; valid rejection sets
`rejected`; the institution may edit and resubmit.

### PO-15 — Approve locks institution editing

1. Approve a Submitted test form as Admin.
2. As the owning institution, try to open its edit route and save it.

**Pass when:** status is Approved and the institution cannot change it.

### PO-16 — Draft cannot be reviewed

As Admin, try to review or apply a decision to a Draft test record.

**Pass when:** only Submitted records can be approved, rejected, or returned
for corrections.

### PO-17 — Date-range XLSX export

1. Create test forms with known creation dates/statuses.
2. As Admin, export a date range with session/status/search filters.
3. Open the downloaded `.xlsx` file in Excel or LibreOffice.
4. Try an invalid date and a start date later than the end date.

**Pass when:** the workbook opens and has expected columns/records; filters
use form creation date and include the selected end date; invalid/reversed
dates are rejected. Spreadsheet values remain text, not formulas.

### PO-18 — Audit history

After draft save, submission, review, and correction/resubmission, inspect
the record's History section.

**Pass when:** actions show actor, time, status transition, and applicable
remark; later edits do not erase earlier events.

### PO-19 — Delete an unused test session

1. Create a second unique `TEST-PO-DELETE-...` session and confirm it is
   available to institutions.
2. Delete this test session from Admin session management.
3. Refresh session management and the institution's new-form session list.
4. Confirm records created using a different session still show their saved
   session label.

**Pass when:** the unused test session is removed from the list and new-form
choices; existing record snapshots are unchanged. Do not delete a session
that contains real or non-test submissions.

## 6. Module 5 — Internal Marks tests

### IM-01 — Configure window and components

1. As Admin, open `admin/internal-marks/configure`.
2. Choose an existing test session/course that matches the institution.
3. Set start time in the past, end time in the future, and enable the window.
4. Enable at least one Theory component and (if relevant) one Practical
   component. Set a positive maximum and a pass mark between zero and maximum.
5. Leave other components disabled and save; reopen the configuration.

**Pass when:** configuration persists and the enabled/max/pass values shown
are correct; disabled components do not appear in Institution entry.

### IM-02 — Reject invalid configuration

Separately try no enabled components, zero/negative maximum, pass above
maximum, more than two decimals, and a start time equal to/later than the end.

**Pass when:** each invalid configuration is rejected and not saved.

### IM-03 — Institution sees applicable windows

Sign in as an ANM/GNM institution and inspect its windows. If available, repeat
with a different course-type institution.

**Pass when:** windows match the institution course type; one institution
cannot choose another institution's marks.

### IM-04 — Find student by roll number

Open a test window, choose an eligible student from the roster, and find that
student by exact assigned roll number.

**Pass when:** the correct exam-form details load and only configured
components appear.

### IM-05 — Find student by reference number

Find the same eligible student by exact exam reference number.

**Pass when:** the same student and configured components load.

### IM-06 — Reject unmatched/ineligible student lookup

Search a nonexistent identifier, another institution's identifier, and (if
available) a form without an assigned roll.

**Pass when:** no unauthorized/ineligible details or marks form is loaded and
the user sees a no-match message.

### IM-07 — Save draft and reopen it

During the open window, enter valid marks for one or more enabled components
for one eligible test student; choose **Save Draft**; reopen the student.

**Pass when:** the saved attendance/marks persist; status remains Draft and
the institution may continue editing.

### IM-08 — Marks boundaries and precision

In separate attempts, enter 0, a normal value, maximum, and a valid two-decimal
mark. Also try negative, above maximum, more than two decimal places, text,
and blank while Present.

**Pass when:** valid values save; invalid values are rejected and do not
replace valid saved marks.

### IM-09 — Present and Absent rules

Save Present with a valid mark and Absent with a blank mark. Then try Absent
with a numeric mark.

**Pass when:** valid Present/Absent values persist; Absent plus a number is
rejected.

### IM-10 — Only configured components are accepted

Confirm disabled components are not shown. In a controlled local request
test, try posting an unconfigured assessment ID.

**Pass when:** the server refuses unconfigured components, even if manually
posted.

### IM-11 — Incomplete final submission remains a draft

Final submission checks **all eligible students**, not only the currently
open student. Leave at least one enabled component/student unfinished, then
choose **Submit All & Lock**.

**Pass when:** submission is rejected with an incomplete-entry message; it
does not become Submitted and remains editable.

### IM-12 — Complete final submission locks immediately

1. Fill every enabled component for every eligible student in the test
   session/course (Present with a valid mark or Absent with no mark).
2. Choose **Submit All & Lock** and confirm.
3. Check Admin status and reopen Institution entry while the window is still
   open.

**Pass when:** status is Submitted and Institution editing is blocked
immediately, independent of remaining window time.

### IM-13 — Window start/end and Admin close control

Use a disposable test window and restore its settings after the test:

1. Set a future start and try a draft before it starts.
2. Set start in the past/end in the future and try a draft.
3. Set the end in the past and try a draft.
4. Set dates in range but turn off **Allow institution entry during this
   window** and try a draft.

**Pass when:** drafts are blocked before start, after end, or when Admin
closes the window; they are allowed only while enabled and in range. Restore
the original dates/open setting.

### IM-14 — Admin filters and review

As Admin, filter `admin/internal-marks` by session, course, institution, and
status; combine filters; open **Review** on a test submission.

**Pass when:** results match filters and review shows the correct
institution/student/components and audit history.

### IM-15 — Admin edit requires reason and audits changes

Try changing a test mark without a reason, then with a reason and valid mark.
Inspect the audit history.

**Pass when:** missing reason is rejected; valid change is saved; history
shows the reason and previous/new values.

### IM-16 — Admin reopen and institution resubmission

1. Reopen a Submitted test record without a reason, then with a reason.
2. As the institution, edit and save a mark; complete and resubmit.
3. Inspect Admin status and history.

**Pass when:** missing reason is rejected; valid reason changes state to
Reopened and permits correction, even outside the normal window; resubmission
locks it again and history records each action.

### IM-17 — Excel-compatible CSV export

As Admin, export internal marks with session/course/institution/status
filters. Open the CSV in Excel or LibreOffice and compare sample rows with
the review page.

**Pass when:** it opens as CSV, has expected columns, honors selected filters,
and reports the same attendance and marks as the saved records. This is CSV,
not native `.xlsx`.

### IM-18 — Assessment definitions lock after marks exist

On a test context with saved marks, try changing enabled components,
maximums, or pass marks. Separately change window dates/open state.

**Pass when:** assessment changes that would invalidate existing marks are
refused; allowed window date/availability changes persist.

### IM-19 — Admin default and all-status view

1. Open `admin/internal-marks` without a status filter.
2. Check which statuses appear by default.
3. Select **All statuses** and then filter separately for Draft, Submitted,
   and Reopened test submissions.

**Pass when:** the default list is Submitted; explicit All statuses shows
the other matching states; each individual status filter returns only that
state.

## 7. Data safety and cleanup

- [ ] Keep test forms, applicants, and session labels clearly marked `TEST`.
- [ ] Never delete or overwrite real records. Use a disposable local database
  or ask its owner to clean test data.
- [ ] After Admit Card tests, confirm test cards are withdrawn and old QR
  links are invalid.
- [ ] After Passed-out tests, note test record IDs and final statuses; clean
  them only under the test-data policy.
- [ ] After Internal Marks tests, restore any changed window dates/open
  setting. Remove test submissions only under the test-data policy.
- [ ] Remove downloaded PDFs, ZIPs, XLSX/CSV exports, and extracted test
  documents from shared folders.
- [ ] Never include passwords, real Aadhaar numbers, QR tokens, or real
  student documents in notes/screenshots.

## 8. Test execution record

Record one result per test (or each individual ID in a range). Use **Pass**,
**Fail**, or **Blocked**.

| Test ID | Result | Date/time | Tester role | Test record ID/reference | Notes or defect |
|---|---|---|---|---|---|
| SH-01 | | | | | |
| SH-02 | | | | | |
| SH-03 | | | | | |
| SH-04 | | | | | |
| AD-01 to AD-13 | | | | | |
| PO-01 to PO-19 | | | | | |
| IM-01 to IM-19 | | | | | |

## 9. Related implementation files

### Admit Cards

- [Controller](./application/controllers/Admit_cards.php)
- [Model](./application/models/Admit_card_model.php)
- [Admin release view](./application/views/admin/admit_card_release.php)
- [Institution list view](./application/views/institution/admit_cards.php)
- [PDF layout](./application/views/admin/admit_card_layout.php)
- [Public verification view](./application/views/frontend/admit_card_verify.php)
- [Release migration](./database/migrations/202610270001_create_admit_card_release_tables.sql)
- [Center/QR migration](./database/migrations/202610270002_add_admit_card_center_qr.sql)

### Passed-out Registration

- [Controller](./application/controllers/Passed_out.php)
- [Model](./application/models/Passed_out_model.php)
- [Institution form](./application/views/institution/passed_out_form.php)
- [Institution list](./application/views/institution/passed_out_records.php)
- [Admin review list](./application/views/admin/passed_out_review.php)
- [Admin record review](./application/views/admin/passed_out_record.php)
- [Admin session management](./application/views/admin/passed_out_sessions.php)
- [Registration migration](./database/migrations/202611030001_create_passed_out_registration_tables.sql)
- [Academic/documents migration](./database/migrations/202611030002_add_passed_out_academics_documents.sql)
- [Passing-month migration](./database/migrations/202611030003_change_passing_date_to_month.sql)
- [Private document storage](./application/storage/)

### Internal Marks

- [Controller](./application/controllers/Internal_marks.php)
- [Model](./application/models/Internal_marks_model.php)
- [Admin list/review filters](./application/views/admin/internal_marks.php)
- [Admin configuration list](./application/views/admin/internal_marks_configure.php)
- [Admin configuration editor](./application/views/admin/internal_marks_configure_window.php)
- [Admin submission review](./application/views/admin/internal_marks_submission.php)
- [Institution window list](./application/views/institution/internal_marks.php)
- [Institution entry form](./application/views/institution/internal_marks_entry.php)
- [Internal Marks migration](./database/migrations/202611090001_create_internal_marks_tables.sql)

### Shared routing

- [Routes](./application/config/routes.php)