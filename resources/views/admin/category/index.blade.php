@extends('layouts.app')

@section('content')
<div class="container">
        @include('admin.includes.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
        <a href="{{url('/admin')}}" class="btn btn--primary btn my-2"><i class="fa fa-arrow-left"></i>  Back</a>
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            Category Dashboard
                        </div>
                        <div class="col-md-4">
                            <a href="" class="btn btn-info btn-block" data-toggle="modal" data-target="#inputCategory"><i class="fas fa-chart-line"></i>  Create New Category</a> 
                        </div>
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="inputCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" name="name" placeholder="Category Here">
                                    </div>
                                <div class="float-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            <form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Show Categories-->
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th style="width:30%">Category ID</th>
                            <th style="width:50%">Category Name</th>
                            <th style="width:10%"></th>
                            <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td><a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm">Edit</a></td>                              
                                <td>
                                <form action="{{route('category.destroy', $category->id) }}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}} 
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                </form>                               
                              </td>
                            </tr>                   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection