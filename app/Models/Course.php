<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    // 1 = Monday ... 7 = Sunday (used in forms and views)
    public const DAYS = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];

    protected $fillable = ['user_id', 'code', 'name', 'lecturer', 'credits', 'day', 'start_time', 'end_time'];

    // example: "Wednesday"
    public function getDayNameAttribute(): string
    {
        return self::DAYS[$this->day] ?? '-';
    }

    // example: "15.00 - 18.00"
    public function getTimeRangeAttribute(): string
    {
        $fmt = fn ($t) => str_replace(':', '.', substr($t, 0, 5));

        return $fmt($this->start_time).' - '.$fmt($this->end_time);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
