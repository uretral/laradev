@php
$u = \App\Models\Test::all()->first()->toArray();
@endphp
@dump($u)

@dump(asset('tt'))


<img src="{{asset('storage/'.$u['intro_img'])}}" alt="">
{!! $u['detail'] !!}
