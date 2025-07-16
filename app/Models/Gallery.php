<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class Gallery extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */

    protected $table = 'gallery';
    protected $fillable = [
        'gallery_img',
        'img_name',
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
            $this->img_name,
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
