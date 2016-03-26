@extends('frontend.layout')
@section('content')

<h1>Beer Map</h1>
<div class="col-lg-12">
    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <div id="beer-map" style="width:100%;height:50%"></div>
</div>
<h1>Random Beers</h1>
<div class="col-lg-12">
    @foreach(Beer::random(8) as $beer)
        @include('includes.beer',['beer'=>$beer])
    @endforeach
</div>
{{HTML::script('js/beermap.js')}}
@stop