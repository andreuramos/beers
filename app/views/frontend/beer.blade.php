@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-beer"></i>&nbsp; {{$beer->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-3 col-md-12">
                    {{HTML::image($beer->mainStickerPath(),$beer->name,['style'=>"max-width:200px"])}}
                </div>
                <div class="col-lg-9 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-industry"></i>@foreach($beer->brewer as $brewer) {{$brewer->name}} @endforeach</li>
                        <li class="list-group-item"><i class="fa fa-globe"></i>
                            @foreach($beer->brewer as $brewer)
                                <img src="{{$brewer->locality->flag()->path}}" style="max-width: 20px">{{$brewer->locality->completeName()}}
                            @endforeach
                        </li>
                    </ul>
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
@stop