<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','description','icon','image','price_from','is_active','sort_order'];
    protected $casts    = ['is_active'=>'boolean','price_from'=>'decimal:2'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('sort_order'); }
}
