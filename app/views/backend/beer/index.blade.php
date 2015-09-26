@extends('backend.layout')
@section('content')

    <h1><i class="fa fa-beer"></i>&nbsp; Beers</h1><!-- Button trigger modal -->
    <a href="{{URL::to('dashboard/beers/create')}}"><button type="button" id="new-element" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        New Beer
    </button></a>
    {{Form::hidden('element_name','beer',['id'=>'element_name'])}}
    <!-- list -->
    <br>
    <div class="row">
        @if(count($beers))
            @include('includes.crud_list',['element_name'=>"beer",'elements'=>$beers])
        @else
            <div class="jumbotron">
                <h2>No Beers added yet</h2>
            </div>
        @endif
    </div>


@stop