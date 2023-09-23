@extends('admin.layouts.template')

@section('page-title','All Category Single Ecom')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All Category</h4>

    <div class="row">
<div class="card">
    <h5 class="card-header">Available Category Information</h5>
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
            <th>Category Name</th>
            <th>Sub Category</th>
            <th>Slug</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($data as $category)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->subcategory_count}}</td>
            <td>{{$category->slug}}</td>
            <td>
              <div class="btn-group">
             <a href="{{route('editcategory',$category->id)}}" class="btn btn-primary">Edit</a>
            
             <form action="{{route('deletecategory',$category->id)}}" method="POST">
              @method('DELETE')
              @csrf
              <button href="{{route('deletecategory',$category->id)}}"   type="submit" class="btn btn-danger">
                Delete
              </button>
            </form>
          </div></td>
           </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
@endsection