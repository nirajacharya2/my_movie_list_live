@extends('app')
@section('content')
<style>
    #hidden {
        /* display: inline; */
        /* display: none; */
    }

    div {
        border: 1px solid black;
    }

</style>
hi {{ $cum }}


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<div id="extraphp" style="display: ;">extraphpcode</div>



<div class="container-sm">100% wide until small breakpoint</div>
<div class="container-md">100% wide until medium breakpoint</div>
<div class="container-lg">100% wide until large breakpoint</div>
<div class="container-xl">100% wide until extra large breakpoint</div>
<div class="container-xxl">100% wide until extra extra large breakpoint</div>


<?php $abc= "cum"?>

<script>
    $('document').ready(() => {
        
    });

    // console.log("{{ $abc }}")
    var c = 'happE';


    function addDiv(id, content) {
        var d = document.createElement("div");
        d.id = id;
        d.textContent = content;
        document.body.appendChild(d);
        // console.log("{{ $cum }}")
    }

    function writePhpCode(content) {
        var e = document.getElementById("extraphp");
        e.textContent = content;
        // console.log("{{ $cum }}")
    }

</script>

<?php $abc= "<script>document.write(c)</script>";
echo $abc;
?>
<script>
// console.log('{{ $abc }}')
</script>


@endsection
