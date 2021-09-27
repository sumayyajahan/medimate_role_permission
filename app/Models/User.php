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
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, LogsActivity, SoftDeletes, CascadeSoftDeletes, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'relationship',
        'mobile',
        'userid',
        'dob',
        'gender',
        'lat',
        'lng',
        'address',
        'district',
        'police_station',
        'post_office',
        'status',
        'referral_code',
        'image',
        'parent_id',
        'email_verified_at',
        'admin_id',
        'status',
        'password',
        'view_password',
        'service_by',

    ];

    protected $cascadeDeletes = ['wallet', 'walletTransactionLogs', 'appointmentSchedules', 'bkashRechargeRequests', 'ePrescriptions', 'notifications', 'referralHistories', 'referByHistory', 'reportPrescriptions', 'userOrders'];
    // protected $dates = ['deleted_at'];


    protected static $logFillable = true;
    // Relations

    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }
    // public function parent()
    // {
    //     return User::where('id',auth()->user()->parent_id)->first();
    // }

    public function reportPrescription()
    {
        return $this->hasMany(ReportPrescription::class);
    }

    public function appointmentSchedule()
    {
        return $this->hasMany(AppointmentSlot::class);
    }
    public function appointmentSchedules()
    {
        return $this->hasMany(AppointmentSchedule::class);
    }

    public function walletTransactionLogs()
    {
        return $this->hasMany(WalletTransactionLog::class);
    }

    public function bkashRechargeRequests()
    {
        return $this->hasMany(BkashRechargeRequest::class);
    }

    public function ePrescriptions()
    {
        return $this->hasMany(EPrescription::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function referralHistories()
    {
        return $this->hasMany(ReferralHistory::class, 'user_refer_by');
    }
    public function reportPrescriptions()
    {
        return $this->hasMany(ReportPrescription::class);
    }
    public function userOrders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function referByHistory()
    {
        return $this->hasOne(ReferralHistory::class,'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }


    // My functions

    public static function users()
    {
        return User::orderBy('name')->where('status', 1)->get();
    }

    public static function usersRe($id)
    {
        return User::where('status', 1)->where('id', $id)->get();
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
        'email_verified_at' => 'datetime',
        'status' => 'int'
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
