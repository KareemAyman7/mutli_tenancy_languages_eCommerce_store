
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{__('admin\sidebar.main_categories')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin\sidebar.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('admin\sidebar.main_categories')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('admin\categories.all_main_categories')}} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table id="example_table"
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>{{__('admin\categories.table_name')}} </th>
                                                <th>{{__('admin\categories.table_type')}}</th>
                                                <th>{{__('admin\categories.table_name_link')}}</th>
                                                <th>{{__('admin\categories.table_status')}}</th>
                                                <th>{{__('admin\categories.table_photo')}}</th>
                                                <th>{{__('admin\categories.table_action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($categories)
                                                @foreach($categories as $category)
                                                    <tr style="font-weight: 700;">
                                                        <td>{{$category -> name}}</td>
                                                        <td>{{$category -> getType()}}</td>
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
                                                    @if (count($category -> subcats) != 0)
                                                        @foreach ($category -> subcats as $cat)
                                                            <tr style="">
                                                                <td>{{$cat -> name}}</td>
                                                                <td>{{$cat -> getType()}} - {{$category -> name}}</td>
                                                                <td>{{$cat -> slug}}</td>
                                                                <td>{{$cat -> getActive()}}</td>
                                                                <td> <img style="width: 100px; height: 100px;" src=" "></td>
                                                                <td>
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
                                                                        <a href="{{route('admin.maincategories.edit',$cat -> id)}}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\general.edit_action')}}</a>
        
        
                                                                        <a href="{{route('admin.maincategories.delete',$cat -> id)}}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\general.delete_action')}}</a>
        
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop


@section('script')
    <script>
        /*$('#example_table').DataTable({
            "ordering": false
        });*/
    </script>
@endsection