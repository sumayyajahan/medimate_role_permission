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

class Doctor extends Authenticatable //implements MustVerifyEmail
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
        'mobile',
        'dob',
        'gender',
        'nid',
        'bmdc_reg',
        'department',
        'degree',
        'designation',
        'institute',
        'specialization',
        'doctorid',
        'address',
        'district',
        'police_station',
        'post_office',
        'status',
        'image',
        'email_verified_at',
        'status',
        'admin_id',
        'password',
        'referral_code',
        'service_by',
    ];

    protected $cascadeDeletes = ['appointmentSchedules', 'appointmentSlots', 'bulkReschedules', 'cashouts', 'speciliztion', 'visitingFee', 'wallet', 'ePrescriptions', 'notifications', 'referralHistories', 'referByHistory', 'walletTransactionLog'];


    protected static $logFillable = true;
    // Relations

    public function ePrescriptions()
    {
        return $this->hasMany(EPrescription::class);
    }
    public function referralHistories()
    {
        return $this->hasMany(ReferralHistory::class, 'doctor_refer_by');
    }
    public function referByHistory()
    {
        return $this->hasOne(ReferralHistory::class, 'doctor_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function walletTransactionLog()
    {
        return $this->hasMany(WalletTransactionLog::class);
    }
    public function bulkReschedules()
    {
        return $this->hasMany(BulkReschedule::class);
    }
    public function cashouts()
    {
        return $this->hasMany(Cashout::class);
    }
    public function visitingFee()
    {
        return $this->hasOne(DoctorVisitCharge::class);
    }
    public function speciliztion()
    {
        return $this->hasOne(DoctorSpecialization::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class)->select('name', 'id');
    }

    public function appointmentSlot()
    {
        return $this->hasMany(AppointmentSlot::class);
    }
    public function appointmentSlots()
    {
        return $this->hasMany(AppointmentSlot::class);
    }

    public function appointmentSchedule()
    {
        return $this->hasMany(AppointmentSlot::class);
    }
    public function appointmentSchedules()
    {
        return $this->hasMany(AppointmentSchedule::class);
    }

    public function appointmentScheduleOld()
    {
        return $this->hasMany(AppointmentSchedule::class)->where('active', 1)->where('consult', 1);
    }

    public function appointmentScheduleUp()
    {
        return $this->hasMany(AppointmentSchedule::class)->where('active', 1)->where('consult', 0);
    }

    public function appointmentScheduleCanceled()
    {
        return $this->hasMany(AppointmentSchedule::class)->where('active', 0)->orWhere('consult', 9)->orWhere('reschedule', '!=', 0);
    }


    // My functions

    public static function doctors()
    {
        return Doctor::orderBy('name')->where('status', 1)->get();
    }

    public static function doctorsRe($id)
    {
        return Doctor::where('status', 1)->where('id', $id)->get();
    }

    public function wallet()
    {
        return $this->hasOne(DoctorWallet::class);
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
        'status' => 'int',
        'admin_id' => 'int',

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
