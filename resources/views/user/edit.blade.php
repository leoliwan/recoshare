@extends('layouts.app')
@section('title','Edit Profile')
@section('content')

<div class="container py-5">
    @include('admin.includes.messages')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <a href="{{ url('/user') }}" class="btn btn-outline-primary mb-3"><i class="fa fa-home"></i> Back to Dashboard</a>
            <div class="card">
                <div class="card-header">
                <h5 class="card-title" id="exampleModalLabel">Edit Profile</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}

                            <!--Avatar-->
                            <div class="form-group bg--secondary text-white p-2">
                                <label class="mb-4">Upload Your Profile Picture</label>
                                <img class="rounded-circle" style="width:8%;" src="{{asset('images/'.$user->avatar)}}"><br>
                                <small>170px X 170px at less than 100 kilobytes</small>
                                <input type="file" name="avatar" class="form-control"></textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><strong>Full Name</strong></label>
                                <input class="form-control" name="name" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label><strong>Username</strong></label>
                                <input class="form-control" name="username" value="{{$user->username}}" placeholder="Add Username">
                            </div>

                            @if($user->bank_permission === 1) <!-- This will display the Donation form if user bank is permitted -->
                            <div class="alert alert-primary" role="alert">
                                    Your Donation Channel is approved. You can edit your donation channels below
                                </div>
                            <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label class="mb-0"><strong>Donation Channels</strong></label><br>
                                            <small>Select ways subscribers can support you through donation channel. Ex. Bank Account, Paypal Account, Patreon Account</small> 
                                            <select name="donate" class="form-control" value="{{$user->donate}}">
                                                <option>Bank (BDO)</option>
                                                <option>Bank (BPI)</option>
                                                <option>Paypal</option>
                                                <option>Patreon</option>
                                                <option>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label class="mb-0"><strong>Your Paypal Link</strong></label><br>
                                            <small>Enter the Paypal link to your donation Channel</small> 
                                            <input class="form-control" name="link" value="{{$user->link}}" placeholder="https://paypal.com/example.link/donate">
                                        </div>
                                        <div class="form-group">        
                                            <label class="mb-0"><strong>Bank Account Number</strong></label><br>
                                            <input type="number" class="form-control" name="bank_account" value="{{$user->bank_account}}">                          
                                        </div>
                                    </div>
                                </div>
                            @else
                            <!-- Display if the user bank is not permitted-->
                            <div class="alert alert-danger" role="alert">
                                Your Donation Channel is still pending approval. Do not enter anything yet.
                            </div>
                            <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group">
                                            
                                            <label class="mb-0"><strong>Donation Channels</strong></label><br>
                                            <small>Select ways subscribers can support you through donation channel. Ex. Bank Account, Paypal Account, Patreon Account</small> 
                                            <select name="donate" class="form-control"  value="{{$user->donate}}">
                                                <option>Bank (BDO)</option>
                                                <option>Bank (BPI)</option>
                                                <option>Paypal</option>
                                                <option>Patreon</option>
                                                <option>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label class="mb-0"><strong>Your Paypal Link</strong></label><br>
                                            <small>Enter the Paypal link to your donation Channel</small> 
                                            <input class="form-control" name="link" value="{{$user->link}}" placeholder="https://paypal.com/example.link/donate">
                                        </div>
                                        <div class="form-group">        
                                            <label class="mb-0"><strong>Bank Account Number</strong></label><br>
                                            <input type="number" class="form-control" name="bank_account" value="{{$user->bank_account}}">                          
                                        </div>
                                    </div>
                                </div>
         
                            @endif
                            
                            <hr>
                            <div class="float-right">
                                <a href="{{ url('/user') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection