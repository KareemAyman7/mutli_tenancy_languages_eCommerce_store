

<tr @if($category->parent_id) style="font-weight: 700;" @endif>
    <td>{{$category -> name}}</td>
    <td>{{$category -> getType()}}-{{$category->parent_cat->name ?? ''}}</td>
    <td>{{$category -> slug}}</td>
    <td>{{$category -> getActive()}}</td>
    <td> <img style="width: 100px; height: 100px;" src=" "></td>
    <td>
        <div class="btn-group" role="group"
             aria-label="Basic example">
            <a href="{{route('admin.maincategories.edit',$category -> id)}}"
               class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\general.edit_action')}}</a>


            <a href="{{route('admin.maincategories.delete',$category -> id)}}"
               class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\general.delete_action')}}</a>

        </div>
    </td>
</tr>

@if (count($category['subcats']) > 0)
    @foreach($category['subcats'] as $category)
        @include('admin.categories.subcats_index', $category)
    @endforeach
@endif