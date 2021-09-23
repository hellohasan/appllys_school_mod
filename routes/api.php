<?php

use App\Http\Controllers\Api\Academic\ClassPeriodController;
use App\Http\Controllers\API\Academic\GradeController;
use App\Http\Controllers\API\Academic\SubjectController;
use App\Http\Controllers\API\Academic\TeacherManageController;
use App\Http\Controllers\API\Accountant\BillAssignController;
use App\Http\Controllers\Api\Accountant\BillItemController;
use App\Http\Controllers\API\AdmissionController;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::apiResources(['user' => 'API\UserController']);
    Route::get('profile','API\UserController@profile');
    Route::post('update-profile','API\UserController@updateProfile');
    Route::post('update-password','API\UserController@updatePassword');

    Route::apiResource('roles','API\RoleController');
    Route::apiResource('permissions','API\PermissionController');

    Route::apiResources(['customers'=> 'API\CustomerController']);

    Route::get('basic-setting','API\BasicSettingController@getBasicSetting');
    Route::post('basic-setting-update','API\BasicSettingController@updateBasicSetting');

    Route::get('email-setting','API\EmailSettingController@getEmailSetting');
    Route::post('email-setting-update','API\EmailSettingController@updateEmailSetting');
    Route::get('get-email-template','API\EmailSettingController@getEmailtemplate');
    Route::post('update-email-template','API\EmailSettingController@updateEmailTemplate');

    Route::get('sms-api','API\SmsSettingController@getSMApiSetting');
    Route::post('sms-api-update','API\SmsSettingController@updateSMApiSetting');

    Route::post('update-logo','API\BasicSettingController@updateLogoFavicon');

    Route::get('roles-select','API\RoleController@roleSelect');

    Route::get('academic-sessions','API\Academic\SessionController@getAcademicSession');
    Route::post('store-academic-sessions','API\Academic\SessionController@storeAcademicSession');
    Route::get('academic-sessions/edit/{id}','API\Academic\SessionController@editAcademicSession');
    Route::put('academic-sessions/update/{id}','API\Academic\SessionController@updateAcademicSession');

    Route::get('load-academic-sessions','API\Academic\SessionController@loadAcademicSession');

    Route::get('load-academic-grading-list','API\Academic\ClassController@loadAcademicGrading');
    Route::post('academic-class-store','API\Academic\ClassController@storeAcademicClass');
    Route::get('get-academic-classes','API\Academic\ClassController@getAcademicClass');
    Route::get('edit-academic-classes/{id}','API\Academic\ClassController@editAcademicClass');
    Route::put('academic-class-update/{id}','API\Academic\ClassController@updateAcademicClass');

    Route::apiResource('academic-groups','API\Academic\GroupController',['except' => ['show','destroy']]);
    Route::apiResource('academic-departments','API\Academic\DepartmentController',['except' => ['show','destroy']]);
    Route::apiResource('academic-years','API\Academic\YearController',['except' => ['show','destroy']]);
    Route::apiResource('academic-sections','API\Academic\SectionController',['except' => ['show','destroy']]);

    Route::get('load-academic-group-list',[CommonController::class,'loadAcademicGroupList']);
    Route::get('load-academic-group-all-list',[CommonController::class,'loadAcademicGroupAllList']);
    Route::get('load-academic-department-list',[CommonController::class,'loadAcademicDepartmentList']);
    Route::get('load-academic-year-list',[CommonController::class,'loadAcademicYearList']);
    Route::get('load-academic-section-list',[CommonController::class,'loadAcademicSectionList']);

    Route::post('sore-academic-grade',[GradeController::class,'storeGrade'])->middleware(['permission:grade-store']);
    Route::get('load-academic-grade-list',[GradeController::class,'getGradeList'])->middleware(['permission:grade-list']);
    Route::get('edit-academic-grade/{id}',[GradeController::class,'editGradeList'])->middleware(['permission:grade-edit']);
    Route::put('update-academic-grade/{id}',[GradeController::class,'updateGradeList'])->middleware(['permission:grade-update']);

    Route::get('load-divisions',[CommonController::class,'loadDivisions']);
    Route::get('load-districts',[CommonController::class,'loadDistricts']);
    Route::get('load-upazilas',[CommonController::class,'loadUpazilas']);
    Route::get('load-guardians',[CommonController::class,'loadGuardians']);

    Route::get('load-religion-list',[CommonController::class,'loadReligionList']);
    Route::get('load-blood-list',[CommonController::class,'loadBloodList']);
    Route::get('load-class-list',[CommonController::class,'loadClassList']);
    Route::get('load-class-group-department',[CommonController::class,'loadClassGroupDepartment']);
    Route::get('load-department-years',[CommonController::class,'loadDepartmentYears']);

    Route::post('search-class-subject',[CommonController::class,'searchClassSubject']);
    Route::get('load-only-class-list',[CommonController::class,'loadOnlyClassList']);
    Route::get('load-only-session-list',[CommonController::class,'loadOnlySessionList']);
    Route::get('load-class-with-session/{sessionId}',[CommonController::class,'loadClassWithSession']);
    Route::get('load-class-section-group-department',[CommonController::class,'loadClassSectionGroupDepartment']);
    Route::get('load-group-section',[CommonController::class,'loadGroupSection']);
    Route::get('load-only-group-section',[CommonController::class,'loadOnlyGroupSection']);

    /*Route for subjects*/
    Route::post('store-academic-subject',[SubjectController::class,'storeSubject']);
    Route::get('edit-academic-subject/{id}',[SubjectController::class,'editSubject']);
    Route::put('update-academic-subject/{id}',[SubjectController::class,'updateSubject']);

    /*Admission Form Route*/
    Route::post('submit-admission-form',[AdmissionController::class,'submitAdmissionForm']);
    Route::post('get-admission-list',[AdmissionController::class,'getAdmissionList']);

    Route::get('load-admission-details',[CommonController::class,'loadAdmissionDetails']);


    /*Salary Scale Route List*/
    Route::apiResource('salary-scale','API\SalaryScaleController',['except' => ['show','destroy']]);
    /*Designation Route list*/
    Route::apiResource('designations', 'API\Academic\DesignationController',['except' => ['show','destroy']]);

    //load test api
    Route::get('/load-test3-student',[AdmissionController::class,'testStudentDataTable'])->name('load-test3-student');

    Route::get('load-academic-classes/{id}','API\Academic\ClassController@loadAcademicClass');
    Route::get('load-salary-scale-list',[CommonController::class,'loadSalaryScaleList']);
    Route::get('load-designation-list',[CommonController::class,'loadDesignationList']);

    /*Teacher Create Route*/
    Route::post('teacher-store',[TeacherManageController::class,'storeTeacher']);
    Route::get('teacher-list',[TeacherManageController::class,'getTeacher']);
    Route::get('teacher-edit/{id}',[TeacherManageController::class,'editTeacher']);
    Route::put('teacher-update/{id}',[TeacherManageController::class,'updateTeacher']);
    Route::get('load-teacher-list',[CommonController::class,'loadTeacherList']);

    /*Class Period Route list*/
    Route::get('class-periods',[ClassPeriodController::class,'index']);
    Route::post('class-periods',[ClassPeriodController::class,'store']);
    Route::put('class-periods/{id}',[ClassPeriodController::class,'update']);

    /*Accountant Route List*/
    Route::apiResource('bill-items','API\Accountant\BillItemController',['except' => ['create','show','destroy']]);
    Route::post('bill-item-export',[BillItemController::class,'exportExcelPDF']);

    Route::get('load-bill-for-student',[CommonController::class,'loadBillForStudent']);

    Route::get('bill-assign-list',[BillAssignController::class,'billAssignList']);
    Route::post('bill-assign-submit',[BillAssignController::class,'billAssignSubmit']);
    Route::get('bill-assign-view/{custom}',[BillAssignController::class,'billAssignView'])->middleware('permission:bill-assign-view');
    Route::delete('bill-assign-delete',[BillAssignController::class,'billAssignDelete'])->middleware('permission:bill-assign-delete');

    Route::get('load-student-for-class',[CommonController::class,'loadStudentForClass']);
    Route::get('load-student-for-class-group',[CommonController::class,'loadStudentForClassGroup']);
    Route::get('load-student-for-class-department-year',[CommonController::class,'loadStudentForClassDepartmentYear']);

    /*Load Student*/
    Route::get('load-specific-student',[CommonController::class,'loadSpecificStudent']);

    /*Bill Receive Route*/
    Route::get('receive-specific-student-bill',[\App\Http\Controllers\API\Accountant\BillReceiveController::class,'receiveSpecificStudentBill']);
    Route::post('submit-specific-student-bill',[\App\Http\Controllers\API\Accountant\BillReceiveController::class,'submitSpecificStudentBill']);
    Route::get('specific-bill-receipt',[\App\Http\Controllers\API\Accountant\BillReceiveController::class,'specificBillReceipt']);
});

