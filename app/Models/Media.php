<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['user_id','file_path','file_name','file_type','file_size_kb','alt_text','model_type','model_id'];
    public function uploader() { return $this->belongsTo(User::class, 'user_id'); }
    public function model()    { return $this->morphTo(); }
}
