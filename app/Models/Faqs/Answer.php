<?php

namespace App\Models\Faqs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'question_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
