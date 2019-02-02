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

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});
Auth::routes();
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::group(['middleware'=>['auth']], function(){
	Route::match(['get', 'post'],'/webauth/choserole', 'EntrustController@choseRole')->name('webauth.choserole');
	Route::match(['get', 'post'],'/webauth/addbasicinfo', 'EntrustController@addBasicInfo')->name('webauth.addbasicinfo');
	Route::post('/webauth/updateavatar',[
		'uses'=>'EntrustController@updateAvatar',
		'as'=>'webauth.updateavatar',
		]);
	Route::post('/webauth/updateprofile',[
		'uses'=>'EntrustController@updateProfile',
		'as'=>'webauth.updateprofile',
		]);
	Route::group(['middleware'=>['role:superadmin']], function(){
		Route::get('/webauth/manageusers',[
		'uses'=>'EntrustController@manageUsers',
		'as'=>'webauth.manageusers',
		]);
		Route::match(['get', 'post'],'/webauth/changeuserrole',[
		'uses'=>'EntrustController@changeUserRole',
		'as'=>'webauth.changeuserrole',
		]);
		Route::get('/webauth/suspenduser/{userid}',[
		'uses'=>'EntrustController@suspendUser',
		'as'=>'webauth.suspenduser',
		]);
	});

	Route::group(['middleware'=>['role:superadmin|admin']], function(){
		
	});
	Route::resource('courses', 'CoursesController');
	Route::resource('questions', 'QuestionsController');
	Route::resource('exams', 'ExamsController');
	Route::get('/exams/{course}/list','ExamsController@index')->name('exams.list');
	//routes accessable by lecturers only
	Route::group(['middleware'=>['role:lecturer']], function(){
		//Route::resource('courses', 'CoursesController',['only'=>['index','show','create','store']]);
		Route::match(['get', 'post'],'/courses/{course}/addlecturers', 'CoursesController@addLecturers')->name('courses.addlecturers');
		Route::match(['get', 'post'],'/questions/{course}/create', 'QuestionsController@createQuestions')->name('questions.createQuestions');
		Route::match(['get', 'post'],'/exams/{course}/create', 'ExamsController@createExam')->name('exams.createExam');
		Route::get('/questions/{course}/list','QuestionsController@index')->name('questions.list');
		Route::get('/exams/{exam}/result','ExamsController@result')->name('exams.result');
		Route::get('/exams/{exam}/printResult', 'ExamsController@printResult')->name('exams.printResult');
	});
	//routes accessable by students only
	Route::group(['middleware'=>['role:student']], function(){
		//Route::resource('courses', 'CoursesController',['only'=>['index','show']]);
		Route::match(['get', 'post'],'/students/findcourse', 'StudentsController@findCourse')->name('students.findcourse');
		Route::match(['get', 'post'],'/courses/{course}/studentregister', 'CoursesController@studentRegister')->name('courses.studentregister');
		Route::match(['get', 'post'],'/exams/{exam}/take', 'ExamsController@take')->name('exams.take');
		
	});

	


	
	
	

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/profile/{user}/{partial?}', 'EntrustController@profile')->name('profile');
});
