@extends('app')
@section('title')
{{ $titleData->titlename }} - My Movie List - Title


@endsection
@section('content')
<style>
    div {
        /* border: 1px solid black; */
    }

    .nav {
        margin: 0
    }

    .hide {
        display: none;
    }

    a {
        color: black;
        text-decoration: none;
    }

    .hidden {
        display: none;
    }

    p {
        /* line-height: 18px;
        height: 54px;
        overflow: hidden; */
    }

    .hide {
        display: none;
    }

    .visibleElem {
        color: aqua;
    }

    .hiddenElem1 {
        display: none;
    }

    .hiddenElem {
        display: none;
    }

    .fav-button {
        color: blue;
    }

    .fav-button:hover {
        color: white;
        background-color: blue;
        cursor: pointer;
        text-decoration-line: underline;
    }

    .spoiler {
        filter: blur(5px);
        transition-property: -webkit-filter;
        transition-duration: .4s;
    }

    .spoiler:hover,
    .spoiler:focus {
        filter: blur(0px);
    }

</style>
@php
$imageWidth='250px';
$actor=null;
$staff=null;
$reviewPara=null;
$home=null;
if($sort=='actor'){
$actor='active';
}elseif($sort=='staff'){
$staff='active';
}elseif($sort=='reviews'){
$reviewPara='active';
}else{
$home='active';
}
@endphp
{{-- {{$titleStaff}} --}}
{{-- {{$userTitelDetail}}
{{count($userTitelDetail)}} --}}
<div class="title">
    <h1>
        {{ $titleData->titlename }}
    </h1>
    @if($titleData->nepaliname!=null)
    <h3 style="padding-bottom:0.3em; ">{{'( '.$titleData->nepaliname.')' }}</h3>
    @endif

    {{-- <h2></h2> --}}
