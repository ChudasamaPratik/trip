@extends('backend.layout.main')
@section('title', 'User Profile')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>User Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">Manage Users</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                User Profile
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <img src="{{ $user->image_url }}" alt="{{ $user->first_name }} {{ $user->last_name }}" class="avatar-photo">
                    </div>
                    <h5 class="text-center h5 mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <p class="text-center text-muted font-14">{{ $user->roles->pluck('name')->implode(', ') }}</p>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li>
                                <span>Email Address:</span>
                                {{ $user->email }}
                            </li>
                            <li>
                                <span>Phone Number:</span>
                                {{ $user->phone ?? 'N/A' }}
                            </li>
                           
                            <li>
                                <span>Member Since:</span>
                                {{ $user->created_at->format('d M Y') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab">
                        <div class="pd-20">
                            <div class="profile-details">
                                <!-- Basic user information -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5 class="text-primary">First Name</h5>
                                        <p>{{ $user->first_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5 class="text-primary">Last Name</h5>
                                        <p>{{ $user->last_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5 class="text-primary">Email</h5>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5 class="text-primary">Status</h5>
                                        <p><span class="badge badge-pill {{ $user->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span></p>
                                    </div>
                                </div>

                                <!-- User Details section if available -->
                                @if($user->userDetails)
                                <div class="mt-4">
                                    <h4 class="text-blue pb-2 border-bottom">Additional Details</h4>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Phone</h5>
                                            <p>{{ $user->userDetails->phone ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Address</h5>
                                            <p>{{ $user->userDetails->address ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">City</h5>
                                            <p>{{ $user->userDetails->city ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">State</h5>
                                            <p>{{ $user->userDetails->state ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Country</h5>
                                            <p>{{ $user->userDetails->country ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Zip Code</h5>
                                            <p>{{ $user->userDetails->zipcode ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5 class="text-primary">Description</h5>
                                            <p>{{ $user->userDetails->description ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Agent Details section if available -->
                                @if($user->agentDetails)
                                <div class="mt-4">
                                    <h4 class="text-blue pb-2 border-bottom">Additional Details</h4>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Agency Name</h5>
                                            <p>{{ $user->agentDetails->agency_name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Phone</h5>
                                            <p>{{ $user->agentDetails->phone ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Address</h5>
                                            <p>{{ $user->agentDetails->address ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">City</h5>
                                            <p>{{ $user->agentDetails->city ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">State</h5>
                                            <p>{{ $user->agentDetails->state ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Country</h5>
                                            <p>{{ $user->agentDetails->country ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h5 class="text-primary">Zip Code</h5>
                                            <p>{{ $user->agentDetails->zipcode ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5 class="text-primary">Description</h5>
                                            <p>{{ $user->agentDetails->description ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Custom JavaScript for the profile page if needed
    });
</script>
@endpush