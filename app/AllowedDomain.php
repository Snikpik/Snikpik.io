<?php

namespace Snikpik;

use Illuminate\Database\Eloquent\Model;
use Laravel\Spark\Token;

/**
 * Class AllowedDomain
 * @package Snikpik
 */
class AllowedDomain extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['domain'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function token()
    {
        return $this->belongsTo(Token::class);
    }
}
