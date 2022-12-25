@extends('app')
@section('title')
Most Favorite - My Movie List
@endsection
@section('content')


@php
// foreach($titles as $title){
// echo $title;
// echo 'aaaaa';
// }
// foreach($noOfFaviourite as $title){
// echo $title;
// }
// echo ($noOfFaviourite[0]->member_fav);
@endphp


<div class="title">
    <h1>Most Favorites Titles</h1>
</div>
<hr>

<div>
    <div class="container-xxl text-center">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Title</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($titles); $i++) <tr>
                    <th>{{ $i+1 }}</th>
                    <td scope="row">
                        <a href="{{ route('title',['title' => $titles[$i][0]->title_id])}}">
                            <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $titles[$i][0]->image }}" alt="img" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                        </a>
                    </td>
                    <td class="text-start">
                        <div>
                            <a href="{{ route('title',['title' => $titles[$i][0]->title_id])}}">{{ $titles[$i][0]->titlename }}</a>
                        </div>
                        <div>Favorites: {{ $noOfFaviourite[$i]->member_fav }}</div>
                        <div>Aired/Released: {{ $titles[$i][0]->startdate }}</div>
                    </td>
                </tr>
                @endfor
            </tbody>
    </table>
</div>
</div>



@endsection
