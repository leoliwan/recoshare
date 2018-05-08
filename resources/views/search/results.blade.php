@extends('layouts.app')
@section('title', 'Search Result')
@section('content')
<div class="container">
        @include('admin.includes.messages')
        
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card card-default bg--secondary text-white">
                @foreach($recos as $reco)
                <div class="card-header">Seach Results for {{$reco->stock}}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- RECOS -->
<div class="py-5" id="recos">
    <div class="container">           
        <div class="card-body bg-white p-1 pt-2 px-3 mb-3">
            <h5>Stock Recommendations</h5>
        </div>
              
            <div class="row">
                @foreach($recos as $reco)
                @if(Auth::user()->permission === 1)
                {{-- @if($reco->user->permission === 1) --}}
                  
                <div class="col-lg-4 mb-4">
                    <div class="card p-1">
                        <div class="mt-2">
                            @if(auth()->id() === $reco->user_id)
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                    <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                </div>
                                <div class="col-sm-10 col-md-10 pl-0">
                                    <p class="bg-secondary text-white mb-1 p-2">Your Stock Reco</p>
                                </div>
                            </div>                          
                            @else
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                    <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 100%;" alt="profile-pic" class="rounded-circle ml-2">
                                </div>
                                <div class="col-sm-10 col-md-10">
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
                        <a href="{{route('showreco', $reco->slug)}}" data-toggle="modal" data-target="#{{$reco->id}}"><img class="card-img-top" style="height: 130px" src="{{asset('images/'.$reco->image)}}" alt="Card image cap"></a>
                        <div class="card-body px-0 pb-0">
                           
                            <a href="{{route('showreco', $reco->slug)}}" class="btn btn-success btn-block btn-sm btn-block">View</a>
                               
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

                                             <div class="col-md-6">
                                                @if(auth()->id() === $reco->user_id)
                                                <a href="" class="btn btn-outline-info btn-block btn-sm">Edit</a>
                                                @endif
                                             </div>
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

                                </ul>
                            </div>    
                        </div>              
                    </div>
                </div>      
            </div>
            @else 

            <div class="container">
                <div class="row mx-auto">
                    <div class="alert alert-danger" role="alert">
                        Your Application is Pending Approval! Please Come Back Later.
                    </div>
                </div>
            </div>
            @endif
        
         
            @endforeach
        </div>          
    </div>
</div>

@endsection



@section('js')
<!-- AJAX for LIKE-->
<script type="text/javascript">
    function recolike(recoId, elem){
        var csrfToken = '{{csrf_token()}}';
        var likeCount = parseInt($('#'+recoId+"-count").text());
        $.post('{{route('recolike')}}', {recoId:recoId,_token:csrfToken}, function (data){

        if(data.message==='liked'){
            $('#'+recoId+"-count").text(likeCount+1);
            $(elem).text('Like').css({color:'blue'});
        }else{
            $('#'+recoId+"-count").text(likeCount-1);
            $(elem).text('Unlike').css({color:'red'});
        }
        });
    }
</script>


@endsection
