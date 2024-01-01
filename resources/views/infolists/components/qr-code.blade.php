<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {{-- {{ $getState() }} --}}
        @php
            $url = url('/profile/'. $getState())
        @endphp
        {!! QrCode::size(500)->generate($url); !!}
    </div>
</x-dynamic-component>
