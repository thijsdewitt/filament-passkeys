<?php

namespace Statview\Passkeys\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passkey extends Model
{
    protected $fillable = [
        'credential_id',
        'credential_data',
    ];

    protected $casts = [
        'credential_data' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function credentialId(): Attribute
    {
        return new Attribute(
            get: fn ($value) => base64_decode($value),
            set: fn ($value) => base64_encode($value),
        );
    }
}
