@extends('frontend.layout')
@section('content')

<div class="col-lg-12" id="upper-div">

    <div class="col-lg-8 col-md-12">
        <h2>Search</h2>
        <div class="input-group col-lg-12">
            <input class="form-control" placeholder="beer name" id="home-search" name="home-search" type="text"/>
        </div>
        <div clas="col-lg-12" id="home-search-results"></div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-12">
        <h1 class="text-center">{{Beer::count()}}</h1>
        <h2 class="text-center">Beers</h2>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-12">
        <h1 class="text-center">{{Locality::countCountries()}}</h1>
        <h2 class="text-center">Countries</h2>
    </div>
</div>

<div class="col-lg-12">
    <h2>Beer Map</h2>
    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <div id="beer-map" style="width:100%;height:50%"></div>
</div>

<div class="col-lg-12">
    <h2>Random Beers</h2>
    @foreach(Beer::random(8) as $beer)
        @include('includes.beer',['beer'=>$beer])
    @endforeach
</div>
{{HTML::script('js/beermap.js')}}
{{HTML::script('js/home.js')}}
@stop