<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    // 1 = Senin ... 7 = Minggu (dipakai di form dan tampilan)
    public const DAYS = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    protected $fillable = ['user_id', 'code', 'name', 'lecturer', 'credits', 'day', 'start_time', 'end_time'];

    // contoh: "Rabu"
    public function getDayNameAttribute(): string
    {
        return self::DAYS[$this->day] ?? '-';
    }

    // contoh: "15.00 - 18.00"
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
