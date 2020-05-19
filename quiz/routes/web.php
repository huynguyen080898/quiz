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

Route::group(['prefix' => 'admin'], function () {
    // Route::get('/', 'Admin\AdminController@index')->name('admin.index');

    Route::group(['prefix' => 'quiz'], function ()
    {
        Route::get('index', 'Admin\QuizController@index')->name('quiz.index');
        Route::get('create', 'Admin\QuizController@create')->name('quiz.create');
        Route::post('store', 'Admin\QuizController@store')->name('quiz.store');
        Route::get('edit/{id}', 'Admin\QuizController@edit')->name('quiz.edit');
        Route::post('update/{id}', 'Admin\QuizController@update')->name('quiz.update');
        Route::get('destroy/{id}', 'Admin\QuizController@destroy')->name('quiz.delete');
    });

    Route::group(['prefix' => 'exam'], function ()
    {
        Route::get('index', 'Admin\ExamController@index')->name('exam.index');
        Route::get('create', 'Admin\ExamController@create')->name('exam.create');
        Route::post('store', 'Admin\ExamController@store')->name('exam.store');
        Route::get('edit/{id}', 'Admin\ExamController@edit')->name('exam.edit');
        Route::post('update/{id}', 'Admin\ExamController@update')->name('exam.update');
        Route::get('destroy/{id}', 'Admin\ExamController@destroy')->name('exam.delete');
    });

    Route::group(['prefix' => 'question'], function ()
    {
        Route::get('index', 'Admin\QuestionController@index')->name('question.index');
        Route::get('create', 'Admin\QuestionController@create')->name('question.create');
        Route::post('store', 'Admin\QuestionController@store')->name('question.store');
        Route::get('edit/{id}', 'Admin\QuestionController@edit')->name('question.edit');
        Route::post('update/{id}', 'Admin\QuestionController@update')->name('question.update');
        Route::get('destroy/{id}', 'Admin\QuestionController@destroy')->name('question.delete');

        Route::get('count','Admin\QuestionController@count')->name('question.count');
    });

    // Route::group(['prefix' => 'answer'], function () {
    //     Route::get('index/{id}', 'Admin\AnswerController@index')->name('answer.index');
    //     Route::get('create/{id}', 'Admin\AnswerController@create')->name('answer.create');
    //     Route::post('store/{id}', 'Admin\AnswerController@store')->name('answer.store');
    //     Route::get('edit/{id}', 'Admin\AnswerController@edit')->name('answer.edit');
    //     Route::post('edit/{id}', 'Admin\AnswerController@update')->name('answer.update');
    //     Route::get('destroy/{id}', 'Admin\AnswerController@destroy')->name('answer.destroy');
    // });

    // Route::group(['prefix' => 'exam-detail'], function () {
    //     Route::get('index/{id}', 'Admin\ExamDetailController@index')->name('examDetail.index');
    //     Route::get('create/{id}', 'Admin\ExamDetailController@create')->name('examDetail.create');
    //     Route::post('store/{id}', 'Admin\ExamDetailController@store')->name('examDetail.store');
    //     Route::get('edit/{id}', 'Admin\ExamDetailController@edit')->name('examDetail.edit');
    //     Route::post('edit/{id}', 'Admin\ExamDetailController@update')->name('examDetail.update');
    //     Route::get('destroy/{id}', 'Admin\ExamDetailController@destroy')->name('examDetail.destroy');
    // });
    
});