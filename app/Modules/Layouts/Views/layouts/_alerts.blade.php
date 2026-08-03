@php($msg = '')
@foreach ($errors->all() as $error)
    @php($msg .= $error . "\n")
@endforeach
{{-- Messages are passed through @json so Laravel escapes quotes/apostrophes for us. The old
     '{!! $msg !!}' form broke the whole <script> tag on any message containing an apostrophe,
     which silently swallowed login/validation errors - the exact path a phone user hits. --}}
@if($msg)
<script>
    notify(@json($msg), 'error')
</script>
@endif


@if (session()->has('error'))
    <script>
        notify(@json(session('error')), 'error')
    </script>
@endif

@if (session()->has('alert'))
    <script>
        notify(@json(session('alert')), 'warning')
    </script>
@endif

@if (session()->has('alertSuccess'))
    <script>
        notify(@json(session('alertSuccess')), 'success')
    </script>
@endif

@if (session()->has('alertInfo'))
    <script>
        notify(@json(session('alertInfo')), 'info')
    </script>
@endif
