@extends('frontend.layout')
@section('content')
<h1>Hello world</h1>
<div class="col-lg-12">
    @foreach(Beer::all() as $beer)
        @include('includes.beer',['beer'=>$beer])
    @endforeach
</div>
@stop