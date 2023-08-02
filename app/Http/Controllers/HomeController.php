<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baseurl = env('MOVIE_DB_BASE_URL');
        $baseimageurl = env('MOVIE_DB_IMAGE_BASE_URL');
        $api_key = env('MOVIE_DB_API_KEY');
        $maxbanner = 5;
        $maxmovie = 12;
        $maxtvshow = 12;

        //hit banner api
        $banner = Http::get("{$baseurl}/movie/popular", [
            'api_key' => $api_key
        ]);

        // prepare variable
        $bannerArray = [];

        //check api response banner
        if ($banner->successful()) {
            //cek data is null or not
            $resultArray =  $banner->object()->results;
            //save response data to variable data
            if (isset($resultArray)) {
                foreach ($resultArray as $data) {
                    array_push($bannerArray, $data);
                    if (count($bannerArray) == $maxbanner) {
                        break;
                    }
                }
            }
        }

        //hit top 12 movie
        $topmovie = Http::get("{$baseurl}/movie/top_rated", [
            'api_key' => $api_key
        ]);

        // prepare movies array
        $topmovieArray = [];

        //check api response top 12 movie
        if ($topmovie->successful()) {
            //cek data is null or not
            $resulttopmovieArray =  $topmovie->object()->results;
            //save response data to variable data
            if (isset($resulttopmovieArray)) {
                foreach ($resulttopmovieArray as $data) {
                    array_push($topmovieArray, $data);
                    if (count($topmovieArray) == $maxmovie) {
                        break;
                    }
                }
            }
        }

        //hit top 12 tv show
        $toptv = Http::get("{$baseurl}/tv/top_rated", [
            'api_key' => $api_key
        ]);

        // prepare movies array
        $toptvArray = [];

        //check api response top 12 movie
        if ($toptv->successful()) {
            //cek data is null or not
            $resulttoptvArray =  $toptv->object()->results;
            //save response data to variable data
            if (isset($resulttoptvArray)) {
                foreach ($resulttoptvArray as $data) {
                    array_push($toptvArray, $data);
                    if (count($toptvArray) == $maxtvshow) {
                        break;
                    }
                }
            }
        }

        // dd($topmovieArray);

        return view('home.home', [
            'baseurl' => $baseurl,
            'baseimageurl' => $baseimageurl,
            'api_key' => $api_key,
            'banner' => $bannerArray,
            'top12movie' => $topmovieArray,
            'top12tv' => $toptvArray,
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
