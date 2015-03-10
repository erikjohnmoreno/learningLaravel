<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 2/27/15
 * Time: 2:15 PM
 */

class MovieController extends \BaseController
{
    public function home()
    {
          ITunes::cacheFor(30);
          $data = ITunes::search('entity', array('limit' => 200, 'entity' =>'software'));
          $data = json_decode($data, true);
          $itunes_app = $data['results'];
          $paginator = $this->paginator($itunes_app, count($itunes_app));
          return View::make('home', compact('itunes_app','paginator'));
    }

    public function movie($app_title)
    {
        $data = ITunes::search($app_title, array('limit' => 200, 'entity' => 'software'));
        $data = json_decode($data, true);
        $itunes_app = $data['results'];
//        $comments = Comment::where('app_title', $app_title)->get();
        $comments = DB::table('comments')->where('app_title', $app_title)
                            ->join('users', 'users.id', '=', 'comments.user_id')
                            ->orderBy('comments.body', 'desc')
                            ->get();
        $rates = Rating::where('app_title', $app_title)->avg('rate');
        if(Auth::check()) {
            $check_comment = $this->isComment($app_title);
            $check_rate = $this->isRate($app_title, Auth::user()->id);
        }
        return View::make('movie', compact('app_title','comments','itunes_app','rates', 'check_rate','check_comment'));
    }

    public function ratedApp()
    {
        if (Auth::check()) {
            $rated = DB::table('ratings')->where('user_id', Auth::user()->id)->get();
            $paginator = $this->paginator($rated, count($rated));
            return View::make('rated', compact('rated', 'paginator'));
        }
        else {
            return Redirect::action('MovieController@home');
        }
    }


    public function isComment($app_title)
    {
        $row = DB::table('comments')->where('user_id', Auth::user()->id)->where('app_title', $app_title)->get();
        if(!empty($row))
        {
            return true;
        }else {
            return false;
        }
    }

    public function paginator($result, $total_items)
    {
        $per_page = 11;
        $offset = ((Paginator::getCurrentPage() - 1) * $per_page);
        $end = $offset + $per_page;
        $items = array();

        if($end > $total_items) {
            $end = $total_items - 1;
        }

        for ($i = $offset; $i <= $end; $i++) {
            $items[] = $result[$i];
        }
        $paginated = Paginator::make($items, $total_items, $per_page);
        return $paginated;
    }

    public function itunes_decoder($y, $x = "entity")
    {
        ITunes::cache(30);
        $data = ITunes::search($x, array('limit' => 15, 'entity' => 'software'));
        $data = json_decode($data, true);
        $itunes_app = $data['results'];
        $comments = Comment::where('app_title', $y)->get();
        $rates = Rating::where('app_title', $y)->avg('rate');
        return array('itunes_app' => $itunes_app, 'comments' => $comments, 'rates'=>$rates);
    }

    public function isRate($title, $id = null)
    {
        $rate = Rating::where('app_title', '=', $title)->where('user_id', '=', $id)->get()->first();
        if (!empty($rate)) {
            return true;
        } else {
            return false;
        }
    }

    public function search()
    {
        ITunes::cache(30);
        $to_search = Input::get('search');
        $data = ITunes::search($to_search, array('limit'=> 200 ,'entity' => 'software'));
        $data = json_decode($data, true);
        $itunes_search = $data['results'];

        $itunes_search = $this->paginator($itunes_search, count($itunes_search));
        return View::make('search', compact('itunes_search','to_search'));
    }
}
