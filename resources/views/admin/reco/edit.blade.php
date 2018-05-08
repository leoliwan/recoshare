@extends('layouts.app')

@section('content')

<div class="container">
        @include('admin.includes.messages')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <a href="{{ url('/admin/reco') }}" class="btn btn-outline-primary mb-3"><i class="fa fa-home"></i> HOME</a>
            <div class="card">
                <div class="card-header">
                <h5 class="card-title" id="exampleModalLabel">Edit Stock Reco: {{$reco->stock}}</h5>
                </div>
                <div class="card-body">
                        <form action="{{ route('reco.update', $reco->id) }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}

                            <div class="form-group">
                                <label for="category_id">Category :</label>
                                    <select name="category_id" class="form-control">
                                        <option value="" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}"<?php if($reco->category_id == $category->id){echo "selected";}?>>{{$category->name}}</option>
                                            @endforeach
                                    </select>
                            </div>
                          <div class="form-group">
                            <label><strong>Stock Code</strong></label>
                          <input class="form-control" name="stock" value="{{$reco->stock}}">
                          </div>
                          <hr>
                          <h5>Buying Range</h5>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From</label>
                                    <input type="number" name="from" class="form-control" value="{{$reco->from}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To</label>
                                    <input type="number" name="to" class="form-control" value="{{$reco->to}}">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stoploss Price</label>
                                    <input type="number" name="stoploss" class="form-control" value="{{$reco->stoploss}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Target Price</label>
                                        <input type="number" name="target" class="form-control" value="{{$reco->target}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Risk</label>
                                        <select type="text" name="risk" class="form-control" value="{{$reco->risk}}">
                                            <option>Low Risk</option>
                                            <option>Medium Risk</option>
                                            <option>High Risk</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Investment Type</label>
                                            <select type="text" name="type" class="form-control" value="{{$reco->type}}">
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
                                <input style="width: 30%;" type="date" name="expire" class="form-control" value="{{$reco->expire}}">
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                            <textarea name="details" class="form-control">{{$reco->details}}</textarea>
                            </div>
            
                            <div class="form-group">
                                <label>Upload Stock Chart</label>
                                <input type="file" name="image" class="form-control"></textarea>
                            </div>
                            <div class="from-group">
                                <img class="img-responsive" style="width:40%" src="{{asset('images/'.$reco->image)}}">
                            </div>
                            <hr>
                            <div class="float-right">
                            <a href="{{ url('/admin/reco') }}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    <div>
</div>

@endsection