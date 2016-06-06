<?php

namespace Snikpik;

use Illuminate\Database\Eloquent\Model;
use Laravel\Spark\Token;

/**
 * Class Request
 * @package Snikpik
 */
class Request extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['from_origin', 'from_ip', 'url'];

    /**
     * @var array
     */
    protected $hidden = ['token', 'token_id', 'id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function token()
    {
        return $this->belongsTo(Token::class);
    }
}
