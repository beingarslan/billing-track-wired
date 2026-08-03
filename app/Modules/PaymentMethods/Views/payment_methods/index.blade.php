@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.payment_methods')</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('paymentMethods.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> @lang('bt.create_paymentmethod')</a>
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
                        <th>{!! Sortable::link('name', trans('bt.payment_method')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($paymentMethods as $paymentMethod)
                        <tr>
                            <td data-label="@lang('bt.payment_method')">{{ $paymentMethod->name }}</td>
                            <td>
                                <div class="btn-group position-static">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                           href="{{ route('paymentMethods.edit', [$paymentMethod->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('paymentMethods.delete', [$paymentMethod->id]) }}');"><i
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
            {!! $paymentMethods->appends(request()->except('page'))->render() !!}
        </div>
    </section>
@stop
