{{--
This include must be called whith the following params
    * element_name = style | brewer | beer ...
    * elements, an array of Model Objects with at least an attribute name and an id
--}}
<ul class="list-group">
    @foreach($elements as $element)
        <li class="list-group-item clearfix">
            <span>{{$element->name}} </span>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-info" onclick="edit{{ucfirst($element_name)}}({{$element->id}})">Edit</button>
                <a href="{{URL::to('/dashboard/'.$element_name.'s/delete/'.$element->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
            </div>
        </li>
    @endforeach
</ul>