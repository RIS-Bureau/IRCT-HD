<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'home')->name('app_accueil');
    Route::get('/a-propos', 'a_propos')->name('app_a-propos');
    Route::match(['get', 'post'], '/ajout-centre', 'ajout_centre')->name('app_ajout-centre');
    Route::match(['get', 'post'], '/ajout-patient', 'ajout_patient')->name('app_ajout-patient');
    Route::match(['get', 'post'], '/remplir-fiche-patient', 'remplir_fiche')->name('app_remplir-fiche-patient');
    Route::match(['get', 'post'], '/dashboard', 'dashboad')->middleware('auth')->name('app_dashboad');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/logout', 'logout')->name('app_logout');
    Route::post('/exist_email', 'existEmail')->name('app_exist_email');
    Route::match(['get', 'post'], '/activation_code/{token}', 'activationCode')->name('app_activation_code');
    Route::get('/user_checker', 'userChecker')->name('app_user_checker');
    Route::get('/resend_activation_code/{token}', 'resendActivationCode')->name('app_resend_activation_code');
    Route::get('/activation_account_link/{token}', 'activationAccountLink')->name('app_activation_account_link');
    Route::match(['get', 'post'], '/activation_account_change_email/{token}', 'ActivationAccountChangeEmail')->name('app_activation_account_change_email');
});




