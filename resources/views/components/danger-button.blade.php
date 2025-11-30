<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }} style="background: #dc3545; color: white; border: none;">
    {{ $slot }}
</button>
