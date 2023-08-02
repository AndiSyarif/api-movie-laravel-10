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

        //hit api
        $banner = Http::get("{$baseurl}/movie/popular", [
            'api_key' => $api_key
        ]);

        // prepare variable
        $bannerArray = [];

        //check api response
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

        return view('home.home', [
            'baseurl' => $baseurl,
            'baseimageurl' => $baseimageurl,
            'api_key' => $api_key,
            'banner' => $bannerArray
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
