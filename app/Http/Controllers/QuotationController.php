<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Quotation;
use App\Models\Drug;
use Illuminate\Http\Request;
use App\Mail\QuotationNotification;
use App\Mail\PharmacyNotification;
use Illuminate\Support\Facades\Mail;


class QuotationController extends Controller
{
    public function viewPrescriptions() {
        $prescriptions = Prescription::with('user')->get();
        return response()->json($prescriptions);
    }

    public function sendQuotation(Request $request, $prescriptionId) {
        $request->validate([
            'quotation_details' => 'required',
        ]);

        Quotation::create([
            'prescription_id' => $prescriptionId,
            'quotation_details' => $request->quotation_details,
        ]);
        return response()->json(['message' => 'Quotation sent successfully'], 200);
    }

    public function create(Prescription $prescription) {

        return view('pharmacy.quotation.create', compact('prescription'));
    }

    public function userQuotations(Prescription $prescription) {

        $quotation = Quotation::where('prescription_id', $prescription->id)->first();

        return view('user.quotations.index', compact('quotation'));
    }

    public function store(Request $request, Prescription $prescription) {

        $request->validate([
            'drug_details' => 'required',
            'total_amount' => 'required|numeric',
        ]);

        $quotation = Quotation::create([
            'prescription_id' => $prescription->id,
            'drug_details' => $request->drug_details ?? '',
            'total_amount' => $request->total_amount,
            'quotation_details' =>'',
            'status' => 'pending'
        ]);


        Mail::to($quotation->prescription->user->email)->send(new QuotationNotification($quotation));
        return redirect()->route('pharmacy.prescriptions.index')->with('success', 'Quotation prepared and sent to user.');
    }

    public function notifyPharmacy1(Quotation $quotation) {
  
        $pharmacyEmail = 'pharmacy@example.com'; 
    
        Mail::raw("The quotation for prescription ID {$quotation->prescription->id} has been {$quotation->status} by the user.", function ($message) use ($pharmacyEmail) {
            $message->to($pharmacyEmail)
                    ->subject('User Quotation Response');
        });
    }

    public function updateStatus(Request $request, Quotation $quotation) {
        $quotation->update([
            'status' => $request->status,
        ]);
    
        $this->notifyPharmacy($quotation);
    
        return redirect()->route('user.prescription.view')->with('success', 'You have ' . $request->status . ' the quotation.');
    }

    public function notifyPharmacy(Quotation $quotation) {
        $pharmacyEmail = $quotation->prescription->user->email;
        Mail::to($pharmacyEmail)->send(new PharmacyNotification($quotation));
    }
}

