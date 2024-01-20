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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|max:255',
            'age' => 'nullable|integer',
            // 'skills' => 'required', // You may need a more specific validation rule here
            'skills' => 'required|array',
            'skills.*' => 'required|string', // Validates each element of the array
            'courses' => 'nullable',
            'education' => 'required',
        ]);

        // Create a new resume instance and save to database
        $resume = Resume::create($validatedData);

        // Redirect or return response
        return redirect()->route('resume.show', $resume->id)->with('success', 'Resume created successfully!');

        
    }

    public function show($id)
    {
        // Fetch the resume from the database
        $resume = Resume::findOrFail($id);

        // Assuming 'details' is the JSON column in your resumes table
        // and your resume template is 'resume_template.blade.php'
        return view('resume.templates.template1', ['resume' => $resume]);

    }
}

