@extends('layouts.projectlayout')

@section('title')
   Laravel | Project Show
@endsection

@section('content')
   <h1>Singolo progetto</h1>
   <img src="{{asset('storage/' . $project->img)}}" alt="">
   <h2>{{$project->project_title}}</h2>    
   <p>{{$project->description}}</p>


@endsection