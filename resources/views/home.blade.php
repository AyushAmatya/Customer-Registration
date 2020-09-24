@extends('layouts.master')
@section('title','Home')
@section('body')
    @if(session('success'))
        <div class="row">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('name')}}</a>
                    </div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('address')}}</a>
                    </div>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">
                </div>
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('organization')}}</a>
                    </div>
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" class="form-control" value="{{old('organization')}}">
                </div>
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('email')}}</a>
                    </div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('mobile')}}</a>
                    </div>
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}">
                </div>
                <div class="form-group">
                    <div>
                        <a href="" style="...">{{$errors->first('image')}}</a>
                    </div>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" value="">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <table class="table table-hover">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Organization</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                @foreach($customerData as $key=>$customerDataLine)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$customerDataLine->customerName}}</td>
                        <td>{{$customerDataLine->address}}</td>
                        <td>{{$customerDataLine->organization}}</td>
                        <td>{{$customerDataLine->email}}</td>
                        <td>{{$customerDataLine->mobile}}</td>
                        <td>
                            <img src="{{url('public/lib/images/'.$customerDataLine->image)}}" height="30" width="30" alt="">
                        </td>
                        <td>
                            <a href="{{route('edit').'/'.$customerDataLine->cid}}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="{{route('delete').'/'.$customerDataLine->cid}}" class="btn btn-danger btn-xs">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$customerData->links()}}
        </div>
    </div>
@endsection
