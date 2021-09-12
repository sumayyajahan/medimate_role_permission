<?php


// User

Route::get('get-prescription/{id}', 'Api\Common\CommonController@get_e_prescription');

Route::namespace('Api\User')->group(function () {
    Route::post('user-login', 'AuthController@login');
    Route::post('user-register', 'AuthController@register');
    Route::post('user-reset-password', 'AuthController@resetPassword');
    // Referral
    Route::post('add-referral', 'ReferralController@addReferral');
    Route::get('get-referral/{id}', 'ReferralController@getReferral');
    Route::get('e-prescription/{id}', 'EPrescriptionController@single');
    Route::get('prescription-appointment/{id}', 'EPrescriptionController@singleApp');
    Route::get('order/prescription/{id}', 'EPrescriptionController@order');
    Route::get('user/doctor7slot/{id}', 'DoctorDetailsController@doctor7slot');
    Route::get('doctor30slot', 'DoctorDetailsController@doctor30slot');
    Route::get('user/allPrescription/{id}', 'EPrescriptionController@allerp');
    Route::get('user/search-doctor/{keyword}', 'DoctorDetailsController@search_doctor');

    //responsive images
    Route::get('view-file/{img}', function ($img) {
        return view('responsive.index', compact('img'));
    });

    // Pharmacy
    Route::post('user/nearby-pharmacy', 'PharmacyController@nearbyPharmacy');


    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user-profile', 'ProfileController@profile');
        Route::post('user-profile-update', 'ProfileController@update');
        Route::post('user-change-password', 'ProfileController@changePassword');

        Route::prefix('user')->group(function () {
            // appointment schedule api
            Route::apiResource('appointment-schedule', 'AppointmentScheduleController');
            // Doctor Details

            // ReportPrescription
            Route::apiResource('report-prescription', 'ReportPrescriptionController');
            // EPrescription
            Route::get('e-prescription', 'EPrescriptionController@all');

            //------------------------------------------------------------------
            // Route::get('e-prescription/{id}', 'EPrescriptionController@single');
            //------------------------------------------------------------------


            // appointment schedule api
            Route::apiResource('appointment-schedule', 'AppointmentScheduleController');
            Route::get('appointment/upcoming', 'AppointmentScheduleController@upcoming');
            Route::get('appointment/history', 'AppointmentScheduleController@history');
            Route::patch('appointment-schedule/update/{id}', 'AppointmentScheduleController@update');
            Route::get('appointment-schedule-cancel/{id}', 'AppointmentScheduleController@disable');
            // Doctor Details
            Route::get('doctor-list', 'DoctorDetailsController@doctorList');
            Route::get('doctor-list/{type}', 'DoctorDetailsController@doctorSpecialty');
            Route::get('doctor/{id}', 'DoctorDetailsController@doctor');
            Route::get('doctor-time-slot/{doctor_id}/{date}', 'DoctorDetailsController@available_time');
            // ReportPrescription
            Route::apiResource('report-prescription', 'ReportPrescriptionController');
            //wallet
            Route::get('wallet', 'WalletController@wallet');
            Route::post('wallet-recharge', 'WalletController@Recharge');
            Route::post('bkash-recharge', 'WalletController@bkash');

            //wallet log
            Route::get('wallet/log', 'WalletController@walletLog');

            // Referral
            // Route::post('add-referral', 'ReferralController@addReferral');
            // Route::get('get-referral/{id}', 'ReferralController@getReferral');
            // Notification
            Route::get('get-notification', 'NotificationController@getNotification');
            Route::get('delete-notification/{id}', 'NotificationController@deleteNotification');
            Route::get('view-otc', 'PharmacyController@viewOtc');
            // Route::post('send-prescription', 'PharmacyController@sendPrescription');
            //feedback
            Route::post('add-feedback', 'PharmacyController@addFeedback');
            // InsuranceEnroll
            Route::apiResource('insurance-enroll', 'InsuranceEnrollController');
            Route::get('insuranceList', 'InsuranceEnrollController@viewInsurance');
            Route::get('insuranceList/{id}', 'InsuranceEnrollController@viewInsurancePkg');
            Route::get('insurancePkgList/{id}', 'InsuranceEnrollController@viewInsurancePkg');
            Route::get('insurancePkgType/{type}', 'InsuranceEnrollController@viewInsurancePkgType');
            // UserOrder
            Route::apiResource('order', 'UserOrderController');

            //Child Account
            Route::apiResource('child', 'ChildController');
            Route::post('child-by-health-id', 'ChildController@childByHealthId');
            Route::post('child-by-phone', 'ChildController@childByPhone');
        });
    });
});

