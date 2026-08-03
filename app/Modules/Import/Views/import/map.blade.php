@extends('layouts.master')

@section('content')

    {!! Form::open(['route' => ['import.map.submit', $importType], 'class' => 'form-horizontal']) !!}

    <section class="app-content-header">
        <div class="bt-toolbar px-3">
            <h3 class="mb-0 me-auto">
                @lang('bt.map_fields_to_import')
            </h3>
            <div class="d-flex flex-wrap gap-2">
                {!! Form::submit(trans('bt.submit'), ['class' => 'btn btn-primary bt-fluid-sm']) !!}
            </div>
        </div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tbody>
                    @foreach ($importFields as $key => $field)
                        <tr>
                            <td class="w-25 text-break">{{ $field }}</td>
                            <td>{!! Form::select($key, $fileFields, (is_numeric(array_search($key, $fileFields)) ? array_search($key, $fileFields) : null), ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
