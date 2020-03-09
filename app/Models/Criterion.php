<?php

namespace ppes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ppes\Models\Criterion
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\Activity[] $activities
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Criterion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Criterion whereName($value)
 */
class Criterion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'criteria';

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

    /**
     * The activities that belong to the criteria.
     */
    public function activities()
    {
        return $this->belongsToMany('ppes\Models\Activity', 'activities_criteria');
    }

    /**
     * The users that belong to the criteria.
     */
    public function users()
    {
        return $this->belognsToMany('ppes\Models\User', 'user_criterion');
    }
}
