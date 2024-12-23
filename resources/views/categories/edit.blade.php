@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Category</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
</div>

<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">EDIT CATEGORIES</h3>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Edit Category</small>
                                    </div>

                                    <div class="form-container border shadow-lg p-4 rounded">
                                        <!-- Edit Category Form -->
                                        <form action="{{ route('categories.update', $category->cid) }}" method="POST">
                                            @csrf
                                            @method('PUT') 

                                            <!-- Category Name -->
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                                    </div>
                                                    <input class="form-control" id="categoryName" name="name"
                                                        value="{{ old('name', $category->name) }}" placeholder="Category Name" type="text">
                                                </div>
                                                @error('name')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Category Description -->
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-regular fa-clipboard"></i></span>
                                                    </div>
                                                    <textarea class="form-control" id="categoryDescription" name="description" placeholder="Category Description" rows="3">{{ old('description', $category->description) }}</textarea>
                                                </div>
                                                @error('description')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4">Save Category</button>
                                            </div>
                                        </form>

                                        <!-- Success/Error Messages -->
                                        @if(session('success'))
                                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                        @endif
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
