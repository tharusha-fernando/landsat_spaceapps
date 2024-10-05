<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',            // Foreign key for user
        'place_name',         // Name of the place (optional, if manually entered)
        'latitude',           // Latitude of the location
        'longitude',          // Longitude of the location
        'lead_time',          // Notification lead time in minutes before overpass
        'notification_method', // Notification method (email, sms, both)
        'cloud_threshold',    // Maximum cloud coverage threshold
    ];

    /**
     * The user that owns this location.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
