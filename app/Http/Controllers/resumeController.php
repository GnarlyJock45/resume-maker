<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume; // Import the Resume model

class ResumeController extends Controller
{
    public function index()
    {
        // This will display the initial page with the create resume button
        return view('resume.index');
    }

    public function create()
    {
        // This will display the form to create a new resume
        return view('resume.create');
    }

    public function store(Request $request)
    {


    
        // ]);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:resumes,email',
            'phone_number' => 'nullable|max:255',
            'age' => 'nullable|integer|between:18,100',
            'job_title' => 'nullable|string|max:255',
            'skills' => 'required|array',
            'skills.*.name' => 'required|string|max:255', // Validates the name of each skill
            'skills.*.description' => 'nullable|string', // Validates the description of each skill        
            'courses' => 'nullable|array',
            'courses.*.name' => 'required|string', // Validates the name of each course
            'courses.*.description' => 'nullable|string', // Validates the description (optional)
            'education' => 'nullable|array',
            'education.*.name' => 'required|string', // Validates the name of each education entry
            'education.*.description' => 'nullable|string', // Validates the description (optional)
            'work_experience' => 'nullable|array',
            'work_experience.*.name' => 'required|string', // Adjust as needed
            'work_experience.*.description' => 'nullable|string', // Adjust as needed
        
        ]);

        // Create a new resume instance
        $resume = new Resume();
        $resume->name = $validatedData['name'];
        $resume->email = $validatedData['email'];
        $resume->phone_number = $validatedData['phone_number'];
        $resume->age = $validatedData['age'];
        $resume->template = $request->template;

        // Convert arrays to JSON for storing in the database
        $resume->skills = json_encode($validatedData['skills']);
        $resume->courses = json_encode($validatedData['courses']);
        $resume->education = json_encode($validatedData['education']);
        $resume->work_experience = json_encode($validatedData['work_experience']);
    

        // Save the resume
        $resume->save();


        // Create a new resume instance and save to database
        // $resume = Resume::create($validatedData);

        // Redirect or return response
        return redirect()->route('resume.show', $resume->id)->with('success', 'Resume created successfully!');

        
    }

    public function show($id)
    {
        // Fetch the resume from the database
        $resume = Resume::findOrFail($id);

        $template = $resume->template ?: 'template1';

        // and your resume template is 'resume_template.blade.php'
        return view('resume.templates.' . $template , ['resume' => $resume]);

    }
}

