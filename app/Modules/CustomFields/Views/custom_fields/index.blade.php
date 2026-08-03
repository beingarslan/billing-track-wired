@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.custom_fields')</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('customFields.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> @lang('bt.create_customfield')</a>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover bt-stack">
                    <thead>
                    <tr>
                        <th>{!! Sortable::link('tbl_name', trans('bt.table_name')) !!}</th>
                        <th>{!! Sortable::link('column_name', trans('bt.column_name')) !!}</th>
                        <th>{!! Sortable::link('field_label', trans('bt.field_label')) !!}</th>
                        <th>{!! Sortable::link('field_type', trans('bt.field_type')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customFields as $customField)
                        <tr>
                            <td data-label="@lang('bt.table_name')">{{ $tableNames[$customField->tbl_name] }}</td>
                            <td data-label="@lang('bt.column_name')">{{ $customField->column_name }}</td>
                            <td data-label="@lang('bt.field_label')">{{ $customField->field_label }}</td>
                            <td data-label="@lang('bt.field_type')">{{ $customField->field_type }}</td>
                            <td>
                                <div class="btn-group position-static">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                           href="{{ route('customFields.edit', [$customField->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('customFields.delete', [$customField->id]) }}');"><i
                                                    class="fa fa-trash-alt text-danger"></i> @lang('bt.delete')</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center justify-content-md-end flex-wrap">
            {!! $customFields->appends(request()->except('page'))->render() !!}
        </div>
    </section>
@stop
