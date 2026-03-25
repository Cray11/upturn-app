<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section',
        'label',
        'title',
        'description',
        'image',
        'primary_button_label',
        'primary_button_url',
        'secondary_button_label',
        'secondary_button_url',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('section');
    }

    public static function pageOptions(): array
    {
        return [
            'home' => 'Home',
            'about' => 'About',
            'services' => 'Services',
            'contact' => 'Contact',
            'careers' => 'Careers',
            'co_working' => 'Co-Working',
            'engagements' => 'Engagements',
        ];
    }

    public static function sectionOptions(): array
    {
        return [
            'hero' => 'Hero',
            'intro' => 'Intro',
            'cta' => 'Call to Action',
        ];
    }

    public function imageUrl(): ?string
    {
        if (blank($this->image)) {
            return null;
        }

        return Storage::disk('public')->url($this->image);
    }
}
