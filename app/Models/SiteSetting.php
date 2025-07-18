<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class SiteSetting extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */


    protected $table = 'site_settings';

    protected $fillable = [
        'site_title',
        'favicon',
        'nav_icon',
        'nav_title',
        'footer_icon',
        'footer_title',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'status',
        'updated_by',
    ];
    protected $casts = [
        'order' => 'integer',
        // status is string so no cast needed
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [ //can be removed
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $fields = [
            $this->site_title,
            $this->nav_title,
            $this->footer_title,
            $this->updated_by,

        ];

        foreach ($fields as $field) {
            if (!empty($field)) {
                return Str::of($field)
                    ->explode(delimiter: ' ')
                    ->map(fn(string $word) => Str::of($word)->substr(0, 1))
                    ->implode('');
            }
        }

        return '';
    }

}
