@extends('layouts.app')

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0 mini-nav">
                <li class="breadcrumb-item text-white">Customer</li>
                <li class="breadcrumb-item text-white active" aria-current="page">All Customers</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 text-white">Customer Tables</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                            
                                <th scope="col">Name</th>
                                <th scope="col">Lname</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">State</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="customerTable" class="text-white text-center">
                            @forelse($customers as $customer)
                            <tr>
                               
                                <td>{{ $customer->fname }} </td>
                                <td>{{ $customer->lname }}</td>
                                <td>{{ ucfirst($customer->gender) }}</td>
                                <td>{{ $customer->contact }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->state }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->custid) }}" class="btn btn-success ">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->custid) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No products available.</td>
                                </tr>
                            @endforelse
                           
                           
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>

@endsection
