<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'position',
        'description',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'updated_by',
    ];

    public function initials(): string
    {
        $fields = [
            $this->name,
            $this->position,
            $this->description,
            $this->updated_by,
        ];

        foreach ($fields as $field) {
            if (!empty($field)) {
                return Str::of($field)
                    ->explode(' ')
                    ->map(fn(string $word) => Str::of($word)->substr(0, 1)->upper())
                    ->implode('');
            }
        }

        return '';
    }
}
