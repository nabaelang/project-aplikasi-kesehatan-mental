<!-- resources/views/admin/mood_configurations/answers.blade.php -->
@foreach ($answerOptions as $option)
    <option value="{{ $option }}">{{ $option }}</option>
@endforeach
