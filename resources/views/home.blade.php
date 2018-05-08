@extends('layouts.welcome_app')
@section('title','Home')
@section('content')

<section class="hero-section">
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-4">
                <div class="search-form">
                    <div class="card-body bg--primary">
                        <div class="text-center icon"><i class="fa fa-search"></i></div>
                        <h2 class="text-center text-white">Search Stock Reco</h2>
                        <p class="text-center text-white py-3">Want to trade today but don't know which stock to choose. Search from the hundreds of stock recos that you can study and trade today. You can also search for specific stock you want to trade. 
                        </p>
                        <div class="search-inputs">
                            <div class="search-input">
                            <form action="{{route('search')}}" method="post" name="Form">
                                {{csrf_field()}}
                                <input type="text" name="search" placeholder="Type Stock Code Here">
                                <input class="bg--default text-white" type="submit" onclick="return IsEmpty();" value="Go">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="post-reco">
                    <div class="card-body bg--default">
                        <div class="text-center icon"><i class="fa fa-edit"></i></div>
                        <h2 class="text-center text-white">Post Stock Reco</h2>
                        <p class="text-center text-white py-3">Are you good at analyzing stocks and want to share them? There are are hundreds of traders who are looking for stock to study and trade. Your stock analysis and recommendation can help them. 
                        </p>
              
                        @foreach($users as $user)                
                        @if(Auth::user()->id == $user->id)
                        @if($user->permission === 1)
                        <a href="" class="btn btn--primary btn-block text-white" data-toggle="modal" data-target="#inputReco"><i class="fas fa-edit"></i>  Post Your Best Stock Reco</a> 
                        @else
                        <a class="btn btn--primary btn-block text-white" data-toggle="modal" data-target="#pendingPermissionMessage"><i class="fas fa-edit"></i>  Post Your Best Stock Reco</a> 
                        @endif
                        @endif
                        @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Pending Permission Modal-->
<div class="modal fade" id="pendingPermissionMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          Your Permission to Post is Pending. Please try again later.
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
</div>

