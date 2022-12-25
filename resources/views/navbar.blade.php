<style>
    .inline {
        display: inline;
        /* background: blue; */
        /* color: black; */
    }

    .hide {
        display: none;
    }

    #searchTextBox {
        padding: 0px;
        display: block;
        margin: 0 auto;
    }

    #searchResult {
        border: 1px solid black;
        border-radius: 1em;
        background: white;
        position: absolute;
        padding: 0px;
        margin-top: 10px auto;
        width: 400px;
        overflow: auto;
        right: 1em;
        top: 3.5em;
        max-height: 20em;
        overflow-y: scroll;
        /* overflow: visible; */
        z-index: 99 !important;


    }

</style>

@php
$titles= $staff= $users= $characters=null;

@endphp

<nav class="navbar navbar-expand-xl bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="{{ route('/') }}">My Movie List</a>

        @if (session()->has('userInfo'))
        <div class="navbar" id="">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle text-primary" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @yield('username')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="position:absolute">
                        <li><a class="dropdown-item" href="{{ route('user',['user'=>Session::get('userInfo')->username]) }}">Profile</a></li>

                        <li><a class="dropdown-item" href="{{ route('userList',['username'=>Session::get('userInfo')->username]) }}">Movie List</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex m-2">
                <a href="{{ route('user',['user'=>Session::get('userInfo')->username]) }}"><img class=" rounded-circle" src="@yield('userImage')" alt="" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'" height="30px" width="30px"></a>
            </div>
        </div>
        @else
        <ul class="">
            <li class="inline">
                <a class="p-2 text-primary" href="{{ route('login') }}">
                    Login
                    {{-- <span class="">Login</span> --}}
                </a>
            </li>
            <li class="inline">
                @if (Route::has('signup'))
                <a class="text-primary" href="{{ route('signup') }}">
                    {{-- <span class="text-primary">SignUp</span> --}}
                    SignUp
                </a>

                @endif
            </li>
        </ul>
        @endif
    </div>
</nav>
<hr>

<nav class="navbar navbar-expand-sm bg-primary pt-1">
    <div class="container-fluid">
        <button class="navbar-toggler navbar-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-right"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="{{ route('top') }}">Top</a>
                </li>
                <li class="nav-item text-light">

                    <a class="nav-link text-light" href="{{ route('popular') }}">Popular</a>

                </li>
                <li class="nav-item text-light">

                    <a class="nav-link text-light" href="{{ route('favorite') }}">Favorite</a>

                </li>
            </ul>
            @php
            $searchTXT='';
            @endphp
            <div id="searchDiv">
                <form class="d-flex" action="{{ route('searchS',['st'=> $searchTXT]) }}" method="post" role="search" id="searchTextBox1">
                    @csrf
                    <input type="search" style="border-radius: 0.5em" class="m-0" autocomplete="off" id="searchTextBox" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light m-1" type="submit">Search</button>
                    <div id="searchResult" class="container dropdown-menu-end hide">
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
<hr>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $('document').ready(() => {

    });

    function getSearchData() {
        var url = "{{ route('searchText',['searchText' => ':a'])}}";
        var formUrl = "{{ route('searchS',['st' => ':a'])}}";
        // if(document.getElementById('searchTextBox').value=='') return;
        url = url.replace(':a', encodeURIComponent(document.getElementById('searchTextBox').value));
        formUrl = formUrl.replace('%3Aa', encodeURIComponent(document.getElementById('searchTextBox').value));
        document.getElementById("searchTextBox1").action = formUrl;


        console.log(url);
        console.log('formurl', formUrl);

        jQuery.ajax({
            url: url
            , dataType: 'json'
            , type: 'get'
            , success: function(result) {
                console.log('success');
                console.log(result.searchTitles);
                console.log(result.searchStaff);
                console.log(result.searchUsers);
                console.log(result.serchCharacter.length);

                var htmlTitle = '';
                var htmlStaff = '';
                var htmlUser = '';
                var htmlCharacters = '';

                if (!result.searchTitles.length <= 0) {
                    for (let i = 0; i < result.searchTitles.length; i++) {
                        if (i > 4) {
                            break;
                        }
                        var c = "{{ route('title',['title'=>':a']) }}".replace(':a', result.searchTitles[i].title_id);
                        htmlTitle = htmlTitle + `
                            <a href='${c}' class='row'>
                                <div class='col-2'> 
                                    <img class="img-fluid img-thumbnail" style="max-width: 50px" src="${result.searchTitles[i].image}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'"> 
                                </div>
                                <div class='col'>${ result.searchTitles[i].titlename} </div>
                            </a>
                            <hr>
                        `
                    }
                } else {
                    htmlTitle = "No Results"
                }
                if (!result.searchStaff.length <= 0) {

                    for (let i = 0; i < result.searchStaff.length; i++) {
                        if (i > 4) {
                            break;
                        }
                        var c = "{{ route('staff',['staff'=>':a']) }}".replace(':a', result.searchStaff[i].staff_id);
                        htmlStaff = htmlStaff + `
                            <a href='${c}' class='row'>
                                <div class='col-2'>
                                    <img class="img-fluid img-thumbnail" style="max-width: 50px" src="${result.searchStaff[i].image}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'">
                                </div>
                                <div class='col'>${ result.searchStaff[i].firstname==null?'': result.searchStaff[i].firstname} 
                                ${ result.searchStaff[i].miiddlename==null?'':result.searchStaff[i].miiddlename} ${result.searchStaff[i].lastname==null?'':result.searchStaff[i].lastname} </div>
                            </a>
                            <hr>
                            `

                    }
                } else {
                    htmlStaff = "No Results"
                }
                if (!result.searchUsers.length <= 0) {

                    for (let i = 0; i < result.searchUsers.length; i++) {
                        if (i > 4) {
                            break;
                        }
                        var c = "{{ route('user',['user'=>':a']) }}".replace(':a', result.searchUsers[i].username);
                        htmlUser = htmlUser + `
                        <a href='${c}' class='row'>
                            <div class='col-2'> 
                                <img class="img-fluid img-thumbnail" style="max-width: 50px" src="${result.searchUsers[i].user_image}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'"> 
                            </div>
                        <div class='col'>${ result.searchUsers[i].username} </div> 
                        </a>
                            <hr>
                            `

                    }
                } else {
                    htmlUser = "No Results"
                }
                if (!result.serchCharacter.length <= 0) {
                    for (let i = 0; i < result.serchCharacter.length; i++) {
                        if (i > 4) {
                            break;
                        }
                        var c = "{{ route('character',['character'=>':a']) }}".replace(':a', result.serchCharacter[i].char_id);
                        htmlCharacters = htmlCharacters + `
                        <a href='${c}' class='row'>
                            <div class='col-2'> 
                                <img class="img-fluid img-thumbnail" style="max-width: 50px" src="${result.serchCharacter[i].characterImage}" alt="img" onerror="this.onerror=null;this.src='{{URL::asset('/No-Image-Placeholder.svg.png')}}'"> 
                            </div>
                            <div class='col'>${ result.serchCharacter[i].characterName==null?"":result.serchCharacter[i].characterName} </div>

                        </a>
                            <hr>
                        `
                    }
                } else {
                    htmlCharacters = "No Results"
                }
                $('#searchResult').
                html(`
                <div class='container genrebordeR'>

                    <h5>Title</h5>
                        ${htmlTitle}
                    </div>
                <div class='container genrebordeR'>
                    <h5>Staff</h5>
                        ${htmlStaff}
                </div>
                <div class='container genrebordeR'>


                    <h5>Characters</h5>
                        ${htmlCharacters}
                </div>
                <div class='container genrebordeR'>


                    <h5>Users</h5>
                        ${htmlUser}
                </div>`);
            }
            , error: function(result) {
                console.log('error');
                // console.log(result);
            }
        , });

    }
    document.getElementById('searchTextBox').addEventListener('input', (e) => {
        // console.log(e);
        // console.log(searchTextBox.value);
        // console.log(searchTextBox.value);
        document.getElementById("searchResult").classList.remove("hide");
        getSearchData();

    });

    document.querySelector('#searchDiv').addEventListener('focusout', (e) => {
        console.log(e.relatedTarget);
        if (!document.querySelector('#searchDiv').contains(e.relatedTarget)) {
            console.log('focus is now outside of container')
            document.getElementById("searchResult").classList.add("hide");
        } else {
            console.log('focus is now inside of container')
        }
    });

    document.querySelector('#searchDiv').addEventListener('focus', (e) => {
        console.log('focus is now inside of container')
    });


    // document.getElementById('searchTextBox').addEventListener("focusout", (e) => {
    //     // console.log(searchTextBox.value);
    //     // console.log();

    // });

</script>
