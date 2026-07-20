<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramSession extends Model
{
    protected $fillable = [
        'telegram_chat_id',
        'user_id',
        'state',
        'payload',
        'expired_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'expired_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->expired_at !== null
            && $this->expired_at->isPast();
    }
}