@extends('template.main')
@section('title', 'Home')
@section('content')

    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="col-md-12">
                    <div class="card-body rounded">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($banner as $index => $data)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                                        @if ($loop->first) class="active" @endif></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($banner as $index => $data)
                                    {{-- {{ dd($data) }} --}}
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img class="d-block w-100 object-fit-cover rounded"
                                            src="{{ $baseimageurl }}/original{{ $data->backdrop_path }}"
                                            alt="image {{ $data->original_title }}">
                                        <div class="carousel-caption d-none d-md-block"
                                            style="z-index: 1;color: #fff;position: absolute;">
                                            <h5><b>{{ $data->title }}</b></h5>
                                            <p>{{ $data->overview }}</p>
                                            <a href="/movie/{{ $data->id }}" class="btn btn-info btn-sm rounded"><i
                                                    class="fa-solid fa-play"></i> Detail</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col -->
                <div class="mt-2">
                    <div class="card rounded">
                        <div class="card-header">
                            <h3><b>Top 12 Movie</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($top12movie as $data)
                                    <div class="col-md-2.5 mx-auto">
                                        <div class="card mb-4">
                                            <img class="card-img-top rounded"
                                                style="width:250px;height:300px;object-fit: cover;"
                                                src="{{ $baseimageurl }}/w500{{ $data->poster_path }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h6 class="card-title"><b>{{ Str::limit($data->title, 21) }}</b></h6><br>
                                                <span>{{ date('Y', strtotime($data->release_date)) }}</span>
                                                <h6 class="card-text"><i class="fa-solid fa-thumbs-up"
                                                        style="color:blue"></i>
                                                    {{ number_format($data->vote_average * 10, 0) }} %</h6>
                                                <a href="/movie/{{ $data->id }}" class="btn btn-primary"><i
                                                        class="fa-solid fa-play"></i> Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <div class="card rounded">
                        <div class="card-header">
                            <h3><b>Top 12 TV Show</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($top12tv as $data)
                                    <div class="col-md-2.5 mx-auto">
                                        <div class="card mb-4">
                                            <img class="card-img-top rounded"
                                                style="width:250px;height:300px;object-fit: cover;"
                                                src="{{ $baseimageurl }}/w500{{ $data->poster_path }}"
                                                alt="Card image cap">
                                            <div class="card-body">
                                                <h6 class="card-title"><b>{{ Str::limit($data->name, 21) }}</b>
                                                </h6><br>
                                                <span>{{ date('Y', strtotime($data->first_air_date)) }}</span>
                                                <h6 class="card-text"><i class="fa-solid fa-thumbs-up"
                                                        style="color:blue"></i>
                                                    {{ number_format($data->vote_average * 10, 0) }} %</h6>
                                                <a href="/tv/{{ $data->id }}" class="btn btn-primary"><i
                                                        class="fa-solid fa-play"></i> Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>

@endsection
