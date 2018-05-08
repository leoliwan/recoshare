@extends('layouts.welcome_app')
@section('title', $reco->slug)
@section('content')

<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-9">
            <div class="card pt-2">
                <div class="row"> 
                    <div class="col-md-12 col-lg-6">
                        <img  class="img-thumbnail" src="{{asset('images/'.$reco->image)}}">
                        <div class="row mt-2 pl-1">
                            <div class="col-md-4 pr-0">
                                <!-- Reviews and Votes -->
                                {{--  <button class="btn btn-outline-secondary btn-sm mx-2"><i class="fa fa-comment"></i> Reviews <span class="badge badge-info p-2">{{$reco->comments()->count()}}</span></button>  --}}
                                <button class="btn btn-outline-secondary btn-sm {{$reco->YouLiked()?"liked":""}}" onclick="recolike('{{$reco->id}}',this)"><i class="fa fa-thumbs-up"></i> Like </button>
                                <button class="btn btn-outline-info btn-sm" id="{{$reco->id}}-count">{{$reco->likes()->count()}}</button>  
                            </div>
                            <div class="col-md-8 pl-0">
                                <!-- Start Rating-->
                                <table class="table table-bordered">
                                    <tbody>
                                        <td class="p-1 bg--success text-white" style="width:30%">Rating</td>
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
                    <div class="col-md-12 col-lg-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr class="bg-success text-white">
                                    <td class="py-1">Stock Code</td>
                                    <td class="py-1">{{$reco->stock}}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Buying Range</td>
                                <td class="py-1 badge badge-warning px-3 ml-3 py-2">{{$reco->from}} - {{$reco->to}}</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Stop Loss</td>
                                    <td class="py-1 badge badge-danger px-3 ml-3 py-2">{{$reco->stoploss}}</td>
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
                        <!-- Start Rating-->    
                        @include('admin.includes.messages')                                         
                        <div class="card-body p-1 bg--info mb-3">
                            <p class="mb-1 text-white">Rate this Reco</p>
                            <form action="{{route('addrating', $reco->id)}}" method="post" name="RateForm">
                                {{csrf_field()}}   
                                <div class="mb-1">                                                            
                                    <select class="" style="width:100%; padding:.3em" name="rating">
                                        <option selected>Select Rating</option>
                                        <option value="1">1-2</option>
                                        <option value="2">3-4</option>
                                        <option value="3">5-6</option>
                                        <option value="4">7-8</option>
                                        <option value="5">9-10</option>
                                    </select>
                                </div>
                              
                                    <button class="btn btn-warning btn-block btn-sm" onclick="return RateIsEmpty();" type="submit">Rate</button>
                                
                            </form> 
                        </div>    

                        <!-- Donate-->   
                        @if($reco->user->bank_permission === 0)
                        <!-- If the bank permission is 0, it shows nothing. But if if is 1 is show the donate button-->
                        @else                                          
                        <div class="card-body p-1 bg-light text-center">
                            <h5>Do you like this reco?</h5>
                            <p>Help {{$reco->user->username}} make more recos in the future.</p>   
                            <a href="" data-toggle="modal" data-target="#donate" class="btn btn-info">Donate</a>  

                        <!-- Create Donate Modal -->
                        <div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-white bg--default">
                                    <h5 class="modal-title" id="exampleModalLabel">Buy me a cup of coffee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body  bg-light">
                                        <div class="row">
                                            <div class="col-md-8  mx-auto">
                                                <div class="border border-info bg-white py-3 mb-3">
                                                    <img src="{{asset('images/'.$reco->user->avatar)}}" style="width: 20%;" alt="profile-pic" class="rounded-circle ml-2">
                                                    <h5 class="mt-2">{{$reco->user->name}}</h5>
                                                <p class="mb-0">{{$reco->user->email}}</p>
                                                </div>
                                            </div>                                         
                                        </div>
                                        <p class="bg--secondary p-2 text-white">Support me to do more in sharing stock recos that makes profit. Analysing stock is not an easy task and it takes a lot of effort. If you think you benefit from my recos like making profit in your trading, consider dropping me just enough to buy a coffee. Doing so will help me do more to help you more.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bg--default text-white">
                                                    <div class="py-3"> Donate through bank account</div>
                                                </div>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="py-1">Bank Name</td>
                                                                <td class="py-1">{{$reco->user->donate}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">Bank Account Name</td>
                                                                <td class="py-1">{{$reco->user->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">Bank Account Number</td>
                                                                <td class="py-1">{{$reco->user->bank_account}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg--info text-white">
                                                    <div class="py-3"> Donate through Paypal</div>
                                                </div>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-1">My Paypal</td>
                                                            <td class="py-1"><a href="{{$reco->user->link}}"> {{$reco->user->link}}</a></td>
                                                        </tr>
                                                        <tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--End of Modal-->
                      </div><!--End of Donate-->
                      @endif

                    </div>
                </div>
                <div class="container my-2">
                    <div class="card">
                        <div class="card-header py-2 bg--secondary text-white">
                            Stock Details
                        </div>  
                        <div class="card-body bg-light">
                            {{$reco->details}}
                        </div>
                    </div>   
                    <!--Disclaimer Message -->
                    <div class="py-3">
                        <p>
                            <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Read Our Disclaimer
                            </a>
                        </p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <small><em><strong>
                        Be advised that investments may go up as well as down for any reason, and past performance of a stock is no guarantee of future performance.<br>
                        
                        RecoShare makes no representation as to the timeliness, accuracy or suitability of any content on this website, and cannot be held liable for any irregularity or inaccuracy.<br>
                        
                        Stock recommendations on this website are solely those of recosharers quoted. They do not represent the opinions of RecoShare on whether to buy, sell or hold shares of any particular stock.<br>
                        
                        All investors are advised to conduct their own independent research before making an investment decision. Investors should consider the source and suitability of any investment advice for their needs. Your use of this website, and its content, is at your own risk.<br>
                        
                        Links from this website to third-party websites are in no way an endorsement by RecoShare of their contents or their suitability for any purpose.     
                        </strong></em></small>                    
                    </div>
                    </div>
                    </div>       
                </div>             
            </div>
        </div>
        
         <!-- Right Sidebar -->
         @include('admin.includes.sidebar')
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
function recolike(recoId, elem){
        var csrfToken = '{{csrf_token()}}';
        var likeCount = parseInt($('#'+recoId+"-count").text());
        $.post('{{route('recolike')}}', {recoId:recoId,_token:csrfToken}, function (data){

        if(data.message==='liked'){
            $('#'+recoId+"-count").text(likeCount+1);
            $(elem).text('Liked').css({color:'blue'});
        }else{
            $('#'+recoId+"-count").text(likeCount-1);
            $(elem).text('Unliked').css({color:'red'});
        }
        });
    }


</script>
@endsection