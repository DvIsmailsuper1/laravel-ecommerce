@extends('admin.layouts.template')

@section('page-title','Edit Sub Category Single Ecom')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Edit Sub Category</h4>

    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit New Sub Category</h5>
            <small class="text-muted float-end">Input Information</small>
          </div>
          <div class="card-body">
            <form action="{{route('updatesubcategory')}}" method="POST">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
                <div class="col-sm-10">
                  <input value="{{$subcategory_info->subcategory_name}}" type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Electronics" />
                  <input value="{{$subcategory_info->id}}" type="hidden" name="id" id="id"   class="form-control"/>
                </div>
              </div>

          
             
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update Sub Category</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Basic with Icons -->
    
    </div>
  </div>
@endsection