@extends('layouts.app')

@section('content')

<div class="container">
        @include('admin.includes.messages')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <a href="{{ url('/admin/category') }}" class="btn btn-outline-primary mb-3"><i class="fa fa-home"></i> Back to Category Dashboard</a>
            <div class="card">
                <div class="card-header">
                <h5 class="card-title" id="exampleModalLabel">Edit: {{$category->name}}</h5>
                </div>
                <div class="card-body">

                <form action="{{ route('category.update', $category->id) }}" method="post">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="from-group">
                            <label for="title">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Submit</button>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>  
</div>

@endsection

