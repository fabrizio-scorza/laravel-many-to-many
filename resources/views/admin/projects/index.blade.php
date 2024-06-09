@extends('layouts.app')

@section('title','Projects')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>My Projects</h2>
        <a class="btn btn-success" href="{{route('admin.projects.create')}}"> Create new project</a>
    </div>
</div>
<div class="container">
    <table class="table table-success table-striped">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Link</th>
            <th scope="col">Type</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td scope="row">{{$project->name}}</td>
                    <td>
                        <a href="{{$project->link}}"  class="link-secondary">{{$project->link}}</a>
                    </td>
                    <td>{{$project->type ? $project->type->name : 'No Type'}}</td>                
                    <td>
                        <a class="link-secondary" href="{{route('admin.projects.show',$project)}}">Details</a>
                    </td>
                    <td>
                        @auth            
                            <a class="link-danger delete" data-bs-toggle="modal" data-bs-target="#modal">Delete</a>
                        @endif
                    </td>                
                </tr>   
            @endforeach        
        </tbody>
    </table>    
</div>

<div class="modal" tabindex="-1" id="modal" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-body">
                <p>ALLERT: if u click on yes your project will permanently deleted. Do you want to delete your project permanently?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">NO</button>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger delete">YES</button>
                </form> 
            </div>
      </div>
    </div>
</div>

    
@endsection