<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/about', function()
{
    return View::make('about');

});

Route::get('/contact', function()
{
    return View::make('contact');
});

Route::post('contact', function()
{
    $data = Input::all();
    $rules = array(
        'subject' => 'required',
        'message' => 'required'
    );

    $validator = Validator::make($data, $rules);

    if($validator->fails()) {
        return Redirect::to('contact')->withErrors($validator)->withInput();
    }

    $emailcontent = array(
        'subject' => $data['subject'],
        'emailmessage' => $data['message']
    );

    Mail::send('emails.contactemail', $emailcontent, function($message)
    {
        $message->to('support@learninglaravel.net','Learning Laravel Support')->subject('Contact via Our Contact Form');
    });
        return 'Your message has been sent';
});
//Movie
Route::get('/','MovieController@home');
Route::get('/movie/{movie}', 'MovieController@movie');
Route::get('/search','MovieController@search');
Route::get('/rated_app', 'MovieController@ratedApp');

//Rating
Route::post('/rate', 'RatingController@rate');
Route::post('/delete_rating', 'RatingController@deleteRate');

//Comment
Route::post('/comment', 'CommentController@saveComment');
Route::post('/comment_delete', 'CommentController@deleteComment');

//User
Route::get('login/fb', 'UserController@loginWithFacebook');
Route::get('/profile','UserController@profile');
Route::post('/profile','UserController@saveProfile');
Route::post('/upload','UserController@upload');
Route::get('/signup', 'UserController@signup');
Route::post('/signup', 'UserController@register');
Route::get('/logout','UserController@logout');