</div>
<div id='extraphp' style="display: none">
</div>
<div>
    <div class="container-xxl text-center">
        <div class="row">
            <div class="col-md-auto text-center border-l-b">
                <div>
                    <img class="img-fluid img-thumbnail" style="max-width:{{$imageWidth}}" src="{{ $titleData->image }}" onerror="this.onerror=null;this.src={{URL::asset('/No-Image-Placeholder.svg.png')}}">
                </div>
                <div class="text-start">
                    @if(Session::has('userInfo'))
                    <hr>
                    <div class="fav-button" id="addToFaviourite">Add To Favioutite</div>
                    <hr>
                    <div class="fav-button hidden" id="editDetails" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Details</div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Title Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="container modal-body text-start gap-6 border-l-r-b">
                                    <div class="row ">
                                        <div class="col "><strong>Title</strong> </div>
                                        <div class="col " id="editTitleName"></div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col "><strong>Status</strong> </div>
                                        <div id="" class="col ">
                                            <select class="form-control " name="cars" id="editWatchStat">
                                                <option value='Watching'>Watching</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Plan To Watch">Plan To Watch</option>
                                                <option value="On-Hold">On-hold</option>
                                                <option value="Dropped">Dropped</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col "><strong> Episodes Watched</strong></div>
                                        <div class="col m p">
                                            <input type="number" id="editEpisodes" value="0" class="form-control" max="{{ $titleData->noOfEpisodes }}" min="0">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col "><strong>Your Score</strong> </div>
                                        <div class="col ">
                                            <select class="form-control " name="cars" id="editScore">
                                                <option value='null'>⭐Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row  ">
                                        <div class="col "><strong>Start Date</strong> </div>
                                        <div class="col "><input type="date" class="form-control" name="dob" placeholder="" id="editStartdate" value="" required></div>
                                    </div>
                                    <hr>
                                    <div class="row  ">
                                        <div class="col "><strong>Finish Date</strong> </div>
                                        <div class="col "><input type="date" class="form-control" name="dob" placeholder="" id="editFinishdate" value="" required></div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="modal-footer">
                                    <form action="javascript:void(0)" id="deleteTitle" method="POST">

                                        @csrf
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                    </form>
                                    <form action="javascript:void(0)" id="" method="get">
                                        @csrf
                                        <button id="editDataSave" type="button" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @endif
                    <br>
                    <hr>
                    <div>
                        <h5><strong>Information</strong> </h5>
                        <hr>
                        <div><strong>Type:</strong> {{ $titleData->titleType==null?"N/A":$titleData->titleType }}</div>
                        <hr>
                        <div><strong> Episodes:</strong> {{ $titleData->noOfEpisodes==null?'N/A':$titleData->noOfEpisodes }}</div>
                        <hr>
                        <div><strong>Status:</strong>
                            @if($titleData->startdate==null)
                            N/A
                            @else
                            @if(date("Y-m-d")>=$titleData->startdate && date("Y-m-d")<=$titleData->enddate)
                                Currently Airing
                                @elseif (date("Y-m-d")<=$titleData->startdate)
                                    Not yet aired
                                    @elseif(date("Y-m-d")>=$titleData->enddate)
                                    Finished Airing
                                    @endif
                                    @endif
                        </div>
                        <hr>
                        <div><strong>Aired: </strong> {{ $titleData->startdate==null?"N/A": $titleData->startdate }}
                            @if($titleData->enddate!=null)
                            To {{ $titleData->enddate}}
                            @else
                            @endif
                        </div>
                        <hr>
                        <div><strong>Source:</strong> orignal</div>
                        <hr>
                        <div class="text-start"><strong>Genres:</strong>
                            @foreach ($titleGenre as $genre )
                            {{-- <span class=""> --}}
                            <a href="{{ route('genre',['genres'=>$genre->genre_id]) }}">{{$genre->genreName}}
                                {{-- sfsdfsdfsdf --}}
                            </a>
                            {{$loop->last ? '' : ','}}
                            {{-- </span> --}}
                            @endforeach
                        </div>
                        <hr>
                        <div><strong>Duration:</strong> {{ $titleData->avrageEpisodeDuration==null?"N/A":$titleData->avrageEpisodeDuration." min. per ep." }} </div>
                        <hr>
                        <div><strong>Rating: </strong> {{ $titleData->rating==null? "N/A":$titleData->rating  }}</div>
                        <hr>
                        <br>
                        <h5><strong>Statistics</strong> </h5>
                        <hr>
                        <div><strong> Score: </strong> {{ $avrageScore==null ? 'Na':round($avrageScore,2)}}</div>
                        <hr>
                        <div><strong>Ranked: </strong>
                            @if(count($totalRank)>0)
                            {{ $totalRank[0]->rank }}
                            @else
                            Na
                            @endif
                        </div>
                        <hr>
                        <div><strong>Popularity: </strong>
                            @if(count($totalRank)>0)
                            {{ $popularity[0]->rank }}
                            @else
                            Na
                            @endif
                        </div>
                        <hr>
                        <div><strong> Members: </strong>{{ $noOfMebers }}</div>
                        <hr>
                        <div id="favCounter"><strong>Favorites: </strong> {{ $noOfFaviourite }}</div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col border-l-r-b">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $home }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $actor }}" id="actors-tab" data-bs-toggle="tab" data-bs-target="#actors-tab-pane" type="button" role="tab" aria-controls="actors-tab-pane" aria-selected="false">Actors</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $staff }}" id="staffs-tab" data-bs-toggle="tab" data-bs-target="#staffs-tab-pane" type="button" role="tab" aria-controls="staffs-tab-pane" aria-selected="false">Staff</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $reviewPara }}" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show  {{ $home }}" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div>
                            <div class="container-xxl text-center">
                                <hr>
                                <div class="row">
                                    <div class="col">Score: {{ $avrageScore==null ? 'Na':round($avrageScore,2) }}</div>
                                    <div class="col">Ranked:
                                        @if(count($totalRank)>0)
                                        {{ $totalRank[0]->rank }}
                                        @else
                                        Na
                                        @endif
                                    </div>
                                    <div class="col">Popularity:
                                        @if(count($totalRank)>0)
                                        {{ $popularity[0]->rank }}
                                        @else
                                        Na
                                        @endif
                                    </div>
                                    <div class="col">Members: {{ $noOfMebers }} </div>
                                </div>
                                <hr>
                                <div id="btn-container" class="row" style="pointer-events: none;">

                                    <form action="javascript:void(0)" method="post" class="col visibleElem" id='addTitleFrm'>
                                        @csrf
                                        <div id='addTitle' class="col">
                                            <button id='titleaddBtn' type="submit" name="submit" class="form-control m-2 ">Add to list</button>
                                        </div>
                                    </form>
                                    <div id="myDropdown" class="col hiddenElem">
                                        <select class="form-control m-2 btn btn-outline-primary" name="cars" id="exampleFormControlSelect11">
                                            <option class="" value='Watching'>Watching</option>
                                            <option class="" value="Completed">Completed</option>
                                            <option class="" value="Plan To Watch">Plan To Watch</option>
                                            <option class="" value="On-Hold">On-hold</option>
                                            <option class="" value="Dropped">Dropped</option>
                                        </select>
                                    </div>
                                    <div id="score" class="col">
                                        <select class="form-control m-2 " name="cars" id="exampleFormControlSelect1">
                                            <option value='null'>⭐Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="number" id="episodes" value='0' class="form-control m-2" max="{{ $titleData->noOfEpisodes }}" min="0">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="text-start"><strong>Synopsis</strong> </h5>
                            <hr>
                            <hr>
                            <div class="container-xxl text-start">
                                {{ $titleData->sypnosis==null? 'No synopsis':$titleData->sypnosis }}
                            </div>
                            <hr>
                            <h5 class="text-start"><strong>Awards</strong> </h5>
                            <hr>
                            <div class="container-xxl text-start">
                                {{ $titleData->awards==null? 'No Awards':$titleData->awards }}

                            </div>
                            <hr>
                            <div class='container-xxl text-center '>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-start">Characters & Actors</h5>
                                    </div>
                                    <div class="col text-end">
                                        <a href="#"></a>
                                    </div>
                                </div>
                                <div class="container-fluid col">
                                    @if(count($titleStaff)<=0 ||$titleStaff==null) No charaacters Associated with this title @else <table class="table table-striped table-hover">
                                        <tbody>
                                            @php
                                            $count=0;
                                            @endphp
                                            @for ($i = 0; $i < count($titleStaff); $i++) @if ($titleStaff[$i]->staffType=='Actor' && $count<5) <tr>
                                                    <td>
                                                        @php
                                                        $count++;
                                                        @endphp
                                                        <a href="{{ route('character',['character'=>$titleStaff[$i]->char_id]) }}">
                                                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->characterImage }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                                                        </a>
                                                    </td>
                                                    <td class="text-start">
                                                        <a href="{{ route('character',['character'=>$titleStaff[$i]->char_id]) }}">
                                                            {{ $titleStaff[$i]->characterName }}
                                                        </a>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                            {{ $titleStaff[$i]->firstname }} {{ $titleStaff[$i]->miiddlename }} {{ $titleStaff[$i]->lastname }}
                                                        </a>
                                                        </th>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->staff_image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                                                        </a>
                                                    </td>
                                                    </tr>
                                                    @else
                                                    @endif
                                                    @endfor
                                        </tbody>
                                        </table>
                                        @endif
                                </div>
                            </div>
                            <hr>
                            <div class='container-xxl text-center'>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-start">Staff</h5>
                                    </div>
                                    <div class="col text-end">
                                        <a href="#"></a>
                                    </div>
                                </div>
                                <div class='container-fluid col text-start'>
                                    @if(count($titleStaff)<=0 ||$titleStaff==null) No Staffs Associated with this title @else <table class="table table-striped table-hover">
                                        <tbody>
                                            @php
                                            $count=0;
                                            @endphp
                                            @for ($i = 0; $i < count($titleStaff); $i++) @if ($titleStaff[$i]->staffType!=='Actor' && $count<5) @php $count++; @endphp <tr>
                                                    <td scope="col">
                                                        <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                            {{ $titleStaff[$i]->firstname }} {{ $titleStaff[$i]->miiddlename }} {{ $titleStaff[$i]->lastname }}
                                                        </a>
                                                        <br>
                                                        <small>
                                                            {{ $titleStaff[$i]->staffType }}
                                                        </small>
                                                        </th>
                                                    <td class="text-end">
                                                        <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->staff_image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                                        </a>
                                                    </td>
                                                    </tr>
                                                    @endif
                                                    @endfor
                                        </tbody>
                                        </table>
                                        @endif
                                        {{-- <div class="container-fluid col text-start"> --}}
                                        {{-- </div> --}}
                                </div>
                                <hr>
                                @if(session()->has('userInfo'))
                                <div class="">
                                    <form action="javascript:void(0)" method="post" class="" id='addCommentFrm'>
                                        @csrf
                                        <div class="text-start mb-3">
                                            {{-- <label for="exampleFormControlTextarea1" class="form-label text-start"> --}}
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">Write a Review</div>
                                                    <div class="col text-end">
                                                        <input class="form-check-input" type="checkbox" id="invalidCheck">
                                                        Spoiler
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            <button id='commentaddbtn' type="submit" name="submit" class="form-control">Add Review</button>
                                        </div>
                                    </form>
                                </div>
                                @else
                                @endif
                                <div id="reviewsHome" class="container-xxl">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-start">Reviews</h5>
                                        </div>
                                        <div class="col text-end">
                                            <a href="#"></a>
                                        </div>
                                    </div>
                                    @if(count($reviews)<=0 ||$reviews==null) No reviews @else @foreach ($reviews as $review) <div class="row">
                                        <div class="col-md-auto">
                                            <a href="{{ route('user',['user'=>$review->username]) }}">
                                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $review->user_image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-sm text-start"><a href="{{ route('user',['user'=>$review->username]) }}">{{$review->username}}</a> </div>
                                                <div class="col-sm text-end">{{$review->created_at==null ? 'Na': $review->created_at->diffForHumans()}}</div>
                                            </div>
                                            <div class="row text-start">
                                                <div class="post {{ $review->rw_type ? 'spoiler':'' }}">
                                                    <p style="white-space: pre-line" class="content text-break"> {{ stripslashes($review->rw_content) }}</p>

                                                    <a onclick="readMore(this)">Read More</a>
                                                </div>
                                                {{-- <p id="review">
                                        {{ $review->rw_content }}
                                                </p>
                                                <a id="load" onclick="lodemore(this)">Load More</a> --}}
                                            </div>
                                            {{-- <div class="row text-start">like or something</div> --}}
                                        </div>
                                </div>
                                <hr>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tab-pane fade show {{ $actor }}" id="actors-tab-pane" role="tabpanel" aria-labelledby="actors-tab" tabindex="0">
                    <div>
                        @if(count($titleStaff)<=0 ||$titleStaff==null) No charaacters Associated with this title @else <table class="table table-striped table-hover">
                            <tbody>
                                @for ($i = 0; $i < count($titleStaff); $i++) @if ($titleStaff[$i]->staffType=='Actor')
                                    <tr>
                                        <td>
                                            <a href="{{ route('character',['character'=>$titleStaff[$i]->char_id]) }}">
                                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->characterImage }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                                            </a>
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('character',['character'=>$titleStaff[$i]->char_id]) }}">
                                                {{ $titleStaff[$i]->characterName }}
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                {{ $titleStaff[$i]->firstname }} {{ $titleStaff[$i]->miiddlename }} {{ $titleStaff[$i]->lastname }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->staff_image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                            </table>
                            @endif
                    </div>
                </div>
                <div class="tab-pane fade show {{ $staff }}" id="staffs-tab-pane" role="tabpanel" aria-labelledby="staffs-tab" tabindex="0">
                    <div>
                        @if(count($titleStaff)<=0 ||$titleStaff==null) No Staffs Associated with this title @else <table class="table table-striped table-hover">
                            <tbody>
                                @for ($i = 0; $i < count($titleStaff); $i++) @if ($titleStaff[$i]->staffType!='Actor') <tr>
                                        <td class="text-start">
                                            <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                {{ $titleStaff[$i]->firstname }} {{ $titleStaff[$i]->miiddlename }} {{ $titleStaff[$i]->lastname }}
                                            </a>
                                            <br>
                                            <small>
                                                {{ $titleStaff[$i]->staffType }}
                                            </small>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('staff',['staff'=>$titleStaff[$i]->staff_id]) }}">
                                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titleStaff[$i]->staff_image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </tbody>
                            </table>
                            @endif
                    </div>
                </div>
                <div class="tab-pane fade show {{ $reviewPara }}" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">

                    <div>
                        @if(count($reviews)<=0 ||$reviews==null) No reviews @else @foreach ($reviews as $review) <div class="row">
                            <div class="col-md-auto">
                                <a href="{{ route('user',['user'=>$review->username]) }}">
                                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $review->user_image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                </a>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm text-start"><a href="{{ route('user',['user'=>$review->username]) }}">{{$review->username}}</a> </div>
                                    <div class="col-sm text-end">{{$review->created_at==null ? 'Na': $review->created_at->diffForHumans()}}</div>
                                </div>
                                <div class="row text-start">
                                    <div class="post {{ $review->rw_type ? 'spoiler':'' }}">
                                        <p style="white-space: pre-line" class="content text-break"> {{ stripslashes($review->rw_content) }}</p>
                                        <a onclick="readMore(this)">Read More</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
@endsection
@section('extraScripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var userInfo = null;
    var submitForm = true;
    var favCount = parseInt("{{ $noOfFaviourite }}");

    // console.log(userInfo);
    jQuery('#commentaddbtn').click(function(e) {
        e.preventDefault();
        if (userInfo == '[]') {
            alert('add to list first');
        } else {
            var url = "{{ route('addTitleReview',['title_id' => $titleData->title_id,'comment' => ':a','commentType'=>':b'])}}"
            url = url.replace(':a', encodeURIComponent(document.getElementById('exampleFormControlTextarea1').value.replace(/(?:\r\n|\r|\n)/g, '<br>')));
            url = url.replace(':b', document.getElementById('invalidCheck').checked == true ? 1 : 0);
            // console.log(url);
            jQuery.ajax({
                url: url
                , data: jQuery('#addCommentFrm').serialize()
                , type: 'post'
                , success: function(result) {
                    // alert('success');
                    location.reload();
                    // a();
                }
                , error: function(result) {
                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = result.responseJSON.message.split(':')[0] == 'SQLSTATE[23000]' ? "You have already added review to this title edit it or delete to submit again" : 'try again';
                    // console.log(result.responseJSON.message.split(':')[0]);
                    document.getElementById('req-status').textContent = "❌"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                }
            , });
        }
    });
    const titleaddBtnClick = () => {
        const addForm = document.getElementById("addTitleFrm");
        const watchingStat = document.getElementById("myDropdown");
        addForm.classList.add("hiddenElem");
        addForm.classList.remove("visibleElem");
        watchingStat.classList.add("visibleElem");
        watchingStat.classList.remove("hiddenElem");
    }
    const disableButtons = () => {
        document.getElementById('titleaddBtn').disabled = true;
        document.getElementById('exampleFormControlSelect1').disabled = true;
        document.getElementById('episodes').disabled = true;
        // console.log('bbbbb');
    }

    function setEditDetails(userInfo) {
        // console.log(userInfo);
        document.getElementById('editTitleName').textContent = "{{ $titleData->titlename }}";
        document.getElementById('editEpisodes').value = userInfo[0].ut_episodewatched;
        document.getElementById('editScore').value = userInfo[0].ut_score, (userInfo[0].ut_score == null ? '⭐Select' : userInfo[0].ut_score);
        document.getElementById('editStartdate').valueAsDate = userInfo[0].ut_startdate == null ? new Date() : new Date(userInfo[0].ut_startdate);
        document.getElementById('editFinishdate').valueAsDate = userInfo[0].ut_enddate == null ? new Date() : new Date(userInfo[0].ut_enddate);
        document.getElementById('editWatchStat').value = userInfo[0].ut_watchingstatus, userInfo[0].ut_watchingstatus;
        changeComboStyle(userInfo[0].ut_watchingstatus);
    }

    function a() {
        // console.log('a');
        // console.log(userInfo.length);
        if (userInfo == '[]') {
            // e.preventDefault();
            // console.log("{{$titleData->id}}");
            var www = document.getElementById('exampleFormControlSelect11').value;
            var scor = document.getElementById('exampleFormControlSelect1').value;
            var epi = document.getElementById('episodes').value;
            var url = "{{ route('/') }}" + `/addUserTitle/{{ $titleData->title_id }}/${www}/${scor}/${epi}`;
            jQuery.ajax({
                url: url
                , data: jQuery('#addTitleFrm').serialize()
                , type: 'post'
                , success: function(result) {
                    submitForm = true


                    userInfo = result.userTitelDetail;
                    // console.log(userInfo)
                    document.getElementById('editDetails').classList.remove('hidden');
                    setEditDetails(userInfo);
                    // console.log('here');
                    titleaddBtnClick();
                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = "Added To Your List"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                    changeComboStyle("Watching");

                }
                , error: function(result) {
                    submitForm = true


                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = result.responseJSON.message

                    document.getElementById('req-status').textContent = "❌"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()


                }
            , });
        } else {
            var www = document.getElementById('exampleFormControlSelect11').value;
            var scor = document.getElementById('exampleFormControlSelect1').value;
            var epi = document.getElementById('episodes').value;
            var url = "{{ route('/') }}" + `/updateWtchStatus/{{ $titleData->title_id }}/${www}/${scor}/${epi}`;
            jQuery.ajax({
                url: url
                , type: 'get'
                , success: function(result) {
                    submitForm = true


                    // alert('success');
                    userInfo = result.userTitelDetail;
                    // console.log(result.userTitelDetail)
                    document.getElementById('editDetails').classList.remove('hidden');
                    setEditDetails(userInfo);
                    // console.log('here');
                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = "Edited Title Status"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                    changeComboStyle(document.getElementById('exampleFormControlSelect11').value);
                }
                , error: function(result) {
                    submitForm = true


                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = result.responseJSON.message

                    document.getElementById('req-status').textContent = "❌"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()

                }
            , });
            // console.log(url);
        }
        // document.getElementById("btn-container").style.pointerEvents = "auto";

    }

    function readMore(btn) {
        let post = btn.parentElement;
        post.querySelector(".dots").classList.toggle("hide");
        post.querySelector(".more").classList.toggle("hide");
        btn.textContent == "Read More" ? btn.textContent = "Read Less" : btn.textContent = "Read More";
    }

    function commentRender() {
        let noOfCharac = 150;
        let contents = document.querySelectorAll(".content");
        contents.forEach(content => {
            //If text length is less that noOfCharac... then hide the read more button
            if (content.textContent.includes('<br>')) {
                let displayText = content.textContent.slice('<br>');
                let moreText = content.textContent;
                content.innerHTML = `${content.textContent.slice(0,content.textContent.indexOf('<br>'))}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
            } else if (content.textContent.length < noOfCharac) {
                content.nextElementSibling.style.display = "none";
            } else {
                let displayText = content.textContent.slice(0, noOfCharac);
                let moreText = content.textContent.slice(noOfCharac);
                content.innerHTML = `${displayText}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
            }
        });
    }

    function chkText() {
        // console.log(document.getElementById('exampleFormControlTextarea1').value)
        // console.log(document.getElementById('exampleFormControlTextarea1').value.length)
        if (document.getElementById('exampleFormControlTextarea1').value.length <= 0) {
            document.getElementById('commentaddbtn').disabled = true;
        } else {
            document.getElementById('commentaddbtn').disabled = false;
        }
    }
    $('document').ready(() => {
        document.getElementById("btn-container").style.pointerEvents = "auto";



        userInfo = "{{ $userTitelDetail }}";
        // console.log(userInfo);
        // console.log("{{ $userTitelDetail }}");

        if (userInfo != '[]' && userInfo != '' && userInfo != null) {
            userInfo = userInfo.replace(/&quot;/g, '\"');
            // console.log(userInfo);
            userInfo = JSON.parse(userInfo);
            // console.log(userInfo);
            titleaddBtnClick();
            setInputData(userInfo);
            document.getElementById('editDetails').classList.remove('hidden');
            setEditDetails(userInfo);
            // console.log('here');
            if (userInfo[0].ut_faviourite) {
                // console.log('a')
                document.getElementById('addToFaviourite').innerText = "Remove from Favioutite";
            }
        } else {
            // console.log(':p')
            // console.log(userInfo.length);
            // console.log(userInfo);

        }
        if ("{{ Session::has('userInfo') }}") {
            document.getElementById('exampleFormControlTextarea1').value = ''
            chkText();
            document.getElementById('exampleFormControlTextarea1').addEventListener('input', () => {
                chkText();
            })


            document.getElementById('editDataSave').addEventListener('click', () => {
                // console.log('saveEditTitle');
                var www = document.getElementById('editWatchStat').value;
                var scor = document.getElementById('editScore').value;
                var epi = document.getElementById('editWatchStat').value == 'Completed' ? "{{ $titleData->noOfEpisodes }}" : document.getElementById('editEpisodes').value;
                var stDate = document.getElementById('editStartdate').value;
                var edDate = document.getElementById('editFinishdate').value;
                var url = "{{ route('/') }}" + `/saveEditTitle/{{ $titleData->title_id }}/${www}/${scor}/${epi}/${stDate}/${edDate}`;
                // console.log(url)
                jQuery.ajax({
                    url: url
                    , type: 'get'
                    , success: function(result) {
                        location.reload();
                    }
                    , error: function(result) {
                        const toastLiveExample = document.getElementById('liveToast')
                        document.getElementById('suscess-message').textContent = result.responseJSON.message

                        document.getElementById('req-status').textContent = "❌"
                        const toast = new bootstrap.Toast(toastLiveExample)
                        toast.show()

                    }
                , });
            });
            document.getElementById('addToFaviourite').addEventListener('click', () => {
                // alert('clicked');
                // console.log(userInfo);
                if (userInfo == '[]') {
                    // alert('Add to list first')
                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = "Add to list first"

                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()

                } else if (userInfo[0].ut_faviourite) {
                    var url = "{{ route('addToFaviourite',['title_id' => $titleData->title_id,'addOrRemove'=>0]) }}"
                    // console.log('aaaaaa')
                    jQuery.ajax({
                        url: url
                        , type: 'get'
                        , success: function(result) {
                            // alert('success');
                            userInfo[0].ut_faviourite = 0;
                            favCount--;
                            document.getElementById('addToFaviourite').innerText = "Add To Favioutite";
                            document.getElementById('favCounter').innerHTML = "<strong>Favorites:</strong>" + favCount;

                            const toastLiveExample = document.getElementById('liveToast')
                            document.getElementById('suscess-message').textContent = "Removed from Favioutites"
                            const toast = new bootstrap.Toast(toastLiveExample)
                            toast.show()

                        }
                        , error: function(result) {
                            const toastLiveExample = document.getElementById('liveToast')
                            document.getElementById('suscess-message').textContent = result.responseJSON.message

                            document.getElementById('req-status').textContent = "❌"
                            const toast = new bootstrap.Toast(toastLiveExample)
                            toast.show()

                        }
                    , });
                } else {
                    var url = "{{ route('addToFaviourite',['title_id' => $titleData->title_id,'addOrRemove'=>1]) }}"
                    // console.log('bbbbb')
                    jQuery.ajax({
                        url: url
                        , type: 'get'
                        , success: function(result) {
                            // alert('success');
                            if (result.responseErr != 'Already have max favorite movie added') {
                                userInfo[0].ut_faviourite = 1;
                                favCount++;
                                document.getElementById('addToFaviourite').innerText = "Remove from Favioutite";
                                document.getElementById('favCounter').innerHTML = "<strong>Favorites:</strong> " + favCount;
                                const toastLiveExample = document.getElementById('liveToast')
                                document.getElementById('suscess-message').textContent = "Added To Favioutites"
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show()
                            } else {
                                // alert(result.responseErr);
                                const toastLiveExample = document.getElementById('liveToast')
                                document.getElementById('suscess-message').textContent = result.responseErr
                                document.getElementById('req-status').textContent = "❌"
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show()

                            }
                        }
                        , error: function(result) {
                            const toastLiveExample = document.getElementById('liveToast')
                            document.getElementById('suscess-message').textContent = result.responseJSON.message

                            document.getElementById('req-status').textContent = "❌"
                            const toast = new bootstrap.Toast(toastLiveExample)
                            toast.show()

                        }
                    , });
                }
            });

        } else {
            disableButtons();
        }
        let noOfCharac = 150;
        let contents = document.querySelectorAll(".content");
        contents.forEach(content => {
            //If text length is less that noOfCharac... then hide the read more button
            if (content.textContent.includes('<br>')) {
                let displayText = content.textContent.slice('<br>');
                let moreText = content.textContent;
                content.innerHTML =
                    `${content.textContent.slice(0,content.textContent.indexOf('<br>'))}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
            } else if (content.textContent.length < noOfCharac) {
                content.nextElementSibling.style.display = "none";
            } else {
                let displayText = content.textContent.slice(0, noOfCharac);
                let moreText = content.textContent.slice(noOfCharac);
                content.innerHTML = `${displayText}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
            }
        });


    });
    jQuery('#deleteTitle').click(function(e) {
        e.preventDefault();
        var url = "{{ route('deleteUserTitle',['title_id'=>$titleData->title_id]) }}"
        // console.log('edit', url);
        jQuery.ajax({
            url: url
            , data: jQuery('#addCommentFrm').serialize()
            , type: 'post'
            , success: function(result) {
                // alert('success');
                // $("#reviewTab").load(window.location.href + " #reviewTab");
                // $("#reviewsHome").load(window.location.href + " #reviewsHome");
                location.reload();
                // a();
            }
            , error: function(result) {
                const toastLiveExample = document.getElementById('liveToast')
                document.getElementById('suscess-message').textContent = result.responseJSON.message

                document.getElementById('req-status').textContent = "❌"
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()

            }
        , });
    });

    const setInputData = (userInfo) => {
        document.getElementById('episodes').value = userInfo[0].ut_episodewatched;
        document.getElementById('exampleFormControlSelect1').value = userInfo[0].ut_score;
        document.getElementById('exampleFormControlSelect11').value = userInfo[0].ut_watchingstatus;
        changeComboStyle(userInfo[0].ut_watchingstatus);
    }

    function changeComboStyle(watStat) {
        switch (watStat) {
            case "Watching":
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-success";
                break;
            case "Completed":
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-primary";
                break;
            case "Plan To Watch":
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-secondary";
                break;
            case "On-Hold":
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-warning";
                break;
            case "Dropped":
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-danger";
                break;
            default:
                document.getElementById("exampleFormControlSelect11").className = "form-control m-2 btn btn-outline-primary";
        }

    }
    document.getElementById('exampleFormControlSelect11').addEventListener('change', () => {
        if (document.getElementById('exampleFormControlSelect11').value == 'Completed') {
            document.getElementById('episodes').value = "{{ $titleData->noOfEpisodes }}";
        }
        // document.getElementById("btn-container").style.pointerEvents = "none";
        if (submitForm) {
            submitForm = false
            a();
        }

        // document.getElementById("btn-container").style.pointerEvents = "auto";
    });
    document.getElementById('exampleFormControlSelect1').addEventListener('change', () => {
        // document.getElementById("btn-container").style.pointerEvents = "none";

        if (submitForm) {
            submitForm = false
            a();
        }

        // document.getElementById("btn-container").style.pointerEvents = "auto";
    });
    document.getElementById('episodes').addEventListener('change', () => {
        // document.getElementById("btn-container").style.pointerEvents = "none";

        if (submitForm) {
            submitForm = false
            a();
        }

        // document.getElementById("btn-container").style.pointerEvents = "auto";
    });


    jQuery('#addTitleFrm').click(function(e) {
        // document.getElementById("btn-container").style.pointerEvents = "auto";
        if (submitForm) {
            submitForm = false
            a();
        }

        // document.getElementById("btn-container").style.pointerEvents = "auto";

    });

</script>
@endsection
