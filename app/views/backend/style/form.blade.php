{{HTML::script('js/backend/style-form.js')}}
<style>
    .ui-autocomplete{
        z-index:9000;
    }
</style>

{{Form::open(['url'=>URL::to('/dashboard/styles/save'),'method'=>"post",'class'=>"form-hotizontal"])}}
{{--<form class="form-horizontal" id="style_form" method="POST" url="{}}">--}}
    {{Form::hidden('style_id')}}
    <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <input class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="parent_style">Parent Style</label>
        <input class="form-control" id="parent_style" name="parent_style">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="wikipedia">Wikipedia Entry</label>
        <input class="form-control" id="wikipedia" name="wikipedia" placeholder="http://es.wikipedia.com/...">
    </div>
    <button type="submit" class="btn btn-success col-lg-12">Save changes</button>
{{Form::close()}}
{{--</form>--}}