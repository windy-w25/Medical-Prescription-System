<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class PrescriptionController extends Controller
{

    public function index() {
        $prescriptions = Prescription::with('user')->get(); // Get prescriptions with related user data
        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }

    public function create() {
        return view('prescriptions.create');
    }


    public function store(Request $request) {
        $request->validate([
            'note' => 'required',
            'delivery_address' => 'required',
            'delivery_time' => 'required',
            'images.*' => 'image|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('prescriptions', 'public');
                $images[] = $path;
            }
        }

        Prescription::create([
            'user_id' =>  auth()->user()->id,
            'images' => json_encode($images),
            'note' => $request->note,
            'delivery_address' => $request->delivery_address,
            'delivery_time' => $request->delivery_time,
        ]);

        return redirect()->back()->with('success', 'Prescription uploaded successfully');
    }

    
    public function userPrescription() {
        $prescriptions = Prescription::with('user')->get();

        return view('user.prescription.view', compact('prescriptions'));
    }

}

