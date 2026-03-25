<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicationStage extends Model
{
    const UPDATED_AT = null;
    protected $fillable = ['application_id','reviewed_by','stage_name','result','notes','reviewed_at'];
    protected $casts    = ['reviewed_at'=>'datetime'];
    public function application() { return $this->belongsTo(Application::class); }
    public function reviewer()    { return $this->belongsTo(User::class, 'reviewed_by'); }
}
