<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (self $reservation) {
            if (empty($reservation->customer_id) && !empty($reservation->passport_number)) {
                $customer = Customer::firstOrCreate(
                    ['passport_number' => trim($reservation->passport_number)],
                    [
                        'full_name' => $reservation->customer_name ?? 'Unknown Customer',
                        'phone_number' => $reservation->phone_number ?? null,
                    ]
                );

                $reservation->customer_id = $customer->id;
                $reservation->customer_name = $customer->full_name;
            }

            if (empty($reservation->customer_name) && !empty($reservation->user_id)) {
                $reservation->customer_name = optional($reservation->user)->name ?? 'Unknown Customer';
            }
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'reservation_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'customer_id',
        'customer_name',
        'passport_number',
        'phone_number',
        'vehicle_id',
        'start_date',
        'end_date',
        'total_cost',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_cost' => 'decimal:2',
    ];

    /**
     * Get the user associated with the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the vehicle associated with the reservation.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
