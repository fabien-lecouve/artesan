<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'phone',
        'address',
        'postal_code',
        'city'
    ];

    public function estimates(): HasMany
    {
        return $this->hasMany(Estimate::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_customer'] ?? false, function($q, $search_customer) {
            $q
                ->where('lastname', 'like', $search_customer . '%')
                ->orWhere('email',  'like', $search_customer . '%'); 
        });
    }
}
