<?php

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


Route::get('admin', 'AdminController@index')->name('admin.index');

Route::group(['prefix' => 'quiz'], function ()
{
    Route::get('index', 'QuizController@index')->name('quiz.index');
    Route::get('create', 'QuizController@create')->name('quiz.create');
    Route::post('store', 'QuizController@store')->name('quiz.store');
    Route::get('edit/{id}', 'QuizController@edit')->name('quiz.edit');
    Route::post('update/{id}', 'QuizController@update')->name('quiz.update');
    Route::get('destroy/{id}', 'QuizController@destroy')->name('quiz.delete');
});

Route::group(['prefix' => 'exam'], function ()
{
    Route::get('index', 'ExamController@index')->name('exam.index');
    Route::get('create', 'ExamController@create')->name('exam.create');
    Route::post('store', 'ExamController@store')->name('exam.store');
    Route::get('edit/{id}', 'ExamController@edit')->name('exam.edit');
    Route::post('update/{id}', 'ExamController@update')->name('exam.update');
    Route::get('destroy/{id}', 'ExamController@destroy')->name('exam.delete');

    Route::group(['prefix' => 'detail'], function () {
        Route::get('{exam_id}', 'ExamDetailController@show')->name('exam.detail');
        // Route::get('create/{id}', 'Admin\ExamDetailController@create')->name('examDetail.create');
        // Route::post('store/{id}', 'Admin\ExamDetailController@store')->name('examDetail.store');
        // Route::get('edit/{id}', 'Admin\ExamDetailController@edit')->name('examDetail.edit');
        // Route::post('edit/{id}', 'Admin\ExamDetailController@update')->name('examDetail.update');
        Route::get('destroy/{id}', 'ExamDetailController@destroy')->name('exam.detail.delete');
    });
});


Route::group(['prefix' => 'question'], function ()
{
    Route::get('index', 'QuestionController@index')->name('question.index');
    Route::get('create', 'QuestionController@create')->name('question.create');
    Route::post('store', 'QuestionController@store')->name('question.store');
    Route::get('edit/{id}', 'QuestionController@edit')->name('question.edit');
    Route::post('update/{id}', 'QuestionController@update')->name('question.update');
    Route::get('destroy/{id}', 'QuestionController@destroy')->name('question.delete');

    Route::get('count','QuestionController@count')->name('question.count');
});

    // Route::group(['prefix' => 'answer'], function () {
    //     Route::get('index/{id}', 'Admin\AnswerController@index')->name('answer.index');
    //     Route::get('create/{id}', 'Admin\AnswerController@create')->name('answer.create');
    //     Route::post('store/{id}', 'Admin\AnswerController@store')->name('answer.store');
    //     Route::get('edit/{id}', 'Admin\AnswerController@edit')->name('answer.edit');
    //     Route::post('edit/{id}', 'Admin\AnswerController@update')->name('answer.update');
    //     Route::get('destroy/{id}', 'Admin\AnswerController@destroy')->name('answer.destroy');
    // });

Route::group(['middleware' => 'auth.user'], function()
{
    Route::get('quiz/{id}/exam','ExamController@getExampleByQuizId')->name('quiz.exam');

    Route::get('quiz-start/{id}','HomeController@getExamDetail')->name('quiz.start');

    Route::put('user-answer','UserAnswerController@putUserAnswer')->name('user.answer');

    Route::get('result','ResultController@index')->name('result.index');
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('login','HomeController@getLogin')->name('login');
Route::get('logout','HomeController@getLogout')->name('logout');
Route::get('register','HomeController@getRegister')->name('register');

// Route::post('register','Auth\RegisterController@g')->name('register');
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/redirect/{social}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{social}', 'Auth\SocialAuthController@callback');