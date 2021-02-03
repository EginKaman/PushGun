@extends('layouts.app')
@section('title', __('Редактирование авторассылки'))
@section('content')
<main class="main createmailing">
    <div class="container">
    <auto-mailing-create action="{{route('autoMailing.store')}}"></auto-mailing-create>
    </div>
</main>

@endsection