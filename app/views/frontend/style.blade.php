@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-font"></i>&nbsp; {{$style->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-6 col-md-12">
                    {{$style->description}}
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="list-group">
                        @if($style->style_id)
                        <li class="list-group-item">
                            <i class="fa fa-font"></i>&nbsp;
                            <a href="/style/{{$style->style_id}}">{{Style::find($style->style_id)->name}}</a>
                        </li>
                        @endif
                    </ul>
                    {{Form::hidden('style_id',$style->id,['id'=>"style_id"])}}
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Beers</h2>
            @foreach($style->beers() as $beer)
                @include('includes.beer',['beer'=>$beer])
            @endforeach
        </div>

    </div>
@stop