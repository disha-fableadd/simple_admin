@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Product</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Add Product</li>
        </ol>
    </nav>
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow ">
                <div class="card-header border-0">
                    <h3 class="mb-0">ADD PRODUCT</h3>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Add Products</small>
                                    </div>
                                    <div class="form-container border shadow-lg p-4 rounded">
                                        <form method="POST" action="{{ route('products.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-solid fa-tag"></i></span>
                                                    </div>
                                                    <input class="form-control" name="name" id="pname"
                                                        placeholder="Product Name" type="text"
                                                        >
                                                </div>
                                                @error('pname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-regular fa-clipboard"></i></span>
                                                    </div>
                                                    <textarea name="description" id="pdes" class="form-control"
                                                        placeholder="Description" rows="3"></textarea>
                                                </div>
                                                @error('pdes')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-brands fa-bitcoin"></i></span>
                                                    </div>
                                                    <input name="price" id="price" class="form-control"
                                                        placeholder="Price" type="number" step="0.01"
                                                       >
                                                </div>
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-solid fa-sitemap"></i></span>
                                                    </div>
                                                    <select class="form-control" name="category" id="category">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->cid }}" >
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-regular fa-image"></i></span>
                                                    </div>
                                                    <input class="form-control" id="image" name="img"
                                                        placeholder="Upload Images" type="file" multiple>
                                                </div>
                                                @error('images')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa-solid fa-cubes-stacked"></i></span>
                                                    </div>
                                                    <input class="form-control" id="stock" name="stock"
                                                        placeholder="Stock Quantity" type="number"
                                                        value="{{ old('stock') }}">
                                                </div>
                                                @error('stock')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4">Add Product</button>
                                            </div>
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