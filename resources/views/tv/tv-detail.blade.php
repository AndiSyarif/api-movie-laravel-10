@extends('template.main')
@section('title', 'TV Show Detail')
@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid pt-3">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="row" id="dataWrapper">
                            @php
                                $backdropPath = $movieData ? "{$baseimageurl}/original{$movieData->backdrop_path}" : '';
                            @endphp
                            <img src="{{ $backdropPath }}" class="w-100 background-image-container" style="object-fit: cover;"
                                alt="image">
                            <div class="w-100 bg-black bg-opacity-60 z-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@endsection
