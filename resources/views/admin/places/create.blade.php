@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.places.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.places.store'], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.places.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 form-group">
                    {!! Form::label('description', trans('quickadmin.places.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            {{-- </div>
            <div class="row"> --}}                
                <div class="col-xs-12 col-md-6  form-group">
                    {!! Form::label('image', trans('quickadmin.places.fields.image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('image', old('image'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            {{-- </div>
                <div class="row"> --}}
                    <div class="col-xs-12 col-md-6  form-group">
                        {!! Form::label('location_id', trans('quickadmin.places.fields.location').'', ['class' => 'control-label']) !!}
                        {!! Form::select('location_id', $locations, old('location_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('location'))
                            <p class="help-block">
                                {{ $errors->first('location') }}
                            </p>
                        @endif
                    </div>
                {{-- </div>
            <div class="row"> --}}
                <div class="col-xs-12 col-md-6 form-group">
                    {!! Form::label('price', trans('quickadmin.places.fields.price').'', ['class' => 'control-label']) !!}
                    {!! Form::number('price', old('price'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('price') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