<!--Post Reco Modal-->
<div class="modal fade" id="inputReco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg--default">
          <h5 class="modal-title" id="exampleModalLabel">Add New Stock Reco</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('home.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="form-group">
            <label for="category_id">Category</label>
            <small style="color:red"><em>(required)</em></small>
                <select name="category_id" class="form-control">
                    <option value="" class="disabled selected">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
        </div>
          <div class="form-group">
            <label><strong>Stock Code</strong></label>
            <small style="color:red"><em>(required)</em></small>
            <input type="text" class="form-control" name="stock" placeholder="Enter Stock Code Here">
          </div>
          <hr>
          <h5>Buying Range</h5>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>From</label>
                    <small style="color:red"><em>(required)</em></small>
                    <input type="number" step="0.001" name="from" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>To</label>
                    <small style="color:red"><em>(required)</em></small>
                    <input type="number" step="0.001" name="to" class="form-control">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stoploss Price</label>
                    <small style="color:red"><em>(required)</em></small>
                    <input type="number" step="0.001" name="stoploss" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label>Target Price</label>
                        <small style="color:red"><em>(required)</em></small>
                        <input type="number" step="0.001" name="target" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Risk</label>
                        <small style="color:red"><em>(required)</em></small>
                        <select type="text" name="risk" class="form-control">
                            <option>Low Risk</option>
                            <option>Medium Risk</option>
                            <option>High Risk</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Investment Type</label>
                            <small style="color:red"><em>(required)<span style="color:blue"> Must be the same with Category</span></em></small>
                            <select type="text" name="type" class="form-control">
                                <option>Day Trade</option>
                                <option>Swing Trade</option>
                                <option>Position Trade</option>
                                <option>Long Term Investment</option>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="form-group">
                <label>End of Reco</label>
                <small style="color:red"><em>(required)</em></small>
                <input style="width: 30%;" type="date" name="expire" class="form-control">
            </div>
            <div class="form-group">
                <label>Details</label>
                <small style="color:red"><em>(required)</em></small>
                <textarea id="details" cols="20" rows="5" name="details" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Upload Stock Chart</label>
                <small style="color:red"><em>(required)</em></small>
                <input type="file" name="image" class="form-control"></textarea>
            </div>
            <hr>
            <p><span style="color:red"><strong>NOTE:</strong></span> check all your details before submitting. You will not be allowed to edit after submitting your reco.</p>
            <div class="float-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>    
    </div>
</div>
</div><!--End Of Create Reco Modal-->


<!-- RECOS -->
<div class="py-5" id="recos">
    <div class="container-fluid">           
            <div class="row">
            <!-- Main Content-->
            <div class="col-md-8 col-lg-9">
                <div class="card-body bg--default p-1 pt-2 px-3 mb-3">
                    <h5 class="text-white">Latest Stock Reco <span><?php echo "(As of " . date("m-d-Y"). ")"; ?></span></h5>
                </div>   
                @include('admin.includes.messages')
                <div class="row">
                        @foreach($recos as $reco)     
                        {{-- @if(Auth::user()->id == $user->id)
                        @if(!Auth::guest())  --}}
                        @if($user->permission === 1)
                   
                        <div class="col-md-12 col-lg-4 mb-4">
                            <div class="card p-1">
                                <div class="mt-2">
                                    @if(auth()->id() === $reco->user_id)
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 d-none d-md-block">
                                            <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                        </div>
                                        <div class="col-sm-10 col-md-10 pl-0">
                                            <p class="bg-secondary text-white mb-1 p-2">{{$reco->user->username}}</p>
                                        </div>
                                    </div>                          
                                    @else
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 d-none d-md-block">
                                            <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                        </div>
                                        <div class="col-md-10 col-lg-10">
                                            <p class="bg-secondary text-white mb-1 p-2">Stock Reco By: <strong>{{$reco->user->username}}</strong></p>
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
                                <a href="{{route('stockreco', $reco->slug)}}"><img class="card-img-top" style="height: 130px" src="{{asset('images/'.$reco->image)}}" alt="Card image cap"></a>
                                <div class="card-body px-0 pb-0">
                                    
                                <a href="{{route('stockreco', $reco->slug)}}"  class="btn btn-success btn-block btn-sm btn-block">View</a>
                                   
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <td class="p-1">Likes</td>
                                                    <td class="p-1" id="{{$reco->id}}-count">{{$reco->likes()->count()}}</td>
                                                </tbody>
                                            </table>
                                           
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
                            <div class="modal-header bg--default  text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Stock Code: {{$reco->stock}}</h5>
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
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr class="bg-success text-white">
                                                    <td class="py-1">Stock</td>
                                                    <td class="py-1">{{$reco->stock}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Buy Range</td>
                                                    <td class="py-1 badge badge-warning px-3 ml-3 py-2">{{$reco->from}} - {{$reco->to}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Stop Loss</td>
                                                    <td class="py-1 py-1 badge badge-danger px-3 ml-3 py-2">{{$reco->stoploss}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">Target Price</td>
                                                    <td class="py-1 badge badge-success px-3 ml-3 py-2">{{$reco->target}}</td>
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
                                            <hr>
                                            <!-- Start Rating-->                                             
                                            <div class="card-body p-1 bg--info">
                                                <p class="mb-1 text-white">Rate this Reco</p>
                                                <form action="{{route('addrating', $reco->id)}}" method="post">
                                                    {{csrf_field()}}   
                                                    <div class="mb-1">                                                            
                                                        <select class="" style="width:100%; padding:.3em" name="rating">
                                                            <option selected>Select Rating</option>
                                                            <option value="1">1 - Not so cool reco</option>
                                                            <option value="2">2 - Not cool reco</option>
                                                            <option value="3">3 - Average cool reco</option>
                                                            <option value="4">4 - Cool reco</option>
                                                            <option value="5">5 - Very cool reco</option>
                                                        </select>
                                                    </div>                                                              
                                                        <button class="btn btn-warning btn-block btn-sm" type="submit">Rate</button>
                                                </form> 
                                            </div>                                                                                 
                                        </div>
                                    </div>
                                <hr>
                    
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
                    {{-- @endif
                    @endif --}}
                    @endforeach
                </div> 

                <!-- Reco By Categories-->
                {{--  <div class="row">
                    <div class="col-md-12 col-lg-6 mb-3">
                        <div class="card-body bg--secondary p-1 pt-2 px-3">
                            <h5 class="text-white">For Day Traders</h5>
                        </div>   
                        <div class="card-body bg-white border border-dark">
                            <table class="table table-bordered">
                                <thead class="bg--default text-white">
                                    <th class="py-1">Reco Date</th>
                                    <th class="py-1">Stock</th>
                                    <th class="py-1">Buy Range</th>
                                    <th class="py-1">Target</th>
                                    <th class="py-1">Rating</th>
                                    <th class="py-1">View</th>
                                </thead>
                                @foreach($recos as $reco)
                                <!-- To display recos according to category only-->
                                @if($reco->type === 'Day Trade')
                                <!-- To display recos according to user permission-->
                                @if($reco->user->permission === 1)
                                <tbody>                                  
                                    <td class="py-1">{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                    <td class="py-1">{{$reco->stock}}</td>
                                    <td class="py-1">{{$reco->from}} - {{$reco->to}}</td>  
                                    <td class="py-1">{{$reco->target}}</td>
                                    <td class="py-1">{{$reco->rating}}</td>  
                                    <td class="py-1 text-center"><a href="{{route('admin.reco.show', $reco->id)}}"><i class="fa fa-eye"></i></a></td>                            
                                </tbody>   
                                @endif  
                                @endif                          
                                @endforeach
                            </table>                      
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3">
                        <div class="card-body bg--info p-1 pt-2 px-3">
                            <h5 class="text-white">For Swing Traders</h5>
                        </div> 
                        <div class="card-body bg-white border border-dark">
                            <table class="table table-bordered">
                                <thead class="bg--default text-white">
                                    <th class="py-1">Reco Date</th>
                                    <th class="py-1">Stock</th>
                                    <th class="py-1">Buy Range</th>
                                    <th class="py-1">Target</th>
                                    <th class="py-1">Rating</th>
                                    <th class="py-1">View</th>
                                </thead>
                                @foreach($recos as $reco)
                                <!-- To display recos according to category only-->
                                @if($reco->type === 'Swing Trade')
                                <!-- To display recos according to user permission-->
                                @if($reco->user->permission === 1)
                                <tbody>                                  
                                    <td class="py-1">{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                    <td class="py-1">{{$reco->stock}}</td>
                                    <td class="py-1">{{$reco->from}} - {{$reco->to}}</td>  
                                    <td class="py-1">{{$reco->target}}</td>
                                    <td class="py-1">{{$reco->rating}}</td>  
                                    <td class="py-1 text-center"><a href="{{route('admin.reco.show', $reco->id)}}"><i class="fa fa-eye"></i></a></td>                            
                                </tbody>   
                                @endif  
                                @endif                          
                                @endforeach
                            </table>                      
                        </div> 
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3">
                        <div class="card-body bg--primary p-1 pt-2 px-3">
                            <h5 class="text-white">For Position Traders</h5>
                        </div>  
                        <div class="card-body bg-white border border-dark">
                            <table class="table table-bordered">
                                <thead class="bg--default text-white">
                                    <th class="py-1">Reco Date</th>
                                    <th class="py-1">Stock</th>
                                    <th class="py-1">Buy Range</th>
                                    <th class="py-1">Target</th>
                                    <th class="py-1">Rating</th>
                                    <th class="py-1">View</th>
                                </thead>
                                @foreach($recos as $reco)
                                <!-- To display recos according to category only-->
                                @if($reco->type === 'Position Trade')
                                <!-- To display recos according to user permission-->
                                @if($reco->user->permission === 1)
                                <tbody>                                  
                                    <td class="py-1">{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                    <td class="py-1">{{$reco->stock}}</td>
                                    <td class="py-1">{{$reco->from}} - {{$reco->to}}</td>  
                                    <td class="py-1">{{$reco->target}}</td>
                                    <td class="py-1">{{$reco->rating}}</td>  
                                    <td class="py-1 text-center"><a href="{{route('admin.reco.show', $reco->id)}}"><i class="fa fa-eye"></i></a></td>                            
                                </tbody>   
                                @endif  
                                @endif                          
                                @endforeach
                            </table>                      
                        </div> 
                    </div>
                    <div class="col-md-12 col-lg-6 mb-3">
                        <div class="card-body bg--success p-1 pt-2 px-3">
                            <h5 class="text-white">For Long Term Investors</h5>
                        </div> 
                        <div class="card-body bg-white border border-dark">
                            <table class="table table-bordered">
                                <thead class="bg--default text-white">
                                    <th class="py-1">Reco Date</th>
                                    <th class="py-1">Stock</th>
                                    <th class="py-1">Buy Range</th>
                                    <th class="py-1">Target</th>
                                    <th class="py-1">Rating</th>
                                    <th class="py-1">View</th>
                                </thead>
                                @foreach($recos as $reco)
                                <!-- To display recos according to category only-->
                                @if($reco->type === 'Long Term Investment')
                                <!-- To display recos according to user permission-->
                                @if($reco->user->permission === 1)
                                <tbody>                                  
                                    <td class="py-1">{{ date('M j, Y', strtotime($reco->created_at)) }}</td>
                                    <td class="py-1">{{$reco->stock}}</td>
                                    <td class="py-1">{{$reco->from}} - {{$reco->to}}</td>  
                                    <td class="py-1">{{$reco->target}}</td>
                                    <td class="py-1">{{$reco->rating}}</td>  
                                    <td class="py-1 text-center"><a href="{{route('admin.reco.show', $reco->id)}}"><i class="fa fa-eye"></i></a></td>                            
                                </tbody>   
                                @endif  
                                @endif                          
                                @endforeach
                            </table>                      
                        </div>  
                    </div>
                </div>  --}}
            </div>

            <!-- Right Sidebar -->
            @include('admin.includes.sidebar')

        </div>
    </div>
</div>
@endsection


