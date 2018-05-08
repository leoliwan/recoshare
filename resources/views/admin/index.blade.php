@extends('layouts.welcome_app')
@section('title','Admin Dashboard')
@section('content')


<div id="main-body">
    <div class="container-fluid">
        <div class="row">
            <!--Sidebar-->
            <div class="col-lg-3 col-md-3 bg--secondary">        
                <div class="sidebar">
                    <div id="sidebar-header"  class="text-white">
                        <div class="py-2 border-bottom">
                            <h2 class="lead text-center">RecoShare</h2>
                        </div>
                        <div class="py-3">
                            <nav class="navbar navbar-expand-md navbar-light p-1">  
                                <button class="navbar-toggler mx-auto bg-orange" data-toggle="collapse" data-target="#sidebarNav">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse text-dark" id="sidebarNav">
                                <nav class="nav flex-column pl-5">
                                    <a class="nav-link collapsed text-white border-bottom" data-toggle="collapse" href="#stockRecos"> Stock Recos </a>
                                    <ul class="sidenav-second-level collapse" id="stockRecos">
                                    <div class="py-2">
                                    <a class="text-white" href="{{url('/admin/reco')}}">Create New Stock Recos</a>
                                    </div>
                                    <div>
                                        <a class="text-white "href="">View All Stock Recos</a>
                                    </div>
                                    </ul>
                                    <a class="nav-link collapsed text-white border-bottom" data-toggle="collapse" href="#stockCategories"> Stock Categories </a>
                                    <ul class="sidenav-second-level collapse" id="stockCategories">
                                    <div class="py-2">
                                        <a class="text-white "href="{{url('/admin/category')}}">View All Stock Categories</a>
                                    </div>
                                    </ul>
                                    <a class="nav-link text-white border-bottom" href="#"> Users</a>
                                    <a class="nav-link text-white border-bottom" href="#"> Homepage</a>                          
                                </nav>
                                </div>                        
                            </nav>                      
                        </div>
                    </div>
                </div>               
            </div>

            <!--Main Dashboard-->
            <section class="col-lg-9 col-md-9 bg-light px-0">
                <div class="bg--default py-1">
                    <div class="container">
                    <h4 class="text-white pt-1">Admin Dashboard</h4>
                    </div>
                </div>

                <!-- Stock Reco-->
                <div class="container pt-3">
                        @include('admin.includes.messages')
                    <div class="card-body border border-dark">
                    <h5 class="bg--secondary p-2 text-white">Stock Recommendations <span class="float-right"><a href="{{url('/admin/reco')}}" class="text-white">See All Recos</a></span></h5>
                            <div class="row mx-3" style="overflow: scroll; height: 500px;">
                                <div class="scroll_down">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th style="width:10%">Stock Code</th>
                                                {{-- <th style="width:20%">Reco By</th> --}}
                                                <th style="width:10%">Type</th>
                                                <th style="width:10%">Posted At</th>
                                                <th style="width:10%">Expire At</th>
                                                <th style="width:10%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($recos) > 0)                                         
                                                @foreach($recos as $reco)                                                  
                                                <tr>
                                                <td>{{$reco->stock}}</td>
                                                {{-- <td>{{$reco->user->name}}</td> --}}
                                                <td>{{$reco->type}}</td>
                                                <td>{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                                <td>{{ date('M j, Y', strtotime($reco->expire)) }}</td>   
                                                <td>                                                    
                                                    <button type="submit" data-toggle="modal" data-target="#deleteReco" class="btn btn-outline-danger btn-block btn-sm">Delete</button>
                                                                                        
                                                    <!-- Delete Modal-->
                                                    <div id="deleteReco" class="modal fade modal-danger" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Are you sure you want to delete</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">
                                                                    <h2>{{$reco->stock}}</h2>
                                                                    </div>                             
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{route('admin.destroy', $reco->id) }}" method="post">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit" class="btn btn-success btn-sm">Yes</button>
                                                                        <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> 
                                           
                                                @endforeach
                                              
                                                @else 
                                                <div class="row justify-content-center py-5">
                                                    <p>No Posts Found</p>
                                                </div>
                                                 @endif                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div><!-- End of Stock Reco-->



                
                <!--Stock Users-->
                <div class="container py-3">
                    <div class="card-body border border-dark">
                        <h5 class="bg--secondary p-2 text-white">Stock Users</h5>                  
                            <div class="row mx-3" style="overflow: scroll; height: 400px;">
                                <div class="scroll_down">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date Join</th>
                                                <th>Access Permission</th>
                                                <th>Bank Permission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
                                                <td>             
                                                    @if($user->permission == 1)
                                                    <div class="badge badge-success">Approved</div>
                                                    @else
                                                    <div class="badge badge-warning">Pending</div>
                                                    @endif
                                                    <a href="{{route('permission.edit', $user->id)}}"><small><button class="btn btn-outline-primary btn-sm mb-2">Edit</button></small></a>
                                                </td>    
                                                <td>
                                                    @if($user->bank_permission == 1)
                                                    <div class="badge badge-success">Allowed</div>
                                                    @else
                                                    <div class="badge badge-warning">Not Allowed</div>
                                                    @endif
                                                    <a href="{{route('bankpermission.edit', $user->id)}}"><small><button class="btn btn-outline-primary btn-sm ">Edit</button></small></a>
                                                </td>                                               
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                    </div>       
                </div>
            </section>
        </div>
    </div>
</div><!--End of Main-Body-->
    

@endsection
