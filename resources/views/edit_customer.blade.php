@extends('layouts.master')
@section('title','Edit Customer')
@section('body')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('editAction')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cus_id" value="{{$editData->cid}}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$editData->customerName}}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$editData->address}}">
                </div>
                <div class="form-group">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" class="form-control" value="{{$editData->organization}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{$editData->email}}">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{$editData->mobile}}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="btn btn-default" value="">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Update Details</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <img src="{{url('public/lib/images/'.$editData->image)}}" alt="No Image" class="img-responsive thumbnail" style="margin-top: 20px">
        </div>
    </div>
@endsection
