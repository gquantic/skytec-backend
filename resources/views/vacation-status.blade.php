@extends('templates.one-page')

@section('head-title')Решение по заявке@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5">
                @if($already)
                    <h3>Решение по заявке уже принято</h3>
                @else
                    <h3>Решение по заявке принято</h3>
                @endif
                @if($vacation->status == 'Одобрено')
                    <p>HR будет отправлено письмо</p>
                @else
                    <p>Заявка сотрудника на отпуск отклонена</p>
                @endif
            </div>
        </div>
    </div>
@endsection
