@extends('layouts.user_layout')


@section('content')
<div class="container">
    <h2>Prepare Quotation</h2>

    <!-- Prescription Image and Thumbnails -->
    <div class="row">
        <div class="col-md-3">
            @php
            $images = json_decode($prescription->images); 
            $imagePath = $images[0]; 
            @endphp
            <img src="{{ asset('storage/' . $imagePath) }}" alt="Prescription Image" class="img-fluid">
            <div class="d-flex mt-2">
                    @foreach(json_decode($prescription->images) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription Image"  class="img-thumbnail mx-1" style="width: 60px;">
                    @endforeach
            </div>
        </div>

        <!-- Quotation Details -->
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th>Drug</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="quotationTable">
                    <!-- Items will be added dynamically -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Total</strong></td>
                        <td id="totalAmount">0.00</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Drug Input Form -->
            <form id="addDrugForm" >
                <div class="form-group">
                    <label>Drug</label>
                    <input type="text" class="form-control" id="drugName" required>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" id="drugQuantity" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="addDrug()">Add</button>
            </form>

            <!-- Send Quotation -->
            <form action="{{ route('pharmacy.quotation.store', $prescription->id) }}" method="POST">
                @csrf
                <input type="hidden" name="drug_details" id="drugDetailsInput">
                <input type="hidden" name="total_amount" id="totalAmountInput">
                <button type="submit" class="btn btn-success mt-3">Send Quotation</button>
            </form>
        </div>
    </div>
</div>

<script>
    let drugs = [];

    function addDrug() {
        let drugName = document.getElementById('drugName').value;
        let quantity = document.getElementById('drugQuantity').value;
        let pricePerUnit = 5; // Example price (fetch dynamically from DB)
        let amount = quantity * pricePerUnit;

        drugs.push({ drug: drugName, quantity: quantity, amount: amount });

        updateTable();
    }

    function updateTable() {
        let tableBody = document.getElementById('quotationTable');
        let totalAmount = 0;
        tableBody.innerHTML = '';

        drugs.forEach((item, index) => {
            totalAmount += item.amount;
            tableBody.innerHTML += `
                <tr>
                    <td>${item.drug}</td>
                    <td>${item.quantity}</td>
                    <td>${item.amount.toFixed(2)}</td>
                </tr>
            `;
        });

        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
        document.getElementById('totalAmountInput').value = totalAmount;
        document.getElementById('drugDetailsInput').value = JSON.stringify(drugs);
    }
</script>
@endsection

