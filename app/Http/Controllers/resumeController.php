<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume; // Import the Resume model
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;


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

    // public function store(Request $request)
    // {



    //     // ]);
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:resumes,email',
    //         'phone_number' => 'nullable|max:255',
    //         'age' => 'nullable|integer|between:18,100',
    //         'job_title' => 'nullable|string|max:255',
    //         'skills' => 'required|array',
    //         'skills.*.name' => 'required|string|max:255', // Validates the name of each skill
    //         'skills.*.description' => 'nullable|string', // Validates the description of each skill        
    //         'courses' => 'nullable|array',
    //         'courses.*.name' => 'required|string', // Validates the name of each course
    //         'courses.*.description' => 'nullable|string', // Validates the description (optional)
    //         'education' => 'nullable|array',
    //         'education.*.name' => 'required|string', // Validates the name of each education entry
    //         'education.*.description' => 'nullable|string', // Validates the description (optional)
    //         'work_experience' => 'nullable|array',
    //         'work_experience.*.name' => 'required|string', // Adjust as needed
    //         'work_experience.*.description' => 'nullable|string', // Adjust as needed

    //     ]);

    //     // Create a new resume instance
    //     $resume = new Resume();
    //     $resume->name = $validatedData['name'];
    //     $resume->email = $validatedData['email'];
    //     $resume->phone_number = $validatedData['phone_number'];
    //     $resume->age = $validatedData['age'];
    //     $resume->template = $request->template;

    //     // Convert arrays to JSON for storing in the database
    //     $resume->skills = json_encode($validatedData['skills']);
    //     $resume->courses = json_encode($validatedData['courses']);
    //     $resume->education = json_encode($validatedData['education']);
    //     $resume->work_experience = json_encode($validatedData['work_experience']);


    //     // Save the resume
    //     $resume->save();


    //     // Create a new resume instance and save to database
    //     // $resume = Resume::create($validatedData);

    //     // Redirect or return response
    //     return redirect()->route('resume.show', $resume->id)->with('success', 'Resume created successfully!');


    // }

    public function show($id)
    {
        // Fetch the resume from the database
        $resume = Resume::findOrFail($id);

        $template = $resume->template ?: 'template1';

        // and your resume template is 'resume_template.blade.php'
        return view('resume.templates.' . $template, ['resume' => $resume]);
    }

    public function generatePDF(Request $request)
    {
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
        // $resume->save();
        
        // $template = $resume->template ?: 'template1';
        // // Assuming you have a Blade view for your resume template
        // $pdf = PDF::loadView('resume.templates.' . $template , ['resume' => $resume]); // Replace 'data' with actual data variable

        // // Return a download response
        // return $pdf->download('resume.pdf');

        // --------------------------- LateX Method: Currently WORKING

        $template_name = "{$resume->template}" . ".tex";
        $template = Storage::get($template_name);
        $template = str_replace('{{NAME}}', $resume->name, $template);
        $texFileName = 'tempfile_' . uniqid() . '.tex';
        Storage::put($texFileName, $template);
        // Compile the .tex file to PDF (using a command line tool like pdflatex)
        // Note: Ensure pdflatex is installed on your server
        // $outputDir = ".\storage\app"; // Specify output directory
        // $texFilePath = $outputDir . '/' . $texFileName;
        $outputDir = storage_path("app");
        $texFilePath = storage_path("app/{$texFileName}");
        $pdfFilePath = $outputDir . '/' . basename($texFileName, '.tex') . '.pdf';
        // $texFilePath = storage_path('app/' . $texFileName);
        // $pdfFilePath = storage_path('app/' . basename($texFileName, '.tex') . '.pdf');
        // exec("pdflatex -output-directory={$outputDir} {$texFilePath}");
        $command = "pdflatex -output-directory {$outputDir} {$texFilePath}";
        // pdflatex -output-directory .\storage\app .\storage\app\tempfile_65bf7a86eed14.tex
        // C:\Users\Yazan\Documents\Laravel Workspace\resume-builder\storage\app\{tempfile_65bf7b4894858.tex}
        exec($command, $output, $returnVar);

        // Check the output and return variable to ensure it executed successfully
        if ($returnVar === 0) {
            // Command executed successfully, handle the next steps
            return response()->download($pdfFilePath);
        } else {
            // Handle errors, maybe log $output for debugging
            dd("An Error Occurred");
        }

        // $command = "pdflatex -output-directory=temp -jobname=" . basename($pdfFilePath, '.pdf') . " " . storage_path('app/' . $texFilePath);
        // exec($command . ' 2>&1', $output, $return_var);
        // $process = new Process(['pdflatex', "-output-directory=temp -jobname=". basename($pdfFilePath, '.pdf') . " " . storage_path('app/' . $texFilePath)]);
        // $process->run();
        // return redirect("/");
        Storage::delete($texFilePath);



    }
}
