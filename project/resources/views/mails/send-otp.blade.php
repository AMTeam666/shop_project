@extends('mails.layouts.master')

@section('content')

<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}</p>

@endsection