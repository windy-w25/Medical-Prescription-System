<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'drug_details',
        'total_amount',
        'quotation_details',
        'status',  // You can add status handling (pending, accepted, rejected) here
    ];

    public function prescription() {
        return $this->belongsTo(Prescription::class);
    }
    public function drugs()
    {
        return $this->belongsToMany(Drug::class)
            ->withPivot('quantity', 'total_price');
    }
}
