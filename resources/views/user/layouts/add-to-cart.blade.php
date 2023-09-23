@extends('user.layouts.usertemplate')
@section('main-content')
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
  <div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Prouct Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @php
                    $total=0;
                    @endphp
                    @foreach ($cart_items as $item)
                        <tr>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                <form action="{{route('removeitemcart',$item->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button href="{{route('removeitemcart',$item->id)}}"   type="submit" class="btn btn-warning">
                                      Remove
                                    </button>
                                  </form>
                            </td>
                            
                        </tr>
                        @php
                        $total += $item->price;
                        @endphp

                    @endforeach
                   
                     
                        @if ($total > 0)
                         <tr>
                            <td></td>
                            <td class="fw-bold">Total</td>
                            <td>{{$total}}</td>
                            <td><a href="{{route('shippingaddress')}}" class="btn btn-primary">Checkout Now</a></td>      
                        </tr>                      
                        @endif
                    
                </table>
            </div>
        </div>
    </div>
  </div>
@endsection