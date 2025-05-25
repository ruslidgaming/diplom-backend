@extends('layouts.index')

@section('layout')
    @include('components.header')
    @yield('content')
    @include('components.footer')
@endsection
