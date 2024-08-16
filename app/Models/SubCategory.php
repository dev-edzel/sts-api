<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class SubCategory extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'category_id',
        'faqs_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function ticket(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faqs::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
