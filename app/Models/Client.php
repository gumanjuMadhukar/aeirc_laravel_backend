<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_logo',
        'type_of_client',
        'updated_by',
    ];

    // For the dropdown in the Blade file
    public const PAGES = [
        'national' => 'National',
        'international' => 'International',
    ];

    public function initials(): string
    {
        $fields = [
            $this->client_name,
            $this->type_of_client,
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
