@extends('template.main')
@section('title', 'Movie Detail')
@section('content')

    <style>
        .col-6 {
            flex: unset !important;
        }
    </style>

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid pt-3">
                <div class="card rounded">
                    <div class="card-body">
                        @php
                            $backdropPath = $movieData ? "{$baseimageurl}/original{$movieData->backdrop_path}" : '';
                        @endphp
                        <div class="card bg-dark text-white">
                            <img class="card-img" src="{{ $backdropPath }}" alt="Card image">

                            @php
                                $title = '';
                                $tagline = '';
                                $year = '';
                                $duration = '';
                                $rating = 0;
                                
                                if ($movieData) {
                                    $originalDate = date('Y', strtotime($movieData->release_date));
                                    $rating = (int) ($movieData->vote_average * 10);
                                    $title = $movieData->title;
                                
                                    if ($movieData->tagline) {
                                        $tagline = $movieData->tagline;
                                    } else {
                                        $tagline = $movieData->overview;
                                    }
                                
                                    if ($movieData->runtime) {
                                        $hour = (int) ($movieData->runtime / 60);
                                        $minute = (int) ($movieData->runtime % 60);
                                        $duration = "{$hour}h {$minute}m";
                                    }
                                }
                                
                                $trailerID = '';
                                if (isset($movieData->videos->results)) {
                                    foreach ($movieData->videos->results as $item) {
                                        if (strtolower($item->type) == 'trailer') {
                                            $trailerID = $item->key;
                                            break;
                                        }
                                    }
                                }
                                
                            @endphp

                            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-start col-12"
                                style="background-color: rgba(0, 0, 0, 0.6);">
                                <h5 class="card-title" style="font-size: 40px"><b>{{ $title }}</b> </h5>
                                <p class="card-text" style="font-size: 20px"><i> {{ $tagline }}</i></p>
                                <div class="col-6 text-center d-flex">
                                    <input type="text" class="knob" value="{{ $rating }}" data-width="90"
                                        data-height="90" data-fgColor="#39CCCC" readonly>
                                    <button class="ml-3 mr-3 mt-3 btn btn-outline-light"
                                        style="height: 60px;width:100px"><b><i class="fa-solid fa-calendar-days"></i>
                                            {{ $originalDate }}</b></button>
                                    <button class="ml-3 mr-3 mt-3 btn btn-outline-light"
                                        style="height: 60px;width:100px"><b><i class="fa-solid fa-clock"></i>
                                            {{ $duration }}</b></button>
                                </div>
                                @if ($trailerID)
                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                        class="btn btn-warning rounded mt-3 ml-2" style="height: 50px;width:150px">
                                        <i class="fa-solid fa-play"></i> Play Trailer
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Trailer {{ $title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="trailerIframe" class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/{{ $trailerID }}"></iframe>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.container-fluid -->

    <script>
        $('#exampleModalCenter').on('hidden.bs.modal', function(e) {
            var iframe = document.getElementById('trailerIframe');
            var iframeSrc = iframe.src;
            iframe.src = '';
            setTimeout(function() {
                iframe.src = iframeSrc;
            }, 500);
        });
    </script>

@endsection
