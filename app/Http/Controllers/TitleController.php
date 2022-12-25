<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title, $sort = null)
    {

        $titleStaff = $title
            ->join('staffs_titles', 'titles.title_id', '=', 'staffs_titles.st_title_id')
            ->join('staff', 'staffs_titles.st_staff_id', '=', 'staff.staff_id')
            ->leftJoin('characters', 'staffs_titles.char_id', '=', 'characters.char_id')
            // ->leftJoin('title_characters', 'titles.title_id', '=', 'title_characters.ct_title_id')
            // ->distinct()
            ->where('titles.title_id', '=', $title->title_id)
            // ->select('title_id', 'characters.characterName', 'staff.firstname')
            ->get();



        $titleGenre = $title
            ->join('titles_genres', 'titles.title_id', '=', 'titles_genres.tg_title_id')
            ->join('genres', 'genres.genre_id', '=', 'titles_genres.tg_genre_id')
            ->distinct()
            ->where('titles.title_id', '=', $title->title_id)
            ->get();

        $userTitelDetail = null;

        if (Session::has('userInfo')) {
            $userTitelDetail = DB::table('users_titles')
                ->where('ut_user_id', Session::get('userInfo')->user_id)
                ->where('ut_title_id', $title->title_id)
                ->get();
            // dd(count($userTitelDetail));
        }

        $avrageScore = DB::table('users_titles')
            ->where('ut_title_id', $title->title_id)
            ->avg('ut_score')
            // ->get()
        ;
        $reviews = $title
            ->join('reviews', 'titles.title_id', '=', 'reviews.ut_title_id')
            ->join('users', 'reviews.ut_user_id', '=', 'users.user_id')
            ->where('ut_title_id', $title->title_id)
            ->orderBy('reviews.updated_at', 'DESC')
            ->select('reviews.rw_content', 'reviews.created_at', 'users.username', 'users.user_image', 'reviews.rw_type')
            ->limit(5)
            ->get();

        $noOfMebers = DB::table('users_titles')
            ->where('ut_title_id', $title->title_id)
            ->count();



        $totalRank = DB::select("select 
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
		) a) s where ut_title_id=" . $title->title_id . " order by s.avrage_rating desc ");

        $popularity = DB::select("select 
	(select 
		count(distinct members) 
		from (select ut_title_id,
	(select 
		count(ut_title_id) 
		from users_titles a1 where a1.ut_title_id=a.ut_title_id 
	)
    as 'members'  from 
		(select 
			distinct ut_title_id from users_titles
		) a) s1 where s1.members>=s.members
	)
    as 'rank' from (select ut_title_id,
	(select 
		count(ut_title_id) 
		from users_titles a1 where a1.ut_title_id=a.ut_title_id
	)
    as 'members'  from 
		(select 
			distinct ut_title_id from users_titles
		) a) s where ut_title_id=" . $title->title_id . " order by s.members desc;");

        // dd($popularity[0]->rank);

        $noOfFaviourite = DB::table('users_titles')
            ->where('ut_faviourite', 1)
            ->where('ut_title_id', $title->title_id)
            ->count();

        // sleep(5);

        return view('title')
            ->with('titleStaff', $titleStaff)
            ->with('titleGenre', $titleGenre)
            ->with('avrageScore', $avrageScore)
            ->with('noOfMebers', $noOfMebers)
            ->with('noOfFaviourite', $noOfFaviourite)
            ->with('popularity', $popularity)
            ->with('totalRank', $totalRank)
            ->with('reviews', $reviews)
            ->with('userTitelDetail', $userTitelDetail)
            ->with('sort', $sort)
            ->with('titleData', $title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }
}