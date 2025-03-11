@extends('layouts.user_layout')

@section('content')
<div class="container">
    <h2>Uploaded Prescriptions</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Prescription Images</th>
                <th>Note</th>
                <th>Delivery Address</th>
                <th>Delivery Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->user->name }}</td>
                <td>
                    @foreach(json_decode($prescription->images) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription Image" width="100">
                    @endforeach
                </td>
                <td>{{ $prescription->note }}</td>
                <td>{{ $prescription->delivery_address }}</td>
                <td>{{ $prescription->delivery_time }}</td>
                <td>{{ $prescription->quotation->status ?? '' }}</td>
                <td>
                    <a href="{{ route('pharmacy.quotation.create', $prescription->id) }}" class="btn btn-primary">Prepare Quotation</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
