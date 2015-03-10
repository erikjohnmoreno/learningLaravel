<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 3/6/15
 * Time: 8:59 AM
 */

class CommentController extends \BaseController
{
    public function saveComment()
    {
        $input = Input::all();

        $rules = array(
            'body' => 'required'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {

            $comment = new Comment;

            $comment->body = $input['body'];
            $comment->app_title = $input['app_title'];
            $comment->user_id = Auth::user()->id;
            $comment->save();

            return Redirect::action('MovieController@movie', array($comment->app_title));
        }

        return Redirect::action('MovieController@movie', array($input['app_title']))->withErrors($validator->errors());
    }

    public function deleteComment()
    {
        $comment = Comment::where('user_id', '=', Auth::user()->id)->get()->first();
        if($comment != null) {
            $comment->delete();
        }
        return Redirect::action('MovieController@movie', array(Input::get('app_title')));

    }
}