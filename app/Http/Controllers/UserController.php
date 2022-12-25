<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $sort = null)
    {
        $userTitles = DB::table('users_titles')
            ->join('titles', 'titles.title_id', '=', 'users_titles.ut_title_id')
            ->where('users_titles.ut_user_id', '=', $user->user_id)
            ->get();


        $lastUpdated
            = DB::table('users_titles')
            ->join('titles', 'titles.title_id', '=', 'users_titles.ut_title_id')
            ->where('users_titles.ut_user_id', '=', $user->user_id)
            ->orderBy('users_titles.updated_at', 'DESC')
            ->select(
                'titles.title_id',
                'titles.image',
                'titles.titlename',
                'users_titles.updated_at',
                'users_titles.ut_watchingstatus',
                'users_titles.ut_watchingstatus',
                'users_titles.ut_episodewatched',
                'titles.noOfEpisodes',
                'users_titles.ut_score'
            )
            ->take(5)
            ->get();

        $favioriteTitle = DB::table('users_titles')
            ->join('titles', 'titles.title_id', '=', 'users_titles.ut_title_id')
            ->where('users_titles.ut_user_id', $user->user_id)
            ->where('users_titles.ut_faviourite', 1)
            ->take(10)
            ->get();

        $favioriteChar = Db::table('favorite_characters')
            ->join('characters', 'characters.char_id', '=', 'favorite_characters.fc_staff_id')
            ->where('favorite_characters.fc_user_id', $user->user_id)
            ->get();
        $favioriteStaff = Db::table('favorite_staffs')
            ->join('staff', 'staff.staff_id', '=', 'favorite_staffs.f_staff_id')
            ->where('favorite_staffs.f_user_id', $user->user_id)
            ->get();

        $userComments = $user
            ->join('user_comments', 'user_comments.u2_user_id', '=', 'users.user_id')
            ->where('user_comments.u2_user_id', $user->user_id)
            ->orderBy('user_comments.created_at', 'DESC')
            ->get();

        $userReviews = $user
            ->join('reviews', 'reviews.ut_user_id', '=', 'users.user_id')
            ->join('titles', 'reviews.ut_title_id', '=', 'titles.title_id')
            ->where('users.user_id', $user->user_id)
            ->select('reviews.rw_content', 'reviews.created_at', 'users.username', 'users.user_image', 'reviews.rw_type', 'titles.titlename', 'titles.title_id', 'titles.image')
            ->get();
        // dd($userReviews);

        return view('user')
            ->with('userTitles', $userTitles)
            ->with('lastUpdated', $lastUpdated)
            ->with('userComments', $userComments)
            ->with('favioriteChar', $favioriteChar)
            ->with('favioriteStaff', $favioriteStaff)
            ->with('favioriteTitle', $favioriteTitle)
            ->with('reviews', $userReviews)
            ->with('sort', $sort)
            ->with('userData', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}