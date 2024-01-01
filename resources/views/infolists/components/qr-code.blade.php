<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {{-- {{ $getState() }} --}}
        {!! QrCode::size(800)->generate($getState()); !!}
    </div>
</x-dynamic-component>
