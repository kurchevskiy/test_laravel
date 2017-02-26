
@extends('layouts.app')
@section('title', 'Edit Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
@include('common.errors')
  {{ Form::model($event, ['route' => ['events.update', $event], 'method'=>'PATCH'] ) }}
  @include('events._fields', ['subButton'=>'Update'])
  {{ Form::close() }}
  
@endsection