// Doctor
Route::namespace('Api\Doctor')->group(function () {
    Route::post('doctor-login', 'AuthController@login');
    Route::post('doctor-register', 'AuthController@register');
    Route::post('doctor-reset-password', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:doctor']], function () {
        Route::get('doctor-profile', 'ProfileController@profile');
        Route::post('doctor-profile-update', 'ProfileController@update');
        Route::post('doctor-change-password', 'ProfileController@changePassword');

        Route::prefix('doctor')->group(function () {
            // appointmentslot
            Route::apiResource('appointment-slot', 'AppointmentSlotController');
            Route::get('appointment-slot-disable/{id}', 'AppointmentSlotController@disable');
            Route::post('user-by-appointment-slot', 'AppointmentSlotController@userByAppointmentSlot');
            // EPrescription
            Route::apiResource('e-prescription', 'EPrescriptionController');
            // User Report Prescription
            Route::get('user-report-prescription/{userId}', 'ReportPrescriptionController@userReportPrescription');
            // EPrescription
            // bulk-reschedule
            Route::apiResource('bulk-reschedule', 'BulkRescheduleController');
            Route::post('bulk-cancel', 'BulkRescheduleController@disable');
            //wallet
            Route::get('wallet', 'WalletController@wallet');
            Route::post('wallet-recharge', 'WalletController@Recharge');
            Route::post('cashout', 'WalletController@cashout');
            Route::get('wallet/log', 'WalletController@walletLog');

            // appointment Schedule
            Route::get('appointment-schedule', 'AppointmentScheduleController@index');
            Route::get('appointment-schedule/{id}', 'AppointmentScheduleController@show');
            Route::patch('appointment-schedule/update/{id}', 'AppointmentScheduleController@update');
            Route::get('appointment-schedule-cancel/{id}', 'AppointmentScheduleController@disable');
            Route::get('appointment-ongoing/{id}', 'AppointmentScheduleController@changeActive');
            Route::get('appointment-done/{id}', 'AppointmentScheduleController@done');
            Route::post('appointment/queue', 'AppointmentScheduleController@queue');
            Route::get('appointment/history', 'AppointmentScheduleController@history');
            //notification
            Route::get('get-notification', 'NotificationController@getNotification');
            Route::get('delete-notification/{id}', 'NotificationController@deleteNotification');
        });
    });
});

// Pharmacy

Route::namespace('Api\Pharmacy')->group(function () {
    Route::post('pharmacy-login', 'AuthController@login');
    Route::post('pharmacy-register', 'AuthController@register');
    Route::post('pharmacy-reset-password', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:pharmacy']], function () {
        Route::get('pharmacy-profile', 'ProfileController@profile');
        Route::post('pharmacy-profile-update', 'ProfileController@update');
        Route::post('pharmacy-change-password', 'ProfileController@changePassword');

        Route::prefix('pharmacy')->group(function () {
            //Manage User Order
            Route::get('orders', 'UserOrderController@orders');
            Route::get('complete-orders', 'UserOrderController@viewCompleteOrders');
            Route::post('order-single', 'UserOrderController@singleOrder');
            Route::post('order-accept', 'UserOrderController@acceptOrder');
            Route::post('order-reject', 'UserOrderController@rejectOrder');
            Route::post('order-complete', 'UserOrderController@completeOrder');
            Route::post('order-price-update', 'UserOrderController@updateOrderPrice');
            //notification
            Route::get('get-notification', 'NotificationController@getNotification');
            Route::get('delete-notification/{id}', 'NotificationController@deleteNotification');
        });
    });
});
// Pharmacy Salesman
Route::namespace('Api\Salesman')->group(function () {
    Route::post('pharmacy-salesman-login', 'AuthController@login');
    Route::post('pharmacy-salesman-register', 'AuthController@register');
    Route::post('pharmacy-salesman-reset-password', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:pharmacySalesman']], function () {
        Route::get('pharmacy-salesman-profile', 'ProfileController@profile');
        Route::post('pharmacy-salesman-profile-update', 'ProfileController@update');

        Route::prefix('salesman')->group(function () {
        });
    });
});
// Service Provider
Route::namespace('Api\ServiceProvider')->group(function () {
    Route::post('service-login', 'AuthController@login');
    Route::post('service-register', 'AuthController@register');
    Route::post('service-reset-password', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:serviceProvider']], function () {

        Route::get('service-profile', 'ProfileController@profile');
        Route::post('service-profile-update', 'ProfileController@update');
        Route::post('service-change-password', 'ProfileController@changePassword');

        Route::prefix('service')->group(function () {

            // On Boarding
            Route::post('user-register', 'OnboardController@user_register');
            Route::post('doctor-register', 'OnboardController@doctor_register');
            Route::post('pharmacy-register', 'OnboardController@pharmacy_register');
            Route::post('service-provider-register', 'OnboardController@service_provider_register');


            //wallet
            Route::get('wallet', 'WalletController@wallet');
            Route::post('wallet-recharge', 'WalletController@recharge');
            Route::post('patient-wallet-recharge', 'WalletController@rechargePatient');
            Route::post('bkash-recharge', 'WalletController@bkash');

            //wallet log
            Route::get('wallet-log', 'WalletController@walletLog');

            // Notification
            Route::get('get-notification', 'NotificationController@getNotification');
            Route::get('delete-notification/{id}', 'NotificationController@deleteNotification');
        });
    });
});


//common
Route::namespace('Api\Common')->group(function () {


    Route::get('get-dashboard/{user_type}/{user_id}', 'CommonHomeAPIController@get_dashboard');
    Route::get('get-popup', 'CommonHomeAPIController@get_popup');

    // Login Activity
    Route::post('send-mail', 'MailController@sendMail');
    Route::post('login-activity', 'CommonController@loginActivity');
    Route::get('send-sms/{contact}/{msg}', 'CommonController@sendSMS');
    Route::get('send-sms-intl/{contact}/{msg}', 'CommonController@sendSMSIntl');
    Route::get('specialization', 'CommonController@specialization');
    Route::get('specialization-with-doctor', 'CommonController@specializationWithDoctor');
    // Route::post('doctor-login-activity', 'CommonController@loginActivity');
    // Route::post('pharmacy-login-activity', 'CommonController@loginActivity');
    // Route::post('salesman-login-activity', 'CommonController@loginActivity');
    // Feedback
    Route::post('feedback', 'FeedbackController@addFeedback');
    // Route::post('doctor-feedback', 'FeedbackController@addFeedback');
    // Route::post('pharmacy-feedback', 'FeedbackController@addFeedback');
    // Route::post('salesman-feedback', 'FeedbackController@addFeedback');
    // FAQ, Terms and conditions, Refund
    Route::get('commonDoc/{docType}', 'CommonController@commonDoc');
    Route::get('medimate-image', 'CommonController@medimateImage');
    // Route::get('terms', 'CommonController@terms');
    // Route::get('refund', 'CommonController@refund');

    // Dynamic Content
    Route::get('dynamic/lab-tests', 'DynamicContentController@get_lab_test');
    Route::get('dynamic/districts', 'DynamicContentController@get_districts');
    Route::get('dynamic/pets/{district_id}', 'DynamicContentController@get_pets');
    Route::get('dynamic/diagnostics/{district_id}', 'DynamicContentController@get_diagnostics');
    Route::get('dynamic/ambulances/{district_id}', 'DynamicContentController@get_ambulancs');

});
