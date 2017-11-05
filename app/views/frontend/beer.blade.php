@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-beer"></i>&nbsp; {{$beer->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-3 col-md-12">
                    {{HTML::image($beer->mainStickerPath(),$beer->name,['style'=>"max-width:200px"])}}
                </div>
                <div class="col-lg-5 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fa fa-industry"></i>&nbsp;@foreach($beer->brewer as $brewer) <a href="/brewer/{{$brewer->id}}">{{$brewer->name}}</a> @endforeach</li>
                        <li class="list-group-item"><i class="fa fa-globe"></i>&nbsp;
                            @foreach($beer->brewer as $brewer)
                                <img src="{{$brewer->locality->flag()->path}}" style="max-width: 20px">{{$brewer->locality->completeName()}}
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-font">&nbsp;<a href="/style/{{$beer->style_id}}">{{$beer->style->name}}</a></i>
                        </li>
                    </ul>
                    {{Form::hidden('beer_id',$beer->id,['id'=>"beer_id"])}}
                </div>
                <div class="col-lg-4 col-md-12" id="map" style="height:25%">
                    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Related Beers</h2>
            @foreach(Beer::random(4) as $beer)
                @include('includes.beer',['beer'=>$beer])
            @endforeach
        </div>

    </div>
    {{HTML::script('js/single-map.js')}}
@stop