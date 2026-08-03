@extends('layouts.master')

@section('content')

    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3 me-auto">@lang('bt.addons')</div>
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
                        <th>@lang('bt.name')</th>
                        <th>@lang('bt.author')</th>
                        <th>@lang('bt.web_address')</th>
                        <th>@lang('bt.status')</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($addons as $addon)
                        <tr>
                            <td data-label="@lang('bt.name')">{{ $addon->name }}</td>
                            <td data-label="@lang('bt.author')">{{ $addon->author_name }}</td>
                            <td data-label="@lang('bt.web_address')" class="text-break">{{ $addon->author_url }}</td>
                            <td data-label="@lang('bt.status')">
                                @if ($addon->enabled)
                                    <span class="badge bg-success">@lang('bt.enabled')</span>
                                @else
                                    <span class="badge bg-danger">@lang('bt.disabled')</span>
                                @endif
                            </td>
                            <td>
                                @if ($addon->enabled)
                                    <a href="#" class="btn btn-sm btn-secondary"
                                       onclick="swalConfirm('@lang('bt.uninstall_addon_warning')', '', '{{ route('addons.uninstall', [$addon->id]) }}');">@lang('bt.disable')</a>
                                    @if ($addon->has_pending_migrations)
                                        <a href="{{ route('addons.upgrade', [$addon->id]) }}"
                                           class="btn btn-sm btn-info">@lang('bt.complete_upgrade')</a>
                                    @endif
                                @else
                                    <a href="{{ route('addons.install', [$addon->id]) }}"
                                       class="btn btn-sm btn-secondary">@lang('bt.install')</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>

@stop
