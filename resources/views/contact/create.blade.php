@extends('layouts.app')
@section('title',__('Добавить'))
@section('content')
<div class="main contact">
    <div class="container">
        <div class="general__title">
            <h1 class="title">@lang('Новый список 18')</h1>
        </div>
        <add-contact-component></add-contact-component>
    </div>
</div>
@endsection