<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Page Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.pages.index') }}" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <h1 class="text-2xl font-bold text-gray-900">Page Builder</h1>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $page->title }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="/{{ $page->slug }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View Page
                    </a>
                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Page Settings
                    </button>
                    <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Pages
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <div class="grid grid-cols-12 gap-6">
                <!-- Left Side: Page Sections -->
                <div class="col-span-8">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-semibold text-gray-900">Page Sections</h2>
                            <p class="text-xs text-gray-400 italic">Drag and drop functionality coming soon</p>
                        </div>
                        <div class="p-6" id="sections-list">
                            @forelse($page->sections as $section)
                                <div class="group flex items-center space-x-4 p-4 mb-3 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-md transition-all cursor-move" data-id="{{ $section->id }}">
                                    <!-- Drag Handle -->
                                    <div class="flex-shrink-0 text-gray-400 cursor-grab active:cursor-grabbing">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="4" cy="4" r="1.5" />
                                            <circle cx="4" cy="10" r="1.5" />
                                            <circle cx="4" cy="16" r="1.5" />
                                            <circle cx="10" cy="4" r="1.5" />
                                            <circle cx="10" cy="10" r="1.5" />
                                            <circle cx="10" cy="16" r="1.5" />
                                        </svg>
                                    </div>

                                    <!-- Section Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center text-white shadow-sm">
                                            {!! $section->type->icon !!}
                                        </div>
                                    </div>

                                    <!-- Section Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $section->type->name }}</h3>
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                Dynamic
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                                {{ $section->type->category }}
                                            </span>
                                            @if(!$section->is_visible)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">
                                                    Hidden
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        <button onclick="toggleVisibility({{ $section->id }}, this)" class="p-2 {{ $section->is_visible ? 'text-green-600 hover:bg-green-50' : 'text-gray-400 hover:bg-gray-100' }} rounded-lg transition-colors" title="Toggle Visibility">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button onclick="openSettings({{ $section->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Settings">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('admin.pages.builder.remove-section', $section) }}" method="POST" onsubmit="return confirm('Remove this section?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No sections</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by adding a section from the right panel.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Side: Add Sections -->
                <div class="col-span-4">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Add Sections</h2>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                    </svg>
                                    <h3 class="text-sm font-semibold text-purple-600 uppercase tracking-wide">Dynamic Sections</h3>
                                </div>
                                <p class="text-xs text-gray-500">These sections pull data automatically from database</p>
                            </div>

                            <div class="grid grid-cols-2 gap-3 max-h-[calc(100vh-300px)] overflow-y-auto">
                                @foreach($sectionTypes as $type)
                                    <form action="{{ route('admin.pages.builder.add', $page) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="section_type_key" value="{{ $type->key }}">
                                        <button type="submit" class="w-full group">
                                            <div class="flex flex-col items-center p-4 bg-white border-2 border-gray-200 rounded-lg hover:border-purple-400 hover:shadow-md transition-all">
                                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center text-white mb-2 group-hover:scale-110 transition-transform">
                                                    {!! $type->icon !!}
                                                </div>
                                                <span class="text-xs font-medium text-gray-900 text-center">{{ $type->name }}</span>
                                            </div>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div id="settings-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modal-title">Configure Section</h3>
                <button onclick="closeSettings()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="modal-content" class="mb-4">
                <!-- Dynamic content -->
            </div>
            <div class="flex justify-end space-x-3">
                <button onclick="closeSettings()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Cancel
                </button>
                <button onclick="saveSettings()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        const sectionsList = document.getElementById('sections-list');
        const modal = document.getElementById('settings-modal');
        let currentSectionId = null;

        // Initialize Sortable
        new Sortable(sectionsList, {
            animation: 150,
            handle: '.cursor-move',
            ghostClass: 'opacity-50',
            onEnd: function(evt) {
                const orderedIds = Array.from(sectionsList.children)
                    .filter(el => el.dataset.id)
                    .map(el => el.dataset.id);
                
                if (orderedIds.length > 0) {
                    fetch('{{ route("admin.pages.builder.reorder", $page) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ordered_ids: orderedIds })
                    });
                }
            }
        });

        function toggleVisibility(id, btn) {
            const isVisible = btn.classList.contains('text-green-600');
            
            fetch(`/admin/pages/sections/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_visible: !isVisible })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }

        function openSettings(id) {
            currentSectionId = id;
            modal.classList.remove('hidden');
            
            fetch(`/admin/pages/sections/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('modal-title').innerText = `Configure ${data.type_name}`;
                    
                    const settings = data.settings || {};
                    const type = data.type_key;
                    let html = '';
                    
                    if (type === 'banner_slider' || type === 'services_grid' || type === 'packages_list') {
                        html = `
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input type="text" id="setting-title" value="${settings.title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Limit</label>
                                    <input type="number" id="setting-limit" value="${settings.limit || 6}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>
                        `;
                    } else if (type === 'about_section') {
                        html = `
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                                    <input type="text" id="setting-title" value="${settings.title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                    <textarea id="setting-content" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">${settings.content || ''}</textarea>
                                </div>
                            </div>
                        `;
                    } else if (type === 'contact_cta') {
                        html = `
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input type="text" id="setting-title" value="${settings.title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                    <input type="text" id="setting-subtitle" value="${settings.subtitle || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="setting-phone" value="${settings.phone || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                                    <input type="text" id="setting-button_text" value="${settings.button_text || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>
                        `;
                    } else if (type === 'how_we_work') {
                        html = `
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                                    <input type="text" id="setting-title" value="${settings.title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                    <input type="text" id="setting-subtitle" value="${settings.subtitle || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2 font-bold text-sm text-gray-900 border-b pb-1">Step 1</div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Title</label>
                                        <input type="text" id="setting-step1_title" value="${settings.step1_title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                        <input type="text" id="setting-step1_desc" value="${settings.step1_desc || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                    
                                    <div class="col-span-2 font-bold text-sm text-gray-900 border-b pb-1">Step 2</div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Title</label>
                                        <input type="text" id="setting-step2_title" value="${settings.step2_title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                        <input type="text" id="setting-step2_desc" value="${settings.step2_desc || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>

                                    <div class="col-span-2 font-bold text-sm text-gray-900 border-b pb-1">Step 3</div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Title</label>
                                        <input type="text" id="setting-step3_title" value="${settings.step3_title || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                        <input type="text" id="setting-step3_desc" value="${settings.step3_desc || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                </div>
                            </div>
                        `;
                    } else {
                        html = '<p class="text-gray-500 text-sm">No settings available for this section type.</p>';
                    }
                    
                    document.getElementById('modal-content').innerHTML = html;
                });
        }

        function closeSettings() {
            modal.classList.add('hidden');
        }

        function saveSettings() {
            const settings = {};
            const inputs = document.querySelectorAll('#modal-content input, #modal-content textarea, #modal-content select');
            
            inputs.forEach(input => {
                const key = input.id.replace('setting-', '');
                settings[key] = input.value;
            });

            fetch(`/admin/pages/sections/${currentSectionId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ settings: settings })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    closeSettings();
                    location.reload();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>

