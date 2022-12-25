<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function show()
    {
        $userTitles = NULL;
        $lastUpdated = NULL;
        if (Session::has('userInfo')) {
            $userTitles = DB::table('users_titles')->where('users_titles.ut_user_id', Session::get('userInfo')->user_id)->get();
            $lastUpdated
                = DB::table('users_titles')
                ->join('titles', 'titles.title_id', '=', 'users_titles.ut_title_id')
                ->where('users_titles.ut_user_id', '=', Session::get('userInfo')->user_id)
                ->orderBy('users_titles.updated_at', 'DESC')
                ->select(
                    'titles.title_id',
                    'titles.image',
                    'titles.titlename',
                    'users_titles.updated_at',
                    'users_titles.created_at',
                    'users_titles.ut_watchingstatus',
                    'users_titles.ut_watchingstatus',
                    'users_titles.ut_episodewatched',
                    'titles.noOfEpisodes',
                    'users_titles.ut_score'
                )
                ->take(5)
                ->get();
        }


        $top = DB::select("select s.ut_title_id, s.avrage_rating,
            (select 
                count(distinct avrage_rating) 
                from (select ut_title_id,
            (select 
                avg(ut_score) 
                from users_titles a1 where a1.ut_title_id=a.ut_title_id
            )
            as 'avrage_rating'  from 
                (select 
                    distinct ut_title_id from users_titles
                ) a) s1 where s1.avrage_rating>=s.avrage_rating
            )
            as 'rank' from (select ut_title_id,
            (select 
                avg(ut_score) 
                from users_titles a1 where a1.ut_title_id=a.ut_title_id
            )
            as 'avrage_rating'  from 
            (select 
                distinct ut_title_id from users_titles
            ) a) s 
             order by s.avrage_rating desc limit 10;");
        // dd($top);

        $topTitles = array();
        for ($i = 0; $i < count($top); $i++) {
            if ($top[$i]->avrage_rating > 0) {
                $a = DB::table('titles')
                ->where('titles.title_id', $top[$i]->ut_title_id)
                    ->select()
                    ->get();
                $a[0]->avrage_rating = $top[$i]->avrage_rating;
                $a[0]->members = DB::table('users_titles')->where('ut_title_id', $top[$i]->ut_title_id)->count();
                array_push($topTitles, $a);
            }
        }
        // dd($Toptitles);
        $noOfMembers = DB::select("select ut_title_id,count(*) as member_fav from users_titles group by ut_title_id order by member_fav desc limit 10;");
        // dd($noOfMembers);
        $topMembers = array();
        foreach ($noOfMembers as $t) {
            $a = DB::table('titles')
            ->where('titles.title_id', $t->ut_title_id)
                ->get();
            $a[0]->members = DB::table('users_titles')->where('ut_title_id', $t->ut_title_id)->count();
            array_push($topMembers, $a);
        }
        // dd($topMembers);
        // dd($topMembers);

        $newTitles = DB::table('titles')->whereDate('startdate', '>', date('Y-m-d'))->get();

        $suggestedTitles = DB::table('titles')->where('startdate', '<', date('Y-m-d'))->inRandomOrder()->limit(10)->get();

        // dd($suggestedTitles);

        // $newReviews = $title
        // ->join('reviews', 'titles.title_id', '=', 'reviews.ut_title_id')
        // ->join('users', 'reviews.ut_user_id', '=', 'users.user_id')
        // ->orderBy('reviews.created_at', 'asc')
        //     ->where('ut_title_id', $title->title_id)
        //     ->select('reviews.rw_content', 'reviews.created_at', 'users.username', 'users.user_image', 'reviews.rw_type')
        //     ->limit(5)
        //     ->get();

        $newReviews = DB::table('reviews')->orderBy('reviews.updated_at', 'DESC')->limit(10)
            ->join('users', 'reviews.ut_user_id', '=', 'users.user_id')
            ->join('titles', 'reviews.ut_title_id', '=', 'titles.title_id')
            ->select('reviews.rw_content', 'reviews.created_at', 'users.username', 'users.user_image', 'reviews.rw_type', 'titles.titlename', 'titles.title_id', 'titles.image')
            ->get();

        return view('welcome')
        ->with('userTitles', $userTitles)
            ->with('topTitles', $topTitles)
            ->with('newTitles', $newTitles)
            ->with('lastUpdated', $lastUpdated)
            ->with('newReviews', $newReviews)
            ->with('suggestedTitles', $suggestedTitles)
            ->with('topMembers', $topMembers);
    }

    // function show(){
    //     return view('aa')->with('a','cum');
    // }
}