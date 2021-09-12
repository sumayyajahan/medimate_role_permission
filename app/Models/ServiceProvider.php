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

class ServiceProvider extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes,CascadeSoftDeletes;

    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'serviceid',
        'mobile',
        'license',
        'incharge',
        'mobile_2',
        'latitude',
        'longtitude',
        'address',
        'district',
        'police_station',
        'post_office',
        'status',
        'referral_code',
        'service_by',
        'image',
        'email_verified_at',
        'admin_id',
        'password',
        'gender',
        'dob',
    ];

    protected $cascadeDeletes = ['notifications', 'referralHistories', 'referByHistory', 'comission', 'comissionHistories', 'wallet', 'walletTransactionLogs'];

    protected static $logFillable = true;


    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function comission()
    {
        return $this->hasOne(ServiceProviderComission::class);
    }
    public function comissionHistories()
    {
        return $this->hasMany(ServiceProviderComissionHistory::class);
    }
    public function referralHistories()
    {
        return $this->hasMany(ReferralHistory::class, 'service_provider_refer_by');
    }
    public function referByHistory()
    {
        return $this->hasOne(ReferralHistory::class, 'service_provider_id');
    }
    public function walletTransactionLogs()
    {
        return $this->hasMany(WalletTransactionLog::class);
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
        'status' => 'int'
    ];


    public function wallet()
    {
        return $this->hasOne(ServiceProviderWallet::class);
    }


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
