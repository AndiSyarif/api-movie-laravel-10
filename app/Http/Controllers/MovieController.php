<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baseurl = env('MOVIE_DB_BASE_URL');
        $baseimageurl = env('MOVIE_DB_IMAGE_BASE_URL');
        $api_key = env('MOVIE_DB_API_KEY');
        $sortBy = "popularity.desc";
        $page = 1;
        $minimalVoter = 100;


        //hit top 12 movie
        $movie = Http::get("{$baseurl}/discover/movie", [
            'api_key' => $api_key,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page

        ]);

        // prepare movies array
        $movieArray = [];

        //check api response top 12 movie
        if ($movie->successful()) {
            //cek data is null or not
            $resultmovieArray =  $movie->object()->results;
            //save response data to variable data
            if (isset($resultmovieArray)) {
                foreach ($resultmovieArray as $data) {
                    array_push($movieArray, $data);
                }
            }
        }

        return view('movies.movies', [
            'baseurl' => $baseurl,
            'baseimageurl' => $baseimageurl,
            'api_key' => $api_key,
            'movie' => $movieArray,
            'sort_by' => $sortBy,
            'page' => $page,
            'minimalVoter' => $minimalVoter

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $baseurl = env('MOVIE_DB_BASE_URL');
        $baseimageurl = env('MOVIE_DB_IMAGE_BASE_URL');
        $api_key = env('MOVIE_DB_API_KEY');

        //hit top deatil movie
        $movie = Http::get("{$baseurl}/movie/{$id}", [
            'api_key' => $api_key,
            'append_to_response' => 'videos'

        ]);

        $movieData = null;

        if ($movie->successful()) {
            $movieData = $movie->object();
        }


        return view('movies.movie-detail', [
            'baseurl' => $baseurl,
            'baseimageurl' => $baseimageurl,
            'api_key' => $api_key,
            'movieData' => $movieData

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
