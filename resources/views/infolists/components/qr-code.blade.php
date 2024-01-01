<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {{-- {{ $getState() }} --}}
        {!! QrCode::size(500)->generate($getState()); !!}
    </div>
</x-dynamic-component>
