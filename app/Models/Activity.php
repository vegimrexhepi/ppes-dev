<?php

namespace ppes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ppes\Models\Activity
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\Criterion[] $criteria
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $bonus1
 * @property string $bonus2
 * @property string $invitation_link
 * @property string $access_code
 * @property boolean $completed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereBonus1($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereBonus2($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereInvitationLink($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereAccessCode($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereCompleted($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\User[] $users
 * @property string $enrollment_key
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereEnrollmentKey($value)
 * @property boolean $status
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Activity whereStatus($value)
 */
class Activity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The criteria that belong to the activity.
     */
    public function criteria()
    {
        return $this->belongsToMany('ppes\Models\Criterion', 'activities_criteria');
    }

    /**
     * The users that belong to the activity.
     */
    public function users()
    {
        return $this->belongsToMany('ppes\Models\User', 'activity_user')->withPivot('completed');;
    }
    
}
