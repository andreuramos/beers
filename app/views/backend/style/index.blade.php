@extends('backend.layout')
@section('content')
    {{HTML::script('js/backend/crud-list-index.js')}}
    <h1><i class="fa fa-font"></i>&nbsp; Styles</h1><!-- Button trigger modal -->
    <button type="button" id="new-style" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        New Style
    </button>

    {{Form::hidden('element_name','style',['id'=>'element_name'])}}
    <!-- list -->
    <div class="row">
    @if(count($styles))
        @include('includes.crud_list',['element_name'=>"style",'elements'=>$styles])
    @else
        <div class="jumbotron">
            <h2>No styles added yet</h2>
        </div>
    @endif
    </div>

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