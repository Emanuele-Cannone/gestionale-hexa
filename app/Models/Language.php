<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 */
class Language extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'locale',
    ];

    /**
     * Scope a query to only include popular users.
     */
    public function scopeOtherLanguages(Builder $query): Builder
    {
        return $query->where('locale', '!=', app()->getLocale());
    }
}
