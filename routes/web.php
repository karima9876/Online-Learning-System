<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PuserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExportImportController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UpDownController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FbController;
use Illuminate\Support\Facades\Route;


 Auth::routes();

//Roles
Route::group(['prefix' => ''], function () {
    Route::resource('roles', 'RolesController');
    Route::get('roles/destroy/{id}',[RolesController::class,'destroy'])->name('roles.destroy');
});
 //questionlist
 Route::get('/',[MainController::class,'displayWelcome'])->name('displayWelcome');
 Route::get('download-file-{id}',[MainController::class,'downloadFile'])->name('downLoadFile');
 Route::get('/pCategory',[MainController::class,'displayParticularCategory'])->name('displayParticularCategory');
 


//User
Route::get('/adduser',[UserController::class,'addUser'])->name('adduser');
Route::post('/user/store',[UserController::class,'storeUser'])->name('user.store');
Route::get('/userlist',[UserController::class,'userList'])->name('userlist');
Route::get('/user/edit/{student_id}',[UserController::class,'userEdit'])->name('user.edit');
Route::post('/user/update/{student_id}',[UserController::class,'updateUser'])->name('user.update');
Route::get('/user/delete/{student_id}',[UserController::class,'deleteUser'])->name('user.delete');
//puser
Route::get('/addpuser',[PuserController::class,'addPuser'])->name('addpuser');
Route::post('/puser/store',[PuserController::class,'storePuser'])->name('puser.store');
Route::get('/puserlist',[PuserController::class,'puserList'])->name('puserlist');
Route::get('/puser/edit/{login_id}',[PuserController::class,'puserEdit'])->name('puser.edit');
Route::post('/puser/update/{login_id}',[PuserController::class,'updatePuser'])->name('puser.update');
Route::get('/puser/delete/{login_id}',[PuserController::class,'deletePuser'])->name('puser.delete');

//category
Route::get('/addcategory',[CategoryController::class,'addCategory'])->name('addcategory');
Route::post('/category/store',[CategoryController::class,'storeCategory'])->name('category.store');
Route::get('/categoryList',[CategoryController::class,'categoryList'])->name('categoryList');
Route::get('/category/edit/{category_id}',[CategoryController::class,'editCategory'])->name('category.edit');
Route::post('/category/update/{category_id}',[CategoryController::class,'updateCategory'])->name('category.update');
Route::get('/category/delete/{category_id}',[CategoryController::class,'deleteCategory'])->name('category.delete');
//profile
Route::get('/profileshow',[ProfileController::class,'showProfile'])->name('profileshow');
Route::get('particularProfile',[ProfileController::class,'displayParticularProfile'])->name('displayParticularProfile');


//password
Route::get('/changepassword',[ProfileController::class,'changePassword'])->name('changepassword');
Route::post('/update/password',[ProfileController::class,'updatePassword'])->name('update.password');
 //export
 Route::get('/ex-import',[ExportImportController::class,'getIndex'])->name('ex_import');
 Route::get('ex-import/export',[ExportImportController::class,'getExport'])->name('export');
 Route::post('ex-import/import',[ExportImportController::class,'postImport'])->name('import');


 //questions

Route::get('questionsAdd',[QuestionController::class,'addQuestion'])->name('addQuestion');
 Route::get('questionsEdit',[QuestionController::class,'editQuestion'])->name('editQuestion');
 Route::get('questions/delete',[QuestionController::class,'deleteQuestion'])->name('deleteQuestion');
 Route::post('questions/save',[QuestionController::class,'saveQuestion'])->name('saveQuestion');
 
//answers  list
Route::get('answers',[AnswerController::class,'listAnswer'])->name('answers');
Route::get('answersAdd',[AnswerController::class,'addAnswer'])->name('addAnswer');
Route::get('answersEdit',[AnswerController::class,'editAnswer'])->name('editAnswer');
Route::get('answers/delete',[AnswerController::class,'deleteAnswer'])->name('deleteAnswer');
Route::post('answers/save',[AnswerController::class,'saveAnswer'])->name('saveAnswer');
 
 //questions report
 Route::get('question_reportList',[ReportController::class,'question_reportList'])->name('question_reportList');
 Route::post('reportQuestion',[ReportController::class,'saveReport_Question'])->name('reportQuestion');
 Route::get('question_reportList/delete/{id}',[ReportController::class,'delete_question_reportList'])->name('delete_question_reportList');

 //answers report
 Route::get('answer_reportList',[ReportController::class,'answer_reportList'])->name('answer_reportList');
 Route::post('reportAnswer',[ReportController::class,'saveReport_Answer'])->name('reportAnswer');
 Route::get('answer_reportList/delete/{id}',[ReportController::class,'delete_answer_reportList'])->name('delete_answer_reportList');

//Block
Route::get('blockUser/{id}',[ReportController::class,'blockUser'])->name('blockUser');

//Unblock

Route::get('unblockUser/{id}',[ReportController::class,'unblockUser'])->name('unblockUser');

//Reply
Route::get('repliesAdd',[ReplyController::class,'addReply'])->name('addReply');
Route::post('replies/save',[ReplyController::class,'saveReply'])->name('saveReply');
Route::get('replies/delete',[ReplyController::class,'deleteReply'])->name('deleteReply');
Route::get('repliesEdit',[ReplyController::class,'editReply'])->name('editReply');
//Rating
Route::get('ratings',[RateController::class,'listRate'])->name('ratings');

// upvote downvote
Route::get('upAnsSave/{id}/{qid}/{bool}',[UpDownController::class,'saveAnsUpVote'])->name('upAnsSave');
Route::get('upDownRepSave/{id}/{bool}',[UpDownController::class,'saveRepUpVote'])->name('upDownRepSave');

//message
Route::get('messages',[MessageController::class,'listMessage'])->name('messages');
Route::post('mSave/{messageId}',[MessageController::class,'messageSaved'])->name('mSave');
Route::post('messSL',[MessageController::class,'messSelectListSearch'])->name('messSL');
Route::get('messSL',[MessageController::class,'messSelectListSearch'])->name('messSL');

//refresh in captcha
Route::post('refresh_captcha',[QuestionController::class,'refreshCaptcha'])->name('refresh_captcha');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//search question
Route::post('welcomeSearch', 'MainController@searchWelcome');
Route::get('welcomeSearch', 'MainController@searchWelcome');

