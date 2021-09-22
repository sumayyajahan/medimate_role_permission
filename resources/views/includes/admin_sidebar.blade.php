<style>
    .nav-link {
        line-height: normal;
    }

</style>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <span class="logo-image">
                    <img src="{{ asset('admin/assets/img/logo.png') }}" style="max-width: -webkit-fill-available;">
                </span>
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="{{ asset('admin/assets/img/user.png') }}">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"></div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                        data-feather="monitor"></i><span>Dashboard</span></a></li>

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Receptionist' || $admin->role == 'Service Administration') --}}
            @if (auth()->user()->can('create users') &&
            auth()->user()->can('create doctors') &&
            auth()->user()->can('create pharmacies') &&
            auth()->user()->can('create service_providers'))
                <li class="menu-header">Account Administration</li>
                <li class="dropdown" style="display: none;">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="plus"></i><span>Add
                            User</span></a>
                    <ul class="dropdown-menu">
                        @can('create users')
                            <li><a class="nav-link" href="{{ route('admin.user.create') }}">Patient</a></li>
                        @endcan
                        @can('create doctors')
                            <li><a class="nav-link" href="{{ route('admin.doctor.create') }}">Doctor</a></li>
                        @endcan
                        @can('create pharmacies')
                            <li><a class="nav-link" href="{{ route('admin.pharmacy.create') }}">Pharmacy</a></li>
                        @endcan

                        <li><a class="nav-link" href="{{ route('admin.pharmacy-salesman.create') }}">Pharmacy
                                Sale
                                Rep.</a>

                        <li><a class="nav-link" href="">Service Provider</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('view users') &&
    auth()->user()->can('view doctors') &&
    auth()->user()->can('view pharmacies') &&
    auth()->user()->can('view service_providers'))
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Manage
                                User</span></a>
                        <ul class="dropdown-menu">
                            @can('view users')
                                <li><a class="nav-link" href="{{ route('admin.user.index') }}">Patient</a></li>
                            @endcan
                            @can('view doctors')
                                <li><a class="nav-link" href="{{ route('admin.doctor.index') }}">Doctor</a></li>
                            @endcan
                            @can('view pharmacies')
                                <li><a class="nav-link" href="{{ route('admin.pharmacy.index') }}">Pharmacy</a>
                                </li>
                            @endcan
                            {{-- <li><a class="nav-link" href="{{route('admin.pharmacy-salesman.index')}}">Pharmacy Sale
                    Rep.</a> --}}
                            @can('view service_providers')
                                <li><a class="nav-link" href="{{ route('admin.service-provider.index') }}">Service
                                        Provider</a></li>
                            @endcan
                        </ul>
                @endif
                @if (auth()->user()->can('delete users') &&
    auth()->user()->can('delete doctors') &&
    auth()->user()->can('delete pharmacies') &&
    auth()->user()->can('delete service_providers'))
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="trash"></i><span>Trash
                            User</span></a>
                    <ul class="dropdown-menu">
                        @can('delete users')
                            <li><a class="nav-link" href="{{ route('admin.user.trash') }}">Patient</a></li>
                        @endcan
                        @can('delete doctors')
                            <li><a class="nav-link" href="{{ route('admin.doctor.trash') }}">Doctor</a></li>
                        @endcan
                        @can('delete pharmacies')
                            <li><a class="nav-link" href="{{ route('admin.pharmacy.trash') }}">Pharmacy</a></li>
                        @endcan
                        {{-- <li><a class="nav-link" href="{{route('admin.pharmacy-salesman.index')}}">Pharmacy Sale
                    Rep.</a> --}}
                        @can('delete service_providers')
                            <li><a class="nav-link" href="{{ route('admin.service-provider.trash') }}">Service
                                    Provider</a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif
                </li>
            {{-- @endif --}}

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Receptionist' || $admin->role == 'Service Administration') --}}
            @if (auth()->user()->can('create insurances') && auth()->user()->can('view insurances') &&
    auth()->user()->can('edit insurance_enrolls') && auth()->user()->can('view insurance_enrolls') &&
    auth()->user()->can('create insurance_packages') && auth()->user()->can('view insurance_packages')
    && auth()->user()->can('view claim_insurances'))

            <li class="menu-header">Product & Service</li>


                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Health
                            Package</span></a>
                    <ul class="dropdown-menu">
                        @can('create insurances')
                        <li><a class="nav-link" href="{{ route('admin.insurance.create') }}">Add Insurance
                                Company</a></li>
                        @endcan
                        @can('view insurances')
                        <li><a class="nav-link" href="{{ route('admin.insurance.index') }}">Manage Insurance
                                Company</a></li>
                        @endcan
                        @can('create insurance_packages')
                        <li><a class="nav-link" href="{{ route('admin.insurance-package.create') }}">Add Health
                                Package</a>
                        </li>
                        @endcan
                        @can('view insurance_packages')
                        <li><a class="nav-link" href="{{ route('admin.insurance-package.index') }}">Manage
                                Insurance
                                Package</a></li>
                        @endcan
                        @can('edit insurance_enrolls')

                        <li><a class="nav-link" href="{{ route('admin.enroll.requests') }}">Insurance
                                Requests</a></li>
                        <li><a class="nav-link" href="{{ route('admin.enroll.processing') }}">Insurance
                                Requests
                                (On
                                Processing )</a></li>
                        <li><a class="nav-link" href="{{ route('admin.enroll.approved') }}">Approved Insurance
                                Requests</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.enroll.reject') }}">Canceled Insurance
                                Requests</a></li>
                        @endcan
                        @can('view claim_insurances')
                        <li><a class="nav-link"
                                href="{{ route('admin.claim-insurance-request.index') }}">Insurance Claim
                                Requests</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('create users') &&
            auth()->user()->can('create doctors') &&
            auth()->user()->can('create pharmacies') &&
            auth()->user()->can('create service_providers'))
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="shopping-cart"></i><span>Pharmacy
                            Service
                        </span></a>
                    <ul class="dropdown-menu">
                        @can('create otc_products')
                        <li><a class="nav-link" href="{{ route('admin.product.create') }}">Add Product</a></li>
                        @endcan
                        @can('create otc_products')
                        <li><a class="nav-link" href="{{ route('admin.product.bulk.create') }}">Add Product
                                (BULK)</a></li>
                        @endcan
                        @can('view otc_products')
                        <li><a class="nav-link" href="{{ route('admin.product.index') }}">Manage Products</a>
                        </li>
                        @endcan
                        @can('edit admins')
                        <li><a class="nav-link" href="{{ route('admin.pending') }}">Pending Orders</a></li>
                        <li><a class="nav-link" href="{{ route('admin.delivered') }}">Delivered Orders</a></li>
                        <li><a class="nav-link" href="{{ route('admin.approved') }}">Approved Orders</a></li>
                        <li><a class="nav-link" href="{{ route('admin.rejected') }}">Rejected Orders</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
            {{-- @endif --}}

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Receptionist' || $admin->role == 'Service Administration') --}}
            @if (auth()->user()->can('view appointment_slots') &&
            auth()->user()->can('create appointment_slots') &&
            auth()->user()->can('edit appointment_slots') &&
            auth()->user()->can('delete appointment_slots'))
                <li class="menu-header">Appointment</li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="watch"></i><span>Doctor's
                            Setup</span></a>
                    <ul class="dropdown-menu">
                        @can('create appointment_slots')
                        <li><a class="nav-link" href="{{ route('admin.appointment-slot.create') }}">Add A
                                Slot</a></li>
                        @endcan
                        @can('view appointment_slots')
                        <li><a class="nav-link" href="{{ route('admin.appointment-slot.index') }}">Manage
                                Slots</a></li>
                        @endcan
                        @can('edit appointment_slots')
                        <li><a class="nav-link" href="{{ route('admin.visit-charge.index') }}">Adjust Visiting
                                Charge</a></li>
                        @endcan
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="git-commit"></i><span>Patient's
                            Appointment Schedule</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.appointment-schedule.create') }}">Book An
                                Appointment</a></li>
                        <li><a class="nav-link" href="{{ route('admin.appointment-schedule.index') }}">All
                                Appointment</a>
                        </li>
                        <li><a class="nav-link"
                                href="{{ route('admin.appointment-schedule.upcoming') }}">Upcoming
                                Appointments</a></li>
                        <li><a class="nav-link"
                                href="{{ route('admin.appointment-schedule.previous') }}">Previous
                                Appointments</a></li>
                    </ul>
                </li>
                @endif
            {{-- @endif --}}
            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="rotate-ccw"></i><span>
                        ReSchedule</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.appointment-schedule.reschedule')}}">Received
            Requests</a></li>
            <li><a class="nav-link" href="{{route('admin.appointment-schedule.reschedule.cancel')}}">Bulk
                    Cancel</a></li>
        </ul>
        </li> --}}

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Moderator' || $admin->role == 'Service Administration') --}}

                <li class="menu-header">Points</li>
                <li class="dropdown">
                    <a href="{{ route('admin.comissions') }}"><i data-feather="dollar-sign"></i><span>Service
                            Charge</span></a>
                    <a href="{{ route('admin.referral.point') }}"><i data-feather="dollar-sign"></i><span>Referral
                            Points
                        </span></a>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="dollar-sign"></i><span>Points</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="nav-link" href="route('admin.recharge') }}}">Point Recharge</a>
        </li> --}}
                        <li><a class="nav-link" href="{{ route('admin.user-wallet.create') }}">Add User
                                Point</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.service-wallet.create') }}">Add Service
                                Provider Point</a></li>
                        <li><a class="nav-link" href="{{ route('admin.bkash') }}">Cash-In Requests (bKash)</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.service-provider.bkash') }}">Service
                                Provider Cash-In Requests
                                (bKash)</a></li>
                        <li><a class="nav-link" href="{{ route('admin.user-wallet.index') }}">Manage User
                                Point</a></li>
                        <li><a class="nav-link" href="{{ route('admin.service-wallet.index') }}">Manage Service
                                Provider Point</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.cashout.req') }}">Cash-Out Request</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.doctor-wallet.create') }}">Cash Out</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.doctor-wallet.index') }}">Manage Doctor
                                Point</a></li>
                    </ul>
                </li>
            {{-- @endif --}}

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Moderator' || $admin->role == 'Service Administration') --}}
                <li class="menu-header">Reports</li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="save"></i><span>Reports</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="nav-link" href="{{route('admin.user.activity')}}">User Activity</a>
        </li> --}}
                        <li><a class="nav-link" href="{{ route('admin.report.recharge') }}">User Payment
                                (Recharge) </a></li>
                        <li><a class="nav-link" href="{{ route('admin.report.referral', 'user') }}">User
                                Referral
                            </a></li>
                        <li><a class="nav-link" href="{{ route('admin.report.referral', 'doctor') }}">Doctor
                                Referral </a></li>
                        <li><a class="nav-link"
                                href="{{ route('admin.report.referral', 'service-provider') }}">Service Provider
                                Referral
                            </a></li>
                        <li><a class="nav-link" href="{{ route('admin.report.sales') }}">Sales Report</a></li>
                        <li><a class="nav-link" href="{{ route('admin.most-freq-doc') }}">Most Frequent
                                Doctor</a></li>
                        <li><a class="nav-link" href="{{ route('admin.latest-orders') }}">Latest Orders</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.user.wallet.log') }}">Patient Transaction
                                History</a></li>
                        <li><a class="nav-link" href="{{ route('admin.doctor.wallet.log') }}">Doctor
                                Transaction
                                History</a></li>
                        <li><a class="nav-link" href="{{ route('admin.service-provider.wallet.log') }}">Service
                                provider
                                Transaction History</a></li>
                        {{-- <li><a class="nav-link" href="{{route('admin.service-provider.recharge.log')}}">Service provider
        Recharge History</a></li> --}}
                        <li><a class="nav-link"
                                href="{{ route('admin.service-provider.comission.log') }}">Service provider
                                Comission History</a></li>
                        <li><a class="nav-link" href="{{ route('admin.report.wallet.log') }}">Medimate
                                Commission
                                History</a></li>

                        {{-- <li><a class="nav-link" href="{{route('admin.non-performing-products')}}">Non-Performing Products</a>
        </li>
        <li><a class="nav-link" href="{{route('admin.top-search-products')}}">Top Search Products</a></li> --}}
                    </ul>
                </li>
            {{-- @endif --}}

            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Moderator' || $admin->role == 'Service Administration') --}}
                <li class="menu-header"> Notification </li>

                <li><a class="nav-link" href="{{ route('admin.notify') }}"><i
                            data-feather="send"></i><span>Send
                            New</span></a></li>
                <li><a class="nav-link" href="{{ route('admin.view-notifications') }}"><i
                            data-feather="play"></i><span>View
                            all</span></a>
                </li>
                <li><a class="nav-link" href="{{ route('admin.app-notify.index') }}"><i
                            data-feather="play"></i><span>App Notification</span></a>
                </li>

            {{-- @endif --}}
            {{-- @if ($admin->role == 'Super Admin' || $admin->role == 'Service Administration') --}}
                <li class="menu-header">App Menu</li>


                <li><a class="nav-link" href="{{ route('admin.specialization.index') }}"><i
                            data-feather="git-pull-request"></i><span>Specialization</span></a></li>
                <li><a class="nav-link" href="{{ route('admin.logs') }}"><i
                            data-feather="rotate-ccw"></i><span>System
                            Logs</span></a></li>

                <li class="menu-header">Dynamic Content</li>
                <li><a class="nav-link" href="{{ route('admin.pet.index') }}"><i
                            data-feather="monitor"></i><span>Pet Service</span></a></li>
                <li><a class="nav-link" href="{{ route('admin.ambulance.index') }}"><i
                            data-feather="monitor"></i><span>Ambulance Service</span></a></li>
                <li><a class="nav-link" href="{{ route('admin.diagnostic.index') }}"><i
                            data-feather="monitor"></i><span>Diagnostic Service</span></a></li>
                <li><a class="nav-link" href="{{ route('admin.lab-test.index') }}"><i
                            data-feather="monitor"></i><span>Lab Test</span></a></li>

                {{-- <li><a class="nav-link" href="{{route('admin.feedbacks')}}"><i
            data-feather="thumbs-up"></i><span>Feedback</span></a></li> --}}
                {{-- <li><a class="nav-link" href="{{route('admin.faq')}}"><i data-feather="tag"></i><span>Common
            Docs</span></a>
        </li> --}}


            {{-- @endif --}}

            <li>&nbsp;</li>
            <li>&nbsp;</li>
        </ul>
    </aside>
</div>
