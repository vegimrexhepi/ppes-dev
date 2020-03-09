<?php

namespace ppes\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ppes\Models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\User[] $users
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\Role whereName($value)
 */
class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('ppes\Models\User', 'user_role');
    }

    /**
     * Get only student role
     * @return ppes\Models\Role
     */
    public function getStudentRole()
    {
        return Role::where('name', 'student')->first();
    }

}
