@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm']) }} style="color: #dc3545; display: flex; flex-direction: column; gap: var(--space-1);">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
