<?php

namespace App\Http\Controllers;

use App\Models\UsersTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserListController extends Controller
{
    public function show($usersTitle, $sort = null)
    {
        $allTitles = DB::table('users_titles')
            ->join('titles', 'titles.title_id', '=', 'users_titles.ut_title_id')
            ->where('users_titles.username', $usersTitle)
            ->get();



        return view('userList')
            ->with('sort', $sort)
            ->with('allTitles', $allTitles);
    }
}