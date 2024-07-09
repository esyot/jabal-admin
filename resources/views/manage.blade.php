<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Roles') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($users as $user)
        <div class="bg-white shadow-md rounded-lg overflow-hidden m-6">        
            <div class="p-6">
                <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                <p class="text-gray-600">Email: {{ $user->email }}</p>
                
                <!-- Roles -->
                <div class="mt-4">
                    <h2 class="text-lg font-semibold mb-2">Roles</h2>
                    @foreach($roles as $role)
                    <label class="inline-flex items-center">
                        <input disabled type="radio" class="form-radio text-indigo-600 h-5 w-5" name="roles[{{ $user->id }}]" value="{{ $role->name }}"
                               {{ $userRoles[$user->id]->contains($role) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $role->name }}</span>
                    </label><br>
                    @endforeach
                </div>

                <!-- Edit User Button -->
                @can('edit users')
                <button onclick="openModal({{ $user->id }})" 
                type="button" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit Roles</button>
                @endcan
            </div>
        </div>
       
        <!-- Modal for Managing Permissions -->
        <div id="modal-{{ $user->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full p-8">
                <h1 class="text-2xl font-bold mb-4">Update role for <a class="text-red-500"> {{ $user->name }}</a></h1>

                <form action="{{ route('manage.permissions.update', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Roles -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">Roles</h2>
                        @foreach($roles as $role)
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio text-indigo-600 h-5 w-5" name="roles[]" value="{{ $role->name }}"
                                   {{ $userRoles[$user->id]->contains($role) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $role->name }}</span>
                        </label><br>
                        @endforeach
                    </div>
                <div class="flex justify-between">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save</button>
                    <button type="button" onclick="closeModal({{ $user->id }})" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Close</button>
                </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function openModal(userId) {
            const modal = document.getElementById('modal-' + userId);
            modal.classList.remove('hidden');
        }

        function closeModal(userId) {
            const modal = document.getElementById('modal-' + userId);
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
