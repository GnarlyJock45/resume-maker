<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Template</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        .resume-font {
            font-family: 'Inter', sans-serif;
        }
         /* Additional Custom Styles */
         .resume-section {
            margin-bottom: 3rem;
        }

        .resume-heading {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .resume-subheading {
            font-weight: 600;
        }

        .resume-list-item {
            margin-bottom: 0.25rem;
        }
        .resume-border {
            border: 20px solid #007bff; /* Approximate blue color */
        }
        /* .resume-border-gradient {
            border: 20px solid transparent;
            border-width: 25px 25px;
            border-image: linear-gradient(to right, #5baafffe, #2a91ff) 1;
        }
        .divider {
            border-right: 3px solid #000000;
        } 
        */
    </style>
</head>
<body class="bg-gray-100 resume-font">





@php
        $skills = json_decode($resume->skills, true);
        $education = json_decode($resume->education, true);
        $courses = json_decode($resume->courses, true);
        $work_experience = json_decode($resume->work_experience, true);
@endphp




    <div class="container mx-auto p-6 bg-white shadow-lg resume-border-gradient">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold uppercase">{{ $resume->name }}</h1>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <!-- Left Column -->
            <div class="divider ">
                <!-- Dynamic Contact Information -->
                <div class="resume-section">
                    <h2 class="resume-heading">CONTACT</h2>
                    
                    <p>Mobile: {{ $resume->phone_number }}</p>
                    <p>{{ $resume->email }}</p>
                </div>
                <!-- Dynamic Education -->
                <div class="resume-section">
                    <h2 class="resume-heading">EDUCATION</h2>
                    @foreach ($education as $education)
                        <p>{{ $education['name'] }}</p>
                        @if($education['description'])
                            <ul class="list-disc pl-5">
                                <li>{{ $education['description'] }}</li>
                            </ul>
                        @endif
                    @endforeach
                </div>
                <!-- Dynamic Courses -->
                <div class="resume-section">
                    <h2 class="resume-heading">COURSES</h2>
                    @foreach ($courses as $course)
                        <p>{{ $course['name'] }}</p>
                        @if($course['description'])
                            <ul class="list-disc pl-5">
                                <li>{{ $course['description'] }}</li>
                            </ul>
                        @endif
                    @endforeach
                </div>
                
            </div>
            <!-- Right Column -->
            <div>
                <!-- Dynamic Skills -->
                <div class="resume-section">
                    <h2 class="resume-heading">SKILLS</h2>
                    <ul class="list-disc pl-5">
                        @foreach ($skills as $skill)
                            <p>{{ $skill['name'] }}</p>
                            @if($skill['description'])
                                <ul class="list-disc pl-5">
                                    <li>{{ $skill['description'] }}</li>
                                </ul>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- Dynamic Professional Summary -->
                <!-- Add a section for professional summary if available in your data -->
                <!-- Dynamic Work History -->
                <div>
                    <h2 class="resume-heading">WORK HISTORY</h2>
                    <div>
                        @foreach ($work_experience as $work)
                            <div class="resume-section">
                                <p>{{ $work['name'] }}</p>
                                @if($work['description'])
                                    <ul class="list-disc pl-5">
                                        <li>{{ $work['description'] }}</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</body>
</html>