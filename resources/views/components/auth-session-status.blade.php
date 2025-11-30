@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'card']) }} style="background: rgba(40, 167, 69, 0.1); border-color: rgba(40, 167, 69, 0.3); margin-bottom: var(--space-4);">
        <div class="card-body">
            <p class="text-sm font-medium" style="color: #28a745;">{{ $status }}</p>
        </div>
    </div>
@endif
