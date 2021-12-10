<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\API\AdmissionController;
use App\Http\Controllers\API\Academic\GradeController;
use App\Http\Controllers\API\Teacher\TeacherController;
use App\Http\Controllers\API\Academic\SubjectController;
use App\Http\Controllers\API\Accountant\SalaryController;
use App\Http\Controllers\API\Academic\MarkInputController;
use App\Http\Controllers\API\Accountant\AccountController;
use App\Http\Controllers\API\Accountant\BillItemController;
use App\Http\Controllers\API\Academic\ClassPeriodController;
use App\Http\Controllers\API\Academic\AcademicExamController;
use App\Http\Controllers\API\Accountant\BillAssignController;
use App\Http\Controllers\API\Academic\SubjectAssignController;
use App\Http\Controllers\API\Academic\TeacherManageController;
use App\Http\Controllers\API\Accountant\BillReceiveController;
use App\Http\Controllers\API\Accountant\TransactionLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt'], function () {

    Route::get('change-language', [LanguageController::class, 'changelanguage']);

    Route::apiResources(['user' => 'API\UserController']);
    Route::get('profile', 'API\UserController@profile');
    Route::post('update-profile', 'API\UserController@updateProfile');
    Route::post('update-password', 'API\UserController@updatePassword');

    Route::apiResource('roles', 'API\RoleController');
    Route::apiResource('permissions', 'API\PermissionController');

    Route::apiResources(['customers' => 'API\CustomerController']);

    Route::get('basic-setting', 'API\BasicSettingController@getBasicSetting');
    Route::post('basic-setting-update', 'API\BasicSettingController@updateBasicSetting');

    Route::get('email-setting', 'API\EmailSettingController@getEmailSetting');
    Route::post('email-setting-update', 'API\EmailSettingController@updateEmailSetting');
    Route::get('get-email-template', 'API\EmailSettingController@getEmailtemplate');
    Route::post('update-email-template', 'API\EmailSettingController@updateEmailTemplate');

    Route::get('sms-api', 'API\SmsSettingController@getSMApiSetting');
    Route::post('sms-api-update', 'API\SmsSettingController@updateSMApiSetting');

    Route::post('update-logo', 'API\BasicSettingController@updateLogoFavicon');

    Route::get('roles-select', 'API\RoleController@roleSelect');

    Route::get('academic-sessions', 'API\Academic\SessionController@getAcademicSession');
    Route::post('store-academic-sessions', 'API\Academic\SessionController@storeAcademicSession');
    Route::get('academic-sessions/edit/{id}', 'API\Academic\SessionController@editAcademicSession');
    Route::put('academic-sessions/update/{id}', 'API\Academic\SessionController@updateAcademicSession');

    Route::get('load-academic-sessions', 'API\Academic\SessionController@loadAcademicSession');
    Route::get('load-active-academic-session', 'API\Academic\SessionController@loadActiveAcademicSession');

    Route::get('load-academic-grading-list', 'API\Academic\ClassController@loadAcademicGrading');
    Route::post('academic-class-store', 'API\Academic\ClassController@storeAcademicClass');
    Route::get('get-academic-classes', 'API\Academic\ClassController@getAcademicClass');
    Route::get('edit-academic-classes/{id}', 'API\Academic\ClassController@editAcademicClass');
    Route::put('academic-class-update/{id}', 'API\Academic\ClassController@updateAcademicClass');

    Route::get('load-class-all-details/{id}', [CommonController::class, 'loadClassAllDetails']);
    Route::get('load-only-class-sections-groups-departments/{id}', [CommonController::class, 'loadOnlyClassSectionGroupDepartment']); // return section, group, department

    Route::apiResource('academic-groups', 'API\Academic\GroupController', ['except' => ['show', 'destroy']]);
    Route::apiResource('academic-departments', 'API\Academic\DepartmentController', ['except' => ['show', 'destroy']]);
    Route::apiResource('academic-years', 'API\Academic\YearController', ['except' => ['show', 'destroy']]);
    Route::apiResource('academic-sections', 'API\Academic\SectionController', ['except' => ['show', 'destroy']]);

    Route::get('load-academic-group-list', [CommonController::class, 'loadAcademicGroupList']);
    Route::get('load-academic-group-all-list', [CommonController::class, 'loadAcademicGroupAllList']);
    Route::get('load-academic-department-list', [CommonController::class, 'loadAcademicDepartmentList']);
    Route::get('load-academic-year-list', [CommonController::class, 'loadAcademicYearList']);
    Route::get('load-academic-section-list', [CommonController::class, 'loadAcademicSectionList']);

    Route::post('sore-academic-grade', [GradeController::class, 'storeGrade'])->middleware(['permission:grade-store']);
    Route::get('load-academic-grade-list', [GradeController::class, 'getGradeList'])->middleware(['permission:grade-list']);
    Route::get('edit-academic-grade/{id}', [GradeController::class, 'editGradeList'])->middleware(['permission:grade-edit']);
    Route::put('update-academic-grade/{id}', [GradeController::class, 'updateGradeList'])->middleware(['permission:grade-update']);

    Route::get('load-divisions', [CommonController::class, 'loadDivisions']);
    Route::get('load-districts', [CommonController::class, 'loadDistricts']);
    Route::get('load-upazilas', [CommonController::class, 'loadUpazilas']);
    Route::get('load-guardians', [CommonController::class, 'loadGuardians']);

    Route::get('load-religion-list', [CommonController::class, 'loadReligionList']);
    Route::get('load-blood-list', [CommonController::class, 'loadBloodList']);
    Route::get('load-class-list', [CommonController::class, 'loadClassList']);
    Route::get('load-class-group-department', [CommonController::class, 'loadClassGroupDepartment']);
    Route::get('load-department-years', [CommonController::class, 'loadDepartmentYears']);

    Route::post('search-class-subject', [CommonController::class, 'searchClassSubject']);
    Route::get('load-only-class-list', [CommonController::class, 'loadOnlyClassList']);
    Route::get('load-only-session-list', [CommonController::class, 'loadOnlySessionList']);
    Route::get('load-class-with-session/{sessionId}', [CommonController::class, 'loadClassWithSession']);
    Route::get('load-class-section-group-department', [CommonController::class, 'loadClassSectionGroupDepartment']);
    Route::get('load-group-section', [CommonController::class, 'loadGroupSection']);
    Route::get('load-only-group-section', [CommonController::class, 'loadOnlyGroupSection']);
    Route::get('load-only-department-year', [CommonController::class, 'loadOnlyDepartmentYear']);

    /*Route for subjects*/
    Route::post('store-academic-subject', [SubjectController::class, 'storeSubject']);
    Route::get('edit-academic-subject/{id}', [SubjectController::class, 'editSubject']);
    Route::put('update-academic-subject/{id}', [SubjectController::class, 'updateSubject']);

    /*Admission Form Route*/
    Route::post('submit-admission-form', [AdmissionController::class, 'submitAdmissionForm']);
    Route::post('get-admission-list', [AdmissionController::class, 'getAdmissionList']);

    Route::get('load-admission-details', [CommonController::class, 'loadAdmissionDetails']);

    /*Salary Scale Route List*/
    Route::apiResource('salary-scale', 'API\SalaryScaleController', ['except' => ['show', 'destroy']]);
    /*Designation Route list*/
    Route::apiResource('designations', 'API\Academic\DesignationController', ['except' => ['show', 'destroy']]);

    //load test api
    Route::get('/load-test3-student', [AdmissionController::class, 'testStudentDataTable'])->name('load-test3-student');

    Route::get('load-academic-classes/{id}', 'API\Academic\ClassController@loadAcademicClass');
    Route::get('load-salary-scale-list', [CommonController::class, 'loadSalaryScaleList']);
    Route::get('load-designation-list', [CommonController::class, 'loadDesignationList']);
    Route::get('load-academic-class-list', [CommonController::class, 'loadAcademicClassList']);

    /*Teacher Create Route*/
    Route::post('teacher-store', [TeacherManageController::class, 'storeTeacher']);
    Route::get('teacher-list', [TeacherManageController::class, 'getTeacher']);
    Route::get('teacher-edit/{id}', [TeacherManageController::class, 'editTeacher']);
    Route::put('teacher-update/{id}', [TeacherManageController::class, 'updateTeacher']);
    Route::get('load-teacher-list', [CommonController::class, 'loadTeacherList']);

    /*Class Period Route list*/
    Route::get('class-periods', [ClassPeriodController::class, 'index']);
    Route::post('class-periods', [ClassPeriodController::class, 'store']);
    Route::put('class-periods/{id}', [ClassPeriodController::class, 'update']);

    /*Accountant Route List*/
    Route::apiResource('bill-items', 'API\Accountant\BillItemController', ['except' => ['create', 'show', 'destroy']]);
    Route::post('bill-item-export', [BillItemController::class, 'exportExcelPDF']);

    Route::get('load-bill-for-student', [CommonController::class, 'loadBillForStudent']);

    Route::get('bill-assign-list', [BillAssignController::class, 'billAssignList']);
    Route::post('bill-assign-submit', [BillAssignController::class, 'billAssignSubmit']);
    Route::get('bill-assign-view/{custom}', [BillAssignController::class, 'billAssignView'])->middleware('permission:bill-assign-view');
    Route::delete('bill-assign-delete', [BillAssignController::class, 'billAssignDelete'])->middleware('permission:bill-assign-delete');

    Route::get('load-student-for-class', [CommonController::class, 'loadStudentForClass']);
    Route::get('load-student-for-class-group', [CommonController::class, 'loadStudentForClassGroup']);
    Route::get('load-student-for-class-department-year', [CommonController::class, 'loadStudentForClassDepartmentYear']);

    /*Load Student*/
    Route::get('load-specific-student', [CommonController::class, 'loadSpecificStudent']);

    /*Bill Receive Route*/
    Route::get('receive-specific-student-bill', [BillReceiveController::class, 'receiveSpecificStudentBill']);
    Route::post('submit-specific-student-bill', [BillReceiveController::class, 'submitSpecificStudentBill']);
    Route::get('specific-bill-receipt', [BillReceiveController::class, 'specificBillReceipt']);
    Route::get('load-bill-pay-lists', [BillReceiveController::class, 'loadBillPayList']);
    Route::delete('delete-bill-pay-lists', [BillReceiveController::class, 'deleteBillPayList']);

    /* load Account list */
    Route::get('load-account-list', [CommonController::class, 'loadAccountList']);

    /* ManageAccount Route List */
    Route::get('manage-accounts', [AccountController::class, 'index'])->middleware('permission:manage-accounts');
    Route::post('manage-accounts-store', [AccountController::class, 'store'])->middleware('permission:manage-accounts-store');
    Route::get('manage-accounts-edit/{id}', [AccountController::class, 'edit'])->middleware('permission:manage-accounts-edit');
    Route::put('manage-accounts-update/{id}', [AccountController::class, 'update'])->middleware('permission:manage-accounts-update');

    /* Academic Expense Route list */
    Route::get('load-office-bill-items', [CommonController::class, 'loadOfficeBillItes']);
    Route::apiResource('expenses', 'API\Accountant\ExpenseController', ['except' => ['edit', 'update']]);

    /* Load Salary Scale list */
    Route::get('load-salary-scales', [CommonController::class, 'loadSalaryScale']);

    /* Salary Route list */
    Route::post('salary-finder', [SalaryController::class, 'salaryFinder']);
    Route::apiResource('salary', 'API\Accountant\SalaryController', ['except' => ['edit', 'update']]);

    /* Load role list */
    Route::get('load-role-list', [CommonController::class, 'loadRoleList']);

    /* Balance Transfer Route List  */
    Route::apiResource('balance-transfer', 'API\Accountant\BalanceTransferController', ['except' => ['edit', 'update']]);

    /* Transaction Log Route list */
    Route::get('transaction-logs', [TransactionLogController::class, 'index']);

    /* Teacher subject assign route list */
    Route::post('get-academic-class-subjects', [SubjectAssignController::class, 'getSubjectList']);
    Route::post('submit-academic-class-subject-list', [SubjectAssignController::class, 'submitAssignList']);
    Route::get('show-academic-class-subject-list/{custom}', [SubjectAssignController::class, 'showAssignList']);
    Route::get('subject-assign-list', [SubjectAssignController::class, 'subjectAssignList']);
    Route::delete('delete-subject-assign/{custom}', [SubjectAssignController::class, 'subjectAssignDelete']);

    /* days and periods route list */
    Route::get('load-day-list', [CommonController::class, 'loadDayList']);
    Route::get('load-period-list', [CommonController::class, 'loadPeriodList']);

    /* Academic Exam Controller Route */
    Route::apiResource('academic-exam', 'API\Academic\AcademicExamController');
    Route::post('academic-exam-assign', [AcademicExamController::class, 'assignExam']);
    Route::get('academic-exam-routine/{custom}', [AcademicExamController::class, 'examRoutine']);
    Route::post('academic-exam-routine-submit', [AcademicExamController::class, 'examRoutineSubmit']);
    Route::get('academic-exam-routine-show/{custom}', [AcademicExamController::class, 'examRoutineShow']);

    /* Student List */
    Route::get('load-teacher-session-subject-list', [TeacherController::class, 'loadTeacherSessionSubjectList']);
    Route::post('load-teacher-student-list', [TeacherController::class, 'loadTeacherStudentList']);

    /* Exam Mark input */
    Route::get('load-session-exams', [MarkInputController::class, 'loadSessionExam'])->middleware('permission:load-session-exam');
    Route::get('load-exam-classes', [MarkInputController::class, 'loadExamClass'])->middleware('permission:load-exam-class');
    Route::get('load-exam-class-subjects', [MarkInputController::class, 'loadExamClassSubject'])->middleware('permission:load-exam-class-subjects');
    Route::post('load-mark-input-students', [MarkInputController::class, 'loadMarkInputStudents'])->middleware('permission:load-mark-input-students');
    Route::post('submit-inputted-mark', [MarkInputController::class, 'submitInputtedMark'])->middleware('permission:mark-submit');
    Route::post('mark-input-print', [MarkInputController::class, 'markInputPrint'])->middleware('permission:load-mark-input-students');
});
