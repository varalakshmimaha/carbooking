<div class="group">
    <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-300 transition-colors shadow-sm ml-{{ $depth * 8 }}">
        <div class="flex items-center space-x-4">
            <div class="cursor-move text-gray-300 group-hover:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                </svg>
            </div>
            <div>
                <span class="font-bold text-gray-900">{{ $item->label }}</span>
                <span class="text-xs text-gray-400 ml-2 italic group-hover:text-blue-500 transition-colors">{{ $item->url }}</span>
            </div>
            @if($item->target_blank)
                <span class="bg-blue-50 text-blue-500 text-[10px] px-2 py-0.5 rounded uppercase font-bold tracking-tighter">New Tab</span>
            @endif
        </div>
        
        <div class="flex items-center space-x-2">
            <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                @csrf @method('DELETE')
                <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    @if($item->children->count() > 0)
        <div class="mt-4 space-y-4">
            @foreach($item->children as $child)
                @include('admin.menus._item_row', ['item' => $child, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</div>
