@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        ready(function () {
            document.getElementById('name').focus()
        })
    </script>

    @if ($editMode == true)
        {!! Form::model($paymentMethod, ['route' => ['paymentMethods.update', $paymentMethod->id]]) !!}
    @else
        {!! Form::open(['route' => 'paymentMethods.store']) !!}
    @endif

    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3 me-auto">@lang('bt.payment_method_form')</div>
                    <div class="bt-action-bar">
                        <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-save"></i> @lang('bt.save') </button>
                        <a class="btn btn-warning" href={!! route('paymentMethods.index')  !!}><i
                                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="control-group">
                    <label>@lang('bt.payment_method'): </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
@stop
