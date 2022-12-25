<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
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
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {

        // $titleStaff = $title
        //     ->join('staffs_titles', 'titles.title_id', '=', 'staffs_titles.st_title_id')
        //     ->join('staff', 'staffs_titles.st_staff_id', '=', 'staff.staff_id')
        //     ->leftJoin('staffs_characters', 'staffs_titles.st_staff_id', '=', 'staffs_characters.sc_staff_id')
        //     ->leftJoin('characters', 'staffs_characters.sc_char_id', '=', 'characters.char_id')
        //     // ->leftJoin('title_characters', 'titles.title_id', '=', 'title_characters.ct_title_id')
        //     ->distinct()
        //     ->where('titles.title_id', '=', $title->title_id)
        //     // ->select('title_id', 'characters.characterName', 'staff.firstname')
        //     ->get();


        $staffRoles = $staff
            ->join('staffs_titles', 'staff.staff_id', '=', 'staffs_titles.st_staff_id')
            ->join('titles', 'staffs_titles.st_title_id', '=', 'titles.title_id')
            // ->leftJoin('staffs_characters', 'staffs_titles.st_staff_id', '=', 'staffs_characters.sc_staff_id')
            ->leftJoin('characters', 'staffs_titles.char_id', '=', 'characters.char_id')
            ->where('staff.staff_id', $staff->staff_id)
            ->get();

        $comments = $staff
            ->join('staff_comments', 'staff.staff_id', '=', 'staff_comments.sco_staff_id')
            ->join('users', 'users.user_id', '=', 'staff_comments.sco_user_id')
            ->where('staff.staff_id', $staff->staff_id)
            ->orderBy('staff_comments.created_at', 'desc')
            ->select('staff_comments.created_at', 'staff_comments.commentText', 'users.username')
            ->limit(10)
            ->get();

        $faviouriteChar = null;

        if (Session::has('userInfo')) {
            $faviouriteChar = $staff
                ->join('favorite_staffs', 'favorite_staffs.f_staff_id', '=', 'staff.staff_id')
                ->where('f_user_id', Session::get('userInfo')->user_id)
                ->where('staff.staff_id', $staff->staff_id)
                ->count();
        }


        $favCount = $staff
            ->join('favorite_staffs', 'favorite_staffs.f_staff_id', '=', 'staff.staff_id')
            ->where('staff.staff_id', $staff->staff_id)
            ->count();


        return view('staff')
            ->with('staffDetail', $staff)
            ->with('comments', $comments)
            ->with('faviouriteChar', $faviouriteChar)
            ->with('favCount', $favCount)
            ->with('staffRoles', $staffRoles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}