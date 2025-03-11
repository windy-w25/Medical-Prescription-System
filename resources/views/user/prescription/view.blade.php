@extends('layouts.user_layout')

@section('content')
<div class="container">
    <h2>Prescriptions</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prescription Images</th>
                <th>Note</th>
                <th>Delivery Address</th>
                <th>Delivery Time</th>
                <th>Quotation Status</th>
                <th>View Quotation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
            @php
                $images = json_decode($prescription->images, true);
            @endphp
            <tr>
                <td>{{ $prescription->id }}</td>
                <td style="width: 20%;">
                @if(!empty($images))
                    @foreach($images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription" width="200" style="width: 20%;">
                    @endforeach
                @endif
                </td>
                <td>{{ $prescription->note }}</td>
                <td>{{ $prescription->delivery_address }}</td>
                <td>{{ $prescription->delivery_time }}</td>
                <td>{{ !empty($prescription->quotation)? ucfirst($prescription->quotation->status) : 'Pending' }}</td>
  
                <td>
                    <a href="{{ route('user.quotations.index', $prescription->id) }}" class="btn btn-primary">View Quotation</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
