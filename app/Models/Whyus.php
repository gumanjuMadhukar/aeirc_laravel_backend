<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Whyus extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'whyus';  // Add this if your table is named 'whyus'

    protected $fillable = [
        'item_title',
        'item_icon',
        'item_description',
        'updated_by',
    ];

    protected $casts = [
        // Add casts if you have columns that require it
        // For example, if 'updated_by' is a date or boolean etc.
    ];

    public function initials(): string
    {
        $fields = [
            $this->item_title,
            $this->item_description,
            $this->updated_by,
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
