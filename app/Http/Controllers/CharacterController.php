<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CharacterController extends Controller
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
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        $actor = $character
            ->join('staffs_characters', 'characters.char_id', '=', 'staffs_characters.sc_char_id')
            ->join('staff', 'staffs_characters.sc_staff_id', '=', 'staff.staff_id')
            ->where('characters.char_id', $character->char_id)
            ->get();

        $relatedTitle = $character
            ->join('staffs_titles', 'characters.char_id', '=', 'staffs_titles.char_id')
            // ->join('staffs_titles', 'staffs_characters.sc_staff_id', '=', 'staffs_titles.st_staff_id')
            ->join('titles', 'staffs_titles.st_title_id', '=', 'titles.title_id')
            ->where('characters.char_id', $character->char_id)
            ->get();


        $faviouriteChar = null;

        if (Session::has('userInfo')) {
            $faviouriteChar = $character
                ->join('favorite_characters', 'favorite_characters.fc_staff_id', '=', 'characters.char_id')
                ->where('favorite_characters.fc_user_id', Session::get('userInfo')->user_id)
                ->where('characters.char_id', $character->char_id)
                ->count();
        }


        // dd($faviouriteChar);
        $favCount = DB::table('favorite_characters')
            ->where('favorite_characters.fc_staff_id', $character->char_id)
            ->count();

        return view('character')
            ->with('relatedTitle', $relatedTitle)
            ->with('actor', $actor)
            ->with('favCount', $favCount)
            ->with('faviouriteChar', $faviouriteChar)
            ->with('characterDetail', $character);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}