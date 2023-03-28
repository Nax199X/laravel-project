@extends('myLayout.app')

@section('content')

<div class="row ">
    <div class="col-md-6 offset-3">
        <div class="card ">
            <div class="card-header text-center fs-4 bg-dark text-white">
                Customer Edit Data
            </div>
            <div class="card-body fs-4  ">


               <form action="{{ route('customer#update',$customer->customer_id) }}" method="post">

                 @if (Session::has('updateSuccess'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                           {{Session::get('updateSuccess')}}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                @csrf
                 <div class="my-3">
                    <label >Name</label> <input type="text" name="name" class="form-control" value="{{ old('name',$customer->name)}}">
                     @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name')}}</small>

                                @endif
                </div>

                <div class="my-3">
                    <label >Email</label> <input type="email" name="email" class="form-control" value="{{ old('email',$customer->email)}}">
                    @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email')}}</small>

                                @endif
                </div>

                <div class="my-3">
                    <label >Address</label>  <textarea name="address"  cols="30" rows="2" class="form-control">{{ old('address',$customer->address)}}</textarea>
                    @if ($errors->has('address'))
                                <small class="text-danger">{{ $errors->first('address')}}</small>

                                @endif

                </div>

                <div class="my-3">
                    <label >Phone</label>  <input type="phone" name="phoneNumber" class="form-control" value="{{ old('phoneNumber',$customer->phone)}}">
                    @if ($errors->has('phoneNumber'))
                                <small class="text-danger">{{ $errors->first('phoneNumber')}}</small>

                                @endif
                </div>

                <div class="my-3">
                    <label >Gender</label>
                                <select name="gender"  class="form-control" {{ old('gender',$customer->gender)}}>
                                    @if ($customer->gender == 1)
                                            <option value="">Choose Option</option>
                                            <option value="1" selected>Male</option>
                                            <option value="2">female</option>
                                            <option value="0">Other</option>

                                    @elseif ($customer->gender == 2)
                                            <option value="">Choose Option</option>
                                            <option value="1">Male</option>
                                            <option value="2" selected>female</option>
                                            <option value="0">Other</option>

                                    @elseif ($customer->gender ==3)
                                            <option value="">Choose Option</option>
                                            <option value="1">Male</option>
                                            <option value="2">female</option>
                                            <option value="0" selected>Other</option>
                                    @else
                                            <option value="" selected>Choose Option</option>
                                            <option value="1">Male</option>
                                            <option value="2">female</option>
                                            <option value="0">Other</option>
                                    @endif
                                </select>
                                @if ($errors->has('gender'))
                                <small class="text-danger">{{ $errors->first('gender')}}</small>

                                @endif
                </div>

                <div class="my-3 ">
                    <label >DOB</label> <input type="date" name="dateOfBirth" class="form-control" value="{{ old('dateOfBirth',$customer->date_of_birth)}}">
                    @if ($errors->has('dateOfBirth'))
                                <small class="text-danger">{{ $errors->first('dateOfBirth')}}</small>

                                @endif
                </div>

                 <div class="my-3 float-end">
                    <input type="submit" value="update" class="btn btn-dark text-white">
                </div>
               </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('customer#list')}}"><button class="btn btn-sm text-white bg-dark">Back</button></a>


            </div>
        </div>

    </div>
</div>

@endsection


