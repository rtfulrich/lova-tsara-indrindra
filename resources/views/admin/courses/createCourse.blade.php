@extends('adminlte::page')

@section('content_header')

@endsection

@section('content')
    
    <livewire:admin.new-course />

@endsection

@section('js')
    @livewireScripts
@endsection

@section('css')
    <livewire:styles />
@endsection