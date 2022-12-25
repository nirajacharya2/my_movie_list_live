@extends('app')
{{-- @extends('title/title') --}}
@section('title','reviews')
@section('content')
<style>
    div {
        border: 1px black solid;
    }

</style>
<div class="container-xxl">
    <div class="row">
        <div class="col-md-auto text-center">
            <div>
                <img class="img-fluid" style="max-width:250px" src="" onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';">
            </div>
        </div>
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="container tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="row" style="white-space: pre-line">
                        <div class="col text-break">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                        <div class="col text-break">bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb</div>
                    </div>
                    <div class="row text-break" style="white-space: pre-line">cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc</div>

                    <div class="row text-break" style="white-space: pre-line">dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</div>

                    <div class="row text-break" style="white-space: pre-line">eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee</div>

                </div>
                <div class="container tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('extraScripts')
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
