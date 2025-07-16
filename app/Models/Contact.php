<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'mobile',
        'email',
        'map_iframe',
        'updated_by',
    ];

    public function initials(): string
    {
        $fields = [
            $this->address,
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
