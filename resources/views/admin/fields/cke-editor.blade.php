<div class="form-group">
    @if($attributes['title'] != '')
        <label for="{{ $attributes['id'] }}" class="form-label">
            {{ $attributes['title'] }}
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $attributes['id'] }}" class="ckeeditor">{!! $value !!}</textarea>

    @if($attributes['help'] != '')
        <small class="form-text text-muted">{{ $attributes['help'] }}</small>
    @endif
</div>

<script>
    $(document).ready(function() {
        setTimeout(function () {
            CKEDITOR.replace('{{ $attributes['id'] }}');
        }, 100)
    });
</script>
