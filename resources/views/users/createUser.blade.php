@extends('layouts.app')
@section('content')
  <h1>Add User</h1>
    {!! Form::open(['action'=>'UsersController@store','method'=>'POST',/*'enctype'=>'multipart/form-data'  */]) !!}
    <div class="form-group">
       {{Form::label('name','Name')}}
       {{Form::text('name', '',['class'=>'form-control','placeholder'=>'Name'])}}
    </div>
    <div class="form-group">
       {{Form::label('email','Email')}}
       {{Form::text('email', '',['class'=>'form-control','placeholder'=>'Email'])}}
    </div>
    <div class="form-group">
       {{Form::label('type','Type')}}
       {{Form::text('type', '',['class'=>'form-control','placeholder'=>'Type'])}}
    </div>
    <div class="form-group">
       {{Form::label('password','Type')}}
       {{Form::text('password', '',['class'=>'form-control','placeholder'=>'Password'])}}
    </div>
   
      
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    
{!! Form::close() !!}
@endsection