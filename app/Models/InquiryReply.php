<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InquiryReply extends Model
{
    const UPDATED_AT = null;
    protected $fillable = ['inquiry_id','user_id','message','is_internal_note','sent_at'];
    protected $casts    = ['is_internal_note'=>'boolean','sent_at'=>'datetime'];
    public function inquiry() { return $this->belongsTo(Inquiry::class); }
    public function sender()  { return $this->belongsTo(User::class, 'user_id'); }
}
