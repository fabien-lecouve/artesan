<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estimate extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function mode_of_work(): BelongsTo
    {
        return $this->belongsTo(ModeOfWork::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function locationOfWorks(): HasMany
    {
        return $this->hasMany(LocationOfWork::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_customer'] ?? false, function($q, $search_customer) {
            $q->whereHas('customer', function($q) use ($search_customer) {
                $q->where('lastname', 'like', $search_customer . '%');
            });
        })->when($filters['search_status'] ?? false, function($q, $search_status) {
            $q->whereHas('status', function($q) use ($search_status) {
                $q->where('slug', $search_status);
            });
        });    
    }

    public function getReference()
    {
        if( $this->reference !== null ){
            return $this->reference;
        } else {
            $reference = strtoupper(substr($this->customer->lastname, 0, 3));
            return $reference .= '00' . count($this->customer->estimates);
        }
    }
}
