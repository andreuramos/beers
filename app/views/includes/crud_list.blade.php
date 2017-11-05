{{--
This include must be called whith the following params
    * element_name = style | brewer | beer ...
    * elements, an array of Model Objects with at least an attribute name and an id
--}}

<div class="col-lg-12">
    <div class="row">
        <div class="input-group col-lg-12 left search-div" style="margin-botton:5%">
            <input type="hidden" id="element" value="{{$element_name}}">
            <input type="text" class="search-crud form-control" placeholder="Search {{$element_name}}" style="clear:both">
        </div>
    </div>
    <div class="row">
        <div class="panel">
        <ul class="list-group" id="crud-list">
            @foreach($elements as $element)
                <li class="list-group-item clearfix">
                    @if($element_name=="locality" && $element->flag())
                        <img class="col-lg-1" src="{{$element->flag()->path}}" style="height:auto; max-width:100%">&nbsp;
                    @elseif($element_name=="brewer" && $element->logo())
                        <img class="col-lg-1" src="{{$element->logo()->path}}" style="height:auto; max-width:100%">&nbsp;
                    @endif
                    <span class="col-lg-4">{{$element->name}} </span>
                    <span class="col-lg-2 visible-lg text-muted">
                        @if($element_name=="brewer" || $element_name=="beer")
                            <img src="{{$element->country()->flag()->path}}" style="width:15px">
                            &nbsp;{{$element->country()->name}}
                        @endif
                    </span>
                    <div class="col-lg-3 btn-group pull-right">
                        @if($element_name=="brewer" || $element_name=="beer")
                            <a href="{{URL::to('/dashboard/'.$element_name.'s/edit/'.$element->id)}}">
                        @endif
                            <button type="button" class="btn btn-info" @if($element_name!="brewer" && $element_name=="beer")onclick="editElement({{$element->id}})"@endif>Edit</button>
                        @if($element_name=="brewer" || $element_name=="beer")
                            </a>
                        @endif
                        <a href="{{URL::to('/dashboard/'.$element_name.'s/delete/'.$element->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </div>
                </li>
            @endforeach
        </ul>
        </div>
    </div>
    {{HTML::script('js/backend/crud-list.js')}}
</div>