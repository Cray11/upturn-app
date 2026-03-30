<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id','title','slug','body','featured_image','link_url','status','category','published_at'];
    protected $casts    = ['published_at'=>'datetime'];
    public function author()           { return $this->belongsTo(User::class, 'user_id'); }
    public function scopePublished($q) { return $q->where('status','published'); }
}
