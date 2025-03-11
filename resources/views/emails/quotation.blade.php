<!DOCTYPE html>
<html>
<head>
    <title>Your Quotation Details</title>
</head>
<body>
    <h2>Hello, {{ $quotation->prescription->user->name }}</h2>
    
    <p>Your prescription quotation is ready.</p>

    <h3>Quotation Details</h3>
    <table cellspacing="0" cellpadding="10">
        <tr>
            <th>Drug</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        @foreach(json_decode($quotation->drug_details, true) as $drug)
            <tr>
                <td>{{ $drug['drug'] }}</td>
                <td>{{ $drug['quantity'] }}</td>
                <td>${{ $drug['amount'] }}</td>
            </tr>
        @endforeach
    </table>

    <h3>Total Price: ${{ $quotation->total_amount }}</h3>

    <p>Thank you for choosing our pharmacy!</p>
</body>
</html>
