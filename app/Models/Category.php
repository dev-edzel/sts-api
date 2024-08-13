<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ticket(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    public function sub_categories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name
        ];
    }
}
