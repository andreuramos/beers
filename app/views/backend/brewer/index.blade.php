@extends('backend.layout')
@section('content')

    <h1><i class="fa fa-industry"></i>&nbsp; Brewers</h1><!-- Button trigger modal -->
    <a href="{{URL::to('dashboard/brewers/create')}}"><button type="button" id="new-element" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        New Brewer
    </button></a>
    {{Form::hidden('element_name','brewer',['id'=>'element_name'])}}
    <!-- list -->
    <br>
    <div class="row">
        @if(count($brewers))
            @include('includes.crud_list',['element_name'=>"brewer",'elements'=>$brewers])
        @else
            <div class="jumbotron">
                <h2>No Brewers added yet</h2>
            </div>
        @endif
    </div>


@stop