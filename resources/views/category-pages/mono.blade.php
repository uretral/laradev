
@dump($data)

{!! $data !!}

@php
$str = 'App\Admin\Controllers\Block\SomeController';
$r = substr($str, 22);
@endphp
{{$r}}
