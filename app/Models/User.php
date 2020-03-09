<?php

namespace ppes\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * ppes\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\Role[] $roles
 * @mixin \Eloquent
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $student_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ppes\Models\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\Criterion[] $criteria
 * @property-read \Illuminate\Database\Eloquent\Collection|\ppes\Models\Activity[] $activities
 */
class User extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if the user is Student
     *
     * @return bool
     */
    public function isStudent() {
        foreach ($this->roles as $role) {
            if ($role->name == "student") {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user is Lecturer
     *
     * @return bool
     */
    public function isLecturer() {
        foreach ($this->roles as $role) {
            if ($role->name == "lecturer") {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user is administrator
     *
     * @return bool
     */
    public function isAdministrator() {
        foreach ($this->roles as $role) {
            if ($role->name == "administrator") {
                return true;
            }
        }
        return false;
    }

    /**
     * Generate an unique student id
     * 
     * @return string Unique Student ID
     */
    public function generateStudentId()
    {
        $studentId = 'SE';

        // get two last year's digits
        $studentIdDate = date('y');

        // attach last two digits of current year to student id
        $studentId .= $studentIdDate;

        // check for the last inserted student
        $lastInsertedStudent = $this->getLastInsertedStudent();
        if (is_null($lastInsertedStudent)) { // there's no students in database
            $studentId .= '001'; // start new counter
        } else {

            $lastInsertedStudentId = $lastInsertedStudent->student_id;
            $lastInsertedStudentIdDate = substr($lastInsertedStudentId, 2, 2);
            $lastInsertedStudentIdCounter = substr($lastInsertedStudentId, -5);

            if ($studentIdDate != $lastInsertedStudentIdDate) {

                // has passed a year since last inserted student 
                $studentId .= '001'; // reset counter for new year

            } else { // within the same year

                // add a non-zero number no preserve leading zeros
                $lastInsertedStudentIdCounter = (int)('1' . $lastInsertedStudentIdCounter);

                // increment last student id to get the next student id
                $nextStudentIdCounter = $lastInsertedStudentIdCounter + 1;

                // grap only last 5 characters (leave out year's last character)
                $nextStudentIdCounter = substr($nextStudentIdCounter, -5);

                $studentId .= $nextStudentIdCounter;

            }
        }

        return $studentId;
    }

    /**
     * Get last inserted student
     *
     * @param Role $role
     * @return User
     */
    public function getLastInsertedStudent(Role $role)
    {
        $studentRole = Role::where('name', 'student')->first();
        return $studentRole->users()->orderBy('created_at', 'desc')->first();
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('ppes\Models\Role', 'user_role');
    }

    /**
     * The criteria that belong to the criteria.
     */
    public function criteria()
    {
        return $this->belongsToMany('ppes\Models\Criterion', 'user_criterion');
    }

    /**
     * The activities that belong to the user.
     */
    public function activities()
    {
        return $this->belongsToMany('ppes\Models\Activity', 'activity_user')->withPivot('completed');
    }
}
