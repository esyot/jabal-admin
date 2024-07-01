<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List of students enrolled in Mater Dei College") }}
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($students as $student)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden m-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-2">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->mi }}</h3>
                            <p class="text-gray-600">Course: {{ $student->course }}</p>
                            <p class="text-gray-600">Address: {{ $student->address }}</p>
                            <p class="text-gray-600 mb-2">DOB: {{ $student->DOB }}</p>

                        <button 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View & Edit
                        </button>
                        
                        <button 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>

                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
