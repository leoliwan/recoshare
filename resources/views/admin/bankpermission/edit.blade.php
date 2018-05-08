@extends('layouts.app')

@section('content')

<div class="container py-5">
        @include('admin.includes.messages')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <a href="{{ url('/admin') }}" class="btn btn-outline-primary mb-3"><i class="fa fa-arrow-circle-left"></i> Back to Admin Dashboard</a>
            <div class="card">
                <div class="card-header">
                <h5 class="card-title" id="exampleModalLabel">Grant Permission to {{$user->name}}</h5>
                <p>This will make user bank details to be displayed</p>
                </div>
                <div class="card-body">

                    <form action="{{ route('bankpermission.update', $user->id) }}" method="post">
                        {{csrf_field()}}
                        {{method_field('put')}}

                        <div class="form-group">
                            <label>Set Permission Status</label>
                        <select type="number" name="bank_permission" class="form-control">
                                <option value="" disabled selected>Select Option...</option>
                                <option value="0">Do Not Allow</option>
                                <option value="1">Allow</option>
                            </select>
                        </div>

                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th style="width:10%">User Id</th>
                                    <th style="width:20%">Name</th>
                                    <th style="width:20%">Email</th>
                                    <th style="width:20%">Date Join</th>
                                    <th style="width:30%">Permission Status</th>
                                    </tr>
                                </thead>
                                <tbody>             
                                    <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        @if($user->bank_permission == 1)
                                            <div class="badge badge-success  p-2">Allowed</div>
                                            @else
                                            <div class="badge badge-warning p-2">Not Allowed</div>
                                            @endif
                                        </td>
                                    </tr>                               
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection