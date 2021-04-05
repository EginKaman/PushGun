@extends('layouts.app')
@section('title',__('Добавить'))
@section('content')
<div class="main contact">
    <div class="container">
        <div class="general__title">
            <h1 class="title">{{$addressBook->name}}</h1>
        </div>
        <add-contact-component :addressBook="{{json_encode($addressBook)}}"></add-contact-component>
    </div>
</div>
@endsection