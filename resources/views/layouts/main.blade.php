@extends('layouts.index')

@section('layouts')
    @include('components.header')
    @yield('content')
    @include('components.footer')
@endsection
