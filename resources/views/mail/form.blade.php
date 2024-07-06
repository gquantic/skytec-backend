<h3>{{ $title }}</h3>

@foreach($data as $key => $val)
    <p><b>{{ $key }}</b>: {{ $val }}</p>
@endforeach
