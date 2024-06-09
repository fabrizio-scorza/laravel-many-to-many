@extends('layouts.app')

@section('title','Types')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between aling-items-center">
        <h2>Types List</h2>
        <div>
            <a href="{{route('admin.dashboard')}}" class=" btn btn-secondary mx-3">Go Back</a>
            <a class="btn btn-success" href="{{route('admin.types.create')}}">ADD Type</a>            
        </div>
    </div>
</div>
<div class="container">
    <table class="table table-success table-striped">
        <thead>
            <tr class="d-flex justify-content-between">
            <th scope="col" class="flex-grow-1">Name</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr class="d-flex justify-content-between">
                    <td scope="row" class="flex-grow-1">{{$type->name}}</td>
                    @auth
                        <td>
                            <a class="link-secondary px-3" href="{{ route('admin.types.edit', $type) }}">Update</a>              
                            <a class="link-danger delete" data-bs-toggle="modal" data-bs-target="#modal">Delete</a>
                        </td>
                    @endif                
                </tr>   
            @endforeach        
        </tbody>
    </table>    
</div>

<div class="modal" tabindex="-1" id="modal" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-body">
                <p>ALLERT: if u click on yes your type will permanently deleted. Do you want to delete your type permanently?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">NO</button>
                <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
                    
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger delete">YES</button>
                </form> 
            </div>
      </div>
    </div>
</div>

    
@endsection