@extends('layouts.master')

@section('content')
    <script type="text/javascript">
        ready(function () {
            var passwordField = document.getElementById('password')
            if (passwordField && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                passwordField.focus()
            }
        });
    </script>

    {!! Form::open(['route' => ['users.password.update', $user->id]]) !!}

    <section class="app-content-header">
        <div class="bt-toolbar px-3">
            <h3 class="me-auto mb-0">
                @lang('bt.reset_password'): {{ $user->name }} ({{ $user->email }})
            </h3>
            <div class="bt-action-bar">
                <button type="submit" class="btn btn-primary"><i
                            class="fa fa-user-lock"></i> @lang('bt.reset_password') </button>
                <a class="btn btn-warning" href={!! route('users.index')  !!}><i
                            class="fa fa-ban"></i> @lang('bt.cancel')</a>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="mb-3">
                    <label>@lang('bt.password'): </label>
                    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    <label>@lang('bt.password_confirmation'): </label>
                    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
@stop
