@foreach ($object->notes()->protect(auth()->user())->orderBy('created_at', 'desc')->get() as $note)
    <div class="direct-chat-msg" id="note-{{ $note->id }}">
        <div class="direct-chat-info d-flex flex-wrap align-items-center gap-2">
            <span class="direct-chat-name me-auto text-break">{{ $note->user->name }}</span>
            <span class="direct-chat-timestamp">
                {{ $note->formatted_created_at }}
            </span>
            @if (isset($showPrivateCheckbox) and $showPrivateCheckbox == true)
                <span class="direct-chat-scope">
                @if ($note->private)
                    <span class="badge bg-danger">@lang('bt.private')</span>
                @else
                    <span class="badge bg-success">@lang('bt.public')</span>
                @endif
            </span>
            @endif
            <span class="direct-chat-scope">
                @if (!auth()->user()->client_id)
                    <a href="javascript:void(0)" class="delete-note bt-tap" data-note-id="{{ $note->id }}">@lang('bt.trash')</a>
                @endif
            </span>
        </div>
        <img class="direct-chat-img" src="{{ profileImageUrl($note->user) }}" alt="message user image">
        <div class="direct-chat-text">
            {!! $note->formatted_note !!}
        </div>
    </div>
@endforeach
