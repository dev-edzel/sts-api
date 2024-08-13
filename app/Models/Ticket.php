<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'reference_no',
        'ticket_types_id',
        'category_id',
        'sub_category_id',
        'initiator',
        'status'
    ];

    protected $hidden = [
        'resolved_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ticket_info(): HasOne
    {
        return $this->hasOne(TicketInfo::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ticket_type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }
}
