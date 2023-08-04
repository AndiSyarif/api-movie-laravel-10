@extends('template.main')
@section('title', 'TV Shows')
@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card rounded">
                    <div class="card-header">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label"><b>Sort</b></label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="sort" onchange="changeSort(this)">
                                        <option value="popularity.desc">Popularity (Descending)</option>
                                        <option value="popularity.asc">Popularity (Ascending)</option>
                                        <option value="toprated.desc">Top Rated (Descending)</option>
                                        <option value="toprated.asc">Top Rated (Ascending)</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row" id="dataWrapper">
                            @foreach ($tv as $data)
                                <div class="col-md-2.5 mx-auto">
                                    <div class="card mb-4">
                                        <img class="card-img-top rounded"
                                            style="width:250px;height:300px;object-fit: cover;"
                                            src="{{ $baseimageurl }}/w500{{ $data->poster_path }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h6 class="card-title"><b>{{ Str::limit($data->name, 23) }}</b></h6>
                                            <br>
                                            <span>{{ date('Y', strtotime($data->first_air_date)) }}</span>
                                            <h6 class="card-text"><i class="fa-solid fa-thumbs-up" style="color:blue"></i>
                                                {{ $data->vote_average * 10 }} %</h6>
                                            <a href="/tv/{{ $data->id }}" class="btn btn-primary"><i
                                                    class="fa-solid fa-play"></i> Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
        let sort_by = "{{ $sort_by }}";
        let page = "{{ $page }}";
        let minimalVoter = "{{ $minimalVoter }}"
        //console.log(baseUrl, baseImageurl, api_key, sort_by, page, minimalVoter);

        //hide loader
        $('#autoload').hide();

        //hide notification
        $('#notification').hide();

        function LoadMore() {
            $.ajax({
                    url: `${baseUrl}/discover/tv?page=${++page}&sort_by=${sort_by}&api_key=${api_key}&vote_count.gte=${minimalVoter}`,
                    type: "get",
                    beforeSend: function() {
                        //show loader
                        $('#autoload').show();
                    }
                })
                .done(function(response) {
                    //hide loader
                    $('#autoload').hide();

                    //get data
                    if (response.results) {
                        console.log(response.results);
                        var htmlData = [];
                        response.results.forEach(item => {
                            let tvTitle = item.name.length > 25 ? item.name.slice(0, 23) +
                                "..." : item
                                .name;
                            //let tvImage = `${baseImageurl}/w500${item.poster_path}`;
                            let tvYear = new Date(item.first_air_date).getFullYear();
                            htmlData.push(`<div class="col-md-2.5 mx-auto">
                                                <div class="card mb-4">
                                                    <img class="card-img-top rounded"
                                                        style="width:250px;height:300px;object-fit: cover;"
                                                        src="${baseImageurl}/w500${item.poster_path}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h6 class="card-title"><b>${tvTitle}</b></h6><br>
                                                        <span>${ tvYear }</span>
                                                        <h6 class="card-text"><i class="fa-solid fa-thumbs-up" style="color:blue"></i>
                                                            ${ item.vote_average * 10 } %</h6>
                                                        <a href="/tv/${item.id}" class="btn btn-primary"><i
                                                                class="fa-solid fa-play"></i> Detail</a>
                                                    </div>
                                                </div>
                                             </div>`);
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

        function changeSort(component) {
            if (component.value) {
                //set new value
                sort_by = component.value;

                //clear data
                $("#dataWrapper").html("");

                //reset page value
                page = 0;

                //get data
                LoadMore();


            }

        }
    </script>

@endsection
