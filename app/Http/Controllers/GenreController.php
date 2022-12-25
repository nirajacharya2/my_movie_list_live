<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;

class GenreController extends Controller
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
     * @param  \App\Models\Genres  $genres
     * @return \Illuminate\Http\Response
     */
    public function show(Genres $genres)
    {

        $gentrTitles = $genres
            ->join('titles_genres', 'genres.genre_id', '=', 'titles_genres.tg_genre_id')
            ->join('titles', 'titles_genres.tg_title_id', '=', 'titles.title_id')
            ->where('genres.genre_id', $genres->genre_id)
            ->get();


        return view("genre")
            // ->with('avrageScore', $avrageScore)
            ->with('genreDetail', $genres)
            ->with('gentrTitles', $gentrTitles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genres  $genres
     * @return \Illuminate\Http\Response
     */
    public function edit(Genres $genres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genres  $genres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genres $genres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genres  $genres
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genres $genres)
    {
        //
    }
}