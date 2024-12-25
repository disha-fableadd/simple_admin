@extends('layouts.app')

@section('content')
<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="min-height: 100px; background-image: url({{ asset('assets/img/theme/profile-cover.jpg') }}); background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-8"></span>
    <div class="header pb-8 pt-5 pt-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0 mini-nav">
                <li class="breadcrumb-item text-white">Profile</li>
                <li class="breadcrumb-item text-white active" aria-current="page">Edit Profile</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')  <!-- This makes the form a PUT request -->
                    <h6 class="heading-small text-muted mb-4">User Information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" id="input-name" name="name"
                                        class="form-control form-control-alternative"
                                        value="{{ old('name', $userInfo->name) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email address</label>
                                    <input type="email" id="input-email" name="email"
                                        class="form-control form-control-alternative"
                                        value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-contact">Contact</label>
                                    <input type="text" id="input-contact" name="contact"
                                        class="form-control form-control-alternative"
                                        value="{{ old('contact', $userInfo->contact) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-gender">Gender</label>
                                    <select id="input-gender" name="gender" class="form-control form-control-alternative">
                                        <option value="male" {{ $userInfo->gender === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $userInfo->gender === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $userInfo->gender === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-dob">Date of Birth</label>
                                    <input type="date" id="input-dob" name="dob"
                                        class="form-control form-control-alternative"
                                        value="{{ old('dob', $userInfo->dob) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">Profile Image</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-profileimage">Profile Image</label>
                                    @if ($userInfo->image)
                                        <img src="{{ asset('storage/' . $userInfo->image) }}" alt="Profile Image" class="img-fluid mb-3 rounded" style="max-height: 150px; width: 150px;">
                                    @else
                                        <img src="{{ asset('storage/placeholder.png') }}" alt="No Profile Image" class="img-fluid mb-3" style="max-height: 150px; width:150px;">
                                    @endif
                                    <input type="file" class="form-control form-control-alternative" name="image" id="input-profileimage">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

@endsection
