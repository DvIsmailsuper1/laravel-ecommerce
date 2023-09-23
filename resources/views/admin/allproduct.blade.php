@extends('admin.layouts.template')

@section('page-title','All Product Single Ecom')


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All Product Category</h4>

    <div class="row">
<div class="card">
    <h5 class="card-header">Available All Product Information</h5>
    <div class="table-responsive text-nowrap">
      @if (session()->has('message'))
      <div class="alert alert-success">
          {{session()->get('message')}}
      </div>
    @endif
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Img</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
        @foreach ( $products as $product )
        <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$product->product_name}}</td>
        <td><img style="height: 100px" src="{{asset($product->product_img)}}" alt="">

          <br><br>
        
          <a href="{{route('editproimage',$product->id)}}" class="btn btn-primary">Update Image</a>
        </td>
        <td>{{$product->price}}</td>
        <td>
         <div class="btn-group">
          <a href="{{route('editproduct',$product->id)}}" class="btn btn-primary">Edit</a>
          <form action="{{route('deleteproduct',$product->id)}}" method="POST">
            @csrf
           @method('DELETE')
           <button href="{{route('deleteproduct',$product->id)}}" type="submit" class="btn btn-danger">Delete</button>
          </form>
         </td>
         </div>
      </tr>
        @endforeach
         
        </tbody>
      </table>
    </div>
  </div>
@endsection