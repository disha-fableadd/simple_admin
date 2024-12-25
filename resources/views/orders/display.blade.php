@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Order</li>
            <li class="breadcrumb-item text-white active" aria-current="page">All Order</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card bg-default  shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 text-white">Order tables</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Product Count</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white" id="orderTableBody">
                        @foreach ($orderItems as $item)
                            <tr>
                                <td>{{ $item->order->customer->fname }} {{ $item->order->customer->lname }}</td> 
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->totalprice }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td> 
                                <td>
                                    <a href="{{ route('orders.show', $item->oid) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View Details</a> 
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endsection