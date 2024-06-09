@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"> Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{route('admin.projects.index')}}">Projects</a>
                        </li>
                        <li>
                            <a href="{{route('admin.types.index')}}">Types</a>
                        </li>                        
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
