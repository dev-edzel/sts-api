<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class TicketInfo extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'phone_number',
        'subject',
        'concern',
        'attachment'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function toSearchableArray()
    {
        return [
            'email' => $this->email,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
        ];
    }
}
