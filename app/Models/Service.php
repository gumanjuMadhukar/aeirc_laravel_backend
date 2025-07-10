<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class Service extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'description',
        'description_for_list',
        'list',
        'image',
        'component_title',
        'service_icon',
        'service_name',
        'service_description',
        'service_features',
        'service_image',
        'updated_by',
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
        $this->description,
        $this->description_for_list,
        $this->list,
        $this->component_title,
        $this->service_name,
        $this->service_description,
        $this->service_features,
    ];

    foreach ($fields as $field) {
        if (!empty($field)) {
            return Str::of($field)
                ->explode(' ')
                ->map(fn (string $word) => Str::of($word)->substr(0, 1))
                ->implode('');
        }
    }

    return '';
}

}
