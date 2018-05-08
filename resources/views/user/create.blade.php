@extends('layouts.app')

@section('content')

<div class="container py-5">
        @include('admin.includes.messages')
        <div class="row">
            <div class="col-md-8 mx-auto">
                <a href="{{ url('/admin') }}" class="btn btn-outline-primary mb-3"><i class="fa fa-home"></i> User Permission</a>
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title" id="exampleModalLabel">User Permission to {{$user->name}}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                    <label>Name of User</label>
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
</div>
@endsection