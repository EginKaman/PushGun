@extends('layouts.app')
@section('title', __('Редактирование авторассылки'))
@section('content')
<main class="main createmailing">
    <div class="container">
        <auto-mailing-edit :automailing="{{$automailing}}" action="{{route('autoMailing.store')}}"></auto-mailing-edit>
    </div>
</main>

@endsection