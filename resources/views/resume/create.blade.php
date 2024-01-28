@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Create Your Resume</h1>
    <form action="{{ route('generate.pdf') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
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

        <div class="mb-4">
            <label for="job_title" class="block text-gray-700 text-sm font-bold mb-2">Job Title:</label>
            <input type="text" id="job_title" name="job_title" placeholder="Job Title" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
        </div>

        <!-- -------------------------------------------------------- -->
        <div id="skills-container" class="mb-4">
            <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills:</label>
            <div class="skill-entry mb-3">
                <input type="text" name="skills[0][name]" placeholder="Skill Name" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
                <textarea name="skills[0][description]" placeholder="Skill Description (optional)" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full" rows="2"></textarea>
            </div>
            <button type="button" id="add-skill" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Another Skill
            </button>
        </div>

        <div id="courses-container" class="mb-4">
            <label for="courses" class="block text-gray-700 text-sm font-bold mb-2">Courses:</label>
            <div class="course-entry mb-3">
                <input type="text" name="courses[0][name]" placeholder="Course Name" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
                <textarea name="courses[0][description]" placeholder="Course Description (optional)" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full" rows="2"></textarea>
            </div>
            <button type="button" id="add-course" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Another Course
            </button>
        </div>

        <div id="education-container" class="mb-4">
            <label for="education" class="block text-gray-700 text-sm font-bold mb-2">Education:</label>
            <div class="education-entry mb-3">
                <input type="text" name="education[0][name]" placeholder="Education Name" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
                <textarea name="education[0][description]" placeholder="Education Description (optional)" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full" rows="2"></textarea>
            </div>
            <button type="button" id="add-education" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Another Education
            </button>
        </div>

        <div id="experience-container" class="mb-4">
            <label for="experience" class="block text-gray-700 text-sm font-bold mb-2">Experience:</label>
            <div class="experience-entry mb-3">
                <input type="text" name="work_experience[0][name]" placeholder="Experience Name" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full">
                <textarea name="work_experience[0][description]" placeholder="Experience Description (optional)" class="shadow border rounded py-2 px-3 form-input mt-1 block w-full" rows="2"></textarea>
            </div>
            <button type="button" id="add-experience" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Another Experience
            </button>
        </div>


        <!-- -------------------------------------------------------- -->




        <select name="template" class="form-control">
            <option value="template1">Template 1</option>
            <option value="template2">Template 2</option>
            <!-- List other templates here -->
        </select>

        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Submit</button>
    </form>
</div>

<script>
    
    
    let skillIndex = 1;
    document.getElementById('add-skill').addEventListener('click', function() {
        var skillsContainer = document.getElementById('skills-container');
        var newSkillContainer = document.createElement('div');
        newSkillContainer.className = 'skill-entry mb-3';
    
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'skills[' + skillIndex + '][name]';
        newInput.placeholder = 'Skill Name';
        newInput.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newSkillContainer.appendChild(newInput);
    
        var newTextArea = document.createElement('textarea');
        newTextArea.name = 'skills[' + skillIndex + '][description]';
        newTextArea.placeholder = 'Skill Description (optional)';
        newTextArea.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newTextArea.rows = 2;
        newSkillContainer.appendChild(newTextArea);
    
        skillsContainer.appendChild(newSkillContainer);
    
        skillIndex++;
    });

    let courseIndex = 1;
    document.getElementById('add-course').addEventListener('click', function() {
        var coursesContainer = document.getElementById('courses-container');

        // Create a container for the new course input and textarea
        var newCourseContainer = document.createElement('div');
        newCourseContainer.className = 'course-entry mb-3';

        // Create new input for course name
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'courses[' + courseIndex + '][name]';
        newInput.placeholder = 'Course Name';
        newInput.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newCourseContainer.appendChild(newInput); // Append the new input to the course container

        // Create new textarea for course description
        var newTextArea = document.createElement('textarea');
        newTextArea.name = 'courses[' + courseIndex + '][description]';
        newTextArea.placeholder = 'Course Description (optional)';
        newTextArea.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newTextArea.rows = 2;
        newCourseContainer.appendChild(newTextArea); // Append the new textarea to the course container

        // Append the new course container to the courses container
        coursesContainer.appendChild(newCourseContainer);

        courseIndex++;
    });

    let educationIndex = 1;
    document.getElementById('add-education').addEventListener('click', function() {
        var educationContainer = document.getElementById('education-container');
        var newEducationContainer = document.createElement('div');
        newEducationContainer.className = 'education-entry mb-3';

        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'education[' + educationIndex + '][name]';
        newInput.placeholder = 'Education Name';
        newInput.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newEducationContainer.appendChild(newInput);

        var newTextArea = document.createElement('textarea');
        newTextArea.name = 'education[' + educationIndex + '][description]';
        newTextArea.placeholder = 'Education Description (optional)';
        newTextArea.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newTextArea.rows = 2;
        newEducationContainer.appendChild(newTextArea);

        educationContainer.appendChild(newEducationContainer);

        educationIndex++;
    });

    let experienceIndex = 1;
    document.getElementById('add-experience').addEventListener('click', function() {
        var experienceContainer = document.getElementById('experience-container');
        var newExperienceContainer = document.createElement('div');
        newExperienceContainer.className = 'experience-entry mb-3';

        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'experience[' + experienceIndex + '][name]';
        newInput.placeholder = 'Experience Name';
        newInput.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newExperienceContainer.appendChild(newInput);

        var newTextArea = document.createElement('textarea');
        newTextArea.name = 'experience[' + experienceIndex + '][description]';
        newTextArea.placeholder = 'Experience Description (optional)';
        newTextArea.className = 'shadow border rounded py-2 px-3 form-input mt-1 block w-full';
        newTextArea.rows = 2;
        newExperienceContainer.appendChild(newTextArea);

        experienceContainer.appendChild(newExperienceContainer);

        experienceIndex++;
    });




</script>



@endsection
