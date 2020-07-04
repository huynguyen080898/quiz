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
    Route::get('/', 'AdminController@index')->name('admin.index')->middleware('admin');
    Route::get('/login', 'Auth\LoginController@getLoginAdmin')->name('admin.login.get');
    Route::post('/login', 'Auth\LoginController@postLoginAdmin')->name('admin.login.post');
});

Route::group(['prefix' => 'quiz', 'middleware' => 'auth'], function () {
    Route::get('index', 'QuizController@index')->name('quiz.index');
    Route::get('create', 'QuizController@create')->name('quiz.create');
    Route::post('store', 'QuizController@store')->name('quiz.store');
    Route::get('edit/{id}', 'QuizController@edit')->name('quiz.edit');
    Route::post('update/{id}', 'QuizController@update')->name('quiz.update');
    Route::get('destroy/{id}', 'QuizController@destroy')->name('quiz.delete');
    Route::get('{id}/count/question', 'QuizController@countQuestionByQuizID')->name('quiz.count.question');
});

Route::group(['prefix' => 'exam', 'middleware' => 'auth'], function () {
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
        Route::post('update', 'ExamDetailController@update')->name('exam.detail.update');
        Route::get('destroy/{id}', 'ExamDetailController@destroy')->name('exam.detail.delete');
    });

    Route::get('{exam_id}/statistical', 'ExamController@getStatistics')->name('exam.statistical')->middleware('admin');
});


Route::group(['prefix' => 'question', 'middleware' => 'auth'], function () {
    Route::get('index', 'QuestionController@index')->name('question.index');
    Route::get('create', 'QuestionController@create')->name('question.create');
    Route::get('edit/{id}', 'QuestionController@edit')->name('question.edit');
    Route::get('destroy/{id}', 'QuestionController@destroy')->name('question.delete');
    Route::get('answer/{id}', 'QuestionController@getAnswerByQuestionId')->name('question.answer');
    Route::get('count', 'QuestionController@count')->name('question.count');

    Route::post('update/{id}', 'QuestionController@update')->name('question.update');
    Route::post('store', 'QuestionController@store')->name('question.store');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/all', 'UserController@getUsers')->name('user.get.all')->middleware('admin');
    Route::post('/', 'UserController@putUser')->name('user.update')->middleware('user');
    Route::get('/', 'UserController@getUser')->name('user.profile')->middleware('user');
});

Route::group(['prefix' => 'answer', 'middleware' => 'auth'], function () {
    Route::get('index/{id}', 'AnswerController@index')->name('answer.index');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('quiz-start/{id}', 'HomeController@getExamDetail')->name('quiz.start');

    Route::put('user-answer-radio', 'UserAnswerController@putUserAnswerRadio')->name('user.answer.radio');

    Route::put('user-answer-checkbox', 'UserAnswerController@putUserAnswerCheckBox')->name('user.answer.checkbox');

    Route::put('user-answer-filltext', 'UserAnswerController@putUserAnswerFillText')->name('user.answer.filltext');

    Route::get('result/{id}', 'ResultController@getResult')->name('result');

    Route::get('history', 'ResultController@getResults')->name('history');
});

Route::get('result-detail/{id}', 'ResultController@getResultDetail')->name('result.detail')->middleware('auth');

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('quiz/{id}/exam', 'ExamController@getExampleByQuizId')->name('quiz.exam');

Route::get('login', 'Auth\LoginController@index')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login.post');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@index')->name('register.get');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

Route::get('/redirect/{social}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{social}', 'Auth\SocialAuthController@callback');
