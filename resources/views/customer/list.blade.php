@extends('myLayout.app')

@section('content')

        <div class="row">
            <div class="col-md-10 offset-1">

                 @if (Session::has('deleteSuccess'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                 {{Session::get('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                        </div>
                @endif

                 @if (Session::has('updateSuccess'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                           {{Session::get('updateSuccess')}}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                <table class="table table-hover text-center">
                    <thead class="bg-primary text-white">
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($customer as $item )
                            <tr>
                                <td>{{ $item ->customer_id}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->email}}</td>
                                <td>{{ $item->phone}}</td>
                                <td>

                                 <a href="{{ route('customer#edit',$item->customer_id)}}"> <button class="btn btn-sm bg-dark text-white">Edit</button></a>
                                 <a href="{{ route('customer#delete',$item->customer_id)}}"> <button class="btn btn-sm btn-danger">Delete</button></a>
                                 <a href="{{ route('customer#seeMore',$item->customer_id)}}"> <button class="btn btn-sm btn-secondary">See More...</button></a>
                                     {{-- {{url('customer/seeMore/'.$item->customer_id)}} --}}

                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-5">
                    {{$customer->links()}}
                </div>

                <a href="{{ route('customer#register')}}"><button class="btn btn-primary btn-sm float-end">Back</button></a>
            </div>
        </div>

@endsection


