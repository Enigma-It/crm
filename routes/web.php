<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
/*front End Routes----------------------------------------------------------------------------------*/



// Web Routes================================================
Route::get('/', 'HomeController@index');
Route::get('/franchise','FranchiseController@index')->name('franchise');
Route::get('contact-us','HomeController@contactUs');
Route::get('news-page','HomeController@newsPage');
Route::get('about','HomeController@about');
// Web Routes================================================
Route::resource('franchise','FranchiseController');
Route::get('franchise-register','FranchiseController@franchiseRegister');
Route::get('load-thana/{thanaId}', 'FranchiseController@getThana');
Route::get('load-district/{dId}', 'FranchiseController@getDisctrict');
//package and service single page show
Route::get('service-details/{id}','ServiceController@singleServiceView');
Route::get('package-details/{id}','PackageController@singlePackageView');
Route::get('doctor-details/{id}','DoctorController@singleDoctorView');
Route::get('search-test','HomeController@singleTestView');



//login register route
Route::get('register-form', 'LoginController@registerForm');
Route::get('login-form', 'LoginController@loginForm');
Route::get('patient-profile', 'LoginController@profile');
Route::get('patient-order', 'LoginController@order');

//patient controller
Route::resource('patient','PatientController');
Route::get('show-increase-cart/{id}/{qty}','CartController@showIncreaseQty');
Route::get('show-decrease-cart/{id}/{qty}','CartController@showDecreaseQty');

Route::post('patient-login','LoginController@usertLogin');
Route::resource('order','OrderController');

Route::post('add-to-cart','CartController@AddCart');
Route::get('view-cart','CartController@viewCart');
Route::get('delete-cart/{id}','CartController@RemoveCart');
Route::get('increase-cart/{id}/{qty}','CartController@increaseQty');
Route::get('decrease-cart/{id}/{qty}','CartController@decreaseQty');

Auth::routes();

Route::group(['middleware'=>['patientAccess']],function(){
    Route::get('patient-order', 'LoginController@order');
    Route::get('patient-profile', 'LoginController@profile');
    Route::get('orderReport-details/{id}','OrderController@showOrderDetails');
    Route::get('patient-logout','LoginController@userLogout');
    Route::get('order-page','PatientController@order');
    Route::get('patient-profile', 'LoginController@profile');
});

//$doctor->id
Route::get('doctor-details/{id}','DoctorController@show');
Route::post('get-appoinment','BookDoctorAppointmentController@store');


Route::get('update-profile/{id}','LoginController@changePassword');
Route::post('update-password/{id}','LoginController@updatePassword');

Route::resource('order','OrderController');


Route::get('orderReport-details/{id}','OrderController@showOrderDetails');

Auth::routes();


