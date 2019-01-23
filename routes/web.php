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
	Route::get('/getTeachers', 'EntrustController@getTeachers')->name('webauth.getTeachers');
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
		Route::match(['get', 'post'],'/teacherrequest/{teacherRequest}/assignteacher', 'TeacherRequestsController@assignTeacher')->name('teacherrequest.assignteacher');
	});
	Route::resource('courses', 'CoursesController');
	//routes accessable by lecturers only
	Route::group(['middleware'=>['role:lecturer']], function(){
		//Route::resource('courses', 'CoursesController',['only'=>['index','show','create','store']]);
		Route::match(['get', 'post'],'/courses/{course}/addlecturers', 'CoursesController@addLecturers')->name('courses.addlecturers');
		Route::match(['get', 'post'],'/courses/{course}/createclasse', 'CoursesController@createClasse')->name('courses.createclasse');
		Route::get('/courses/classe/{classe}/printTokens', 'CoursesController@printTokens')->name('courses.printtokens');
		Route::get('/courses/{course}/classes', 'CoursesController@classes')->name('courses.classes');
		Route::get('/courses/{course}/attendance', 'CoursesController@attendance')->name('courses.attendance');
		Route::get('/courses/{course}/printattendance', 'CoursesController@printAttendance')->name('courses.printattendance');
		Route::get('/courses/classes/{classe}/attendance', 'CoursesController@classeAttendance')->name('courses.classes.attendance');
		Route::get('/courses/classes/{classe}/printattendance', 'CoursesController@printClasseAttendance')->name('courses.classes.printattendance');
		Route::get('/courses/classes/{classe}/update', 'CoursesController@updateClasse')->name('courses.classes.update');
		Route::get('/courses/classes/{classe}/show', 'CoursesController@showClasse')->name('courses.classes.show');
	});
	//routes accessable by students only
	Route::group(['middleware'=>['role:student']], function(){
		//Route::resource('courses', 'CoursesController',['only'=>['index','show']]);
		Route::match(['get', 'post'],'/students/findcourse', 'StudentsController@findCourse')->name('students.findcourse');
		Route::match(['get', 'post'],'/courses/{course}/studentregister', 'CoursesController@studentRegister')->name('courses.studentregister');
		Route::match(['get', 'post'],'/students/classe/{classe}/takeattendance', 'StudentsController@takeAttendance')->name('students.takeattendance');
		Route::get('/courses/{course}/classes', 'CoursesController@classes')->name('courses.classes');
		Route::get('/courses/classes/{classe}/show', 'CoursesController@showClasse')->name('courses.classes.show');
		Route::get('/students/courses/{course}/attendance', 'StudentsController@attendance')->name('students.courses.attendance');
	});

	Route::group(['middleware'=>['role:teacher']], function(){
		Route::match(['get', 'post'],'webauth/addsubjects','EntrustController@addSubjects')->name('webauth.addsubjects');
	});

	Route::group(['middleware'=>['role:student|parent']], function(){
		Route::match(['get', 'post'],'/teacherrequest/{teacherRequest}/rateteacher', 'TeacherRequestsController@rateTeacher')->name('teacherrequest.rateteacher');
	});

	Route::group(['middleware'=>['role:parent']], function(){
		Route::match(['get', 'post'],'webauth/addchildren', 'EntrustController@addChildren')->name('webauth.addchildren');
	});
	
	Route::match(['get', 'post'],'uploadDocument', 'EntrustController@uploadDocument')->name('uploadDocument');
	Route::delete('uploadDocument/{document}', 'EntrustController@deleteDocument')->name('deleteDocument');

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/profile/{user}/{partial?}', 'EntrustController@profile')->name('profile');//change to webauth and above to resource
	Route::resource('teacherrequest', 'TeacherRequestsController');
});

//Route::get('login/github', 'Auth\LoginController@redirectToProvider');
//Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');']
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');entrust/uploadDocument
