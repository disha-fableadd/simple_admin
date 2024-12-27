@extends('layouts.app')

@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Order</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Completed Order</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 text-white">Completed Orders</h3>
                </div>
                <div class="table-responsive">


                    <table class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @forelse ($completedOrders as $order)
                            <tr>
                                <td>{{ $order->oid }}</td>
                                <td>{{ $order->customer->fname }} {{ $order->customer->lname }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <span class="btn btn-success">Completed</span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->oid) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <p class="text-center text-white">No completed orders found.</p>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @endsection