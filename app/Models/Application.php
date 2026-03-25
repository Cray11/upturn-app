<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'applicant_name',
        'email',
        'contact_no',
        'address',
        'transportation_mode',
        'professional_summary',
        'educational_background',
        'recent_company',
        'recent_position',
        'opportunity_reason',
        'best_time_to_contact',
        'resume_path',
        'cover_letter',
        'status',
        'remarks',
        'interviewed_at',
    ];

    protected $casts    = ['interviewed_at'=>'datetime'];
    public function jobPosting() { return $this->belongsTo(JobPosting::class); }
    public function stages()     { return $this->hasMany(ApplicationStage::class); }
}
