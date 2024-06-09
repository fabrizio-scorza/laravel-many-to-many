@extends('layouts.app')

@section('title','Edit Project')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 my-5">Edit Project</h2>
        <a href="{{route('admin.projects.show',$project)}}" class="link-secondary">Go Back</a>
    </div>
  </div>
  
  <div class="container">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
  
      @csrf 
      @method('PUT')
  
      <div class="mb-3">
        <label for="name" class="form-label">Project Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $project->name) }}">
      </div>
      
      <div class="mb-3">
        <label for="type_id" class="form-label">Type</label>
        <select class="form-control" name="type_id" id="type_id">
          <option value="">-- Slect type --</option>
          @foreach($types as $type) 
            <option @selected( $type->id == old('type_id', $project->type_id) ) value="{{ $type->id }}"> {{ $type->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Project Desctiption</label>
        <textarea class="form-control" name="description" id="description" rows="5" >{{ old('description', $project->description) }}</textarea>
      </div>
  
      <div class="mb-3">
        <label for="link" class="form-label">GitHub link</label>
        <input type="url" min="1" max="100" name="link" class="form-control" id="link" value="{{ old('link', $project->link) }}">
      </div>  

      <button class="btn btn-secondary">Update</button>
    </form>
    @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  </div>
@endsection