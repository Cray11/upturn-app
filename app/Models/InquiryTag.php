<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InquiryTag extends Model
{
    public $timestamps = false;
    protected $fillable = ['inquiry_id','tag'];
    public function inquiry() { return $this->belongsTo(Inquiry::class); }
}
