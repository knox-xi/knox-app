@props(['name', 'label', 'hint' => '', 'type' => 'text'])

<div class="mb-4">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
        @if ($type !== 'password') value="{{ old($name) }}" @endif
        {{ $attributes->merge(['class' => 'input peer user-invalid:border-red-500']) }}>

    @error($name)
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
    @else
        <p class="mt-1 text-xs text-white peer-user-invalid:text-red-600">{{ $hint }}</p>
    @enderror
</div>
