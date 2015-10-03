@extends('frontend.layout')
@section('content')
<h1>Random Beers</h1>
<div class="col-lg-12">
    @foreach(Beer::random(8) as $beer)
        @include('includes.beer',['beer'=>$beer])
    @endforeach
</div>
@stop