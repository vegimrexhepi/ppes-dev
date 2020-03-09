<?php

namespace ppes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ppes\Models\Result
 *
 * @property integer $id
 * @property integer $voting_user_id
 * @property integer $activity_id
 * @property integer $student_evaluated_id
 * @property integer $criterion_id
 * @property integer $vote_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereVotingUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereStudentEvaluatedId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereCriterionId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereVoteValue($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Result whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Result extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'results';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function activity()
    {
        $this->belongsTo('ppes\Models\Activity', 'activity_id');
    }

    public function votingUser()
    {
        $this->belongsTo('ppes\Models\User', 'voting_user_id');
    }

    public function evaluatedUser()
    {
        $this->belongsTo('ppes\Models\User', 'student_evaluated_id');
    }

    public function criterion()
    {
        $this->belongsToMany('ppes\Models\Criterion', 'criterion_id');
    }
}
