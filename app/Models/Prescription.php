<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    // Add the fields that can be mass assigned
    protected $fillable = [
        'user_id',        // The ID of the user uploading the prescription
        'images',         // The uploaded prescription images
        'note',           // Any note related to the prescription
        'delivery_address',// The delivery address for the prescription
        'delivery_time',  // The preferred delivery time
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }
}

