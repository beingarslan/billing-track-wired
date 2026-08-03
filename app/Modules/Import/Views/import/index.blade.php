@extends('layouts.master')

@section('content')

    {!! Form::open(['route' => 'import.upload', 'files' => true]) !!}

    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3 me-auto">@lang('bt.import_data')</div>
                    <div class="d-flex flex-wrap gap-2">
                        @if (!config('app.demo'))
                            {!! Form::submit(trans('bt.submit'), ['class' => 'btn btn-primary bt-fluid-sm']) !!}
                        @endif
                    </div>
                </div>
            </div></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="mb-3">
                    <label>@lang('bt.what_to_import')</label>
                    {!! Form::select('import_type', $importTypes, null, ['class' => 'form-select']) !!}
                </div>
                <div class="mb-3">
                    <label>@lang('bt.select_file_to_import')</label>
                    @if (!config('app.demo'))
                        {!! Form::file('import_file', ['class' => 'form-control']) !!}
                    @else
                        Imports are disabled in the demo.
                    @endif
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
