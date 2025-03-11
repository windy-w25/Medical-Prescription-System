@extends('layouts.user_layout')

@section('content')

@section('content')
<div class="container">
    <h2>Quotation Details</h2>
    @if(!empty($quotation->drug_details))
    <div class="row">
        <div class="col-md-6">
            <h4>Prescription</h4>
            @php
            $images = !empty($quotation) ? json_decode($quotation->prescription->images) : ''; 
            $imagePath = !empty( $images ) ?  $images[0] : ''; 
            @endphp
                <img src="{{ asset('storage/' . $imagePath) }}" alt="Prescription Image" width="100">
        </div>
        </div>
 
        <div class="col-md-6">
            <h4>Quotation</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Drug</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($quotation->drug_details, true) as $drug)
                        <tr>
                            <td>{{ $drug['drug'] }}</td>
                            <td>{{ $drug['quantity'] }}</td>
                            <td>${{ $drug['amount'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total Price: ${{ $quotation->total_amount }}</h4>
            @if ($quotation->status === 'pending')
            <form action="{{ route('user.quotations.update', $quotation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button name="status" value="accepted" class="btn btn-success">Accept</button>
                <button name="status" value="rejected" class="btn btn-danger">Reject</button>
            </form>
            @else
                <p><b> Quotation : {{ ucfirst($quotation->status) }}</b></p>
            @endif
        </div>
   
    </div>
    @else
    <p>No records found</p>
    @endif
</div>
@endsection









