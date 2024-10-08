<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Company extends Model
{
    use HasFactory, BelongsToTenant;
    protected $fillable = [
        'name',
        'tenant_id',
    ];
    // public function user(): HasMany
    // {
    //     return $this->HasMany(User::class, 'user_id');
    // }
    
}
