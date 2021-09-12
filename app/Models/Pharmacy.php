<?php

namespace App\Models;

use App\Notifications\ResetPasswordQueue;
use App\Notifications\VerifyEmailQueue;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Pharmacy extends Authenticatable //implements MustVerifyEmail
{

    use LogsActivity, SoftDeletes, CascadeSoftDeletes;

    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pharmaid',
        'email',
        'mobile',
        'gender',
        'dob',
        'license',
        'incharge',
        'mobile_2',
        'latitude',
        'longitude',
        'address',
        'district',
        'police_station',
        'post_office',
        'status',
        'image',
        'email_verified_at',
        'admin_id',
        'password',
        'referral_code',
        'service_by',
    ];

    protected $cascadeDeletes = ['orders', 'notifications'];


    protected static $logFillable = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
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
        'admin_id' => 'int',
        'email_verified_at' => 'datetime',
        'status' => 'int',
    ];




    //override for sending the verification email using queue
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueue());
    }

    // override for sending the reset password using queue
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordQueue($token));
    }
}
