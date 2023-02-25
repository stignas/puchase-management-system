@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-danger fw-bold fs-6', 'id' => 'err-msg']) }}>
        @foreach ((array) $messages as $message)
            <p>{{ $message }}</p>
        @endforeach
    </div>
@endif
