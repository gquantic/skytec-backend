<div class="form-group">
    <label class="form-label">{{ $title }}</label>
    <input type="file" name="{{$name}}" class="form-control uploadfile" accept="*" value="">
    @if($value)
        <p class="mt-3 mb-0">
            Не загружайте файл, если не хотите заменить текущий.
            <br>
            Сейчас установлен файл: <a target="_blank" href="{{ $value }}">Нажмите для открытия</a>
        </p>
    @endif
</div>
