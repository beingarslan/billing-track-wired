{{-- allow reload on back button --}}
{!! header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0") !!}
{!! header("Cache-Control: post-check=0, pre-check=0", false) !!}
{!! header("Pragma: no-cache")!!}
@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        addEvent(document, 'click', "[id^=createWorkorder]", (e) => {
            date = e.target.dataset.date
            window.livewire.emit('showModal', 'modals.create-seeded-workorder-modal', date, 'showschedule')
        })
    </script>
@endsection

@section('content')
    @include('layouts._alerts')
    <div class="app-content-header">
        <div class="card">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default-default">
                    <div class="card-header h2 d-flex justify-content-center">@lang('bt.employee'){{'/'}}@lang('bt.resource') @lang('bt.schedule')</div>
                    {!! Form::open(['route' => 'scheduler.showschedule','id' => 'showschedule']) !!}
                    <div class="card-body p-1">
                        <div class="card-text d-flex flex-wrap justify-content-center gap-2 mt-1 mb-3">
                            <input type="hidden" value=" {{ $dates[0] }}" name="sdate">
                            <input class="btn btn-success" type="submit" name="back" value="<< Back">
                            <input class="btn btn-secondary" type="submit" name="today" value="<< Today >>">
                            <input class="btn btn-success" type="submit" name="forward" value="Forward >>">
                        </div>
                        <div class="row fc-view-harness">
                            @foreach($dates as $date)
                                <div class="col-12 col-lg-3">
                                    <div class="h4 d-flex justify-content-center">{{ Carbon\Carbon::parse($date)->format('l m/d/Y') }}
                                        @if(config('bt.schedulerCreateWorkorder'))
                                            <button type='button' id='createWorkorder{{ $loop->index }}'
                                                    data-date='{{ $date }}' class='btn btn-link btn-sm '
                                                    title='@lang('bt.create_workorder')'><i
                                                        class='createwobutton far fa-file-alt'></i></button>
                                        @endif
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne{{ $loop->index }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-success " type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $loop->index }}"
                                                        aria-expanded="false" aria-controls="collapseOne{{ $loop->index }}">
                                                    @lang('bt.employees_not_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne{{ $loop->index }}" class="collapse show" aria-labelledby="headingOne{{ $loop->index }}">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-sm bt-nowrap"
                                                       id="table1{{ $loop->index }}">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($aedata as $emp => $value)
                                                        @if($emp == $date)
                                                            @foreach($value as $emp)
                                                                @if($emp->driver)
                                                                    <tr>
                                                                        <td style="color: blue">{{$emp->short_name}}</td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td> {!! $emp->short_name !!}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo{{ $loop->index }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-success collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $loop->index }}"
                                                        aria-expanded="false" aria-controls="collapseTwo{{ $loop->index }}">
                                                    @lang('bt.resources_not_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo{{ $loop->index }}" class="collapse" aria-labelledby="headingTwo{{ $loop->index }}">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-sm bt-nowrap"
                                                       id="table2{{ $loop->index }}">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.resource')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ardata as $res => $value)
                                                        @if($res == $date)
                                                            @foreach($value as $res)
                                                                <tr>
                                                                    <td> {!! $res['name'] !!}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree{{ $loop->index }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-warning " type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree{{ $loop->index }}"
                                                        aria-expanded="false" aria-controls="collapseThree{{ $loop->index }}">
                                                    @lang('bt.employees_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree{{ $loop->index }}" class="collapse show" aria-labelledby="headingThree{{ $loop->index }}">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-sm bt-nowrap"
                                                       id="table3{{ $loop->index }}">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.client')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledemp as $emp)
                                                        @if($emp->job_date->format('Y-m-d') == $date)
                                                            @foreach($emp->workorderItems->sortBy('name') as $woitem)
                                                                <tr>
                                                                    @foreach ($woitem->employees as $woemp)
                                                                        @if($woemp->driver)
                                                                            <td style="color: blue">{{$woitem->name}}</td>
                                                                        @else
                                                                            <td> {{ $woitem->name }} </td>
                                                                        @endif
                                                                    @endforeach
                                                                    <td> {{ $emp->formatted_start_time }}</td>
                                                                    <td> {{ $emp->formatted_end_time }}</td>
                                                                    <td><a href="{!! url('/workorders') . '/' . $emp->id . '/edit' !!}">
                                                                        <span class="badge text-bg-success">{{ mb_strimwidth($emp->client->name,0,15,'...') }}</span></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour{{ $loop->index }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-warning " type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour{{ $loop->index }}"
                                                        aria-expanded="false" aria-controls="collapseFour{{ $loop->index }}">
                                                    @lang('bt.resources_scheduled')
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseFour{{ $loop->index }}" class="collapse show" aria-labelledby="headingFour{{ $loop->index }}">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-sm bt-nowrap"
                                                       id="table4{{ $loop->index }}">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.resource')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.client')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledprod as $prod)
                                                        @if($prod->job_date->format('Y-m-d') == $date)
                                                            @foreach($prod->workorderItems as $woitem)
                                                                <tr>
                                                                    <td> {{ $woitem->name }}</td>
                                                                    <td> {{ $prod->formatted_start_time }}</td>
                                                                    <td> {{ $prod->formatted_end_time }}</td>
                                                                    <td><a href="{!! url('/workorders') . '/' . $prod->id . '/edit' !!}">
                                                                            <span class="badge text-bg-success">{{ mb_strimwidth($prod->client->name,0,15,'...') }}</span></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFive{{ $loop->index }}">
                                            <h2 class="mb-0">
                                                {{--                                            remove class collapsed--}}
                                                <button class="btn btn-warning " type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive{{ $loop->index }}"
                                                        aria-expanded="false" aria-controls="collapseFive{{ $loop->index }}">
                                                    @lang('bt.employee_appointments')
                                                </button>
                                            </h2>
                                        </div>
                                        {{--                                    add class show--}}
                                        <div id="collapseFive{{ $loop->index }}" class="collapse show" aria-labelledby="headingFive{{ $loop->index }}">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-sm bt-nowrap"
                                                       id="table5{{ $loop->index }}">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('bt.employee')</th>
                                                        <th>@lang('bt.start')</th>
                                                        <th>@lang('bt.end')</th>
                                                        <th>@lang('bt.description')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($scheduledcalemp as $emp)
                                                        @if(\Carbon\Carbon::parse($emp->start_date)->format('Y-m-d') == $date)
                                                            @foreach($emp->resources as $calemp)
                                                                <tr>
                                                                    <td> {{ $calemp->value }}</td>
                                                                    <td> {{ \Carbon\Carbon::parse($emp->start_date)->format('H:i') }}</td>
                                                                    <td> {{\Carbon\Carbon::parse($emp->end_date)->format('H:i') }}</td>
                                                                    <td> {{ $emp->description }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
