@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.places.title')</h3>
    {{-- @can('place_create') --}}
        <p>
            <a href="{{ route('admin.places.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

        </p>
    {{-- @endcan --}}

    {{-- @can('place_delete') --}}
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.places.index') }}"
                   style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a>
            </li>
            |
            <li><a href="{{ route('admin.places.index') }}?show_deleted=1"
                   style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a>
            </li>
        </ul>
        </p>
    {{-- @endcan --}}


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($places) > 0 ? 'datatable' : '' }} 
                {{-- @can('place_delete')  --}}
                @if ( request('show_deleted') != 1 ) dt-select @endif 
                {{-- @endcan --}}
                ">
                <thead>
                <tr>
                    {{-- @can('place_delete') --}}
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>@endif
                    {{-- @endcan --}}

                    <th>@lang('quickadmin.places.fields.title')</th>
                    <th>@lang('quickadmin.places.fields.image')</th>
                    <th>@lang('quickadmin.places.fields.location')</th>
                    <th>@lang('quickadmin.places.fields.description')</th>
                    <th>@lang('quickadmin.places.fields.price')</th>
                    @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                    @else
                        <th>&nbsp;</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @if (count($places) > 0)
                    @foreach ($places as $place)
                        <tr data-entry-id="{{ $place->id }}">
                            {{-- @can('place_delete') --}}
                                @if ( request('show_deleted') != 1 )
                                    <td></td>@endif
                            {{-- @endcan --}}

                            <td field-key='title'>{{ $place->title }}</td>
                            <td field-key='image'><img style="width: 100px;" src="{{ asset('public/storage/'.$place->image) }}" alt="Place Image"></td>
                            <td field-key='location'>{{ $place->location_id }}</td>
                            <td field-key='description'>{!! $place->description !!}</td>
                            <td field-key='price'>{{ $place->price }}</td>
                            @if( request('show_deleted') == 1 )
                                <td>
                                    {{-- @can('place_delete') --}}
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.places.restore', $place->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    {{-- @endcan
                                    @can('place_delete') --}}
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.places.perma_del', $place->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    {{-- @endcan --}}
                                </td>
                            @else
                                <td>
                                    {{-- @can('place_view') --}}
                                        <a href="{{ route('admin.places.show',[$place->id]) }}"
                                           class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    {{-- @endcan
                                    @can('place_edit') --}}
                                        <a href="{{ route('admin.places.edit',[$place->id]) }}"
                                           class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    {{-- @endcan
                                    @can('place_delete') --}}
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.places.destroy', $place->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    {{-- @endcan --}}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        // @can('place_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.places.mass_destroy') }}'; @endif
        // @endcan

    </script>
@endsection