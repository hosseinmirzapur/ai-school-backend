<!-- resources/views/filament/forms/components/image-field.blade.php -->
@if ($getRecord()->image)
    <div style="display: flex; justify-content: center; align-items: center;">
        <img src="{{$getRecord()->image}}" alt="submission-image" style="border-radius: 10px;">
    </div>
@else
    <span>تصویری ثبت نشده است</span>
@endif
