<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'faq';  // Add this if your table is named 'faq'

    protected $fillable = [
        'question',
        'answer',
        'updated_by',
    ];

    protected $casts = [
        // Add casts if you have columns that require it
        // For example, if 'updated_by' is a date or boolean etc.
    ];

    public function initials(): string
    {
        $fields = [
            $this->question,
            $this->answer,
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
