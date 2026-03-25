<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['client_name','company','content','rating','is_featured','sort_order'];
    protected $casts    = ['is_featured'=>'boolean'];
    public function scopeFeatured($q) { return $q->where('is_featured',true)->orderBy('sort_order'); }
}
