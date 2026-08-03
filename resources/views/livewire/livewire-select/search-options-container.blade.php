{{-- w-100 pins the panel to the field width (it used to shrink-to-fit and could
     run off the right edge of a phone); overflow-auto + the max-height rule in
     mobile.css keep a long result list inside the viewport. --}}
<div
    class="{{ $styles['searchOptionsContainer'] }} w-100 overflow-auto"

    x-show="isOpen"
>
    @if(!$emptyOptions)
        @foreach($options as $option)
            @include($searchOptionItem, [
                'option' => $option,
                'index' => $loop->index,
                'styles' => $styles,
            ])
        @endforeach
    @elseif ($isSearching)
        @include($searchNoResultsView, [
            'styles' => $styles,
        ])
    @endif
</div>
