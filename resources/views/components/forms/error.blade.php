@props(["field"])

@error($field)
    <p class="error">{{ $message }}</p>
@enderror
