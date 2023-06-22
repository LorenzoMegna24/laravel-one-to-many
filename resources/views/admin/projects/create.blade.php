@extends('layouts.projectlayout')

@section('title')
   Laravel | Project Create
@endsection

@section('content')
    <div class="container">

        <h1>Inserisci un nuovo progetto</h1>
        
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
    
            @csrf
    
            <div class="form-group my-2">
                <label class="form-label" for="">TITOLO</label>
                <input class="form-control" type="text" name="project_title">
            </div>
    
            <div class="form-group my-2">
                <label class="form-label" for="">DESCRIZIONE</label>
                <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
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
    
            <button type="submit" class="btn btn-success my-3">CREA PROGETTO</button>
        </form>   
    </div>

@endsection