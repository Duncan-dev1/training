@extends('layouts.app')
@section('content')
<h1>TESTING</h1>
<a href="/users/createUser" class="btn btn-secondary btn-lg active float-right" role="button" aria-pressed="true" type="submit">ADD User</a>
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Type</th>
       
      </tr>
    </thead>
    <tbody>
    
        @if (count($users)>0) 
        @foreach($users as $user)
        <tr>
      
        
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        
        <td>{{$user->type}}</td>
        
      </tr>
     @endforeach
     @else
     <p>No Users found</p>
     @endif
    </tbody>
  </table>
@endsection