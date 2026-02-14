<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Filters & Search -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-4 w-full md:w-auto">
                    <select name="role" onchange="this.form.submit()" class="border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Roles</option>
                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="editor" {{ request('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." 
                        class="border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm w-full md:w-64">
                </form>

                <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-sm transition-all flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New User
                </a>
            </div>

            <!-- Users Grid -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="p-6">User Details</th>
                                <th class="p-6">Role</th>
                                <th class="p-6">Contact</th>
                                <th class="p-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg mr-4">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">Joined {{ $user->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    @php
                                        $badges = [
                                            'super_admin' => 'bg-purple-100 text-purple-700',
                                            'admin' => 'bg-blue-100 text-blue-700',
                                            'editor' => 'bg-orange-100 text-orange-700',
                                            'user' => 'bg-gray-100 text-gray-600',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $badges[$user->role] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ str_replace('_', ' ', $user->role) }}
                                    </span>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm text-gray-600 mb-1">
                                        <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $user->email }}
                                    </div>
                                    @if($user->phone)
                                    <div class="text-sm text-gray-600">
                                        <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $user->phone }}
                                    </div>
                                    @endif
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit User">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        
                                        @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Ensure this action is intentional. Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete User">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-gray-500">
                                    No users found matching criteria.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
