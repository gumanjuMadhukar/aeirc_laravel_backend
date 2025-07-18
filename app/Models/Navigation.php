<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class Navigation extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */


    protected $table = 'navigations';

    protected $fillable = [
        'label',
        'url',
        'type',
        'order',
        'status',     // changed from is_active boolean
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
            $this->label,
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
