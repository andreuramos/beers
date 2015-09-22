@extends('backend.layout')
@section('content')
    {{HTML::script('js/backend/style-index.js')}}
    <h1>Styles</h1><!-- Button trigger modal -->
    <button type="button" id="new-style" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
        New Style
    </button>

    <!-- list -->
    @if(count($styles))
        <ul class="list-group">
        @foreach($styles as $style)
            <li class="list-group-item clearfix">
                <span>{{$style->name}} </span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-info" onclick="editStyle({{$style->id}})">Edit</button>
                    <a href="{{URL::to('/dashboard/styles/delete/'.$style->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </div>
            </li>
        @endforeach
        </ul>
    @else
            <h2>No styles added yet</h2>
    @endif
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Style</h4>
                </div>
                <div class="modal-body" style="padding:5%">
                    @include('backend.style.form',['style'=>new Style()])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop