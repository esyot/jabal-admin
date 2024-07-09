<x-app-layout>
    <x-slot name="header">
        <button onclick="showAddModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Student
        </button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List of students enrolled in Mater Dei College") }}
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($students as $student)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden m-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-2">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}.</h3>
                            <p class="text-gray-600">Course: {{ $student->course }}</p>
                            <p class="text-gray-600">Address: {{ $student->address }}</p>
                            <p class="text-gray-600 mb-2">DOB: {{ $student->DOB }}</p>
                        
                            <form action="{{ route('delete', ['id' => $student->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showUpdateModal({{ $student }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View & Edit
                                </button>
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
            <div class="px-6 py-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Add a Student</h3>
                    <button onclick="closeAddModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <form action="{{ route('create.student') }}" method="POST">
                    @csrf 
                    @method('POST')
                    <div class="form-group">
                        <label for="first_name" class="block mt-2 float-left">First Name:</label>
                        <input type="text" id="first_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's first name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="block mt-2 float-left">Last Name:</label>
                        <input type="text" id="last_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's last name" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="block mt-2 float-left">Middle Name:</label>
                        <input type="text" id="middle_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's middle name" name="middle_name">
                    </div>
                    <div class="form-group">
                        <label for="address" class="block mt-2 float-left">Address:</label>
                        <input type="text" id="address" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's complete address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="DOB" class="block mt-2 float-left">Date of Birth:</label>
                        <input type="date" id="DOB" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="DOB">
                    </div>
                    <div class="form-group">
                        <label for="course" class="block mt-2 float-left">Course:</label>
                        <select name="course" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="course">
                            <option value="BSIT">BSIT</option>
                            <option value="CABM">CABM</option>
                            <option value="BEED">BEED</option>
                            <option value="BSN">BSN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="block mt-2 float-left">Year:</label>
                        <select name="year" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="year">
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 text-right">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Student</button>
                        <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Update -->
    <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
            <div class="px-6 py-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Update Student</h3>
                    <button onclick="closeUpdateModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <form id="updateForm" action="{{ route('update.student') }}" method="POST">
                    @csrf 
                    @method('POST')
                    <input type="hidden" id="update_id" name="id">
                    <div class="form-group">
                        <label for="update_first_name" class="block mt-2 float-left">First Name:</label>
                        <input type="text" id="update_first_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's first name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="update_last_name" class="block mt-2 float-left">Last Name:</label>
                        <input type="text" id="update_last_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's last name" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="update_middle_name" class="block mt-2 float-left">Middle Name:</label>
                        <input type="text" id="update_middle_name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's middle name" name="middle_name">
                    </div>
                    <div class="form-group">
                        <label for="update_address" class="block mt-2 float-left">Address:</label>
                        <input type="text" id="update_address" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter student's complete address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="update_DOB" class="block mt-2 float-left">Date of Birth:</label>
                        <input type="date" id="update_DOB" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="DOB">
                    </div>
                    <div class="form-group">
                        <label for="update_course" class="block mt-2 float-left">Course:</label>
                        <select name="course" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="update_course">
                            <option value="BSIT">BSIT</option>
                            <option value="CABM">CABM</option>
                            <option value="BEED">BEED</option>
                            <option value="BSN">BSN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_year" class="block mt-2 float-left">Year:</label>
                        <select name="year" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="update_year">
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 text-right">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update Student</button>
                        <button type="button" onclick="closeUpdateModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
function showAddModal() {
    const addModal = document.getElementById('addModal');
    addModal.classList.remove('hidden');
}

function closeAddModal() {
    const addModal = document.getElementById('addModal');
    addModal.classList.add('hidden');
}

function showUpdateModal(student) {
    document.getElementById('update_id').value = student.id;
    document.getElementById('update_first_name').value = student.first_name;
    document.getElementById('update_last_name').value = student.last_name;
    document.getElementById('update_middle_name').value = student.middle_name;
    document.getElementById('update_address').value = student.address;
    document.getElementById('update_DOB').value = student.DOB;
    document.getElementById('update_course').value = student.course;
    document.getElementById('update_year').value = student.year;

    const updateModal = document.getElementById('updateModal');
    updateModal.classList.remove('hidden');
}

function closeUpdateModal() {
    const updateModal = document.getElementById('updateModal');
    updateModal.classList.add('hidden');
}
</script>
