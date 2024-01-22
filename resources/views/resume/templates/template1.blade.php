<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f4f4f4;
      padding: 20px;
    }
    h1, h2, h3 {
      color: #446688;
    }
    h1 {
      font-size: 2rem;
    }
    h2 {
      font-size: 1.5rem;
    }
    h3 {
      font-size: 1.2rem;
    }
    p {
      margin-bottom: 10px;
    }
    .section {
      margin-bottom: 30px;
    }
    .section:last-child {
      margin-bottom: 0;
    }
    .section-title {
      margin-top: 0;
    }
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .section-content {
      color: #666;
    }
    .resume-item {
      margin-bottom: 5px;
    }
    .resume-item:last-child {
      margin-bottom: 0;
    }
    .resume-item-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 5px;
    }
    .resume-item-title {
      color: #446688;
    }
    .resume-item-dates {
      color: #999;
    }
    .resume-item-details {
      margin-left: 50px;
    }
  </style>
  <title>Resume Example</title>
</head>
<body>
  <div class="section">
    <h2 class="section-title">{{ $resume->name }}</h2>
    <p class="section-header">
        {{ $resume->job_title }} <span class="section-content">| {{ $resume->job_field }}</span>
    </p>
    <p class="section-content">{{ $resume->phone }}</p>
</div>

    @php
        $skills = json_decode($resume->skills, true);
    @endphp
    @php
        $education = json_decode($resume->education, true);
    @endphp
    @php
        $courses = json_decode($resume->courses, true);
    @endphp
    
      <div class="section">
        <h3 class="section-title section-header">SKILLS</h3>
        <div class="section-content">
            @foreach ($skills as $skill)
                <div class="resume-item">
                    <div class="resume-item-header">
                        <span class="resume-item-title">{{ $skill['name'] }}</span>
                        @if($skill['description'])
                            <p>Description: {{ $skill['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
      <div class="section">
        <h3 class="section-title section-header">COURSES</h3>
        <div class="section-content">
            @foreach ($courses as $course)
              <div class="resume-item">
                  <div class="resume-item-header">
                      <span class="resume-item-title">{{ $course['name'] }}</span>
                      @if($course['description'])
                        <p>Description: {{ $course['description'] }}</p>
                      @endif
                  </div>
              </div>
            @endforeach
        </div>
      <div class="section">
        <h3 class="section-title section-header">EDUCATION</h3>
        <div class="section-content">
            @foreach ($education as $education)
                <div class="resume-item">
                    <div class="resume-item-header">
                        <span class="resume-item-title">{{ $education['name'] }}</span>
                        @if($education['description'])
                          <p>Description: {{ $education['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  
      
    </div>
  </div>
</body>
</html>