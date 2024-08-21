<?php

namespace App\Models\Faqs;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'question',
        'sub_category_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
