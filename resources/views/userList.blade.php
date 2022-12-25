@extends('app')
@section('title')
{{ $allTitles[0]->username }} - My Movie List - Movie List
@endsection
@push('css')
<style>
    .Watching {
        background-color: green;
        min-width: 3px;
    }

    .Completed {
        background-color: blue;
    }

    .On-Hold {
        background-color: orange;
    }

    .Dropped {
        background-color: red;
    }

    .Plan {
        background-color: gray;
    }

</style>

@endpush
@section('content')
@php
$all=null;
$watching=null;
$completed=null;
$onhold=null;
$dropped=null;
$plantowatch=null;
if($sort=='Watching'){
$watching='active';
}elseif($sort=='completed'){
$completed='active';
}elseif($sort=='on-hold'){
$onhold='active';
}elseif($sort=='dropped'){
$dropped='active';
}elseif($sort=='plan to watch'){
$plantowatch='active';
}else {
$all='active';
}

@endphp

{{-- {{ $allTitles }} --}}

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $all }}" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $watching }}" id="watching-tab" data-bs-toggle="tab" data-bs-target="#watching-tab-pane" type="button" role="tab" aria-controls="watching-tab-pane" aria-selected="false">Currently Watching</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $completed }}" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $onhold }}" id="onHold-tab" data-bs-toggle="tab" data-bs-target="#onHold-tab-pane" type="button" role="tab" aria-controls="onHold-tab-pane" aria-selected="false">On Hold</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $dropped }}" id="dropped-tab" data-bs-toggle="tab" data-bs-target="#dropped-tab-pane" type="button" role="tab" aria-controls="dropped-tab-pane" aria-selected="false">Dropped</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $plantowatch }}" id="planToWatch-tab" data-bs-toggle="tab" data-bs-target="#planToWatch-tab-pane" type="button" role="tab" aria-controls="planToWatch-tab-pane" aria-selected="false">Plan To Watch</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show {{ $all }}" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="max-width: 3px;"></th>
                    <th>#</th>
                    <th>Image</th>
                    <th>Movie Title</th>
                    <th>Score</th>
                    <th>Type</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else

                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        <td class="{{ $allTitles[$i]->ut_watchingstatus}}" style="max-width: 3px;"></td>
                        <td>{{ $i+1 }}</td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}
                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endfor
                        @endif
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade show {{ $watching }}" id="watching-tab-pane" role="tabpanel" aria-labelledby="watching-tab" tabindex="0">


        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col-md-auto" style="max-width: 2px"></th>
                    <th scope="col-md-auto">#</th>
                    <th scope="col-md-auto">Image </th>
                    <th scope="col-md-auto">Movie Title</th>
                    <th scope="col-md-auto">Score</th>
                    <th scope="col-md-auto">Type</th>
                    <th scope="col-md-auto">Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else
                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        @if($allTitles[$i]->ut_watchingstatus=='Watching')
                        @php
                        $k=0;
                        @endphp
                        <td scope="row" class="Watching" style="max-width: 2px;background-color: green;"></td>
                        <td scope="row">{{ $k+1 }}</td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}

                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endif
                        @endfor

                        @endif


            </tbody>
        </table>
    </div>
    <div class="tab-pane fade show {{ $completed }}" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">


        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col-md-auto" style="max-width: 2px"></th>
                    <th scope="col-md-auto">#</th>
                    <th scope="col-md-auto">Image</th>
                    <th scope="col-md-auto">Movie Title</th>
                    <th scope="col-md-auto">Score</th>
                    <th scope="col-md-auto">Type</th>
                    <th scope="col-md-auto">Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else

                    @php
                    $k=0;
                    @endphp

                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        @if($allTitles[$i]->ut_watchingstatus=='Completed')

                        <td scope="row" style="max-width: 2px;background-color: blue;"></td>
                        <td scope="row">{{ $k+1 }}</td>

                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}
                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endif
                        @endfor
                        @endif
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade show {{ $onhold }}" id="onHold-tab-pane" role="tabpanel" aria-labelledby="onHold-tab" tabindex="0">


        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col-md-auto" style="max-width: 2px"></th>
                    <th scope="col-md-auto">#</th>
                    <th scope="col-md-auto">Image</th>
                    <th scope="col-md-auto">Movie Title</th>
                    <th scope="col-md-auto">Score</th>
                    <th scope="col-md-auto">Type</th>
                    <th scope="col-md-auto">Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else

                    @php
                    $k=0;
                    @endphp

                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        @if($allTitles[$i]->ut_watchingstatus=='On-Hold')

                        <td scope="row" style="max-width: 2px;background-color: orange;"></td>
                        <td scope="row">{{ $k+1 }}</td>

                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}
                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endif
                        @endfor
                        @endif
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade show {{ $dropped }}" id="dropped-tab-pane" role="tabpanel" aria-labelledby="dropped-tab" tabindex="0">


        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col-md-auto" style="max-width: 2px"></th>
                    <th scope="col-md-auto">#</th>
                    <th scope="col-md-auto">Image</th>
                    <th scope="col-md-auto">Movie Title</th>
                    <th scope="col-md-auto">Score</th>
                    <th scope="col-md-auto">Type</th>
                    <th scope="col-md-auto">Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else

                    @php
                    $k=0;
                    @endphp

                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        @if($allTitles[$i]->ut_watchingstatus=='Dropped')
                        <td scope="row" style="max-width: 2px;background-color: red;"></td>
                        <td scope="row">{{ $k+1 }}</td>

                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}
                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endif
                        @endfor
                        @endif
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade show {{ $plantowatch }}" id="planToWatch-tab-pane" role="tabpanel" aria-labelledby="planToWatch-tab" tabindex="0">


        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="max-width: 2px"></th>
                    <th>#</th>
                    <th>Image</th>
                    <th>Movie Title</th>
                    <th>Score</th>
                    <th>Type</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                @if(count($allTitles)<=0 ||$allTitles==null) <tr>
                    <td colspan="7">
                        No titles
                    </td>
                    </tr>
                    @else

                    @php
                    $k=0;
                    @endphp

                    @for ($i=0;$i<count($allTitles);$i++) <tr>
                        @if($allTitles[$i]->ut_watchingstatus=='Plan To Watch')

                        <td style="max-width: 2px;background-color: gray;"></td>
                        <td>{{ $k +1}}</td>

                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $allTitles[$i]->image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </td>
                        <td>
                            <a class="" href="{{ route('title',['title' => $allTitles[$i]->title_id])}}">
                                {{ $allTitles[$i]->titlename }}
                            </a>
                        </td>
                        <td>{{ $allTitles[$i]->ut_score==null?'Not Scored':$allTitles[$i]->ut_score }}</td>
                        <td>{{ $allTitles[$i]->titleType }}</td>
                        <td>{{ $allTitles[$i]->ut_episodewatched }}/{{ $allTitles[$i]->noOfEpisodes }}</td>
                        </tr>
                        @endif
                        @endfor
                        @endif
            </tbody>
        </table>

    </div>
</div>
<script>
    watching = document.getElementsByClassName('Watching');

    for (let i = 0; i < watching.length; i++) {

        watching[i].style.backgroundColor = 'green'
    }

    completed = document.getElementsByClassName('Completed');

    for (let i = 0; i < completed.length; i++) {

        completed[i].style.backgroundColor = 'blue'




    }




    onhold = document.getElementsByClassName('On-Hold');

    for (let i = 0; i < onhold.length; i++) {

        onhold[i].style.backgroundColor = 'orange'



    }




    dropped = document.getElementsByClassName('Dropped');

    for (let i = 0; i < dropped.length; i++) {

        dropped[i].style.backgroundColor = 'red'



    }




    plantowatch = document.getElementsByClassName('Plan To Watch');

    for (let i = 0; i < plantowatch.length; i++) {

        plantowatch[i].style.backgroundColor = 'grey'

    }

</script>
@endsection
