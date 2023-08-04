@extends('template.main')
@section('title', 'Search')
@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card rounded">
                    <div class="row" id="dataWrapper">
                        {{-- @foreach ($movie as $data)
                                <div class="col-md-2.5 mx-auto">
                                    <div class="card mb-4">
                                        <img class="card-img-top rounded" style="width:250px;height:300px;object-fit: cover;"
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
                <div class="alert alert-danger row justify-content-center" role="alert" id="notification">
                    <span id="notificationMessage"></span>
                </div>
                <div class="row justify-content-center">
                    <div class="spinner-border" role="status" id="autoload">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <script>
        let baseUrl = "{{ $baseurl }}";
        let baseImageurl = "{{ $baseimageurl }}";
        let api_key = "{{ $api_key }}";
        let searchKeyword = "";

        //hide loader
        $('#autoload').hide();

        //hide notification
        $('#notification').hide();

        $('#searchInput').keypress(function(event) {
            var key = event.which;

            if (key == 13) {
                searchKeyword = $('#searchInput').val();
                if (searchKeyword) {
                    search();
                }
                return false;
            }
        });

        function search() {
            $.ajax({
                    url: `${baseUrl}/search/multi?page=1&api_key=${api_key}&query=${searchKeyword}`,
                    type: "get",
                    beforeSend: function() {
                        //show loader
                        $('#autoload').show();

                        //clear content
                        $("#dataWrapper").html("");
                    }
                })
                .done(function(response) {
                    //hide loader
                    $('#autoload').hide();

                    if (response.results) {
                        var htmlData = [];
                        response.results.forEach(item => {
                            if (item.media_type == 'movie' || item.media_type == 'tv') {
                                let searchTitel = "";
                                let originalDate = "";
                                let detailUrl = "";

                                if (item.media_type == 'movie') {
                                    detailUrl = `/movie/${item.id}`;
                                    originalDate = new Date(item.release_date).getFullYear();
                                    searchTitel = item.title.length > 25 ? item.title.slice(0, 23) + "..." :
                                        item.title;
                                } else {
                                    detailUrl = `/tv/${item.id}`;
                                    originalDate = new Date(item.first_air_date).getFullYear();
                                    searchTitel = item.name.length > 25 ? item.name.slice(0, 23) + "..." : item
                                        .name;
                                }

                                let searchImage = item.poster_path ? `${baseImageurl}/w500${item.poster_path}` :
                                    'https://via.placeholder.com/250x300';
                                let searchRating = (item.vote_average * 10).toFixed(2);

                                htmlData.push(`<div class="col-md-2.5 mx-auto">
                                                <div class="card mb-4">
                                                    <img class="card-img-top rounded"
                                                        style="width:250px;height:300px;object-fit: cover;"
                                                        src="${searchImage}" alt="image">
                                                    <div class="card-body">
                                                        <h6 class="card-title"><b>${searchTitel}</b></h6><br>
                                                        <span>${ originalDate }</span>
                                                        <h6 class="card-text"><i class="fa-solid fa-thumbs-up" style="color:blue"></i>
                                                            ${ searchRating } %</h6>
                                                        <a href="${detailUrl}" class="btn btn-primary"><i
                                                                class="fa-solid fa-play"></i> Detail</a>
                                                    </div>
                                                </div>
                                             </div>`);
                            }
                        });
                        $("#dataWrapper").append(htmlData.join(""));
                    }

                })
                .fail(function(jqHXR, ajaxOptions, thrownError) {
                    //hide loader
                    $('#autoload').hide();

                    //show notification
                    $('#notificationMessage').text("Problem occurs, Please try again later");
                    $('#notification').show();

                    //set timeout
                    setTimeout(function() {
                        $('#notification').hide();
                    }, 3000);
                })
        }
    </script>

@endsection
