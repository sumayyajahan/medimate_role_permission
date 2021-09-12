<?php

namespace App\Models;

use App\Notifications\ResetPasswordQueue;
use App\Notifications\VerifyEmailQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Spatie\Activitylog\Traits\LogsActivity;

class PharmacySalesman extends Authenticatable //implements MustVerifyEmail
{

    use LogsActivity;

    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pharmacy_id',
        'admin_id',
        'name',
        'email',
        'mobile',
        'image',
        'password',
    ];

    protected static $logFillable = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class)->select('name', 'id');
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
        'pharmacy_id' => 'int',
        'admin_id' => 'int',
        'email_verified_at' => 'datetime',
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
