<legend class="text-black px-2 mt-2">
    {{$title ?? 'Редактирование поля'}}

    <p class="small text-muted mt-2 mb-0 text-balance">
        {{ $description ?? '' }}
    </p>
</legend>
<page-blocks-edit position="{{ $position }}" :default-blocks='@json($value)' />
