<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasFactory, HasApiTokens;
    protected $connection = 'foo_tenant';
    protected $fillable = [
        'name',
        'cargo',
        'departamento',
        'user_id'
    ];
    protected $guard_name = "api";
 //   protected $connection = 'foo_tenant';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
