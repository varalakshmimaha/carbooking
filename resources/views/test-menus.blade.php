@extends('layouts.frontend')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Menu Debug Test</h1>
    
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">Header Menu Debug</h2>
        
        <p><strong>headerMenu variable exists:</strong> {{ isset($headerMenu) ? 'YES' : 'NO' }}</p>
        
        @if(isset($headerMenu))
            <p><strong>headerMenu object:</strong> {{ $headerMenu ? 'NOT NULL' : 'NULL' }}</p>
            <p><strong>Items count:</strong> {{ $headerMenu->items->count() ?? 'N/A' }}</p>
            
            @if($headerMenu->items)
                <p><strong>Items exist:</strong> YES</p>
                <ul class="list-disc pl-5 mt-2">
                    @foreach($headerMenu->items as $item)
                        <li>{{ $item->label }} -> {{ $item->url }}</li>
                    @endforeach
                </ul>
            @else
                <p><strong>Items exist:</strong> NO</p>
            @endif
        @else
            <p><strong>headerMenu object:</strong> NOT SET</p>
        @endif
    </div>
</div>
@endsection