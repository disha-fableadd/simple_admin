@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Product</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Edit Product</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow ">
                <div class="card-header border-0">
                    <h3 class="mb-0">EDIT PRODUCT</h3>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Edit Products</small>
                                    </div>
                                    <div class="form-container border shadow-lg p-4 rounded">
                                        <form method="POST" action="{{ route('products.update', $product->pid) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
                                                @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->cid }}" {{ $category->cid == $product->cid ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="stock">Stock Quantity</label>
                                                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                                                @error('stock')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="img">Product Image</label>
                                                <input type="file" name="img" id="img" class="form-control">
                                                @if ($product->img)
                                                <img src="{{ asset('storage/' . $product->img) }}" alt="Product Image" class="img-thumbnail mt-2" width="100">
                                                @endif
                                                @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-4">Save Product</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
