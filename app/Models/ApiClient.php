<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model
{
    use HasUuids;

    protected $fillable = [
        'email',
        'name',
        'token',
        'activation_token',
        'activation_token_used',
        'activation_expired_at',
        'status',
        'activated_at',
        'last_used_at',
        'expired_at',
        'notes',
    ];

    protected $casts = [
        'activation_token_used' => 'boolean',
        'activation_expired_at' => 'datetime',
        'activated_at'          => 'datetime',
        'last_used_at'          => 'datetime',
        'expired_at'            => 'datetime',
    ];

    protected $hidden = ['token', 'activation_token'];

    public function isActivationLinkValid(): bool
    {
        return !$this->activation_token_used
            && $this->activation_expired_at
            && now()->lt($this->activation_expired_at);
    }

    public function isActive(): bool
    {
        return $this->status === 'active'
            && ($this->expired_at === null || now()->lt($this->expired_at));
    }
}
