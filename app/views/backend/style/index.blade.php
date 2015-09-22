@extends('backend.layout')
@section('content')

    <h1>Styles</h1><!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
        New Style
    </button>
    <!-- list -->
    @if(count($styles))
        @foreach($styles as $style)
            {{$style->name}}<br>
        @endforeach
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