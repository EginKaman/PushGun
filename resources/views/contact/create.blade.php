@extends('layouts.app')
@section('title',__('Добавить'))
@section('content')
<div class="main contact">
    <div class="container">
        <div class="general__title">
            <h1 class="title">{{$addressbook->name}}</h1>
        </div>
        <add-contact-component action="{{route('contact.store')}}" :addressbook="{{$addressbook}}"></add-contact-component>
    </div>
</div>
@endsection