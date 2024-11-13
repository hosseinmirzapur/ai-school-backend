<!-- resources/views/filament/tables/columns/audio-column.blade.php -->
@if ($getRecord()->voice)
    <audio controls>
        <source src="{{ Storage::url($getRecord()->voice) }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@else
    <span>No audio file</span>
@endif
