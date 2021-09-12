<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ContactFeedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\AppointmentSchedule;
use App\Models\Doctor;
use App\Models\UserOrder;
use Carbon\Carbon;
use Exception;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.admins', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.admin_create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {
        $password = bcrypt($request->password);
        Admin::create(array_merge($request->all(), ['password' => $password]));
        return back()->with('success', 'Successfully Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.admin_show', compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.admin_edit', compact('admin'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admin $admin, AdminUpdateRequest $request)
    {

        $admin->fill($request->all());
        $admin->save();
        return back()->with('success', 'Successfully Updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            //code...
        } catch (Exception $th) {
            return back()->with('error', 'Cannot delete admin. This admin might create user, doctor, pharmacy or service provider. Please delete the child accounts to delete the admin.');
        }
        return back()->with('success', 'Successfully Deleted.');
    }


    /**
     * showing the dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user_esc = User::orderBy('created_at', 'ASC')->first()->pluck('created_at');
        $user_esc = strtotime($user_esc);
        $user_esc_last = User::latest()->first()->pluck('created_at');
        $user_esc_last = strtotime($user_esc_last);

        $users = User::count();
        $user_last_month = User::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $user_this_month = User::whereMonth('created_at', '=', Carbon::now()->month)->count();

        if ($user_last_month == 0) {
            $u_percent = 100;
        } else {
            $u_percent = round((($user_this_month - $user_last_month) / $user_last_month), 1);
        }

        $numberOfMonths = abs((date('Y', $user_esc_last) - date('Y', $user_esc)) * 12 + (date('m', $user_esc_last) - date('m', $user_esc))) + 2;

        $avg_user = round($users / $numberOfMonths);


        $doctors = Doctor::count();
        $d_last_month = Doctor::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $d_this_month = Doctor::whereMonth('created_at', '=', Carbon::now()->month)->count();
        if ($d_last_month == 0) {
            $d_percent = 100;
        } else {
            $d_percent = round((($d_this_month - $d_last_month) / $d_last_month), 1);
        }


        $app = AppointmentSchedule::count();
        $a_last_month = AppointmentSchedule::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $a_this_month = AppointmentSchedule::whereMonth('created_at', '=', Carbon::now()->month)->count();
        if ($a_last_month == 0) {
            $a_percent = 100;
        } else {
            $a_percent = round((($a_this_month - $a_last_month) / $a_last_month), 1);
        }

        $completed_appointment = AppointmentSchedule::where('consult', 1)->count();
        $pending_appointment = AppointmentSchedule::where('consult', 0)->where('reschedule', 0)->count();

        //latest doctor - 5

        $latest5Doctor = Doctor::orderBy('created_at', 'DESC')->take(8)->with('appointmentSlot')->get();
        //return $latest5Doctor[0]->appointmentSlot->count();

        //get pending more than 30 minutes orders

        $orders = UserOrder::where('is_accept_user', 0)->where('is_order', 1)
            ->where('created_at', '<', Carbon::now()->subMinutes(30)->toDateTimeString())
            ->with('user', 'pharmacy')->take(6)->get();


        return view('admin.dashboard', compact(
            'users',
            'avg_user',
            'doctors',
            'app',
            'completed_appointment',
            'pending_appointment',
            'u_percent',
            'd_percent',
            'a_percent',
            'latest5Doctor',
            'orders'
        ));
    }

    public function changePasswordView()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $admin = Admin::find(Auth::id());
        if (Hash::check($request->oldpassword, $admin->password)) {
            $admin->password = Hash::make($request->password);
            $admin->save();
            return back()->with('success', 'Password Change Successful.');
        } else {
            return back()->with('error', 'Password Mismatch.');
        }
    }

    public function contacts(Request $request)
    {
        $contactFeedbacks = ContactFeedback::whereNotNull('phone')->get();
        if ($request->ajax()) {
            return DataTables::of($contactFeedbacks)
                ->addIndexColumn()
                ->addColumn('created_at', function (ContactFeedback $contactFeedbacks) {
                    return $contactFeedbacks->created_at->toFormattedDateString();
                })
                ->addColumn('action', function (ContactFeedback $contactFeedbacks) {
                    return '<a class="btn btn-danger" onclick="return confirm(\'Are you sure?\')" href="' . route('admin.contact-feedback.delete', $contactFeedbacks->id) . '">Delete</a> ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.contacts');
    }

    public function feedbacks(Request $request)
    {
        $contactFeedbacks = ContactFeedback::whereNull('phone')->get();
        if ($request->ajax()) {
            return DataTables::of($contactFeedbacks)
                ->addIndexColumn()
                ->addColumn('created_at', function (ContactFeedback $contactFeedbacks) {
                    return $contactFeedbacks->created_at->toFormattedDateString();
                })
                ->addColumn('action', function (ContactFeedback $contactFeedbacks) {
                    return '<a  onclick="return confirm(\'Are you sure?\')" href="' . route('admin.contact-feedback.delete', $contactFeedbacks->id) . '">Delete</a> ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $averageFeedback = ContactFeedback::avg('feedback');
        $averageFeedback = round($averageFeedback, 2);
        return view('admin.feedbacks', compact('averageFeedback'));
    }

    public function contactFeedbackDelete(ContactFeedback $contactFeedback)
    {
        $contactFeedback->delete();
        return back()->with('success', 'Delete Successful.');
    }
}
