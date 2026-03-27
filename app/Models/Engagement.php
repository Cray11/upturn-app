<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Engagement extends Model
{
    use HasFactory;

    public const SECTION_LATEST_PROJECTS = 'latest_projects';
    public const SECTION_TEAM_BUILDING_EVENTS = 'team_building_events';
    public const SECTION_CULTURE_GALLERY = 'culture_gallery';

    protected $fillable = [
        'section',
        'label',
        'title',
        'description',
        'images',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'images' => 'array',
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->latest('id');
    }

    public static function sectionOptions(): array
    {
        return [
            self::SECTION_LATEST_PROJECTS => 'Latest Projects',
            self::SECTION_TEAM_BUILDING_EVENTS => 'Team Building Events',
            self::SECTION_CULTURE_GALLERY => 'Culture Gallery',
        ];
    }

    public function sectionLabel(): string
    {
        return static::sectionOptions()[$this->section] ?? $this->section;
    }

    public function imageUrls(): array
    {
        return collect($this->images ?? [])
            ->filter()
            ->map(fn (string $path): string => Storage::disk('public')->url($path))
            ->values()
            ->all();
    }

    public function primaryImageUrl(): ?string
    {
        return $this->imageUrls()[0] ?? null;
    }
}
