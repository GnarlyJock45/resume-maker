@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Create Your Resume</h1>
    <form action="{{ route('resume.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
            <input type="text" id="name" name="name" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
            <input type="number" id="age" name="age"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <!-- <div class="mb-4">
            <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills:</label>
            <textarea id="skills" name="skills" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div> -->
        <div id="skills-container">
            <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills:</label>
            <div class="mb-3">
                <input type="text" name="skills[]" placeholder="Skill 1" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
            </div>
        </div>
        <button type="button" id="add-skill" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add More Skills
        </button>

        <div class="mb-4">
            <label for="courses" class="block text-gray-700 text-sm font-bold mb-2">Courses:</label>
            <textarea id="courses" name="courses" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="mb-6">
            <label for="education" class="block text-gray-700 text-sm font-bold mb-2">Education:</label>
            <textarea id="education" name="education" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-skill').addEventListener('click', function() {
        var newInputDiv = document.createElement('div');
        newInputDiv.className = 'mb-3';

        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'skills[]';
        newInput.placeholder = 'Skill';
        newInput.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';

        newInputDiv.appendChild(newInput);
        document.getElementById('skills-container').appendChild(newInputDiv);
    });
</script>



@endsection
