@extends('app')
@section('title')
{{ $characterDetail->characterName}} - My Movie List - Character
@endsection

@section('content')
<style>
    div {
        /* border: 1px solid black; */
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

</style>
{{-- {{ $relatedTitle }} --}}
{{-- {{ $actor }} --}}
{{-- {{ $characterDetail }} --}}
{{-- {{ $faviouriteChar }} --}}
{{-- {{ $characterDetail->characterImage }} --}}

<div class="title">

    <h1>{{ $characterDetail->characterName==null? 'Na':$characterDetail->characterName }} </h1>

</div>

<div class="container-xxl text-center">
    <div class="container-xxl row">

        <div class="col-md-auto border-l-r-b">
            <div>
                <img class="img-thumbnail" style="max-width:250px;" src="{{ $characterDetail->characterImage }}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">

            </div>
            <hr>
            <div class="text-start">
                @if(Session::has('userInfo'))
                <div class="fav-button" id="addToFaviourite">Add To Favioutite</div>
                <hr>
                @else
                @endif
                <br>
                <hr>
                <div class="container ">
                    <div><strong>Characters Title</strong></div>
                    <hr>

                    @foreach ($relatedTitle as $title)
                    <div class="row">
                        <div class="col-md-auto" style="max-width: 50px">

                            <a href="{{ route('title',['title' => $title->title_id])}}">

                                <img class="img-thumbnail" style="max-width:50px" src="{{ $title->image }}">
                            </a>
                        </div>
                        <div class="col text-start">
                            <a href="{{ route('title',['title' => $title->title_id])}}">
                                {{ $title->titlename==null?'Na':$title->titlename }}
                            </a>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                <hr>
            </div>
            <div id="favCounter" class="text-start">
                Member Favorites:{{ $favCount }}
            </div>
        </div>
        <div class="col border-l-b">

            <div class="text-start">
                <div>
                    <strong>
                        {{ $characterDetail->characterName==null?'Na':$characterDetail->characterName }}
                    </strong>
                    <hr>
                </div>
                <div>
                    {{ $characterDetail->characterDescription==null? 'No Description': $characterDetail->characterDescription}}
                </div>
            </div>
            <hr>
            <div class="container-xxl text-start">
                <strong>Actor</strong>
                <hr style="margin:0 -0.5em  0 -0.5em">
                @if(count($actor)<=0 || $actor==null) No Actor Associated with this Character @else @foreach ($actor as $act) <div class="row">
                    <div class="col-md-auto" style="max-width: 100px">
                        <a href=" {{ route('staff',['staff' => $act->staff_id])}}">
                            <img class="img-thumbnail" style="max-width: 100px" src="{{ $act->staff_image }}" alt="img" onerror="this.onerror=null;this.src={{URL::asset('/No-Image-Placeholder.svg.png')}}">
                        </a>
                    </div>
                    <div class="col text-start">
                        <a href="{{ route('staff',['staff' => $act->staff_id])}}">
                            {{ $act->firstname }} {{ $act->miiddlename }} {{ $act->lastname }}
                        </a>
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
@endsection
@section('extraScripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var faviourite = parseInt("{{ $faviouriteChar }}");
    var favCount = parseInt("{{ $favCount }}");


    var submitForm = true;
    // console.log(faviourite)

    $('document').ready(() => {
        if (faviourite && "{{ Session::has('userInfo') }}") {

            document.getElementById('addToFaviourite').innerText = "Remove from Favioutite";
        }
    });
    if ("{{ Session::has('userInfo') }}") {


        document.getElementById('addToFaviourite').addEventListener('click', () => {
            if (submitForm) {
                document.getElementById('addToFaviourite').textContent = "loading..."


                submitForm = false

                // console.log('clicked')
                if (faviourite) {
                    var url = "{{ route('addToFaviouriteChar',['char_id' => $characterDetail->char_id,'addOrRemove'=>0]) }}"
                    // console.log(url)

                    jQuery.ajax({
                        url: url
                        , type: 'get'
                        , success: function(result) {
                            // alert('success');
                            if (result.responseErr != 'Already have max favorite movie added') {
                                faviourite = 0;
                                favCount = favCount - 1;
                                document.getElementById('addToFaviourite').innerText = "Add To Favioutite";
                                document.getElementById('favCounter').innerHTML = 'Member Favorites: ' + favCount;
                            } else {
                                // alert(result.responseErr);
                                // submitForm = true


                            }
                            submitForm = true


                        }
                        , error: function(result) {
                            // alert('error');
                            // alert(result);
                            submitForm = true


                        }
                    , });
                } else {
                    var url = "{{ route('addToFaviouriteChar',['char_id' => $characterDetail->char_id,'addOrRemove'=>1]) }}"
                    // console.log(url)
                    jQuery.ajax({
                        url: url
                        , type: 'get'
                        , success: function(result) {
                            // alert('success');
                            if (result.responseErr != 'Already have max favorite movie added') {
                                faviourite = 1;
                                favCount = favCount + 1;
                                document.getElementById('addToFaviourite').innerText = "Remove from Favioutite";
                                document.getElementById('favCounter').innerHTML = 'Member Favorites: ' + favCount;
                            } else {
                                alert(result.responseErr);
                            }
                            submitForm = true


                        }
                        , error: function(result) {
                            // alert('error');
                            // alert(result);
                            submitForm = true


                        }
                    });
                }
            }
        });

    }

</script>
@endsection
