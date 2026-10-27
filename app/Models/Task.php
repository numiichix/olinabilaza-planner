<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'title', 'description', 'deadline', 'priority', 'is_done',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'is_done' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // true if not done and the deadline has passed
    public function getIsOverdueAttribute(): bool
    {
        return ! $this->is_done && $this->deadline->isPast() && ! $this->deadline->isToday();
    }
}
