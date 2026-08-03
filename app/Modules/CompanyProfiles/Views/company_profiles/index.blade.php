@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3 me-auto">@lang('bt.company_profiles')</div>
                    <a href="{{ route('companyProfiles.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> @lang('bt.create_companyprofile')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>@lang('bt.company')</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companyProfiles as $companyProfile)
                        <tr>
                            <td>{{ $companyProfile->company }}</td>
                            <td>
                                {{-- position-static: the .table-responsive wrapper is overflow:auto at EVERY width, which would clip this menu on desktop too --}}
                                <div class="btn-group position-static">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('companyProfiles.edit', [$companyProfile->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '','{{ route('companyProfiles.delete', [$companyProfile->id]) }}');"><i
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
            {!! $companyProfiles->appends(request()->except('page'))->render() !!}
        </div>
    </section>
@stop
