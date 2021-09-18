<?php

// *****************************Frontend **************************

use App\Http\Controllers\Api\Common\FeedbackController;
use App\Models\Doctor;
use App\Models\User;
use App\Models\UserOrder;



// SSLCOMMERZ Start
Route::namespace('Payment')->group(function () {

    // Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
    // Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');
    // Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');
    // Route::post('/pay', 'SslCommerzPaymentController@index');
    // Route::post('/ipn', 'SslCommerzPaymentController@ipn');

    Route::get('/recharge/{uid}/{amount}', 'SslCommerzPaymentController@recharge');
    Route::get('/service/recharge/{uid}/{amount}', 'SslCommerzPaymentController@serviceRecharge');

    Route::post('/success', 'SslCommerzPaymentController@success');
    Route::post('/fail', 'SslCommerzPaymentController@fail');
    Route::post('/cancel', 'SslCommerzPaymentController@cancel');
});
//SSLCOMMERZ END

// SSLCOMMERZ Start Service Provider
Route::namespace('Payment')->group(function () {

    // Route::get('/service/example1', 'ServiceProviderSslCommerzPaymentController@exampleEasyCheckout');
    // Route::get('/service/example2', 'ServiceProviderSslCommerzPaymentController@exampleHostedCheckout');

    // Route::post('/service/pay', 'ServiceProviderSslCommerzPaymentController@index');
    // Route::post('/service/pay-via-ajax', 'ServiceProviderSslCommerzPaymentController@payViaAjax');

    // Route::post('/service/success', 'ServiceProviderSslCommerzPaymentController@success');
    // Route::post('/service/fail', 'ServiceProviderSslCommerzPaymentController@fail');
    // Route::post('/service/cancel', 'ServiceProviderSslCommerzPaymentController@cancel');

    // Route::post('/service/ipn', 'ServiceProviderSslCommerzPaymentController@ipn');
});
//SSLCOMMERZ END Service Provider

//ajax for home page

Route::get('rt-admin/ajax/transaction-query/{id}', 'User\DashboardController@ajaxTQ');

//ajax for home page end

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
    //Give feed back and contact User side
    Route::get('contact', 'IndexController@contact')->name('contact');
    // Route::post('feedback', 'IndexController@submitFeedback')->name('submit.feedback');
    Route::get('feedback', 'IndexController@feedback')->name('feedback');
    Route::get('privacy-policy', 'IndexController@privacyPolicy')->name('privacy.policy');
    Route::get('terms-and-conditions', 'IndexController@termsAndConditions')->name('terms.and.conditions');
    // Blog
    Route::get('blogs', 'BlogController@blogs')->name('blogs');
    // Route::get('blog/{id}-{slug}', 'BlogController@blogSingle')->name('blog.single');
    Route::get('about', 'IndexController@about')->name('about');
    Route::get('galleries', 'IndexController@galleries')->name('galleries');
});
// Icons
// ********************************USER********************************


    Route::resource('rt-admin/roles', 'Roles\RolesController');



Auth::routes();
// Auth::routes(['verify' => true]);

// Ckeditor Image Upload
Route::post('ckeditor/image-upload', 'Common\CKEditorController@imageUpload')->name('ckeditor.image.upload');

Route::prefix('user')->group(function () {
    Route::name('user.')->group(function () {
        Route::namespace('User')->group(function () {
            Route::group(['middleware' => ['auth', 'preventBackHistory']], function () {
                //dashboard
                Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
                //User Profile
                Route::get('change-password', 'ProfileController@changePasswordView')->name('change.password');
                Route::post('change-password', 'ProfileController@changePassword')->name('change.password');
                Route::get('profile', 'ProfileController@profileView')->name('profile.view');
                Route::post('profile', 'ProfileController@profileChange')->name('profile.change');
            });
        });
    });
});

// **************************************************ADMIN************************************************
//admin Login, logout, forget password routes
Route::prefix('rt-admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('login', 'Auth\Admin\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\Admin\LoginController@login');
        Route::post('logout', 'Auth\Admin\LoginController@logout')->name('logout');
        //show the link request form to reset password
        Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        //Send the link - it will use the notification from admin model
        Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        //receive the request from the send email
        Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('password.reset');
        //update password
        Route::post('password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('password.update');
    });
});

