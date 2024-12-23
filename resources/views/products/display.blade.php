@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Product</li>
            <li class="breadcrumb-item text-white active" aria-current="page">All Product</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 text-white">All Products</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Images</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-white text-center">
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->pid }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if ($product->img)
                                            <img src="{{ asset('storage/' . $product->img) }}" alt="Profile Image" width="100"
                                                height="100">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('products.edit', $product->pid) }}"
                                            class="btn btn-success">Edit</a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('products.destroy', $product->pid) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
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