@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ $candidate->name }}'s Information</h2>

        <!-- Candidate Profile -->
        <h3>Candidate Profile</h3>
        <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
            @csrf
            <label for="biography">Biography:</label>
            <textarea name="biography">{{ $profile->biography ?? '' }}</textarea><br>
            <label for="year">Year:</label>
            <input type="text" name="year" value="{{ $profile->year ?? '' }}"><br>
            <label for="vision">Vision:</label>
            <textarea name="vision">{{ $profile->vision ?? '' }}</textarea><br>
            <label for="mission">Mission:</label>
            <textarea name="mission">{{ $profile->mission ?? '' }}</textarea><br>
            <button type="submit">Update Profile</button>
        </form>

        <!-- Achievements -->
        <h3>Achievements</h3>
        <ul>
            @foreach($achievements as $achievement)
                <li>
                    {{ $achievement->year }} - {{ $achievement->title }} ({{ $achievement->type }})
                    <form action="{{ route('achievements.destroy', $achievement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form action="{{ route('achievements.store', $candidate->id) }}" method="POST">
            @csrf
            <label for="year">Year:</label>
            <input type="text" name="year"><br>
            <label for="title">Title:</label>
            <input type="text" name="title"><br>
            <label for="type">Type:</label>
            <select name="type">
                <option value="competition">Competition</option>
                <option value="organizational">Organizational</option>
                <option value="volunteer">Volunteer</option>
            </select><br>
            <button type="submit">Add Achievement</button>
        </form>

        <!-- Experiences -->
        <h3>Experiences</h3>
        <ul>
            @foreach($experiences as $experience)
                <li>
                    {{ $experience->start_date }} - {{ $experience->end_date }}: {{ $experience->position }}
                    <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form action="{{ route('experiences.store', $candidate->id) }}" method="POST">
            @csrf
            <label for="position">Position:</label>
            <input type="text" name="position"><br>
            <label for="description">Description:</label>
            <textarea name="description"></textarea><br>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date"><br>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date"><br>
            <button type="submit">Add Experience</button>
        </form>
    </div>
@endsection
