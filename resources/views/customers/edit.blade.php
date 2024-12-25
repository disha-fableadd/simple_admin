@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Customer</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Edit Customer</li>
        </ol>
    </nav>
</div>
<div class="container-fluid mt--7">

    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">EDIT CUSTOMERS</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="card bg-secondary shadow border-0 card-margin">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Edit Customer</small>
                                    </div>
                                    <div class="form-container border shadow-lg p-4 rounded">
                                        <form action="{{ route('customers.update', $customer->custid) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <input class="form-control" name="fname" id="fname"
                                                    value="{{ old('fname', $customer->fname) }}"
                                                    placeholder="First Name" type="text">
                                                @error('fname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input class="form-control" name="lname" id="lname"
                                                    value="{{ old('lname', $customer->lname) }}" placeholder="Last Name"
                                                    type="text">
                                                @error('lname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label">Gender</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="male" name="gender" value="male"
                                                        class="custom-control-input" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="female" name="gender" value="female"
                                                        class="custom-control-input" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="female">Female</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="other" name="gender" value="other"
                                                        class="custom-control-input" {{ old('gender', $customer->gender) == 'other' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="other">Other</label>
                                                </div>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input class="form-control" name="contact" id="contact"
                                                    value="{{ old('contact', $customer->contact) }}"
                                                    placeholder="Contact No" type="tel">
                                                @error('contact')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control" id="email" name="email"
                                                    value="{{ old('email', $customer->email) }}" placeholder="Email"
                                                    type="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address"
                                                    placeholder="Address"
                                                    rows="3">{{ old('address', $customer->address) }}</textarea>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select class="form-control" name="city" id="city">
                                                    <option value="">Select City</option>
                                                    <option value="Surat" {{ old('city', $customer->city) == 'Surat' ? 'selected' : '' }}>Surat</option>
                                                    <option value="Mumbai" {{ old('city', $customer->city) == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                    <option value="Udaipur" {{ old('city', $customer->city) == 'Udaipur' ? 'selected' : '' }}>Udaipur</option>
                                                    <option value="Baroda" {{ old('city', $customer->city) == 'Baroda' ? 'selected' : '' }}>Baroda</option>
                                                    <option value="Pune" {{ old('city', $customer->city) == 'Pune' ? 'selected' : '' }}>Pune</option>
                                                </select>
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="">Select State</option>
                                                    <option value="Gujarat" {{ old('state', $customer->state) == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                                    <option value="Maharashtra" {{ old('state', $customer->state) == 'Maharashtra' ? 'selected' : '' }}>
                                                        Maharashtra</option>
                                                    <option value="Rajsthan" {{ old('state', $customer->state) == 'Rajsthan' ? 'selected' : '' }}>Rajsthan
                                                    </option>
                                                </select>
                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4">Update
                                                    Customer</button>
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
    @endsection