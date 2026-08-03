@extends('layouts.master')

@section('content')
    <script type="text/javascript">
        ready(function () {
            // Do not pop the soft keyboard before the page settles on a touch device.
            var nameField = document.getElementById('name')
            if (nameField && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                nameField.focus()
            }
            @if ($editMode == true)
            addEvent(document, 'click', '#btn-delete-logo', (e) => {
                axios.post("{{ route('companyProfiles.deleteLogo', [$companyProfile->id]) }}").then(function () {
                    document.getElementById('div-logo').innerHTML = ''
                });
            });
            @endif
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($companyProfile, ['route' => ['companyProfiles.update', $companyProfile->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'companyProfiles.store', 'files' => true]) !!}
    @endif

    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3 me-auto">@lang('bt.company_profile_form')</div>
                    <div class="bt-action-bar">
                        <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-save"></i> @lang('bt.save') </button>
                        <a class="btn btn-warning" href={!! route('companyProfiles.index')  !!}><i
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
                @include('company_profiles._form')
            </div>
        </div>
    </section>
    {!! Form::close() !!}
@stop
