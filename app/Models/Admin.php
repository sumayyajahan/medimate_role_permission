<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordQueue;
use App\Notifications\ResetPasswordQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'admin';
    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'admin_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin_id' => 'int',
    ];



    protected static $logFillable = true;

    // override for sending the reset password using queue
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordQueue($token));
    }


    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
