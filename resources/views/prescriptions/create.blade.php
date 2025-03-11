@extends('layouts.user_layout')

@section('content')
<div class="container">
    <h2>Upload Prescription</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="note">Prescription Note</label>
            <textarea name="note" id="note" class="form-control" rows="4" required>{{ old('note') }}</textarea>
        </div>

        <div class="form-group">
            <label for="delivery_address">Delivery Address</label>
            <input type="text" name="delivery_address" id="delivery_address" class="form-control" value="{{ old('delivery_address') }}" required>
        </div>

        <div class="form-group">
            <label for="delivery_time">Delivery Time (2-hour slots)</label>
            <select name="delivery_time" id="delivery_time" class="form-control" required>
                <option value="8-10 AM">8-10 AM</option>
                <option value="10-12 AM">10-12 AM</option>
                <option value="12-2 PM">12-2 PM</option>
                <option value="2-4 PM">2-4 PM</option>
                <option value="4-6 PM">4-6 PM</option>
            </select>
        </div>

        <div class="form-group">
            <label for="images">Prescription Images (max 5)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple required accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Submit Prescription</button>
    </form>
</div>
@endsection
