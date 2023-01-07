@extends('app')
@section('title')
{{ $staffDetail->firstname }} {{ $staffDetail->miiddlename }} {{ $staffDetail->lastname }} - My Movie List - Staff

@endsection

@section('content')
<style>
    div {
        /* border: 1px solid black; */
    }

    hr {
        margin: 0.2em;
    }

    .roles {
        margin-bottom: 1em;
    }

    .hide {
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

</style>
{{-- {{ $staffRoles }} --}}
{{-- {{ $staffRoles }} --}}
{{-- {{ $faviouriteChar }} --}}





{{-- {{ $staffRoles }} --}}

<div class="title">
    <h1>{{ $staffDetail->firstname }} {{ $staffDetail->miiddlename }} {{ $staffDetail->lastname }} </h1>
</div>

<div class="container-xxl text-center">
    <div class="row">
        <div class="col-sm-3 border-l-b">
            <div>
                <img class="img-thumbnail" src="{{ $staffDetail->staff_image }}" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
            </div>
            <div class="text-start">
                @if(Session::has('userInfo'))
                <div class="fav-button" id="addToFaviourite">Add To Favioutite</div>
                @endif
                <br>
                <div>
                    <h5><strong>Information</strong></h5>
                    <hr>
                    <div>
                        @if($staffDetail->firstname!=null)
                        <strong>Firstname: </strong>{{ $staffDetail->firstname }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->miiddlename!=null)
                        <strong>Middlename: </strong>{{ $staffDetail->miiddlename }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->lastname !=null)
                        <strong>Lastname: </strong>{{ $staffDetail->lastname  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_dob !=null)
                        <strong>Birthday: </strong>{{ $staffDetail->staff_dob  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_sex !=null)
                        <strong>Gender: </strong>{{ $staffDetail->staff_sex? "Male":"Female"  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->height !=null)
                        <strong>Height: </strong>{{ $staffDetail->height  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->stagename !=null)
                        <strong>Stagename: </strong>{{ $staffDetail->stagename  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->biography !=null)
                        <strong>Biography: </strong>{{ $staffDetail->biography  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_bloodtype !=null)
                        <strong>Blood Type: </strong>{{ $staffDetail->staff_bloodtype  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_spouse !=null)
                        <strong>Spouse: </strong>{{ $staffDetail->staff_spouse  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_award !=null)
                        <strong>Awards: </strong>{{ $staffDetail->staff_award  }}
                        <hr>
                        @endif
                    </div>
                    <div>
                        @if($staffDetail->staff_hobby !=null)
                        <strong>Hobbys: </strong>{{ $staffDetail->staff_hobby  }}
                        <hr>
                        @endif
                    </div>
                    <div id="favCounter">
                        <strong>Member Favorites: </strong>{{ $favCount }}
                        {{-- <p id="favCounter"></p> --}}
                        <hr>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-9 border-l-r-b">

            <div class="">
                <h5 class="text-start">
                    Acting Roles
                    <hr>
                </h5>
                @php
                $actorcount=0;
                @endphp
                <div class="container text-center">
                    @if(count($staffRoles)<=0 || $staffRoles==null) No acting roles @else @foreach ( $staffRoles as $staff ) @if($staff->staffType=='Actor')
                        @php
                        $actorcount++;
                        @endphp

                        <div class="row roles">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-auto text-start">
                                        <a href="{{ route('title',['title' => $staff->title_id])}}">
                                            <img class="img-fluid img-thumbnail" style="max-width: 70px;min-height:99px" src="{{ $staff->image }}" alt="img" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                        </a>
                                    </div>
                                    <div class="col text-start">
                                        <a href="{{ route('title',['title' => $staff->title_id])}}">{{ $staff->titlename }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col text-end">
                                        <a href="{{ route('character',['character' => $staff->char_id])}}">{{ $staff->characterName }}</a>
                                    </div>
                                    <div class="col-md-auto text-end">
                                        <a href="{{ route('character',['character' => $staff->char_id])}}">
                                            <img class="img-fluid img-thumbnail" style="max-width: 70px;min-height:99px;" src="{{ $staff->characterImage }}" alt="img" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @else
                        @endif
                        @endforeach
                        @endif
                </div>
                <h5 class="text-start">
                    Staff Roles
                    <hr>
                </h5>
                <div class="container">
                    @if((count($staffRoles)-$actorcount)<=0 || $staffRoles==null) No Staff Roles associated with this staff @else @foreach ($staffRoles as $staff) @if($staff->staffType!='Actor')
                        <div class="row roles">
                            <div class="col-auto text-start">
                                <a href="{{ route('title',['title' => $staff->title_id])}}">

                                    <img src="{{ $staff->image }}" style="max-width:100px" alt="">
                                </a>
                            </div>
                            <div class="col text-start">
                                <div class="row">
                                    <div class="col text-start">
                                        <a href="{{ route('title',['title' => $staff->title_id])}}">

                                            {{ $staff->titlename }}<br>
                                        </a>
                                        <small>{{ $staff->staffType }}</small>


                                    </div>
                                    <div class="col text-end">
                                        {{-- member --}}
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div>{{ $staff->tytleType }}</div>

                                    <div>
                                        {{ $staff->startdate }}
                                    </div>


                                    {{-- title type,relesedate --}}
                                </div>
                            </div>
                        </div>
                        @else
                        @endif
                        @endforeach

                        @endif
                </div>
                <hr>
                @if(session()->has('userInfo'))
                <div class="">
                    <form action="javascript:void(0)" method="post" class="" id='addCommentFrm'>
                        @csrf
                        <div class="text-start mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label text-start">Write a Comment</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <button id='commentaddbtn' type="submit" name="submit" class="form-control">Add a Comment</button>
                        </div>
                    </form>
                </div>
                @endif
                <hr>
                <h5>Comments</h5>
                <hr>
                <div class="container" id='coments'>
                    @if(count($comments)<=0 ||$comments==null) No Comments @else @foreach ($comments as $comment) <div class="row">
                        <div class="col-md-auto">
                            <a href="{{ route('user',['user'=>$comment->username]) }}">
                                <img class="img-fluid img-thumbnail" style="max-width: 70px" src="{{ $comment->user_image }} " onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
                            </a>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-sm text-start"><a href="{{ route('user',['user'=>$comment->username]) }}">{{$comment->username}}</a> </div>
                                <div class="col-sm text-end">{{$comment->created_at==null ? 'Na': $comment->created_at->diffForHumans()}}</div>
                            </div>
                            <div class="row text-start">
                                <div class="post">
                                    <p style="white-space: pre-line" class="content text-break"> {{ stripslashes($comment->commentText) }}</p>

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

    @endsection
    @section('extraScripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var faviourite = parseInt("{{ $faviouriteChar }}");
        var favCount = parseInt("{{ $favCount }}");
        var submitForm = true

        // console.log((parseInt(faviourite)));
        // console.log(((faviourite)));

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


        $('document').ready(() => {
            if (faviourite) {
                document.getElementById('addToFaviourite').innerText = "Remove from Favioutite";
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
            if ("{{ session()->has('userInfo') }}") {
                document.getElementById('exampleFormControlTextarea1').value = ''
                chkText();
            }
        });
        if ("{{ session()->has('userInfo') }}") {


            document.getElementById('addToFaviourite').addEventListener('click', () => {
                // console.log('clicked')

                if (submitForm) {
                    document.getElementById('addToFaviourite').textContent = "loading..."
                    submitForm = false
                    if (faviourite) {
                        var url = "{{ route('addToFaviouriteStaff',['staff_id' => $staffDetail->staff_id,'addOrRemove'=>0]) }}"
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
                                    // document.getElementById('favCounter').innerHTML = '<ol><li>html data</li></ol>';
                                    document.getElementById('favCounter').innerHTML = '<strong>Member Favorites: </strong>' + favCount;
                                    const toastLiveExample = document.getElementsByClassName('toast')[0];

                                    document.getElementById('suscess-message').textContent = "Removed from Favioutite"
                                    const toast = new bootstrap.Toast(toastLiveExample, {
                                        animation: true
                                        , delay: 5000
                                    })
                                    toast.show()
                                    submitForm = true




                                } else {
                                    submitForm = true
                                    alert(result.responseErr);
                                }
                            }
                            , error: function(result) {
                                const toastLiveExample = document.getElementById('liveToast')
                                document.getElementById('suscess-message').textContent = result
                                document.getElementById('req-status').textContent = "❌"
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show()
                                submitForm = true


                            }
                        , });


                    } else {
                        var url = "{{ route('addToFaviouriteStaff',['staff_id' => $staffDetail->staff_id,'addOrRemove'=>1]) }}"
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
                                    document.getElementById('favCounter').innerHTML = '<strong>Member Favorites: </strong>' + favCount;
                                    // const toastLiveExample = document.getElementById('liveToast')
                                    const toastLiveExample = document.getElementsByClassName('toast')[0];
                                    document.getElementById('suscess-message').textContent = "Added to Favorites"
                                    const toast = new bootstrap.Toast(toastLiveExample)
                                    toast.show()
                                    submitForm = true


                                } else {
                                    alert(result.responseErr);
                                    submitForm = true


                                }
                            }
                            , error: function(result) {


                                const toastLiveExample = document.getElementById('liveToast')
                                document.getElementById('suscess-message').textContent = result
                                document.getElementById('req-status').textContent = "❌"
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show()
                                submitForm = true


                            }
                        , });
                    }
                }
            });
        }




        jQuery('#commentaddbtn').click(function(e) {
            e.preventDefault();
            var url = "{{ route('addStaffcomment',['staff_id' => $staffDetail->staff_id,'comment' => ':a'])}}"
            url = url.replace(':a', encodeURIComponent(document.getElementById('exampleFormControlTextarea1').value.replace(/(?:\r\n|\r|\n)/g, '<br>')));

            // console.log(url)
            jQuery.ajax({
                url: url
                , data: jQuery('#addCommentFrm').serialize()
                , type: 'post'
                , success: function(result) {
                    alert('success');
                    location.reload();


                }
                , error: function(result) {
                    const toastLiveExample = document.getElementById('liveToast')
                    document.getElementById('suscess-message').textContent = result
                    document.getElementById('req-status').textContent = "❌"
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()

                }
            , });
        });


        function readMore(btn) {
            let post = btn.parentElement;
            post.querySelector(".dots").classList.toggle("hide");
            post.querySelector(".more").classList.toggle("hide");
            btn.textContent == "Read More" ? btn.textContent = "Read Less" : btn.textContent = "Read More";
        }

    </script>
    @endsection
