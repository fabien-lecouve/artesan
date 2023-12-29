<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function mode_of_work(): BelongsTo
    {
        return $this->belongsTo(ModeOfWork::class);
    }
}
