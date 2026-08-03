{{--@once--}}
{{--    @push('styles')--}}
{{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
{{--    @endpush--}}

{{--    @push('head_scripts')--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>--}}
{{--    @endpush--}}
{{--@endonce--}}

{{--@props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])--}}
{{--@props(['options' => "{dateFormat:'Y-m-d', altFormat:'{{config('bt.dateFormat')}}', altInput:true, position: 'auto center', }"])--}}
@props(['options' => [], 'value' => date("Y-m-d")])

@php
    $options = array_merge([
                    'dateFormat' => 'Y-m-d',
                    'altFormat' =>  config('bt.dateFormat'),
                    'altInput' => true,
                    'position' => 'auto center'
                    ], $options);
@endphp

<div class="input-group text-bg-light" wire:ignore>
    <input
            x-data
            x-init="flatpickr($refs.input, {{json_encode((object)$options)}} );"
            x-ref="input"
            type="text"
            value="{{$value}}"
            data-input
            {{-- The class list must be MERGED, not emitted twice. A hard-coded
                 class attribute followed by the caller's class attribute inside
                 the attribute bag produces two class attributes on one element
                 and the browser keeps only the first, so every caller that
                 passed form-control was silently losing it. Carrying
                 form-control here also gives the field the 16px font and 44px
                 height that mobile.css applies to .form-control below 992px. --}}
            {{ $attributes->merge(['class' => 'form-control text-bg-light']) }}
    />
    <span class="input-group-text"><i class="fas fa-calendar-alt"></i> </span>
</div>
