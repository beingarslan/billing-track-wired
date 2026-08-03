@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        ready(function () {
            addEvent(document, 'click', ".btn-bill-expense", (e) => {
                // e.target is the <i class="fa fa-dollar-sign"> on a touch tap; resolve the
                // real trigger so data-expense-id is never undefined.
                const trigger = e.target.closest('.btn-bill-expense')
                loadModal('{{ route('expenses.expenseBill.create') }} ', {
                    id: trigger.dataset.expenseId,
                    redirectTo: '{{ request()->fullUrl() }}'
                })
            })
        });
    </script>
@stop

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.expenses')</div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="d-flex">
                        {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                        <div class="input-group flex-wrap gap-1">
                            {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                            {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                            {!! Form::select('category', $categories, request('category'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                            {!! Form::select('vendor', $vendors, request('vendor'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <a href="{{ route('expenses.create') }}" class="btn btn-primary rounded border"><i
                                class="fa fa-plus"></i> @lang('bt.create_expense')</a>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="card ">
            <div class="card-body">
                <livewire:data-tables.module-table :module_type="'Expense'"/>
            </div>
        </div>
    </section>
@stop

