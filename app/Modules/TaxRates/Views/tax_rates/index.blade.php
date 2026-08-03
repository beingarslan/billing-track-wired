@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.tax_rates')</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('taxRates.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> @lang('bt.create_taxrate')</a>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover bt-stack">
                    <thead>
                    <tr>
                        <th>{!! Sortable::link('name', trans('bt.name')) !!}</th>
                        <th>{!! Sortable::link('percent', trans('bt.percent')) !!}</th>
                        <th>{!! Sortable::link('is_compound', trans('bt.compound')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($taxRates as $taxRate)
                        <tr>
                            <td data-label="@lang('bt.name')">{{ $taxRate->name }}</td>
                            <td data-label="@lang('bt.percent')">{{ $taxRate->formatted_percent }}</td>
                            <td data-label="@lang('bt.compound')">{{ $taxRate->formatted_is_compound }}</td>
                            <td>
                                <div class="btn-group position-static">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('taxRates.edit', [$taxRate->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('taxRates.delete', [$taxRate->id]) }}');"><i
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
            {!! $taxRates->appends(request()->except('page'))->render() !!}
        </div>
    </section>
@stop
