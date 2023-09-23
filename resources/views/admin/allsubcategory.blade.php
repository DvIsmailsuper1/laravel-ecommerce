@extends('admin.layouts.template')

@section('page-title','All Sub Category Single Ecom')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All Sub Category</h4>

    <div class="row">
<div class="card">
    <h5 class="card-header">Available Sub Category Information</h5>
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
            <th>Sub Category Name</th>
            <th>Category</th>
            <th>Product</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
            @foreach ($data as $subcategory )
            <tr>
           <td>{{$loop->index+1}}</td>
           <td>{{$subcategory->subcategory_name}}</td>
           <td>{{$subcategory->category_name}}</td>
           <td>{{$subcategory->product_count}}</td>
           <td>
           <div class="btn-group">
            <a href="{{route('editsubcat',$subcategory->id)}}" class="btn btn-primary">Edit</a>
            
            <form action="{{route('deletesubcategory',$subcategory->id)}}" method="POST">
              @method('DELETE')
              @csrf
              <button href="{{route('deletesubcategory',$subcategory->id)}}"   type="submit" class="btn btn-danger">
                Delete
              </button>
            </form>
           </div>
           </td>
          </tr>
           @endforeach
        
        </tbody>
      </table>
    </div>
  </div>
@endsection