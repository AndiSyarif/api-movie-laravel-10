<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
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


        //hit top 12 tv shows
        $tv = Http::get("{$baseurl}/discover/tv", [
            'api_key' => $api_key,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page

        ]);

        // prepare movies array
        $tvArray = [];

        //check api response top 12 movie
        if ($tv->successful()) {
            //cek data is null or not
            $resulttvArray =  $tv->object()->results;
            //save response data to variable data
            if (isset($resulttvArray)) {
                foreach ($resulttvArray as $data) {
                    array_push($tvArray, $data);
                }
            }
        }

        // dd($tvArray);

        return view('tv.tv', [
            'baseurl' => $baseurl,
            'baseimageurl' => $baseimageurl,
            'api_key' => $api_key,
            'tv' => $tvArray,
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
        //
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
