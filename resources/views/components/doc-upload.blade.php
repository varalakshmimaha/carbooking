@props(['label', 'name', 'required' => false, 'current' => null])

<div class="space-y-2" x-data="{ preview: '{{ $current ? asset('storage/' . $current) : '' }}' }">
    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $label }} @if($required)<span class="text-red-500">*</span>@endif</label>
    <div class="relative group">
        <input type="file" name="{{ $name }}" @if($required) required @endif 
            @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => { preview = e.target.result }; reader.readAsDataURL(file); }"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
        
        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 flex flex-col items-center justify-center space-y-2 group-hover:border-blue-300 transition-colors bg-gray-50 aspect-video overflow-hidden">
            <template x-if="!preview">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <span class="text-xs font-medium text-gray-400 mt-2">Click to upload</span>
                </div>
            </template>
            <template x-if="preview">
                <img :src="preview" class="w-full h-full object-cover rounded-lg">
            </template>
        </div>

        @if($required)
            @error($name)
                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
            @enderror
        @endif
    </div>
</div>
