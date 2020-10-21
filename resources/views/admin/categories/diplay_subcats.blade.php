


<option value="{{$category -> id}}">{{str_repeat("-->", $category->depth)}}{{$category -> name}}</option>

@if (count($category['subcats']) > 0)
    @foreach($category['subcats'] as $category)
        @include('admin.categories.diplay_subcats', $category)
    @endforeach
@endif