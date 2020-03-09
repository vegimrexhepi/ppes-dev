<?php

namespace ppes;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class UserCriterion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_criterion';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
