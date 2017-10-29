@extends('backend.layout')
@section('content')
    <h1>Manager</h1>
    <div class="row">
        <div class="jumbotron col-lg-3 col-md-6 col-sm-12">
            <h2><a href="{{URL::to('dashboard/beers')}}"><i class="fa fa-beer"></i> Beers</a></h2>
            <h1>{{count(Beer::all())}}</h1>
        </div>
        <div class="jumbotron col-lg-3 col-md-6 col-sm-12">
            <h2><a href="{{URL::to('dashboard/brewers')}}"><i class="fa fa-industry"></i> Brewers</a></h2>
            <h1>{{count(Brewer::all())}}</h1>
        </div>
        <div class="jumbotron col-lg-3 col-md-6 col-sm-12">
            <h2><a href="{{URL::to('dashboard/localities')}}"><i class="fa fa-globe"></i> Localities</a></h2>
            <h1>{{count(Locality::all())}}</h1>
        </div>
        <div class="jumbotron col-lg-3 col-md-6 col-sm-12">
            <h2><a href="{{URL::to('dashboard/styles')}}"><i class="fa fa-font"></i> Styles</a></h2>
            <h1>{{count(Style::all())}}</h1>
        </div>
    </div>
@stop


