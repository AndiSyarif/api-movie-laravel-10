@extends('template.main')
@section('title', 'Search')
@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="row" id="dataWrapper">
                            {{-- @foreach ($movie as $data)
                                <div class="col-md-2.5 mx-auto">
                                    <div class="card mb-4">
                                        <img class="card-img-top rounded"
                                            style="width:250px;height:300px;object-fit: cover;"
                                            src="{{ $baseimageurl }}/w500{{ $data->poster_path }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h6 class="card-title"><b>{{ Str::limit($data->title, 25) }}</b></h6><br>
                                            <span>{{ date('Y', strtotime($data->release_date)) }}</span>
                                            <h6 class="card-text"><i class="fa-solid fa-thumbs-up" style="color:blue"></i>
                                                {{ $data->vote_average * 10 }} %</h6>
                                            <a href="/movie/{{ $data->id }}" class="btn btn-primary"><i
                                                    class="fa-solid fa-play"></i> Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger row justify-content-center" role="alert" id="notification">
                    <span id="notificationMessage"></span>
                </div>
                <div class="row justify-content-center">
                    <div class="spinner-border" role="status" id="autoload">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="row justify-content-center mt-2 pb-3">
                    <button class="btn btn-info btn-block w-50 rounded text-uppercase" onclick="LoadMore()"><i
                            class="fa-solid fa-spinner"></i> Load
                        More</button>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <script>
        let baseUrl = "{{ $baseurl }}";
        let baseImageurl = "{{ $baseimageurl }}";
        let api_key = "{{ $api_key }}";

        //hide loader
        $('#autoload').hide();

        //hide notification
        $('#notification').hide();

    </script>

@endsection
