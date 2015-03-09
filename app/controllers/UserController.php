<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 3/6/15
 * Time: 8:39 AM
 */

class UserController extends \BaseController
{
    public function loginWithFacebook()
    {
        $code = Input::get('code');
//        dd(\Artdarek\OAuth\Facade\OAuth::consumer('Facebook'));
        $fb = \Artdarek\OAuth\Facade\OAuth::consumer('Facebook');

        if (!empty($code)) {
            $token = $fb->requestAccessToken($code);

            $result = json_decode($fb->request('/me'), true);
            $_SESSION['email'] = $result['email'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['facebook_id'] = $result['id'];
            $user_info = $this->isRegistered($result);
            if ($user_info == null) {
                return Redirect::action('UserController@signup');
            } else {
                // find user using facebookid = DB::table()->where(fbid = $sessi);
                // Auth::loginbyid($user->id)
                // Auth::get()->id;
                // User::where(facebook_id = session facebookid

                $find_user = User::where('facebook_id', $_SESSION['facebook_id'])->get()->first();
                Auth::loginUsingId($find_user->id);
                return Redirect::action('MovieController@home');
            }
            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";

            //dd($result);

        } else {
            $url = $fb->getAuthorizationUri();
            return Redirect::to((string)$url);
        }
    }

    public function isRegistered($result)
    {
        $users = User::where('email','=', $result['email'])->get()->first();
//        if (!empty($users)) {
//            $_SESSION['id'] = $users->facebook_id;
//        }
        return $users;
    }

    public function signup()
    {
        if(!Auth::check()) {
            return View::make('signup');
        } else {
            return Redirect::action('MovieController@home');
        }
    }

    public function register()
    {
        $input = Input::all();
        $user = new User;
        $user_directory = public_path().'/img/avatar/' . $input['email'];
        $created_directory = File::makeDirectory($user_directory, $mode = 0777, true);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->about = " ";
        $user->facebook_id = $_SESSION['facebook_id'];
        $user->save();


        return Redirect::action('MovieController@home');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        Auth::logout();
        return Redirect::action('MovieController@home');
    }

    public function profile()
    {
        if (Auth::check()) {
            $name = $_SESSION['name'];
            $user = User::where('facebook_id','=', $_SESSION['facebook_id'])->get()->first();
            $about = $user->about;
            $image = $user->image;
            $personal_folder = $user->email;
            return View::make('profile', compact('name', 'about', 'image', 'personal_folder'));
        } else {
            return Redirect::action('MovieController@home');
        }
    }

    public function saveProfile()
    {
        $input = Input::all();
        DB::table('users')
            ->where('facebook_id', Auth::user()->facebook_id)
            ->update(array('about'=> $input['about']));

        return Redirect::action('UserController@profile');
    }

    public function upload()
    {
        $file = array('image' => Input::file('image'));
        $rules = array(
            'image' => 'required'
        );
        $validator = Validator::make($file, $rules);

        if ($validator->fails()) {
            return Redirect::to('profile')->withInput()->withErrors($validator);
        } else {
            if (Input::file('image')->isValid()) {
                $destination_path = '/Users/eric/Sites/learningLaravel/public/img/avatar/'. $_SESSION['email'];
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = rand(111111,999999) . '.' . $extension;
                Input::file('image')->move($destination_path, $fileName);
                DB::table('users')
                    ->where('facebook_id', Auth::user()->facebook_id)
                    ->update(array('image' => $fileName));

                return Redirect::to('profile');
            } else {
                return Redirect::to('profile');
            }
        }
    }


}