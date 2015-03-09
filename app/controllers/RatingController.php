<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 3/6/15
 * Time: 9:01 AM
 */
class RatingController extends \BaseController
{
    public function rate()
    {
        $input = Input::get('rating');
        $app = Input::all();
        $rate = new Rating;
        switch($input) {
            case 'one':
                $rate->rate = 1;
                break;
            case 'two':
                $rate->rate = 2;
                break;
            case 'three':
                $rate->rate = 3;
                break;
            case 'four':
                $rate->rate = 4;
                break;
            case 'five':
                $rate->rate = 5;
                break;
            case null:
                return Redirect::action('MovieController@movie', array($app['app_title']));
                break;
            default:
                break;
        }
        $rate->user_id = Auth::user()->id;
        $rate->app_title = $app['app_title'];
        $rate->save();

        return Redirect::action('MovieController@movie', array($app['app_title']));
    }

    public function deleteRate()
    {
        $input = Input::get('app_title');
        $rate = Rating::where('app_title', '=', $input)->where('user_id','=', Auth::user()->id)->get()->first();
        $rate->delete();
        return Redirect::action('MovieController@movie', array($input));
    }
}