<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['created_by','title','department','location','description','requirements','employment_type','status','deadline'];
    protected $casts    = ['deadline'=>'date'];
    public function creator()      { return $this->belongsTo(User::class, 'created_by'); }
    public function applications() { return $this->hasMany(Application::class); }
    public function scopeOpen($q)  { return $q->where('status','open'); }
}
