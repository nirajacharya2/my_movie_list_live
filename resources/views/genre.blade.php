@extends('app')
@section('title')
{{ $genreDetail->genreName }} - My Movie List - Genre



@endsection

@section('username', 'aaa')
@section('content')




<style>
    div {
        /* border: black 1px solid; */
    }

</style>
{{-- {{ $gentrTitles }} --}}

{{-- {{ $avrageScore }} --}}

<div>
    <h1>
        {{ $genreDetail->genreName==null?'Na': $genreDetail->genreName}}

    </h1>
</div>
<div>
    <div>
        <h5>
            {{ $genreDetail->genreName==null?'Na': $genreDetail->genreName }}: {{ count($gentrTitles) }}
        </h5>
    </div>
    <hr>
    <div>
        {{ $genreDetail->genraDescription==null ? 'No description': $genreDetail->genraDescription }}
    </div>

    <div class="container-xxl text-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3">
            @if(count($gentrTitles)<=0 || $gentrTitles==null) No Title Associated with this Genre @else @foreach ($gentrTitles as $title) 
            <div class="col genrebordeR">
                    <div><a href=" {{ route('title',['title'=>$title->title_id]) }}">
                            {{ $title->titlename }}</a></div>
                            <hr>
                    <div>{{ $title->startdate==null ? 'Na': date("Y", strtotime($title->startdate)) }}, @if(date("Y-m-d")>=$title->startdate && date("Y-m-d")<=$title->enddate)
                            Currently Airing
                            @elseif (date("Y-m-d")<=$title->startdate)
                                Not yet aired
                                @elseif(date("Y-m-d")>=$title->enddate)
                                Finished Airing
                                @endif,{{ $title->noOfEpisodes }}ep {{ $title->avrageEpisodeDuration}}min</div>
                                <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-auto border-l-r-b"><a href=" {{ route('title',['title'=>$title->title_id]) }}">

                                    <img src="{{ $title->image }}" style="max-width:100px;min-height:150px" alt=""></a></div>
                            <div class="col sypnosis border-l-r-b" style="overflow-y: auto;max-height:152px;" {{-- style="overflow-y: scroll;" --}}>{{ $title->sypnosis }}</div>

                        </div>
                    </div>
                    {{-- <div>avrage rating,members,userstat</div> --}}
            </div>
        @endforeach
        @endif

    </div>
</div>


</div>




{{-- {{ $gentrTitles }} --}}




{{-- {{ $genreDetail }} --}}


@endsection
