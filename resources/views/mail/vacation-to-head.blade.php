@php
    $data = [
        'Ф.И.О. сотрудника' => $vacation->user->name,
        'Подразделение и должность' => ($vacation->user->department->title ?? 'Нет подразделения') . ", " . $vacation->user->position,
        'Причина' => $vacation->reason,
        'Тип отпуска' => $vacation->vacation_type,
        'Начало' => $vacation->start_date,
        'Конец' => $vacation->end_date,
    ];

    $type = $vacation->approved_with_head == true ? 'hr' : 'head';
@endphp

<h3>Заявка на отпуск</h3>

<div style="margin-bottom: 20px;">
    @foreach($data as $key => $val)
        <p><b>{{ $key }}</b>: {{ $val }}</p>
    @endforeach
</div>
<hr style="margin-bottom: 20px;">

<td>
    <tr>
        <a href="{{ route('vacation.decline', $vacation->hash) }}?status=declined&type={{ $type }}" class="decline">Отклонить</a>
    </tr>
    <tr>
        <a href="{{ route('vacation.accept', $vacation->hash) }}?status=accepted&type={{ $type }}" class="accept">Одобрить</a>
    </tr>
</td>

<style>
    .decline {
        padding: 10px 15px;
        background: #fafafa;
        font-size: 15px;
        color: #000;
        margin-right: 15px;
        cursor: pointer;
        text-decoration: none;
    }
    .accept {
        padding: 10px 15px;
        background: #60945c;
        font-size: 15px;
        color: #fff;
        cursor: pointer;
        text-decoration: underline;
    }
</style>
