
@extends('layouts.app')

@section('title', 'Create Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
@include('common.errors')
	{{ Form::open(['url'=>'events']) }}
@include('articles._fields', ['subButton'=>'Create'])
  {{ Form::close() }}
  
@endsection