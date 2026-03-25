<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','space_id','reference_no','booking_date','start_time','end_time','duration_hours','total_amount','status','notes'];
    protected $casts    = ['booking_date'=>'date','total_amount'=>'decimal:2'];
    public function user()             { return $this->belongsTo(User::class); }
    public function space()            { return $this->belongsTo(Space::class); }
    public function addons()           { return $this->hasMany(BookingAddon::class); }
    public function payment()          { return $this->hasOne(Payment::class); }
    public function scopePending($q)   { return $q->where('status','pending'); }
    public function scopeConfirmed($q) { return $q->where('status','confirmed'); }
}
