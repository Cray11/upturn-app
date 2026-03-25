<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
    protected $fillable = ['name','type','description','capacity','price_per_hour','price_per_day','thumbnail','is_available'];
    protected $casts    = ['is_available'=>'boolean','price_per_hour'=>'decimal:2','price_per_day'=>'decimal:2'];
    public function bookings()          { return $this->hasMany(Booking::class); }
    public function scopeAvailable($q)  { return $q->where('is_available',true); }
    public function scopeOfType($q,$t)  { return $q->where('type',$t); }
}
