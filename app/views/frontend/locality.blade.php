@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-globe"></i>&nbsp; {{$locality->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-3 col-md-12">
                    @if($locality->flag())
                        {{HTML::image($locality->flag()->path,$locality->name,['style'=>"max-width:200px"])}}
                    @endif
                </div>
                <div class="col-lg-5 col-md-12">
                    <ul class="list-group">
                        @foreach($locality->hierarchy() as $parent_locality)
                        <li class="list-group-item">
                            <i class="fa fa-globe"></i>&nbsp;
                            @if($parent_locality->flag())
                                <img src="{{$parent_locality->flag()->path}}" style="max-width:20px">&nbsp;
                            @endif
                            <a href="/locality/{{$parent_locality->id}}">{{$parent_locality->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    {{Form::hidden('locality_id',$locality->id,['id'=>"locality_id"])}}
                </div>
                <div class="col-lg-4 col-md-12" id="map" style="height:25%">
                    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Brewers</h2>
            <ul class="list-group">
                @foreach($locality->brewers() as $brewer)
                    <li class="list-group-item">
                        <i class="fa fa-industry"></i>&nbsp;
                        <img src="{{$brewer->logoUrl()}}" style="max-height:30px">&nbsp;
                        <a href="/brewer/{{$brewer->id}}">{{$brewer->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="row">
            <h2>Produced Beers</h2>
            @foreach($locality->beers() as $beer)
                @include('includes.beer',['beer'=>$beer])
            @endforeach
        </div>

    </div>
    {{HTML::script('js/single-map.js')}}
@stop