@extends('layouts.master')

@section('content')
    @include('layouts._alerts')
    <section class="app-content-header">
        <form method='POST' action="{{route('users.permissions.update', $permission->id)}}">
            @csrf
            @method('PUT')
            <div class="card card-light">
                <div class="card-header bt-toolbar">
                    <h3 class="card-title me-auto mb-0"><i
                                class="fa fa-edit fa-fw"></i>
                        @lang('bt.acl_edit_permission')
                    </h3>
                    <button type="submit" class="btn btn-primary"><i
                                class="fa fa-save"></i> @lang('bt.save') </button>
                    <a class="btn btn-warning" href="{{ $returnUrl }}"><i
                                class="fa fa-ban"></i> @lang('bt.cancel')</a>
                </div>
                <div class="card-body">
                    <div class="form-group col-12 col-md-3 mb-3">
                        <label class="fw-bold mb-1" for="name">@lang('bt.acl_perm_name')</label>
                        <input type="text" name="name" value="{{$permission->name}}" class='form-control'
                               placeholder='@lang('bt.acl_perm_name')'>
                    </div>
                    <div class="form-group col-12 col-md-3 mb-3">
                        <label class="fw-bold mb-1" for="description">@lang('bt.description')</label>
                        <textarea name="description" class='form-control' placeholder='@lang('bt.description')'>{{$permission->description}}</textarea>
                    </div>
                    <div class="form-group col-12 col-md-3 mb-3">
                        <label class="fw-bold mb-1" for="name">@lang('bt.acl_perm_group')</label>
                        <input type="text" name="group" value="{{$permission->group}}" class='form-control'
                               placeholder='@lang('bt.acl_perm_group')'>
                    </div>
                    <div class="form-group col-12 col-md-3 mb-3">
                        <label class="fw-bold mb-1" for="guard_name">@lang('bt.acl_guard_name')</label>
                        <input type="text" name="guard_name" value="{{$permission->guard_name}}" class='form-control'
                               placeholder='@lang('bt.acl_guard_name')'>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
