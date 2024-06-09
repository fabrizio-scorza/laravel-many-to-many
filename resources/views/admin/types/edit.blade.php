@extends('layouts.app')

@section('title','Edit Type')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 my-5">Edit Type</h2>
        <a href="{{route('admin.types.index')}}" class="link-secondary">Go Back</a>
    </div>
  </div>
  
  <div class="container">
    <form action="{{ route('admin.types.update', $type) }}" method="POST">
  
      @csrf 
      @method('PUT')
  
      <div class="mb-3">
        <label for="name" class="form-label">Type Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $type->name) }}">
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