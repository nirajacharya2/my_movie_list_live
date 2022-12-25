@extends('app')
@section('title')
'{{ $searchText }}' - My Movie List - Search Result
@endsection

@section('content')
<style>
    div {
        /* border: black 1px solid; */
    }

</style>
<div class="title">
    <h1>Search Results For : '<strong>{{ $searchText }}</strong>' </h1>
</div>

<div class="border-l-r-b">
    @if(count($searchTitles)>0)
    <div class="container-xxl" id="searchTitle">
        <h5><strong>Titles</strong></h5>
        <hr>
        @foreach ($searchTitles as $a)
        <div class="row">
            <div class="col" style="max-width: 90px">
                <a href="{{ route('title',['title' => $a->title_id]) }}">

                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{  $a->image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                </a>
            </div>
            <div class="col">
                <div>
                    <a href="{{ route('title',['title' => $a->title_id]) }}">

                        {{ $a->titlename }}
                    </a>
                </div>
                <div>{{ $a->titleType }}({{ $a->noOfEpisodes }} eps)</div>
                <div>{{ $a->startdate==null? '':$a->startdate}} </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @else
    @endif
    @if(count($searchStaff)>0)
    <div class="container-xxl" id="searchStaff">
        <h5><strong>Staff</strong></h5>
        <hr>
        @foreach ($searchStaff as $a)
        <div class="row">
            <div class="col-md-auto">
                <a href="{{ route('staff',['staff'=>$a->staff_id]) }}">
                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{  $a->staff_image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                </a>
            </div>
            <div class="col">
                <div>
                    <a href="{{ route('staff',['staff'=>$a->staff_id]) }}">
                        {{ $a->firstname }}{{ $a->miiddlename }}{{ $a->lastname }}
                    </a>
                </div>
                <div>{{ $a->staff_dob }}</div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @else
    @endif
    @if(count($serchCharacter)>0)
    <div class="container-xxl" id="searchUsers">
        <h5><strong>Characters</strong> </h5>

        <hr>
        @foreach ($serchCharacter as $a)
        <div class="row">
            <div class="col-md-auto">
                <a href="{{ route('character',['character'=>$a->char_id]) }}">
                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{  $a->characterImage }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                </a>
            </div>
            <div class="col">
                <div>
                    <a href="{{ route('character',['character'=>$a->char_id]) }}">
                        {{ $a->characterName }}
                    </a>
                </div>
                <div>moviename</div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @else
    @endif
    @if(count($searchUsers)>0)
    <div class="container-xxl" id="searchCharacters">
        <h5>Users</h5>
        @foreach ($searchUsers as $a)
        <div class="row">
            <div class="col-md-auto">
                <a href="{{ route('user',['user'=>$a->username]) }}">
                    <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{  $a->user_image }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                </a>
            </div>
            <div class="col">
                <a href="{{ route('user',['user'=>$a->username]) }}">
                    <div>{{ $a->username }}</div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    @endif
</div>



{{-- <div>
    @if(!is_null($searchTitles))
    <div id="searchTitle">
        <h5>Titles</h5>
        <div>{{ $searchTitles}}</div>
</div>
@else
@endif
@if(!is_null($searchStaff))
<div id="searchStaff">
    <h5>Staff</h5>
    <div>{{ $searchStaff }}</div>
</div>
@else
@endif
@if(!is_null($searchUsers))
<div id="searchCharacters">
    <h5>Characters</h5>
    <div>{{ $searchUsers }}</div>
</div>
@else
@endif
@if(!is_null($serchCharacter))
<div id="searchUsers">
    <h5>Users</h5>
    <div>{{ $serchCharacter }}</div>
</div>
@else
@endif
</div> --}}
@endsection
