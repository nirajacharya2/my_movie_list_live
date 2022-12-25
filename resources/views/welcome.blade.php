@extends('app')
@section('title','Home - My Movie List')

@section('content')
<style>
    div {
        /* border: solid black 1px; */
    }

    .myContainer {
        background: #e2e6ee;
        padding-bottom: 1em;
        margin-bottom: 1em;
        border-radius: 10px;

    }

    .fav-image {
        width: 200px;
        height: 300px;
        transition: 0.5s;
        display: flex;
        justify-content: center;
        align-items: center;
        background-position: center;
        background-size: cover

    }

    .fav-image p {
        opacity: 0;
        width: 100%;
        word-wrap: break-word;
        transform: scale(0);
        transition: 0.2s;
        color: white;
        text-align: center;
        font-size: 0.8em;
        text-overflow: ellipsis;
        -o-text-overflow: auto;

    }

    p {
        word-wrap: break-word;
    }

    .fav-image:hover {
        box-shadow: 0 0 0 200px rgba(20, 17, 17, 0.7)inset;
    }

    .fav-image:hover p {
        opacity: 1;
        transform: scale(1);
    }

    .titlE {
        background: #b0c0eb;
        border-radius: 5px;
        margin-bottom: 1em;
    }

    .li {
        list-style-type: none;
        display: inline-block;
        /* height: 200px;
        /*width: 200px; */
        /* background-color: lightblue; */
        margin: 5px;

    }

    .paddles {}

    .paddle {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 3em;
    }

    .left-paddle {
        left: 0;
    }

    .right-paddle {
        right: 0;
    }

    .hidden {
        display: none;
    }

    .1 {
        scroll-snap-align: end;
    }

    .bg-noprogress {
        background-color: #fff;
    }

    .li:hover {
        opacity: 1;
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

    .users {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        color: rgb(232, 230, 227);
        text-decoration-color: currentcolor;
        text-shadow: rgba(0, 0, 0, 0.3) 1px 1px 0px;
    }

    .users {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .3);
        color: #fff;
        display: inline-block;
        opacity: 0;
        position: absolute;
        right: 0;
        text-decoration: none;
        text-shadow: rgba(0, 0, 0, .3) 1px 1px 0;
        top: 0;
    }

    .users:hover {
        opacity: 1;
        width: 100%;
        height: 100%;
        /* height: 100px; */
    }

    .link.bg-center {
        background-position: center center;
    }

    .link.bg-center:hover {
        opacity: 1;
    }

    .link {
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        display: block;
        opacity: 1;
        position: relative;
        -webkit-transition-duration: .3s;
        transition-duration: .3s;
        transition-property: opacity;
        transition-timing-function: ease-in-out;
        width: auto;
    }

    .overlay {
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
    }

    .overlay:hover {
        opacity: 1;
    }

</style>
{{-- {{ $topMembers[0] }} --}}
{{-- {{ $topTitles[0][0]->members }} --}}


@php
$first=true;
@endphp

<div style="background: #E1E7F5;margin-bottom:0.1em;padding: 0 0 0 0.3em;">

    <h3><strong>Home</strong> </h3>

</div>
<hr>
<div class="container-xxl">
    <div class="row justify-content-md-center">
        <div class="container col-8 border-l-b">
            <div class="row ">
                <strong>Suggestions</strong>
                <hr>
                @if(count($suggestedTitles)<=0 || $suggestedTitles==null) No Titles @else 
                    <ul id="" class="col text-start fav-ul" style=" white-space: nowrap;overflow-x:auto;scroll-snap-type:inline mandatory;,scroll-padding-inline:1rem;">

                        @foreach ($suggestedTitles as $title)
                        <li class="fav-li" style="display: inline-block;scroll-snap-align:{{ $first?'start':'end'}}{{ $first=false; }};">

                            <a class="" href="{{ route('title',['title' => $title->title_id])}}">
                                <div class="fav-image" style="background-image:url({{ $title->image }})">

                                    <p class="text-wrap">

                                        {{ $title->titlename }}
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
            @endif
        </div>
        <hr>
        <div class="container-xxl">
            <div class="row">
                <div class="col">
                    <h5 class="text-start"> <strong>Reviews</strong> </h5>
                </div>
                <hr>
                <div class="col text-end">
                    <a href="#"></a>
                </div>
            </div>
            @if(count($newReviews)<=0 ||$newReviews==null) No reviews @else @foreach ($newReviews as $review) <div class="row">
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
                        {{-- <p id="review">
                                        {{ $review->rw_content }}

                        </p>
                        <a id="load" onclick="lodemore(this)">Load More</a> --}}
                    </div>
                    <div class="row text-start"><a href="{{ route('user',['user'=>$review->username]) }}">{{$review->username}}</a></div>
                </div>
        </div>
        <hr>
        @endforeach
        @endif
    </div>

