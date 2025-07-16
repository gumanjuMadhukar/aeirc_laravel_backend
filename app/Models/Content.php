<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Content extends Model
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * Predefined component list
     */
    const COMPONENTS = [
        'services' => 'Services',
        'whyus' => 'Why Us',
        'faq' => 'FAQ',
        'products' => 'Products',
        'teams' => 'Teams',
        'clients' => 'Clients',
        'contact' => 'Contact',
        'gallery' => 'Gallery',
        'weatherCard' => 'Weather Card',
        'testimonial' => 'Testimonial',
        'aboutSection' => 'About page',
        'serviceSection' => 'Service page',
        // Add more as needed...
    ];

    const STATUSES = [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ];

    protected $fillable = [
        'headings',
        'sub_headings',
        'title',
        'description',
        'features',
        'image',
        'video',
        'status',
        'component',
        'updated_by',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    /**
     * Get initials from headings or title
     */
    public function initials(): string
    {
        return Str::of($this->headings ?? $this->title)
            ->explode(' ')
            ->map(fn (string $word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
