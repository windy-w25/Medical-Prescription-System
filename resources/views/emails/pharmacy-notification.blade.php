<!DOCTYPE html>
<html>
<head>
    <title>Quotation Status Update</title>
</head>
<body>
    <h1>Quotation Status Update</h1>

    <p>Dear Pharmacy User,</p>

    <p>The user has {{ $quotation->status }} the quotation for their prescription.</p>

    <p><strong>Prescription Note:</strong> {{ $quotation->prescription->note }}</p>
    <p><strong>Quotation Details:</strong> {{ $quotation->quotation_details }}</p>
    <p><strong>Quotation Status:</strong> {{ ucfirst($quotation->status) }}</p>

    <p>Please log in to your system for more details.</p>

    <p>Thank you!</p>
</body>
</html>
