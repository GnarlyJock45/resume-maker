@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4">
    <h1 class="text-xl font-bold mb-10">Welcome to Resume Builder</h1>
    <a href="{{ route('resume.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create New Resume
    </a>
</div>
@endsection