Route::group(['middleware'=>['auth','currencyCheck', 'userrolewiseaccess']],function(){

    Route::get('dashboard', 'dashboardController@index')->name('route.dashboard');
    Route::get('truncate', 'dashboardController@allTable');
    Route::get('truncate/{table}', 'dashboardController@truncateTable');

    Route::post('update-profile', 'UserController@updateProfile');
    //admin controller
    Route::resource('manage-admin', 'AdminController');

    Route::resource('employee-designation', 'EmployeeDesignationController');
    Route::resource('employee-list','EmployeeController');
    Route::get('add-employee','EmployeeController@create');
    Route::match(['get', 'post'], '/search-employee', [
        'uses'=>Request::isMethod('post')?'EmployeeController@searchEmployee':'EmployeeController@index'
    ]);
    Route::get('edit-employee/{id}','EmployeeController@edit');
    //employee salary---------
    Route::resource('employee-salary-list','EmployeeSalaryController');
    Route::resource('user-type', 'UserTypeController');

    Route::resource('doctor', 'DoctorController');
    Route::get('search-doctor', 'DoctorController@searchDoctor');
    Route::resource('medical-department', 'MedicalDepartmentController');
    // Route::resource('doctor-appointment', 'DoctorAppointment');
    // Route::get('load-apponitment-schedule', 'DoctorAppointment@loadApponitmentSchedule');
    Route::post('save-update-view-booking', 'DoctorAppointment@saveUpdateViewBooking');

    Route::resource('blood-group', 'BloodGroupController');
    //franchise
    Route::resource('agent-franchise','AgentFranchiseController');
    Route::get('franchise-list','AgentFranchiseController@franchiseList');
    //division
    Route::resource('division','DivisionController');

    //district
    Route::resource('district','DistrictController');

    //thana
    Route::resource('thana','ThanaController');
    //franchise approval
    Route::resource('franchise-approval','FranchiseApprovalController');
    Route::resource('recharge-money','FranchiseDepositController');
    //diagnostic test department
    Route::resource('pathology-test','PathologyTestController');
    Route::resource('test-department','TestDepartmentController');
    //diagnostic test sample collection
    Route::post('change-delivery-status', 'DiagnosticController@changeDeliveryStatus');
    Route::resource('diagnostic', 'DiagnosticController');
    Route::get('search-auto-doctor-list', 'DiagnosticController@searchDoctorList');
    Route::get('search-tests', 'DiagnosticController@searchTests');
    Route::get('diagnostic-search', 'DiagnosticController@searchPatientDiagnostic');
    Route::get('diagnostic-invoice-print/{patientId}','DiagnosticController@diagnosticInvoice');
    Route::resource('diagnostic-patient-due-pay','DiagnosticPatientDuePayController');
    Route::post('test-list-by-invoice','DiagnosticPatientDuePayController@testListByInvoice');
    Route::resource('diagnostic-test-report-status','DiagnosticTestStatusCheckController');
    Route::post('test-status-check-invoice','DiagnosticTestStatusCheckController@testStatusCheckByInvoice');
    Route::get('search-ot-patient','DiagnosticTestStatusCheckController@searchPatientList');
    // Web Modules Route==================================

    Route::post('/insert-agent','AgentController@add');
    Route::get('/agent', 'AgentController@AllAgent')->name('agent');
    Route::get('/view_agent/{id}', 'AgentController@ViewAgent');
    Route::get('/delete_agent/{id}', 'AgentController@DeleteAgent');
    Route::get('/edit_agent/{id}', 'AgentController@EditAgent');
    /*Route::post('/update_agent/{id}','AgentController@UpdateAgent');*/

    //service
    Route::get('add-service','ServiceController@index')->name('service');
    Route::get('/all-service','ServiceController@allService')->name('all_service');
    Route::post('/insert-service','ServiceController@store');
    Route::get('/view_service/{id}','ServiceController@ViewService');
    Route::get('/delete_service/{id}','ServiceController@DeleteService');
    Route::get('/edit_service/{id}','ServiceController@EditService');
    Route::post('/update_service/{id}','ServiceController@UpdateService');

    //package
    Route::get('add-package','PackageController@index')->name('package');
    Route::get('/all-package','PackageController@allPackage')->name('all_package');
    Route::get('/booking_package','PackageController@allPackageBookingList')->name('booking_package');
    Route::post('/insert-package','PackageController@store');
    Route::post('/booking-package','PackageController@BookingPackage');
    Route::get('/view_package/{id}', 'PackageController@ViewPackage');
    Route::get('/delete_package/{id}', 'PackageController@DeletePackage');
    Route::get('/edit_package/{id}', 'PackageController@EditPackage');
    Route::post('/update_package/{id}','PackageController@UpdatePackage');

    //event
    Route::get('add-event','EventController@index')->name('event');
    Route::get('/all_event','EventController@allEvent')->name('all_event');
    Route::post('/insert-event','EventController@store');
    Route::get('/view_event/{id}','EventController@ViewEvent');
    Route::get('/delete_event/{id}','EventController@DeleteEvent');
    Route::get('/edit_event/{id}','EventController@EditEvent');
    Route::post('/update_event/{id}','EventController@UpdateEvent');

    //doctor
    Route::get('add-doctor','DoctorController@index')->name('doctor');
    Route::get('/all_doctor','DoctorController@allDoctor')->name('all_doctor');
    Route::get('/all_appointment','DoctorController@allAppointment')->name('all_appointment');
    Route::post('/insert-doctor','DoctorController@store');
    Route::get('/view_doctor/{id}','DoctorController@ViewDoctor');
    Route::get('/delete_doctor/{id}','DoctorController@DeleteDoctor');
    Route::get('/edit_doctor/{id}','DoctorController@EditDoctor');
    Route::post('/update_doctor/{id}','DoctorController@UpdateDoctor');
    //blog
    Route::get('add-blog','BlogController@index')->name('blog');
    Route::get('/all_blog','BlogController@allBlog')->name('all_blog');
    Route::post('/insert-blog','BlogController@store');
    Route::get('/view_blog/{id}','BlogController@ViewBlog');
    Route::get('/delete_blog/{id}','BlogController@DeleteBlog');
    Route::get('/edit_blog/{id}','BlogController@EditBlog');
    Route::post('/update_blog/{id}','BlogController@UpdateBlog');
    //story
    Route::get('add-story','StoryController@index')->name('story');
    Route::get('/all_story','StoryController@allStory')->name('all_story');
    Route::post('/insert-story','StoryController@store');
    Route::get('/view_story/{id}','StoryController@ViewStory');
    Route::get('/delete_story/{id}','StoryController@DeleteStory');
    Route::get('/edit_story/{id}','StoryController@EditStory');
    Route::post('/update_story/{id}','StoryController@UpdateStory');

    //newly added route list------------------------------
    //healthtips
    Route::resource('health','HealthTipsController');
    //order list for admin
    Route::get('order-list','OrderController@adminOrderList');   
    Route::resource('doctor-appoinment','BookDoctorAppointmentController');

    //------------------Delivery Man Modules-------------------------------
    Route::resource('franchise-area-assign','FranchiseAssignToDeliveryManController');
    // ---------------------Proloy update route-------------------------//
    //configration settings
    Route::resource('configration','ConfigurationSetting');
    //agent management 
    Route::resource('agent-management','AgentManagementController');
    //sample collection 
    Route::resource('sample-collection','SampleCollectionController');
    Route::get('sample-collection-list','SampleCollectionController@collection_list');
    //sample collection update
    Route::resource('sample-status-update',"SampleCollectionUpdateController");
    //order approved route-----------------------------------------
    Route::resource('order-approve','OrderApproveController');

    Route::resource('area','AreaController');
    //organization
    Route::resource('organization','OrganizationController');
    //health package 
    Route::resource('health-package-test','HealthPackageTestController');

    //26012020
    Route::resource('health-package','HealthPackageController');
    Route::get('health-package-list','HealthPackageController@show_package_list');
    Route::get('edit-package-list/{id}','HealthPackageController@edit');
    Route::resource('health-package-sell','AgentPackageSellController');
    Route::get('health-package-sell-list','AgentPackageSellController@sellList');
    //package hospital price
    Route::get('load-hospital-bill/{hospitalId}','HealthPackageController@getHospitalPrice');
    Route::get('load-yearly-bill/{yearlyId}','HealthPackageController@getYearlyPrice');
    Route::get('load-package-yearly-bill/{yearlyBillId}','AgentPackageSellController@getYearlyPrice');
    Route::get('load-package-data/{packageId}','AgentPackageSellController@getPackInfo');
    //logistic
    Route::resource('logistic','LogisticController');
    Route::post('logistic-change-password','LogisticController@change_password');
    //sample collection collection
    Route::resource('courier-collection','CourierSampleCollectionController');
    Route::get('courier-sample','CourierSampleCollectionController@courier_collection');
    Route::resource('empty-box-collection','CentralLabController');
    Route::resource('news','NewsController');
    Route::get('all-news','NewsController@all_news');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return('Successfully Clear Cache facade value.');
});
//Clear Config cache:
Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return('Successfully Clear view cache.');
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return('Successfully Clear Config cache.');
});