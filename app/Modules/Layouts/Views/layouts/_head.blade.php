
{{--
    Mobile responsiveness layer.
    MUST load AFTER /build/assets/app.css (every layout that includes this
    partial does so on the line following its app.css <link>) so that its
    overrides win on cascade order without needing !important, and BEFORE
    custom/custom.css so a site's own overrides still win over ours.
    Static ?v= cache-buster - bump it by hand when mobile.css changes.
    Source of truth: resources/public/css/mobile.css (mirrored to public/css/).
--}}
<link href="{{ asset('css/mobile.css') }}?v=1" rel="stylesheet" type="text/css"/>

<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif

