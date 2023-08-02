@extends('template.main')
@section('title', 'Movie')
@section('content')

    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="col-md-12">
                    <div class="card-body">
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
                                        <img class="d-block w-100 object-fit-cover"
                                            src="{{ $baseimageurl }}/original{{ $data->backdrop_path }}"
                                            alt="image {{ $data->original_title }}">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $data->title }}</h5>
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

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>

@endsection
