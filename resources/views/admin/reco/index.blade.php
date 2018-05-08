@extends('layouts.app')

@section('content')
<div class="container">
        @include('admin.includes.messages')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                 <a href="" class="btn btn--primary btn-block" data-toggle="modal" data-target="#inputReco"><i class="fas fa-chart-line"></i>  New Stock Reco</a> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inputReco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Stock Reco</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('reco.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

        <div class="form-group">
            <label for="category_id">Category :</label>
                <select name="category_id" class="form-control">
                    <option value="" class="disabled selected">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
        </div>
          <div class="form-group">
            <label><strong>Stock Code</strong></label>
            <input class="form-control" name="stock" placeholder="Enter Stock Code Here">
          </div>
          <hr>
          <h5>Buying Range</h5>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>From</label>
                    <input type="number" name="from" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>To</label>
                    <input type="number" name="to" class="form-control">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stoploss Price</label>
                    <input type="number" name="stoploss" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label>Target Price</label>
                        <input type="number" name="target" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Risk</label>
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
                <input style="width: 30%;" type="date" name="expire" class="form-control">
            </div>
            <div class="form-group">
                <label>Details</label>
                <textarea name="details" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Upload Stock Chart</label>
                <input type="file" name="image" class="form-control"></textarea>
            </div>
            <hr>
            <div class="float-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>    
    </div>
</div>
</div><!--End Of Modal-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th style="width:10%">Stock Code</th>
                    <th style="width:20%">Reco By</th>
                    <th style="width:10%">Chart</th>
                    <th style="width:20%">Category</th>
                    <th style="width:10%">Buying Range</th>
                    <th style="width:10%">Target Price</th>
                    <th style="width:15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recos as $reco)
                    <tr>
                    <td>{{$reco->stock}}</td>
                    <td>{{$reco->user->name}}</td>
                    <td><img class="img-responsive"  src="{{asset('images/'.$reco->image)}}" style="height: 50px" alt="reco-chart"></td>
                    <td>{{$reco->type}}</td>
                    <td>{{$reco->from}} - {{$reco->to}}</td>
                    <td>{{$reco->target}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('reco.edit', $reco->id) }}" class="btn btn-outline-info btn-block btn-sm">Edit</a>
                            </div>
                            <div class="col-sm-6">  
                                <button type="submit" data-toggle="modal" data-target="#delete" class="btn btn-outline-danger btn-block btn-sm">Delete</button>                               
                            </div>
                        </div> 
                        
                        <!-- Delete Modal-->
                        <div id="delete" class="modal fade modal-danger" role="dialog">
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
                                        <form action="{{route('reco.destroy', $reco->id) }}" method="post">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection