<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookingAddon extends Model
{
    public $timestamps = false;
    protected $fillable = ['booking_id','addon_name','price'];
    protected $casts    = ['price'=>'decimal:2'];
    public function booking() { return $this->belongsTo(Booking::class); }
}
