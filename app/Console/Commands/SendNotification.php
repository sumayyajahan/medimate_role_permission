<?php

namespace App\Console\Commands;

use App\Helpers\CommonHelper;
use App\Helpers\FileHelper;
use App\Models\AppointmentSchedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redirect;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification to user and doctor 20 minute before every schedule.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get schedules from now to 20 minutes
        $schedules = AppointmentSchedule::where('date', today())->with('appointmentSlotForNotification', 'doctor', 'user')->get();

        $userContacts = "";
        $userContactLowBalance = "";
        $doctorContacts = "";

        //git mobile number of the users

        foreach ($schedules as $schedule) {

            if ($schedule->appointmentSlotForNotification && $schedule->reschedule == 0) {

                //checking the balance
                if ($schedule->user->wallet->balance < $schedule->doctor->visitingFee->visit_charge) {
                    $userContactLowBalance .= $schedule->user->mobile . ",";
                } else {
                    $userContacts .= $schedule->user->mobile . ",";
                }
                // FileHelper::userNotify($schedule->user_id, "Upcoming Appointment","You have an appointment in 20 Min. ");
            }
        }

        //doctor may have 5 schedule at a specific time. so he should get one notification
        $uniqueDoctorSchedules = $schedules->unique('doctor_id');

        foreach ($uniqueDoctorSchedules as $uniqueDoctorSchedule) {

            if ($uniqueDoctorSchedule->appointmentSlotForNotification && $schedule->reschedule == 0) {
                $doctorContacts .= $uniqueDoctorSchedule->doctor->mobile . ",";
            }
        }

        //send msg for user and doctor
        CommonHelper::sendSMSForNotification($userContacts);
        CommonHelper::sendSMSForNotification($userContactLowBalance, "Your balance is low. Please recharge to continue your appointment.");
        CommonHelper::sendSMSForNotification($doctorContacts);
    }
}
