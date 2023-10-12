<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roster extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'proof_id',
        'from',
        'to',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Proof>
     */
    public function proof(): BelongsTo
    {
        return $this->belongsTo(Proof::class);
    }

    public function scopeManager($query)
    {
        return $query->join('users', 'users.id', 'rosters.user_id')->where('users.manager_id', Auth::id());
    }
}
