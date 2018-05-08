@extends('layouts.welcome_app')
@section('title','User Dashboard')
@section('content')

<div class="container pt-5">
    @include('admin.includes.messages')
<div class="row justify-content-center">
    {{--  <div class="col-md-3">

    </div>  --}}
    <div class="col-md-10">
        <div class="card card-default">
            <div class="card-header">Profile Page</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <a href="{{url('/home')}}" class="btn btn--info btn-block"><i class="fas fa-home"></i>  Home</a> 
                    </div>
                    @if(Auth::user()->admin === 1)
                    <div class="col-md-4">
                        <a href="" class="btn btn--secondary btn-block"><i class="fas fa-chart-line"></i>  New Stock Reco</a> 
                    </div>
                    <div class="col-md-4">         
                        
                        <a href="{{url('/admin')}}" class="btn btn--default btn-block"><i class="fas fa-chart-line"></i>  Admin Dashboard</a> 
                        @endif
                       
                    </div>
                </div>
                <hr>

                <!--Profile Info-->
               
                @foreach($users as $user)
                @if(!Auth::guest())
                @if(Auth::user()->id == $user->id)
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="container">
                        <img src="{{asset('images/'.$user->avatar)}}" style="width: 50%;" alt="profile-pic" class="rounded-circle">
                        <p class="text-center mt-2 mb-0">{{$user->name}}</p>
                            <div class="py-3">
                                @if($user->permission === 1)
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-primary btn-sm"><small>Edit Account</small></a>
                                @else
                                    <a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#notAllowedMessage"><small>Edit Account</small></a>
                                    <!--  Modal -->
                                    <div class="modal fade" id="notAllowedMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Please wait for your application to be approved. Thank you.
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                 @endif
                        </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead class="bg--default text-white">
                                <th scope="col">Full Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Donation Channel</th>
                                <th scope="col">Join Date</th>
                                <th scope="col">Status</th>
                            </thead>
                            <tbody>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    @if($user->bank_permission === 1)
                                    {{$user->donate}}
                                    @if($user->donate === 'Paypal')
                                    <small><a href="{{$user->link}}">{{$user->link}}</a></small>
                                    @else
                                    <p>{{$user->bank_account}}</p>
                                    @endif
                                    @else 
                                    <span class="badge badge-warning p-2">Pending Approval</span></h5>
                                    @endif
                                </td>
                                <td>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    @if($user->permission === 1)
                                    <span class="badge badge-success p-2">Approved</span></h5>
                                    @else
                                    <span class="badge badge-warning p-2">Pending Approval</span></h5>
                                    @endif
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
               
            </div>
        </div>
    </div>
</div>
</div>

<div class="container pt-5">
    @include('admin.includes.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-default">
                    <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                          My Recos 
                    </div>
                    @foreach($users as $user)
                    @if(!Auth::guest())
                    @if(Auth::user()->id == $user->id)
                    @if($user->permission === 1)
                    <div class="col-md-6">
                        <p class=" badge-success p-2">You can now post your reco in Homepage <span class="btn btn--default btn-sm"><a href="{{url('/home')}}" class="text-white">Click Here</a></span></p>
                    </div>
                    @else
                    <span class="badge badge-warning p-2">You are not allowed to Post reco until your status is approved</span></h5>
                    @endif
                    @endif
                    @endif
                    @endforeach
                </div>
                    </div>
                
                    <div class="card-body">             
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead class="bg--default text-white">
                                        <th scope="col">Stock Reco</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Ratings</th>
                                        <th scope="col">Chart</th>
                                        <th scope="col">Posted On</th>
                                        <th scope="col">Expiry Date</th>                                     
                                    </thead>

                                    @foreach($recos as $reco)
                                    <tbody>
                                        @if(auth()->id() === $reco->user_id) <!-- Only the user recos will be displayed -->
                                            <td>{{$reco->stock}}</td>
                                            <td>{{$reco->type}}</td>
                                            <td>Rating</td>
                                            <td><img  class="img-fluid" style="width: 80px;" src="{{asset('images/'.$reco->image)}}"></td>
                                            <td>{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                            <td>{{ date('M j, Y', strtotime($reco->expire)) }}</td>
                                        @endif
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                           
                    </div>

            </div>
        </div>
    </div>
</div>




@endsection