Route::prefix('rt-admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::group(['middleware' => ['auth:admin', 'preventBackHistory']], function () {
                // Dashboard
                Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
                //change password
                Route::get('change-password', 'AdminController@changePasswordView')->name('change.password');
                Route::post('change-password', 'AdminController@changePassword')->name('change.password');
                // contact and feedback
                Route::get('contacts', 'AdminController@contacts')->name('contacts');
                // Route::get('feedbacks', 'AdminController@feedbacks')->name('feedbacks');
                Route::get('contact-feedback-delete/{contactFeedback}', 'AdminController@contactFeedbackDelete')->name('contact-feedback.delete');
                // Icon
                Route::get('/rt/icons1', function () {
                    return view('/rt/admin.icons1');
                });
                Route::get('icons2', function () {
                    return view('admin.icons2');
                });
                //doctor specialization
                Route::resource('specialization', 'SpecializationController');

                // Dynamic Content
                Route::resource('pet', 'PetController');
                Route::resource('ambulance', 'AmbulanceController');
                Route::resource('diagnostic', 'DiagnosticController');
                Route::resource('lab-test', 'LabTestController');

                // User
                Route::resource('user', 'UserController');
                Route::get('user-trash', 'UserController@trash')->name('user.trash');
                Route::get('user-search', 'UserController@search')->name('user.search');
                Route::delete('user-delete/{id}', 'UserController@forceDelete')->name('user.forceDelete');
                // User Child
                Route::get('user-child/{id}', 'UserChildController@child')->name('user.child');
                Route::get('user-child-create/{id}', 'UserChildController@create')->name('user.child.create');
                Route::get('user-child-edit/{id}', 'UserChildController@edit')->name('user.child.edit');
                Route::post('user-child-update/{id}', 'UserChildController@update')->name('user.child.update');
                // Doctor
                Route::resource('doctor', 'DoctorController');
                Route::get('doctor-trash', 'DoctorController@trash')->name('doctor.trash');
                Route::delete('doctor-delete/{id}', 'DoctorController@forceDelete')->name('doctor.forceDelete');
                // Admin Create
                Route::resource('admins', 'AdminController');
                // Pharmacy
                Route::resource('pharmacy', 'PharmacyController');
                Route::get('pharmacy-trash', 'PharmacyController@trash')->name('pharmacy.trash');
                Route::delete('pharmacy-delete/{id}', 'PharmacyController@forceDelete')->name('pharmacy.forceDelete');
                // PharmacySalesman
                Route::resource('pharmacy-salesman', 'PharmacySalesmanController');
                // Insurance
                Route::resource('insurance', 'InsuranceController');
                // InsurancePackage
                Route::resource('insurance-package', 'InsurancePackageController');
                // ServiceProvider
                Route::resource('service-provider', 'ServiceProviderController');
                Route::get('service-provider-trash', 'ServiceProviderController@trash')->name('service-provider.trash');
                Route::delete('service-provider-delete/{id}', 'ServiceProviderController@forceDelete')->name('service-provider.forceDelete');

                //insurance enroll
                Route::get('insurance/enroll/requests', 'InsuranceEnrollController@viewRequests')->name('enroll.requests');
                Route::get('insurance/enroll/processing', 'InsuranceEnrollController@viewProcessing')->name('enroll.processing');
                Route::get('insurance/enroll/approved', 'InsuranceEnrollController@viewApproved')->name('enroll.approved');
                Route::get('insurance/enroll/reject', 'InsuranceEnrollController@viewDeclined')->name('enroll.reject');
                //insurance enroll - -ajaxUrl
                Route::get('insurance/enroll/ajax/acceptEnroll/{id}', 'InsuranceEnrollController@acceptEnroll');
                Route::get('insurance/enroll/ajax/rejectEnroll/{id}', 'InsuranceEnrollController@rejectEnroll');
                Route::get('insurance/enroll/ajax/acceptEnrollProvider/{id}', 'InsuranceEnrollController@acceptEnrollProvider');
                Route::get('insurance/enroll/ajax/rejectEnrollProvider/{id}', 'InsuranceEnrollController@rejectEnrollProvider');
                Route::get('insurance/enroll/ajax/rejectEnrollUser/{id}', 'InsuranceEnrollController@rejectEnrollUser');
                Route::get('insurance-enroll-details/{id}', 'InsuranceEnrollController@get_enroll_details')->name('insurance.enroll.details');

                Route::resource('claim-insurance-request', 'ClaimInsuranceController');

                // AppointmentSlot
                Route::resource('appointment-slot', 'AppointmentSlotController');
                Route::get('appointment-slot-by-doctor', 'AppointmentSlotController@appointmentSlotByDoctor')->name('appointment.slot.by.doctor');
                Route::get('appointment-slot-by-doctor-get-date', 'AppointmentSlotController@appointmentSlotByDoctorGetDate')->name('appointment.slot.by.doctor.get.date');
                Route::get('getDSlot/{id}', 'AppointmentSlotController@getSlot')->name('get-slot');
                // AppointmentSchedule
                Route::resource('appointment-schedule', 'AppointmentScheduleController');
                Route::get('appointment-schedule-upcoming', 'AppointmentScheduleController@upcoming')->name('appointment-schedule.upcoming');
                Route::get('appointment-schedule-previous', 'AppointmentScheduleController@previous')->name('appointment-schedule.previous');
                Route::get('appointment-schedule-reschedule', 'AppointmentScheduleController@reschedule')->name('appointment-schedule.reschedule');
                Route::get('appointment-schedule-reschedule-cancel', 'AppointmentScheduleController@rescheduleForCancel')->name('appointment-schedule.reschedule.cancel');


                Route::get('appointment-update-reschedule/{appointment_schedule}', 'AppointmentScheduleController@updateReschedule')->name('appointment-schedule.update.reschedule');
                Route::get('appointment-cancel-reschedule/{appointment_schedule}', 'AppointmentScheduleController@cancelReschedule')->name('appointment-schedule.cancel.reschedule');
                Route::get('appointment-approve-reschedule/{appointment_schedule}', 'AppointmentScheduleController@approveReschedule')->name('appointment-schedule.approve.reschedule');
                // UserWallet
                Route::resource('user-wallet', 'UserWalletController');
                // ServiceProviderWallet
                Route::resource('service-wallet', 'ServiceProviderWalletController');

                Route::get('recharge-request/bkash/', 'UserWalletController@bkashRequest')->name('bkash');
                Route::post('recharge-request/bkash/recharge', 'UserWalletController@bkashRecharge');
                //service Provider bkash request
                Route::get('service-provider-recharge-request/bkash/', 'ServiceProviderWalletController@bkashRequest')->name('service-provider.bkash');

                Route::post('service-provider-recharge-request/bkash/recharge', 'ServiceProviderWalletController@bkashRecharge');
                // DoctorWallet
                Route::resource('doctor-wallet', 'DoctorWalletController');

                Route::get('wallet-history/users', 'UserWalletController@userWalletLog')->name('user.wallet.log');
                Route::get('wallet-history/doctors', 'DoctorWalletController@doctorWalletLog')->name('doctor.wallet.log');
                Route::get('wallet-history/service-providers', 'ServiceProviderWalletController@serviceProviderWalletLog')->name('service-provider.wallet.log');
                Route::get('recharge-history/service-providers', 'ServiceProviderWalletController@serviceProviderRechargeLog')->name('service-provider.recharge.log');
                Route::get('comission-history/service-providers', 'ServiceProviderWalletController@serviceProviderComissionLog')->name('service-provider.comission.log');
                Route::get('cashout-requests', 'DoctorWalletController@cashout')->name('cashout.req');
                Route::get('cashout-requests/ajax/done/{id}', 'DoctorWalletController@cashoutDone')->name('cashout.done');

                //Reports Files
                /** --------------------------------------------------------------------------- */
                /** --------------------------------------------------------------------------- */

                // User Activity - Login
                Route::get('report/user-activity', 'ReportController@userActivity')->name('user.activity');


                //recharge history

                Route::get('report/recharge-history', 'ReportController@rechargeHistory')->name('report.recharge');

                //referral history
                Route::get('report/referral-history/{type}', 'ReportController@referralHistory')->name('report.referral');

                Route::get('report/sales', 'ReportController@salesReport')->name('report.sales');

                Route::get('report/medimate-commission', 'ReportController@commission')->name('report.wallet.log');

                Route::get('report/frequent-doctors', 'ReportController@frequentDoctor')->name('most-freq-doc');

                // Route::get('top-search-products', function () {
                //     return view(top-search-products');
                // })->name('top-search-products');


                Route::get('report/latest-orders', 'ReportController@latestOrders')->name('latest-orders');




                // Route::get('report/non-performing-products', function () {
                //     return view('admin.non-performing-products');
                // })->name('non-performing-products');


                Route::resource('app-notify', 'AppNotificationController');
                Route::get('notify-create', 'NotificationController@create')->name('notify');
                Route::post('notify-create', 'NotificationController@send')->name('notify');
                Route::get('view-notifications', 'NotificationController@index')->name('view-notifications');
                Route::delete('view-notifications/{notificationForAll}', 'NotificationController@destroy')->name('notification.destroy');



                Route::get('feedbacks', 'FeedbackController@index')->name('feedbacks');
                Route::get('Common-Docs', 'FeedbackController@common')->name('faq');
                Route::post('Common-Docs', 'FeedbackController@commonSave')->name('faq');

                //products otc
                Route::resource('product', 'ProductController');
                Route::get('products/bulkAdd', 'ProductController@bulkCreate')->name('product.bulk.create');
                Route::post('products/bulkAdd', 'ProductController@bulkStore')->name('product.bulk.store');

                //user order


                Route::get('order/pending', 'UserOrderController@pending')->name('pending');
                Route::get('order/delivered', 'UserOrderController@delivered')->name('delivered');
                Route::get('order/rejected', 'UserOrderController@rejected')->name('rejected');
                Route::get('order/approved', 'UserOrderController@approved')->name('approved');

                //doctor visiting charge setup for
                Route::get('/visit-charge', 'DoctorVisitChargeController@index')->name('visit-charge.index');
                Route::post('/visit-charge', 'DoctorVisitChargeController@store')->name('visit-charge.store');
                Route::get('/visit-charge/{id}', 'DoctorVisitChargeController@show')->name('visit-charge.show');

                //comission Param
                Route::get('comissions', 'ComissionController@comissions')->name('comissions');
                Route::post('update/{id}', 'ComissionController@update')->name('comission.update');

                Route::post('comissions', 'ComissionController@store')->name('commission.store');
                Route::get('/commission-charge/{id}', 'ComissionController@ajax')->name('commission-charge.show');

                //Logs
                Route::get('logs', 'LogController@logs')->name('logs');

                //Referral Point
                Route::get('referral-point', 'ReferralPointController@view')->name('referral.point');
                Route::put('referral-point/{referralPoint}', 'ReferralPointController@update')->name('referral.point.update');
            });
        });
    });
});


Route::post('rt-admin/list', 'Admin\NotificationController@list');

Route::get('/user', function () {
    return User::all();
});
Route::get('/doctor', function () {
    return Doctor::all();
});


Route::get('/rt-admin/insurance/add/package', function () {
    return view('admin.add-insurance-package');
})->name('admin.insurance.pkg.create');

Route::get('/rt-admin/insurance/view/package', function () {
    return view('admin.manage-ins-package');
})->name('admin.insurance.pkg.view');


Route::get('/rt-admin/wallet/recharge', function () {
    return view('admin.recharge');
})->name('admin.recharge');


Route::get('/rt-admin/wallet/cashout', function () {
    return view('admin.cashoutdone');
})->name('admin.cashout');


Route::get('/rt-admin/wallet/users', function () {
    return view('admin.user-wallet');
})->name('admin.wallet.users');

Route::get('/rt-admin/wallet/doctors', function () {
    return view('admin.doctor-wallet');
})->name('admin.wallet.doctors');

Route::get('/rt-admin/wallet/history', function () {
    return view('admin.all-transaction');
})->name('admin.wallet.history');


Route::get('/rt-admin/doctor/slot/add', function () {
    return view('admin.add-slot');
})->name('admin.slot');

Route::get('/rt-admin/doctor/slot/view', function () {
    return view('admin.manage-slot');
})->name('admin.slot.view');

Route::get('/rt-admin/user/appointment/add', function () {
    return view('admin.add-appointment');
})->name('admin.appointment');

Route::get('/rt-admin/user/appointment/view', function () {
    return view('admin.manage-appointment');
})->name('admin.appointment.view');


Route::get('/rt-admin/user/appointment/previous/view', function () {
    return view('admin.manage-oldappointment');
})->name('admin.appointment.prev');


Route::get('/rt-admin/reschedule/request', function () {
    return view('admin.reschedule-request');
})->name('admin.reschedule.view');


Route::get('/rt-admin/reschedule/view', function () {
    return view('admin.manage-reschedule');
})->name('admin.reschedule.done');


Route::get('claim-insurance/{insurance_id}', 'Admin\ClaimInsuranceController@create');
Route::post('claim-insurance-submit', 'Admin\ClaimInsuranceController@store')->name('claim-insurance.submit');
Route::get('health-statement-form/{enroll_id}', 'Admin\HealthStatementController@open_health_form');
Route::get('health-statement-details/{id}', 'Admin\HealthStatementController@show_health_form');
Route::post('health-statement-form', 'Admin\HealthStatementController@save_health_form')->name('health-statement.submit');


