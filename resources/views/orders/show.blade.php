
@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 mini-nav">
      <li class="breadcrumb-item text-white">Order</li>
      <li class="breadcrumb-item text-white active" aria-current="page">Order Items Details</li>
    </ol>
  </nav>
</div>

<!-- Main Content -->
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
        <h3 class="mb-0 text-white">Order Details</h3>
        <p class="text-white mt-4"> Order Date: {{ $order->created_at }}</p>
        <p class="text-white">Customer: {{ $order->customer->fname }} {{ $order->customer->lname }}</p>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
           
                @foreach ($order->orderItems as $item)
               
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" width="100" height="100"></td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            <button class="decreaseQtyBtn" data-order-id="{{ $order->oid }}" data-item-id="{{ $item->oitemid }}" data-current-qty="{{ $item->qty }}">-</button>
                            <span id="qty-{{ $item->oitemid }}">{{ $item->qty }}</span>
                            <button class="increaseQtyBtn" data-order-id="{{ $order->oid }}" data-item-id="{{ $item->oitemid }}" data-current-qty="{{ $item->qty }}">+</button>
                        </td>
                        <td>${{ number_format($item->totalprice, 2) }}</td>
                        <td>
                            <button class="btn btn-danger deleteItemBtn" data-order-id="{{ $order->oid }}" data-item-id="{{ $item->oitemid }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>

        <!-- Footer Section with Total Price -->
        <div class="card-footer bg-transparent">
          <div class="d-flex justify-content-between">
            <span class="text-white ml-auto">Total Price:  ${{ number_format($order->orderItems->sum('totalprice'), 2) }}</span>
          </div>

          <!-- Only show the 'Complete Order' button if the order is not completed -->
         
            @if ($order->orderstatus != 'completed')
            <button id="completeOrderBtn" class="btn btn-success">Complete Order</button>
            <a href="{{ route('orders.display') }}" class="btn btn-primary mt-2">Back to All Orders</a>
        @endif
          
        
        </div>
        <div id="message" class="alert" style="display: none;"></div>
      </div>
    </div>
  </div>

  @endsection