</div>
<div class="col-4 border-l-r-b">

    @if (session()->has('userInfo'))
    {{-- <div>userstats</div> --}}
    @else
    @endif
    <div class="container myContainer" style="">
        <div class="row titlE" style=""><strong>Top Titles</strong> </div>

        @if(count($topTitles)<=0 ||$topTitles==null) No Titles @else @for($i=0; $i < count($topTitles); $i++) <div class="row">
            <div class="col-md-auto">
                <a href="{{ route('title',['title' => $topTitles[$i][0]->title_id]) }}">
                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $topTitles[$i][0]->image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                </a>
            </div>
            <div class="col">
                <div>
                    <a href="{{ route('title',['title' => $topTitles[$i][0]->title_id]) }}">
                        {{ $topTitles[$i][0]->titlename }}
                    </a>
                </div>
                <div><small>Aired: {{ $topTitles[$i][0]->startdate }}</small></div>
                <div><small>Members: {{ $topTitles[$i][0]->members }}</small></div>
                <div><small>Rating: {{ $topTitles[$i][0]->avrage_rating==null?"N/A":round($topTitles[$i][0]->avrage_rating,2) }}</small></div>
            </div>
    </div>
    @if(!$i==count($topTitles)-1)

    <hr>


    @endif


    @endfor

    @endif

</div>
<div class="container myContainer">
    <div class="row titlE"><strong>New Upcomming Titles</strong> </div>

    @if(count($newTitles)<=0 ||$newTitles==null) No Upcomming Titles @else @for ($i=0; $i < count($newTitles); $i++) <div class="row">

        <div class="col-md-auto">
            <a href="{{ route('title',['title' => $newTitles[$i]->title_id]) }}">


                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $newTitles[$i]->image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
            </a>
        </div>
        <div class="col">
            <div>
                <a href="{{ route('title',['title' => $newTitles[$i]->title_id]) }}">{{ $newTitles[$i]->titlename }}</a></div>


            <div><small>To Be Aired: {{ $newTitles[$i]->startdate }}</small></div>


        </div>
</div>
@if(!$i==count($newTitles)-1)


<hr>

@endif





@endfor
@endif


</div>
<div class="container myContainer">
    <div class="row titlE"><strong>Most Popular Movies</strong> </div>


    @if(count($topMembers)<=0 ||$topMembers==null) No Titles @else @for ($i=0; $i < count($topMembers); $i++) <div class="row">


        <div class="col-md-auto">
            <a href="{{ route('title',['title' => $topMembers[$i][0]->title_id]) }}">


                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $topMembers[$i][0]->image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
            </a>
        </div>
        <div class="col">
            <div><a href="{{ route('title',['title' => $topMembers[$i][0]->title_id]) }}">{{ $topMembers[$i][0]->titlename }}</a></div>


            <div><small>Aired: {{ $topMembers[$i][0]->startdate }}</small></div>

            <div><small>Members: {{ $topMembers[$i][0]->members }}</small></div>


        </div>
</div>
@if($i!=count($topMembers)-1)

<hr>
@endif
@endfor
@endif


</div>
@if (session()->has('userInfo'))
<div class="container myContainer" style="background: #dee3ed;margin-bottom:1em">
    <div class="row titlE">
        <strong>Last Movie Updates</strong>
    </div>

    <hr>
    {{-- {{ $lastUpdated }} --}}
    @if(count($lastUpdated)<=0 || $lastUpdated==null) Nothing to see hear @else @foreach ($lastUpdated as $title) <div class="row">
        <div class="col-auto text-start">
            <a href="{{ route('title',['title' => $title->title_id]) }}">
                <img class="image-fluid" style="max-height: 70px;max-width:50px" src="{{ $title->image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
            </a>
        </div>
        <div class="col text-start">
            <a href="{{ route('title',['title' => $title->title_id]) }}">
                {{ $title->titlename }}
            </a>
            @php
            $watchStat='Watching';
            switch ($title->ut_watchingstatus) {
            case "Watching":
            $watchStat='bg-success';
            break;
            case "Completed":
            $watchStat='';
            break;
            case "On-Hold":
            $watchStat='bg-warning';
            break;
            case "Plan To Watch":
            $watchStat='bg-secondary';
            break;
            case "Dropped":
            $watchStat='bg-danger';
            break;
            }
            @endphp
            <div class="row">
                <div class="col text-start">
                    <div class="progress">
                        <div class="progress-bar {{ $watchStat }}" role="progressbar" aria-label="" style="width: {{ $title->ut_episodewatched/$title->noOfEpisodes*100 }}%" aria-valuenow="{{ $title->ut_episodewatched }}" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-noprogress" role="progressbar" aria-label="" style="width: {{ ($title->ut_episodewatched/$title->noOfEpisodes*100)-100 }}%" aria-valuenow="{{ $title->ut_episodewatched-$title->noOfEpisodes }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-md-auto text-end"><small>

                        {{ $title->updated_at == null ? \Carbon\Carbon::parse($title->created_at)->diffForHumans():\Carbon\Carbon::parse($title->updated_at)->diffForHumans() }}</small>


                </div>
            </div>
            <div class="row text-start">
                <small>
                    {{ $title->ut_watchingstatus }} {{ $title->ut_episodewatched }}/{{ $title->noOfEpisodes }} · Scored - {{ $title->ut_score }}</small>

            </div>
        </div>
</div>

@if($title!=$lastUpdated[count($lastUpdated)-1])
<hr>
@endif


@endforeach
@endif
</div>
@endif
</div>
</div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>
    $('document').ready(() => {

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
    });



    function readMore(btn) {
        let post = btn.parentElement;
        post.querySelector(".dots").classList.toggle("hide");
        post.querySelector(".more").classList.toggle("hide");
        btn.textContent == "Read More" ? btn.textContent = "Read Less" : btn.textContent = "Read More";
    }

</script>
@endsection
