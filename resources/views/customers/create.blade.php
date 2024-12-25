@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Customer</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Add Customer</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">

    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">ADD CUSTOMERS</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="card bg-secondary shadow border-0 card-margin">

                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Add Customer</small>
                                    </div>
                                    <div class="form-container border shadow-lg p-4 rounded">
                                        <form action="{{ route('customers.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname"
                                                    value="{{ old('fname') }}">
                                                @error('fname') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname"
                                                    value="{{ old('lname') }}">
                                                @error('lname') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select name="gender" class="form-control" id="gender">
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('gender') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="text" class="form-control" id="contact" name="contact"
                                                    value="{{ old('contact') }}">
                                                @error('contact') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email') }}">
                                                @error('email') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address"
                                                    name="address">{{ old('address') }}</textarea>
                                                @error('address') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select class="form-control" name="city" id="city">
                                                    <option value="Surat" {{ old('city') == 'Surat' ? 'selected' : '' }}>
                                                        Surat</option>
                                                    <option value="Mumbai" {{ old('city') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                    <option value="Udaipur" {{ old('city') == 'Udaipur' ? 'selected' : '' }}>Udaipur</option>
                                                    <option value="Baroda" {{ old('city') == 'Baroda' ? 'selected' : '' }}>Baroda</option>
                                                    <option value="Pune" {{ old('city') == 'Pune' ? 'selected' : '' }}>
                                                        Pune</option>
                                                </select>
                                                @error('city') <span style="color: red;">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="Gujrat" {{ old('state') == 'Gujrat' ? 'selected' : '' }}>Gujrat</option>
                                                    <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                                    <option value="Rajsthan" {{ old('state') == 'Rajsthan' ? 'selected' : '' }}>Rajsthan</option>
                                                </select>
                                                @error('state') <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">Add Customer</button>
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
    @endsection
