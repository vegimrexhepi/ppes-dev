<?php

namespace ppes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ppes\Models\ActivityCriterion
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $activity_id
 * @property integer $criterion_id
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\ActivityCriterion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\ActivityCriterion whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\ActivityCriterion whereCriterionId($value)
 */
class ActivityCriterion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities_criteria';

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
