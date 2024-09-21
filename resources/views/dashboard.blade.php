@extends('app', ['page' => 'dashboard'])
@section('content')
    @if (Auth::check() && Auth::user()->id_jenis_user == 2)
        @include('dashboard.mhs')
        @else
        @include('dashboard.dosen')
    @endif
@endsection
