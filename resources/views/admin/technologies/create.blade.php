@extends('layouts.app')

@section('title','New Technology')

@section('content')

<div class="container">
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="fs-2 my-5">Create a new Technology</h2>
    <a href="{{route('admin.technologies.index')}}" class="link-secondary">Go Back</a>
  </div>
</div>
  
  <div class="container">
    <form action="{{ route('admin.technologies.index') }}" method="POST">
  
      @csrf 
  
      <div class="mb-3">
        <label for="name" class="form-label">Technology Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
      </div>
               
      <button class="btn btn-secondary">Create</button>
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