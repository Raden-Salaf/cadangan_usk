@extends('master')
@section('konten')
<style>
    body {
        background: url('/img/login.jpg') center center fixed;
        background-size: cover;
        background-color: grey;
    }
</style>
<h4>Selamat Datang <b>{{Auth::user()->name}}</b>,Anda Login sebagai <b>{{Auth::user()->role}}</b>.
</h4>
@endsection