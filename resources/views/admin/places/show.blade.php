@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.places.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.places.fields.title')</th>
                            <td field-key='title'>{{ $place->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.places.fields.description')</th>
                            <td field-key='description'>{!! $place->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.places.index') }}"
               class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
