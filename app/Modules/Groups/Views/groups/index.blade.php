@extends('layouts.master')

@section('content')

    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.groups')</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('groups.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> @lang('bt.create_group')</a>
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
                        <th>{!! Sortable::link('format', trans('bt.format')) !!}</th>
                        <th>{!! Sortable::link('next_id', trans('bt.next_number')) !!}</th>
                        <th>{!! Sortable::link('left_pad', trans('bt.left_pad')) !!}</th>
                        <th>{!! Sortable::link('reset_number', trans('bt.reset_number')) !!}</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td data-label="@lang('bt.name')">{{ $group->name }}</td>
                            <td data-label="@lang('bt.format')">{{ $group->format }}</td>
                            <td data-label="@lang('bt.next_number')">{{ $group->next_id }}</td>
                            <td data-label="@lang('bt.left_pad')">{{ $group->left_pad }}</td>
                            <td data-label="@lang('bt.reset_number')">{{ $resetNumberOptions[$group->reset_number] }}</td>
                            <td>
                                <div class="btn-group position-static">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('groups.edit', [$group->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '', '{{ route('groups.delete', [$group->id]) }}');"><i
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
            {!! $groups->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop
