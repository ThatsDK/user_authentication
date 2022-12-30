@extends('layouts.app')

@section('content')


<h1>Home : {{ Auth::user()->name }}</h1>
<h2>Email ID: {{ Auth::user()->email }}</h2>

@endsection