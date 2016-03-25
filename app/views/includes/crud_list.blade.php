{{--
This include must be called whith the following params
    * element_name = style | brewer | beer ...
    * elements, an array of Model Objects with at least an attribute name and an id
--}}

<div class="col-lg-12">
    <div class="input-group col-lg-12 left search-div" style="margin-botton:5%">
        <input type="hidden" id="element" value="{{$element_name}}">
        <input type="text" class="search-crud form-control" placeholder="Search {{$element_name}}" style="clear:both">
    </div>
    <div class="panel">
    <ul class="list-group" id="crud-list">
        @foreach($elements as $element)
            <li class="list-group-item clearfix">
                @if($element_name=="locality" && $element->flag())
                    <img src="{{$element->flag()->path}}" style="height:15px">&nbsp;
                @elseif($element_name=="brewer" && $element->logo())
                    <img src="{{$element->logo()->path}}" style="height:15px">&nbsp;
                @endif
                <span>{{$element->name}} </span>
                <div class="btn-group pull-right">
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
    {{HTML::script('js/backend/crud-list.js')}}
</div>