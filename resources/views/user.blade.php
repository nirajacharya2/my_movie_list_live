@extends('app')
@section('title')
{{ $userData->username }} - My Movie List - Users

@endsection

@section('content')
<style>
    div {
        /* border: 1px solid black; */
    }

    hr {
        /* padding: 0 1rem 0 1rem; */
    }

    ul>li {
        /* display: inline-block; */
        /* You can also add some margins here to make it look prettier */
    }

    .fav-ul {
        /* width: 100%;
        white-space: nowrap;
        overflow: auto; */

        width: 100%;
        white-space: nowrap;
        scroll-snap-type: inline mandatory;
        scroll-padding-inline: 1rem;
        overflow: auto;

    }

    .fav-li {
        float: left;
        margin: 0.5em;
        list-style: none;
        display: inline;


    }

    .fav-image {
        width: 100px;
        height: 140px;
        transition: 0.5s;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-position: center;
        background-size: cover;
    }

    .fav-image p {
        opacity: 0;
        transform: scale(0);
        text-size-adjust: 80%;

        transition: 0.2s;
        color: white;
    }

    .fav-image:hover {
        box-shadow: 0 0 0 100px rgba(20, 17, 17, 1)inset;
    }

    .fav-image:hover p {
        opacity: 1;
        transform: scale(1);
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
$imageWidth = '250px';
$watching = 0;
$completed = 0;
$onhold = 0;
$dropped = 0;
$Plan2w = 0;
$daysWatched=0;
$reviewPara=null;
$commentPara=null;

$home=null;
if($sort=='reviews'){
$reviewPara='active';
}elseif($sort=='comments'){
$commentPara='active';

}else {
$home='active';
}
@endphp
{{-- {{ $lastUpdated }} --}}
{{-- {{ $favioriteTitle }} --}}
{{-- {{ $userComments }} --}}
{{-- {{ $favioriteStaff }}

{{ $favioriteChar }} --}}

{{-- {{ $reviews }} --}}



<div class="container-xxl title">
    <div class="row">
        <div class="col">
            <h1>{{ $userData->username == null ? 'Na' : $userData->username }} </h1>
        </div>
        @if(session()->has('userInfo'))
        @if(session()->get('userInfo')->username==$userData->username)
        <div class="col text-end p-2 m-2"><a href="#" class="md-auto" data-bs-toggle="modal" data-bs-target="#userModal" onclick="aboutme(this)">Edit</a></div>


        {{-- <a href="#" onclick="aboutme(this)">Edit</a> --}}


        @endif
        @endif

        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button> --}}
        <!-- Modal -->
        <div class=" modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bordeR">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Your Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('updateUser') }}" method="POST">
                        @csrf
                        <div class="modal-body bordeR">

                            <input type="hidden" name="username" value="{{ $userData->username }}">

                            <div class="row">
                                <div class="col"><strong>Sex</strong></div>
                                <div class="col">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" value='1' name="sex" id="btnradio1" required autocomplete="off" {{ $userData->user_sex==1?'checked':"" }}>
                                        <label class="btn btn-outline-primary" for="btnradio1">Male</label>
                                        <input type="radio" class="btn-check" value='0' name="sex" id="btnradio2" required autocomplete="off" {{ $userData->user_sex==0?'checked':"" }}>
                                        <label class="btn btn-outline-primary" for="btnradio2">Female</label>
                                    </div>
                                    <span class="text-danger">@error('sex'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <hr>
                            <br>



                            <div class="row  ">
                                <div class="col "><strong>Birthday</strong> </div>
                                <div class="col "><input type="date" class="form-control" name="dob" placeholder="" id="editStartdate" value="{{ $userData->user_dob }}" required></div>
                            </div>
                            <hr>
                            <br>



                            <div class="row">
                                <div class="col"><strong>Profile Picture</strong></div>
                                <div class="col">
                                    {{-- <label for="validationDefault01" class="form-label">Username</label> --}}
                                    <input type="text" class="form-control" id="" name="pfpPicture" placeholder="" value="{{ $userData->user_image}}">
                                    <span class="text-danger">@error('pfpPicture'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <hr>
                            <br>



                            <div class="row">
                                <div class="col"><strong>Location</strong></div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="location" placeholder="" value="{{ $userData->user_location}}">
                                    <span class="text-danger">@error('location'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <hr>
                            <br>



                            <div class="row">
                                <div class="col"><strong>Socialmedia</strong></div>
                                <div class="col">
                                    <input type="text" class="form-control" id="" name="socialmedia" placeholder="" value="{{ $userData->user_socialmedia}}">
                                    <span class="text-info">If multiple seprate by comma</span>

                                    <span class="text-danger">@error('socialmedia'){{ $message}}@enderror</span>
                                </div>
                            </div>
                            <hr>
                            <br>


                            <div class="row">
                                <div class="col"><strong>About Me</strong></div>
                                <div class="text-start">
                                    <textarea class="form-control" contenteditable="true" id="aboutMe" name="aboutme" placeholder="" rows="3"></textarea>
                                </div>
                            </div>
                            <br>

                            <hr>
                            <div class="row"></div>
                            <div class="row"></div>
                            <div class="row"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-xxl text-center">
    <div class="row">
        <div class="col-md-auto text-center border-l-b">

            <div>
                <img class="img-fluid" style="max-width:{{ $imageWidth }}" src="{{ $userData->user_image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
            </div>
            <hr>
            <div class="text-start">
                <div><strong>Last Online:</strong> </div>
                <hr>
                <div><strong>Gender:</strong> {{ $userData->user_sex ? 'Male' : 'Female' }}</div>
                <hr>
                <div><strong>Birthday:</strong> {{ $userData->user_dob }}</div>
                <hr>
                <div><strong>Location:</strong> {{ $userData->user_location == null ? 'NA' : $userData->user_location }}</div>
                <hr>
                <div><strong>Joined:</strong> {{ $userData->created_at == null ? 'NA' :date_format($userData->created_at,' M d Y')  }}</div>
                @if($userData->user_location!=null)
                <div><strong>Location:</strong> {{ date_format($userData->created_at,' M d Y')  }}</div>
                <hr>
                @else
                @endif
                <hr>


                @if($userData->user_socialmedia!=null)
                @php
                $myString = $userData->user_socialmedia;
                $myArray = explode(',', $myString);
                @endphp
                <div>
                    <div><strong>Social Medias </strong>
                        <br>
                        <hr>
                        @foreach ($myArray as $link)
                        <a href="{{ $link }}">{{ explode('.',parse_url($link)['host'])[0] }} </a>
                        <br>
                        <hr>
                        @endforeach
                    </div>
                </div>
                @endif

                <div><a href="{{ route('userList', ['username' => $userData->username]) }}">Movie List</a></div>


                {{-- <div><a href="#">Reviews</a></div> --}}
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="col border-l-r-b">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $home }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>

                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $reviewPara }}" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews-tab-pane" type="button" role="tab" aria-controls="Reviews-tab-pane" aria-selected="false">Reviews</button>


                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $commentPara }}" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments-tab-pane" type="button" role="tab" aria-controls="comments-tab-pane" aria-selected="false">Comments</button>


                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="container-xxl tab-pane fade show {{ $home }}" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                    {{-- <hr> --}}
                    @if($userData->user_aboutme!=null)
                    <div class="row">
                        <strong class="text-start" style="margin-top: 1em">AboutMe</strong>
                        <hr>
                        {{ $userData->user_aboutme }}
                    </div>
                    @endif
                    <hr>
                    <div class="row text-center">
                        <div class="col-sm text-break bordeR">

                            Statistics
                            <hr>
                            <div class="text-start">
                                Movie Stats
                                <hr>
                                @php
                                $divideBy = count($userTitles);
                                if ($divideBy > 0) {
                                foreach ($userTitles as $title) {
                                if ($title->avrageEpisodeDuration!=null) {
                                $daysWatched=$daysWatched+($title->avrageEpisodeDuration*$title->ut_episodewatched);
                                }
                                switch ($title->ut_watchingstatus) {
                                case 'Watching':
                                $watching++;
                                break;
                                case 'Completed':
                                $completed++;
                                break;
                                case 'On-Hold':
                                $onhold++;
                                break;
                                case 'Dropped':
                                $dropped++;
                                break;
                                case 'Plan To Watch':
                                $Plan2w++;
                                break;
                                default:
                                break;
                                }
                                }
                                } else {
                                $divideBy = 1;
                                }
                                @endphp
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-label="Segment one" style="width: {{ ($completed / $divideBy) * 100 }}%" aria-valuenow="{{ $completed }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success" role="progressbar" aria-label="Segment two" style="width: {{ ($watching / $divideBy) * 100 }}%" aria-valuenow="{{ $watching }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three" style="width: {{ ($dropped / $divideBy) * 100 }}%" aria-valuenow="{{ $dropped }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-warning" role="progressbar" aria-label="Segment three" style="width: {{ ($onhold / $divideBy) * 100 }}%" aria-valuenow="{{ $onhold }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-secondary" role="progressbar" aria-label="Segment three" style="width: {{ ($Plan2w / $divideBy) * 100 }}%" aria-valuenow="{{ $Plan2w }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="container  text-start">
                                    {{-- <div class="row"> --}}
                                    Days : <strong>{{ round($daysWatched/1440,2) }}</strong>

                                    {{-- <div class="col-md-auto">Days Watched:</div>

                                    <div class="col"><strong>{{ round($daysWatched/1440,2) }}</strong></div> --}}



                                {{-- </div> --}}
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('userList', ['username' => $userData->username, 'sort' => 'Watching']) }}">
                                            Watching</a>
                                    </div>
                                    <div class=" col text-end">
                                        {{ $watching }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('userList', ['username' => $userData->username, 'sort' => 'completed']) }}">
                                            Completed</a>
                                    </div>
                                    <div class="col text-end">
                                        {{ $completed }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('userList', ['username' => $userData->username, 'sort' => 'on-hold']) }}">
                                            On-Hold</a>
                                    </div>
                                    <div class="col text-end">
                                        {{ $onhold }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('userList', ['username' => $userData->username, 'sort' => 'dropped']) }}">
                                            Dropped</a>
                                    </div>
                                    <div class="col text-end">
                                        {{ $dropped }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('userList', ['username' => $userData->username, 'sort' => 'plan to watch']) }}">
                                            Plan To Watch</a>
                                    </div>
                                    <div class="col text-end">
                                        {{ $Plan2w }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    Total Entries : {{ count($userTitles) }}
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm text-break bordeR">

                        <div class="container-xxl">
                            Last Movie Updates
                            <hr>
                            {{-- {{ $lastUpdated }} --}}
                            @if (count($lastUpdated) <= 0 || $lastUpdated==null) Nothing to see hear @else @foreach ($lastUpdated as $title) <div class="row">
                                <div class="col-auto text-start">
                                    <a href="{{ route('title', ['title' => $title->title_id]) }}">
                                        <img class="image-fluid" style="max-height: 70px;max-width:50px" src="{{ $title->image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                    </a>
                                </div>
                                <div class="col text-start">
                                    <a href="{{ route('title', ['title' => $title->title_id]) }}">
                                        {{ $title->titlename }}
                                    </a>
                                    @php
                                    $watchStat = 'Watching';
                                    switch ($title->ut_watchingstatus) {
                                    case 'Watching':
                                    $watchStat = 'bg-success';
                                    break;
                                    case 'Completed':
                                    $watchStat = '';
                                    break;
                                    case 'On-Hold':
                                    $watchStat = 'bg-warning';
                                    break;
                                    case 'Plan To Watch':
                                    $watchStat = 'bg-secondary';
                                    break;
                                    case 'Dropped':
                                    $watchStat = 'bg-danger';
                                    break;
                                    }
                                    @endphp
                                    <div class="row">
                                        <div class="col text-start">
                                            <div class="progress">
                                                <div class="progress-bar {{ $watchStat }}" role="progressbar" aria-label="" style="width: {{ ($title->ut_episodewatched / $title->noOfEpisodes) * 100 }}%" aria-valuenow="{{ $title->ut_episodewatched }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-noprogress" role="progressbar" aria-label="" style="width: {{ ($title->ut_episodewatched / $title->noOfEpisodes) * 100 - 100 }}%" aria-valuenow="{{ $title->ut_episodewatched - $title->noOfEpisodes }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto text-end">
                                            {{ $title->updated_at == null ? 'NA' : \Carbon\Carbon::parse($title->updated_at)->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="row text-start">
                                        {{ $title->ut_watchingstatus }}
                                        {{ $title->ut_episodewatched }}/{{ $title->noOfEpisodes }} ·
                                        Scored - {{ $title->ut_score }}
                                    </div>
                                </div>
                        </div>
                        @php
                        if(!$loop->last){
                        echo "
                        <hr>";
                        }
                        @endphp
                        {{-- {{$loop->last ? '' : "<hr>"}} --}}
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="container-xxl text-start">
                    Favorites
                    <hr>
                    <div class="row">
                        Titles ({{ count($favioriteTitle) }})
                        <hr>
                        @if(count($favioriteTitle)<=0 || $favioriteTitle==null) No Faviorite Titles @else <ul class="col text-start fav-ul">

                            @foreach ($favioriteTitle as $title)
                            <li class="fav-li">
                                <a class="" href="{{ route('title',['title' => $title->title_id])}}" style="">
                                    <div class="fav-image" style="background-image:url({{ $title->image==null? URL::asset('/No-Image-Placeholder.svg.png'):$title->image }})">
                                        <p class="" style="white-space: normal;">
                                            {{ $title->titlename }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            </ul>
                            @endif
                    </div>
                    <div class="row" style="">
                        Staff ({{ count($favioriteStaff) }})
                        <hr>
                        @if(count($favioriteStaff)<=0 || $favioriteStaff==null) No Faviorite Titles @else <ul class="col fav-ul">




                            @foreach ($favioriteStaff as $title)
                            <li class="fav-li">

                                <a class="" href="{{ route('title',['title' => $title->staff_id])}}" style="w">
                                    <div class="fav-image" style="background-image:url({{ $title->staff_image==null? URL::asset('/No-Image-Placeholder.svg.png'):$title->staff_image }});">
                                        <p class="" style="white-space: normal;">

                                            {{ $title->firstname }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            </ul>
                            @endif
                    </div>
                    <div class="row text-break" style="">
                        Character ({{ count($favioriteChar) }})
                        <hr>
                        @if(count($favioriteChar)<=0 || $favioriteChar==null) No Faviorite Titles @else <ul class="col fav-ul">




                            @foreach ($favioriteChar as $title)
                            <li class="fav-li">

                                <a class="" href="{{ route('title',['title' => $title->char_id])}}" style="">



                                    <div class="fav-image" style="background-image:url({{ $title->characterImage==null? URL::asset('/No-Image-Placeholder.svg.png'):$title->characterImage }});">
                                        <p class="" style="white-space: normal;">

                                            {{ $title->characterName }}

                                        </p>
                                    </div>
                                </a>
                            </li>

                            @endforeach
                            </ul>
                            @endif
                    </div>
                </div>

                <div class="container-xxl text-break">

                    @if (session()->has('userInfo'))
                    <div class="mb-3">
                        <form action="javascript:void(0)" method="post" class="" id='addCommentFrm'>
                            @csrf
                            <div class="text-start mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label text-start">Write
                                    a Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                <button id='commentaddbtn' type="submit" name="submit" class="form-control">Add a Comment</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="container-fluid">
                        <h5>Comments</h5>
                        <hr>
                        <div class="container">
                            @if (count($userComments) <= 0 || $userComments==null) No Comments @else @foreach ($userComments->slice(0, 5) as $comment) <div id="{{ $comment->ur_comment_id  }}" class="row">
                                    <div class="col-md-auto">
                                        <a href="{{ route('user', ['user' => $comment->username]) }}">
                                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $comment->user_image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-sm text-start"><a href="{{ route('user', ['user' => $comment->username]) }}">{{ $comment->username }}</a>
                                            </div>
                                            <div class="col-sm text-end">
                                                {{ $comment->created_at == null ? 'Na' : $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="row text-start">
                                            <div class="post">
                                                <p style="white-space: pre-line" class="content text-break">
                                                    {{ ($comment->commentText) }}</p>
                                                <a onclick="readMore(this)">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container tab-pane fade show {{ $commentPara }}" id="comments-tab-pane" role="tabpanel" aria-labelledby="comments-tab" tabindex="0">
            <div class="container-fluid">
                <h5>Comments</h5>
                <hr>
                <div class="container">
                    @if (count($userComments) <= 0 || $userComments==null) No Comments @else @foreach ($userComments as $comment) <div id="{{ $comment->ur_comment_id  }}" class="row">
                        <div class="col-md-auto">
                            <a href="{{ route('user', ['user' => $comment->username]) }}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $comment->user_image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-sm text-start"><a href="{{ route('user', ['user' => $comment->username]) }}">{{ $comment->username }}</a>
                                </div>
                                <div class="col-sm text-end">
                                    {{ $comment->created_at == null ? 'Na' : $comment->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="row text-start">
                                <div class="post">
                                    <p style="white-space: pre-line" class="content text-break">
                                        {{ stripslashes($comment->commentText) }}</p>
                                    <a onclick="readMore(this)">Read More</a>
                                </div>
                            </div>
                            @if(session()->has('userInfo')&& session()->get('userInfo')->username== $comment->username)
                            <div class="row text-end">
                                <form action="javascript:void(0)" id="deleteComment" method="get">
                                    @csrf
                                    <button type="submit" id="deleteComment" data-comment-id="{{ $comment->ur_comment_id }}" onclick="delCom(this)" class="btn btn-danger">Delete</button>

                                </form>
                            </div>
                            @else
                            @endif

                        </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="container tab-pane fade show  {{ $reviewPara }}" id="Reviews-tab-pane" role="tabpanel" aria-labelledby="Reviews-tab" tabindex="0">

        <div class="container-xxl">
            <div class="row">
                <div class="col">
                    <h5 class="text-start">Reviews</h5>
                </div>
                <div class="col text-end">
                    <a href="#"></a>
                </div>
            </div>
            @if(count($reviews)<=0 ||$reviews==null) No reviews @else @foreach ($reviews as $key=> $review)
                <div class="row">
                    <div class="col-md-auto">
                        <a href="{{ route('title',['title'=>$review->title_id]) }}">
                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $review->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                        </a>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-sm text-start"><a href="{{route('title',['title'=>$review->title_id]) }}">{{$review->titlename}}</a> </div>
                            <div class="col-sm text-end">{{$review->created_at==null ? 'Na':\Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</div>
                        </div>
                        <div class="row text-start">
                            <div class="post {{ $review->rw_type ? 'spoiler':'' }}">
                                <p style="white-space: pre-line" class="content text-break"> {{ stripslashes($review->rw_content) }}</p>

                                <a onclick="readMore(this)">Read More</a>
                            </div>
                        </div>
                        <div class="row text-start">
                            <div class="col">
                                <a href="{{ route('user',['user'=>$review->username]) }}">{{$review->username}}</a>
                            </div>
                            <div class="col text-end">
                                @if(session()->has('userInfo'))
                                @if(session()->get('userInfo')->username==$review->username)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-review-index="{{ $key }}" onclick="canit(this)">
                                    Edit Review
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <form action="javascript:void(0)" method="post" class="" id='addCommentFrm'>
                                                        @csrf
                                                        <div class="text-start mb-3">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col">Edited Review</div>
                                                                    <div class="col text-end">
                                                                        <input class="form-check-input" type="checkbox" id="invalidCheck">
                                                                        Spoiler
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control" contenteditable="true" id="editExampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <form action="javascript:void(0)" method="get">
                                                    @csrf
                                                    <button type="submit" id="deleteReview" class="btn btn-danger">Delete</button>
                                                </form>
                                                <form action="javascript:void(0)" method="post">
                                                    @csrf
                                                    <button type="button" id="editReview" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
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
    var scrolled = 0;
    var reviews = "{{ rawurlencode($reviews) }}";
    var reviews = "{{ $reviews }}".replace(/&quot;/g, '\"');

    function aboutme(e) {
        document.getElementById('aboutMe').value = "{{ $userData->user_aboutme }}";
    }


    // console.log('raw', reviews);

    reviews = JSON.parse(reviews);

    var reviewIndex = 0;
    var commentIndex = 0;
    // console.log(reviews[0]);

    function setEditReview() {
        document.getElementById('editExampleFormControlTextarea1').value = $("<div />").html(reviews[reviewIndex].rw_content).text().replaceAll('<br>', "\n");
    }

    function canit(e) {
        reviewIndex = e.dataset.reviewIndex;
        setEditReview();
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
    if ("{{ session()->has('userInfo') }}") {
        document.getElementById('exampleFormControlTextarea1').addEventListener('input', () => {
            chkText();
        })
    }

    function delCom(e) {
        var url = "{{ route('deleteUserComment',['comment_id'=>':c'])}}";
        commentIndex = e.dataset.commentId;
        url = url.replace(':c', commentIndex);
        // console.log('editcom', url);
        jQuery.ajax({
            url: url
            , data: jQuery('#deleteComment').serialize()
            , type: 'post'
            , success: function(result) {
                window.location.replace("{{ route('/') }}" + '/user' + '/{{ $userData->username }}/comments')
            }
            , error: function(result) {
                const toastLiveExample = document.getElementById('liveToast')
                document.getElementById('suscess-message').textContent = 'some error occurred' + result.responseErr

                document.getElementById('req-status').textContent = "❌"
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            }
        , });
    }
    $(".scroll-left").on("click", function() {
        scrolled = scrolled - 300;
        $("ul").animate({
            scrollLeft: scrolled
        });
    });
    $(".scroll-right").on("click", function() {
        scrolled = scrolled + 300;
        $("ul").animate({
            scrollLeft: scrolled
        });
    });
    jQuery('#commentaddbtn').click(function(e) {
        e.preventDefault();
        var url = "{{ route('addUsercomment', ['user_id' => $userData->user_id, 'comment' => ':a']) }}"
        url = url.replace(':a', encodeURIComponent(document.getElementById('exampleFormControlTextarea1').value.replace(/(?:\r\n|\r|\n)/g, '<br>')));

        // console.log(url);
        jQuery.ajax({
            url: url
            , data: jQuery('#addCommentFrm').serialize()
            , type: 'post'
            , success: function(result) {}
            , error: function(result) {
                const toastLiveExample = document.getElementById('liveToast')
                document.getElementById('suscess-message').textContent = "Some error occurred. try again"
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();

            }
        , });
    });
    jQuery('#editReview').click(function(e) {
        e.preventDefault();

        var url = "{{ route('editTitleReview',['title_id' => ':c','comment' => ':a','commentType'=>':b'])}}"
        url = url.replace(':c', reviews[reviewIndex].title_id);
        url = url.replace(':a', encodeURIComponent(document.getElementById('editExampleFormControlTextarea1').value.replace(/(?:\r\n|\r|\n)/g, '<br>')));

        url = url.replace(':b', document.getElementById('invalidCheck').checked == true ? 1 : 0);
        // console.log('edit', url);
        jQuery.ajax({
            url: url
            , data: jQuery('#addCommentFrm').serialize()
            , type: 'post'
            , success: function(result) {
                // alert('success');
                // $("#reviewTab").load(window.location.href + " #reviewTab");
                // $("#reviewsHome").load(window.location.href + " #reviewsHome");
                // location.reload();
                location.replace("{{ route('/') }}" + '/user/' + '{{ $userData->username}}/reviews');
            }
            , error: function(result) {
                const toastLiveExample = document.getElementById('liveToast')
                document.getElementById('suscess-message').textContent = "Some error occurred. try again"
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();

            }
        , });
    });
    jQuery('#deleteReview').click(function(e) {

        e.preventDefault();

        var url = "{{ route('deleteTitleReview',['title_id' => ':c'])}}"
        url = url.replace(':c', reviews[reviewIndex].title_id);
        // console.log('edit', url);
        jQuery.ajax({
            url: url
            , data: jQuery('#addCommentFrm').serialize()
            , type: 'post'
            , success: function(result) {
                location.reload();
            }
            , error: function(result) {
                const toastLiveExample = document.getElementById('liveToast')
                document.getElementById('suscess-message').textContent = "Some error occurred. try again"
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();

            }
        , });
    });




    $('document').ready(() => {

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
                content.innerHTML =
                    `${displayText}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
            }
        });
        if ("{{ session()->has('userInfo') }}") {
            // document.getElementById('exampleFormControlTextarea1').value = ''
            chkText();
        }
    });



    function readMore(btn) {
        let post = btn.parentElement;
        post.querySelector(".dots").classList.toggle("hide");
        post.querySelector(".more").classList.toggle("hide");
        btn.textContent == "Read More" ? btn.textContent = "Read Less" : btn.textContent = "Read More";
    }

</script>
@endsection
