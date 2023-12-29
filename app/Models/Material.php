<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
