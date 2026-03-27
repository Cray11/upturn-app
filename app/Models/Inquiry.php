<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = ['assigned_to','name','email','contact_no','business_name','service_interest','message','status','source','replied_at'];
    protected $casts    = ['replied_at'=>'datetime'];
    public function assignedUser()      { return $this->belongsTo(User::class, 'assigned_to'); }
    public function replies()           { return $this->hasMany(InquiryReply::class); }
    public function tags()              { return $this->hasMany(InquiryTag::class); }
    public function scopeNew($q)        { return $q->where('status','new'); }
    public function scopeUnresolved($q) { return $q->whereNotIn('status',['resolved','closed']); }
}
