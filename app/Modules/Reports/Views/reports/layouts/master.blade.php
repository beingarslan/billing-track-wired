<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- This document is rendered BOTH as the PDF source and inside the report preview iframe.
         Without a viewport meta the framed copy falls back to the ~980px default layout viewport
         and is illegible on a phone. PDF engines (dompdf / wkhtmltopdf) ignore this tag. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <style>
        @page {
            margin: 25px;
        }

        body {
            color: #001028;
            background: #FFFFFF;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 12px;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        h1, h2, h3, h4, h5 {
            color: #5D6975;
            text-align: center;
        }

        h1 {
            font-size: 2.8em;
            line-height: 1.4em;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th {
            padding: 5px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 10px;
        }

        table.alternate tr:nth-child(even) td {
            background: #F5F5F5;
        }

        th.amount, td.amount {
            text-align: right;
        }

        .total {
            text-align: right;
            color: #5D6975;
            font-weight: bold;
        }

        /* Phone-only, screen-only. This document is never reached by mobile.css (it is
           rendered standalone inside the preview iframe), so the rules have to live here.
           The query is deliberately "only screen and (max-width: …)" rather than a bare
           "screen": the "only" keyword exists precisely so that parsers which understand
           media TYPES but not media QUERIES (dompdf, which matches the query string against
           its allowed-media-type list verbatim) skip the block entirely. wkhtmltopdf lays
           out at the page width (~794px at A4/96dpi), which is above the breakpoint. Print
           and PDF output are therefore untouched. */
        @media only screen and (max-width: 767px) {
            body {
                font-size: 14px;
            }

            h1 {
                font-size: 1.6em;
                line-height: 1.2em;
            }

            h2, h3, h4 {
                font-size: 1.15em;
            }

            /* Each table becomes its own horizontal scroller so the report never forces
               the framed page to scroll sideways. thead/tbody stay column-aligned because
               display:block wraps them in a single anonymous table box. */
            table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            th {
                padding: 4px 6px;
            }

            td {
                padding: 6px;
            }
        }

    </style>
</head>
<body>

@yield('content')

</body>
</html>