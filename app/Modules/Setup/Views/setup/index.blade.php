@extends('setup.master')

@section('content')
    <section class="app-content-header">
        <h1>@lang('bt.license_agreement')</h1>
    </section>
    <section class="content">
        {!! Form::open() !!}
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class=" card card-light">
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::textarea('', $license, ['id' => 'license', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="mb-3 form-check d-inline-block text-start">
                            {!! Form::checkbox('accept', 1, null, ['id' => 'accept', 'class' => 'form-check-input']) !!}
                            <label class="form-check-label" for="accept">@lang('bt.license_agreement_accept')</label>
                        </div>
                        {!! Form::submit(trans('bt.i_accept'), ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@stop
