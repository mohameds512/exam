<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Livewire\Exams;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    // if (session()->get('guest_experiment') == 1 ) {
    //     Route::get('/', function () {
    //         return view('index');
    //     })->middleware(['auth']);
    // }else {
    //     Route::get('/', function () {
    //         return view('index');
    //     });
    // }

    Route::get('/', function () {
        return view('index');
    });


    // Route::get('/dashboard', function () {
    //     return view('index');
    // })->middleware(['auth'])->name('dashboard');



    // auth_routs
    Route::group(['namespace'=>'examController' , 'middleware' => ['auth']] , function(){



        Route::resource( 'users' ,'UsersController');

        Route::resource( 'grades' ,'GradesController');

        Route::resource( 'classes' ,'ClassesController');

        Route::resource( 'sections' ,'SectionsController');

        // to_get_classes_from_grade_id

        Route::get('/get_classes/{grade_id}','SectionsController@get_classes');

        Route::resource( 'subjects' ,'SubjectsController');

        // to_get_sections_from_class_id

        Route::get('/get_sections/{class_id}','SubjectsController@get_sections');

        Route::resource('specialists' , 'SpecialistController' );


        Route::resource('teachers' , 'TeachersController' );

        Route::resource('questions' , 'QuestionsController' );

        // trashed_question
        Route::get('/get_trashed/{id}','QuestionsController@trashed_questions')->name('get_trashed');

        // CkeditorController_for_active_img_upload_from_disk
        // Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');

        // Route::get('edit/{id}', 'QuestionsController@edit' )->name('edit');
        Route::get('get_question/{id}' , 'QuestionsController@show_question')->name('get_question');

        // to_get_subjects_from_section_id
        Route::get('/get_subjects/{section_id}','QuestionsController@get_subjects');
        // to_get_unites_from_subject_id
        Route::get('/get_unites/{subject_id}','QuestionsController@get_unites');
        // delete_all_selected_question
        Route::post('delete_all', 'QuestionsController@delete_all_selected' )->name('delete_all_selected');
        // force_delete_trashed_questions
        Route::get('destroy_trashed' , 'QuestionsController@destroy_trashed')->name('destroy_trashed');
        // restore_trashed_questions
        Route::get('restore_question' , 'QuestionsController@restore_question')->name('restore_question');
        // restore_all_selected_question
        Route::post('restore_all', 'QuestionsController@restore_all_selected' )->name('restore_all_selected');

        Route::resource('unites' , 'UnitesController');

        Route::get('/unites/{id}', 'UnitesController@get_unite_byId')->name('get_unite_byId');


        ###################--exams--###############
        Route::resource('exams' , 'ExamsController');
        Route::get('results', 'ExamsController@results_table')->name('results');

        ###################--livewire_create_exam--###############

        // Route::view('create_exam', 'exams.create_exam');

        // to_export_exams_table commented in controller
        Route::get('export_test', [Exams::class, 'export']);
        // roles_and_permissions
        Route::view('per_roles', 'livewire.roles.main')->name('per_roles');

        // user_profile

        Route::view('profile', 'livewire.users.main')->name('profile');


    });


    // social login
    Route::get('redirectSocial/{service}', 'sociolController@redirectSocial');

    Route::get('callbackSocial/{service}', 'sociolController@callbackSocial');

    //log_out
    Route::get('logOut',[AuthenticatedSessionController::class , 'destroy'])->name('logOut');



    require __DIR__.'/auth.php';


    // theme_routs
    Route::get('/{page}','AdminController@get_page');

});

