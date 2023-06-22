@extends('layouts.projectlayout')

@section('title')
   Laravel | Project Edit
@endsection

@section('content')
    <div class="container">

        <h1>Modifica il progetto: {{$project->project_title}}</h1>

        {{-- validation error list --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>

                    @foreach ($errors->all() as $elem)
                        <li>
                            {{$elem}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
    
            @csrf
            
            @method('PUT')

            <div class="form-group my-2">
                <label class="form-label" for="">TITOLO</label>
                <input class="form-control" type="text" name="project_title" value="{{old('project_title') ?? $project->project_title}}">
            </div>
    
            <div class="form-group my-2">
                <label class="form-label" for="">DESCRIZIONE</label>
                <textarea class="form-control" name="description" cols="30" rows="10">{{old('description') ?? $project->description}}</textarea>
            </div>
    
            {{-- campo input file --}}
            <div class="form-group my-2">
                <label class="form-label" for="">CARICA IMMAGINE</label>
                <input class="form-control" type="file" name="img" aria-describedby="fileHelpId">
            </div>

            {{-- <div class="form-group my-2">
                <label class="form-label" for="">SLUG</label>
                <input class="form-control" type="text" name="slug">
            </div> --}}
    
            <button type="submit" class="btn btn-success my-3">MODIFICA PROGETTO</button>
        </form>   
    </div>

@endsection