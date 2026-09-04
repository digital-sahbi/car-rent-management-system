<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'full_name',
        'passport_number',
        'phone_number',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customer_id');
    }
}
