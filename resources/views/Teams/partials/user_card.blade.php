<!-- resources/views/partials/user_card.blade.php -->
<x-app-layout>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>Function:</strong> {{ $user->function }}</p>
        <p class="card-text"><strong>Bio:</strong> {{ $user->bio }}</p>
        <h6 class="card-subtitle mb-2 text-muted">Degrees</h6>
        @foreach ($user->degrees as $degree)
            <p class="card-text">{{ $degree->degree }} - {{ $degree->school }}</p>
        @endforeach
        <h6 class="card-subtitle mb-2 text-muted">Skills</h6>
        @foreach ($user->skills as $skill)
            <p class="card-text">{{ $skill->skillName }} ({{ $skill->skillExperience }} years)</p>
        @endforeach
        <h6 class="card-subtitle mb-2 text-muted">Courses</h6>
        @foreach ($user->courses as $course)
            <p class="card-text">{{ $course->courseName }} ({{ $course->year }})</p>
        @endforeach
    </div>
</div>
</x-app-layout>

