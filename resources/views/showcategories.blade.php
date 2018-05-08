@extends('layouts.welcome_app')
@section('title', 'Category')
@section('content')

<div class="container-fluid py-5">
    <div class="row">
        <!-- Main Content-->
        <div class="col-md-9">
            <div class="card-body bg--default p-1 pt-2 px-3 mb-3">  
                    @foreach($categories2->recos->slice(0, 1) as $reco)
                <h5 class="text-white">Investment Type : {{$reco->category->name}}</h5>   
                @endforeach
            </div>   

            @if(count($categories2->recos) > 0)
            <div class="row">    
                @foreach($categories2->recos as $reco)
                @if($reco->user->permission === 1)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card p-1">
                        <div class="mt-2">
                            @if(auth()->id() === $reco->user_id)
                            <div class="row">
                                <div class="col-md-2 col-lg-2 d-none d-md-block">
                                    <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                </div>
                                <div class="col-sm-10 col-md-10 pl-0">
                                    <p class="bg-secondary text-white mb-1 p-2">Your Stock Reco</p>
                                </div>
                            </div>                          
                            @else
                            <div class="row">
                                <div class="col-md-2 col-lg-2 d-none d-md-block">
                                    <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                </div>
                                <div class="col-md-10 col-lg-10">
                                    <p class="bg-secondary text-white mb-1 p-2">Stock Reco By: <strong>{{$reco->user->name}}</strong></p>
                                </div>
                            </div>
                            @endif
                        </div>                          
                        <table class="table table-bordered">
                            <thead class="bg--default text-white">
                                <th scope="col">Stock</th>
                                <th scope="col">Reco Date</th>
                                <th scope="col">Expire</th>
                            </thead>
                            <tbody>
                                <td>{{$reco->stock}}</td>
                                <td>{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                <td>{{ date('M j, Y', strtotime($reco->expire)) }}</td>
                            </tbody>
                        </table>
                        <a href="{{route('showreco', $reco->slug)}}"><img class="card-img-top" style="height: 130px" src="{{asset('images/'.$reco->image)}}" alt="Card image cap"></a>
                        <div class="card-body px-0 pb-0">
                            
                        <a href="{{route('showreco', $reco->slug)}}"  class="btn btn-success btn-block btn-sm btn-block">View</a>
                            
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                  
                                    <button class="btn btn-outline-secondary btn-sm {{$reco->YouLiked()?"liked":""}}" onclick="recolike('{{$reco->id}}',this)"><i class="fa fa-thumbs-up"></i> Like </button>
                                    <button class="btn btn--success btn-sm" id="{{$reco->id}}-count">{{$reco->likes()->count()}}</button>  
                                </div>
                                <div class="col-md-8">
                                    <!-- Start Rating-->
                                    <table class="table table-bordered">
                                            <tbody>
                                                <td class="p-1" style="width:30%">Rating</td>
                                                <td class="p-1">{{$reco->rating}}</td>
                                                <td class="p-1" style="width:70%">
                                                    @for ($star = 1; $star <= 5; $star++)
                                                        @if($reco->rating >= $star)
                                                            <span><i class="fa fa-star" style="color:darkorange;"></i></span>
                                                        @else
                                                            <span><i class="fa fa-star" style="color:antiquewhite;"></i></span>
                                                        @endif
                                                    @endfor
                                                </td>           
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>

                    <!-- Modal -->
                <div class="modal fade" id="{{$reco->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg--default">
                            <h5 class="modal-title text-center" id="exampleModalLabel">{{$reco->stock}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img  class="img-thumbnail" src="{{asset('images/'.$reco->image)}}">
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="py-1">Stock</td>
                                                    <td class="py-1">{{$reco->stock}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Buy Range</td>
                                                <td class="py-1">{{$reco->from}} - {{$reco->to}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Stop Loss</td>
                                                    <td class="py-1">{{$reco->stoploss}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Target Price</td>
                                                    <td class="py-1">{{$reco->target}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Risk Level</td>
                                                    <td class="py-1">{{$reco->risk}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Horizon</td>
                                                    <td class="py-1">{{$reco->type}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row">

                                                <!-- Edit and Delete Button for Owner of Reco-->
                                                {{--  {{ route('recos.edit', $reco->id) }}  --}}
                                                    <div class="col-md-6">
                                                    @if(auth()->id() === $reco->user_id)
                                                    <a href="" class="btn btn-outline-info btn-block btn-sm">Edit</a>
                                                    @endif
                                                </div>
                                                {{--  <div class="col-md-6">
                                                    @if(auth()->id() === $reco->user_id)
                                                    <form action="{{ route('recos.destroy', $reco->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline-danger btn-block btn-sm">Delete</button> 
                                                    </form>
                                                    @endif 
                                                </div>   --}}
                                            </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <!-- Start Rating-->
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <td class="p-1" style="width:30%">Rate this reco</td>
                                                <td class="p-1" style="width:70%">
                                                    <div class="stars-outer"></div>
                                                    <div class="stars-inner"></div>  
                                                </td>            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                    </div>
                                </div>
                                <hr>                         
                                <div class="card">
                                    <div class="card-header bg--secondary text-white py-2">
                                        Details
                                    </div>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$reco->details}}</li>
                                    <li class="list-group-item">
                                        <div class="card">
                                            <div class="card-header py-2">
                                                <p class="mb-0"><strong>Stock Reviews</strong><span> (Share your review about this reco)</span></p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                            {{--  <li class="list-group-item">
                                            <form action="{{route('comment.store', $reco->id)}}" method="post">
                                            {{csrf_field()}}
                                                <div class="form-group">
                                                    <textarea type="text" name="content" class="form-control" placeholder="Your Review Here..."></textarea>
                                                    <button type="submit" class="btn btn--primary btn-sm float-right mt-2">Submit</button>
                                            </form>
                                            </li>

                                            @if($reco->comments->isEmpty())
                                                <div class="text-center py-3">No Review</div>
                                            @else
                                            @foreach($reco->comments as $comment)
                                            <li class="list-group-item bg--default text-white m-3" style="border-top-right-radius: 35px; border-bottom-left-radius: 30px;">
                                                <div>
                                                <p class="mb-0">{{$comment->content}}
                                                    @if(auth()->id() === $reco->user_id)
                                                    <form action="{{ route('comment.destroy', $comment->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline-danger btn-sm py-0"><i class="fa fa-trash-alt"></i></button>
                                                    </form>
                                                    @endif
                                                </p>
                                                </div>
                                            <hr>
                                            <div class="row mt-2">
                                                <div class="col-sm-6 col-md-8">
                                                    
                                                </div>
                                                <div class="col-sm-6 col-md-4">
                                                <p class="bg-light text-dark mb-0 p-1 px-2" style="border-radius: 20px">By: {{$comment->user->name}}<small class="float-right">{{$comment->created_at->diffForHumans()}}</small></p>
                                                </div>
                                            </div>   
                                            </li>
                                            @endforeach
                                            @endif  --}}
                                                
                                            </ul>
                                        </div>
                                    </li>    
                                    </ul>
                                </div>    
                            </div>
                        <div class="modal-footer">                   
                        </div>
                    </div>
                    </div>
                </div>
                @endif
                @endforeach 
            </div> 
            @else 
                <p class="text-center">No Recos Found in this Category</p>
            @endif
        </div>

         <!-- Right Sidebar -->
         @include('admin.includes.sidebar')
    </div>
</div>

@endsection