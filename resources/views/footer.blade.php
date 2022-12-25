<style>
    .footer {
        padding: 40px 0;
        background-color: #ffffff;
        color: #4b4c4d;
    }

    .footer ul {
        padding: 0;
        list-style: none;
        text-align: center;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .footer li {
        padding: 0 10px;
    }

    .footer ul a {
        color: inherit;
        text-decoration: none;
        opacity: 0.8;
    }

    .footer ul a:hover {
        opacity: 1;
    }

    .footer .copyright {
        margin-top: 15px;
        text-align: center;
        font-size: 13px;
        color: #aaa;
        margin-bottom: 0;
    }

</style>
<div class="footer">
    <footer>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="{{ route('/') }}">Home</a></li>
            {{-- <li class="list-inline-item"><a href="#">Services</a></li> --}}
            <li class="list-inline-item"><a href="#">About</a></li>
            {{-- <li class="list-inline-item"><a href="#">Terms</a></li> --}}
            {{-- <li class="list-inline-item"><a href="#">Privacy Policy</a></li> --}}
        </ul>
        <p class="copyright">My Movie List © 2018</p>
    </footer>
</div>
