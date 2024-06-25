@extends('layouts.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $customer->name) }}" placeholder="Enter Name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="company">Company <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company" id="company"
                                    value="{{ old('company', $customer->company) }}" placeholder="Enter Company" required>
                                @error('company')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="4" placeholder="Enter Address">{{ old('address', $customer->address) }}</textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ old('phone', $customer->phone) }}" placeholder="Enter Phone" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email', $customer->email) }}" placeholder="Enter Email" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="0" {{ old('status', $customer->status) == '0' ? 'selected' : '' }}>Enabled</option>
                                    <option value="1" {{ old('status', $customer->status) == '1' ? 'selected' : '' }}>Disabled</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
