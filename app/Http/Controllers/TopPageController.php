<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopPageController extends Controller
{
    function topRating()
    {
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
        order by s.avrage_rating desc;");
        // dd($top);

        $titles = array();
        for ($i = 0; $i < count($top); $i++) {
            if ($top[$i]->avrage_rating > 0) {
                $a = DB::table('titles')
                    ->where('titles.title_id', $top[$i]->ut_title_id)
                    ->select()
                    ->get();
                $a[0]->avrage_rating = $top[$i]->avrage_rating;
                $a[0]->members = DB::table('users_titles')->where('ut_title_id', $top[$i]->ut_title_id)->count();
                array_push($titles, $a);
            }
        }
        // dd($titles);

        return view('top')->with('titles', $titles);
    }
    function topMembers()
    {
        $noOfMembers = DB::select("select ut_title_id,count(*) as member_fav from users_titles group by ut_title_id order by member_fav desc;");
        // dd($noOfMembers);
        $titles = array();
        foreach ($noOfMembers as $t) {
            $a = DB::table('titles')
                ->where('titles.title_id', $t->ut_title_id)
                ->get();
            array_push($titles, $a);
        }
        return view('popular')
            ->with('titles', $titles)
            ->with('noOfMembers', $noOfMembers);
    }
    function topFavorited()
    {
        $noOfFaviourite = DB::select("select ut_title_id,count(*) as member_fav from users_titles where ut_faviourite=1 group by ut_title_id order by member_fav desc;");
        // dd($noOfFaviourite);
        $titles = array();
        foreach ($noOfFaviourite as $t) {
            $a = DB::table('titles')
                ->where('titles.title_id', $t->ut_title_id)
                ->get();
            array_push($titles, $a);
        }
        return view('favorite')
            ->with('titles', $titles)
            ->with('noOfFaviourite', $noOfFaviourite);
    }
}