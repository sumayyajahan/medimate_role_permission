<head>
    <title>Admin Dashboard</title>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js"></script>

</head>

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                            collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
            <!-- <li>
                <form class="form-inline mr-auto">
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </li> -->
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello </div>
                <!-- <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                                fa-user"></i> Profile
                </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                    Activities -->
                </a>
                <a href="./change-password.php" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="./dashboard.php"> <span class="logo-name">Medimate</span>
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="assets/img/user.png">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"></div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="./dashboard.php"><i data-feather="monitor"></i><span>Dashboard</span></a></li>

            <li class="menu-header">Create-View</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="plus"></i><span>Create</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add-admin.php">Admin</a></li>
                    <li><a class="nav-link" href="add-user.php">User</a></li>
                    <li><a class="nav-link" href="add-doctor.php">Doctor</a></li>
                    <li><a class="nav-link" href="add-pharmacy.php">Pharmacy</a></li>
                    <li><a class="nav-link" href="add-pharmacy-salesman.php">Pharmacy Sale Rep.</a></li>
                    <li><a class="nav-link" href="add-insurance.php">Insurance Company</a></li>
                    <li><a class="nav-link" href="add-insurance-package.php">Insurance Package</a></li>
                    <li><a class="nav-link" href="add-product.php">Product</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>View</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="manage-admin.php">Admin</a></li>
                    <li><a class="nav-link" href="manage-user.php">User</a></li>
                    <li><a class="nav-link" href="manage-doctor.php">Doctor</a></li>
                    <li><a class="nav-link" href="manage-pharmacy.php">Pharmacy</a></li>
                    <li><a class="nav-link" href="manage-pharmacy-reps.php">Pharmacy Sale Rep.</a></li>
                    <li><a class="nav-link" href="manage-insurance-company.php">Insurance Company</a></li>
                    <li><a class="nav-link" href="manage-ins-package.php">Insurance Package</a></li>
                    <li><a class="nav-link" href="manage-product.php">Products</a></li>
                    <li><a class="nav-link" href="manage-p-order.php">Pending Orders</a></li>
                    <li><a class="nav-link" href="manage-d-order.php">Delivered Orders</a></li>
                </ul>
            </li>

            <li class="menu-header">Wallet</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Wallet</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="recharge.php">Wallet Recharge</a></li>
                    <li><a class="nav-link" href="withdraw.php">Withdraw Amount</a></li>
                    <li><a class="nav-link" href="user-wallet.php">User Wallet</a></li>
                    <li><a class="nav-link" href="doctor-wallet.php">Doctor Wallet</a></li>
                    <li><a class="nav-link" href="all-transaction.php">Transaction History</a></li>
                </ul>
            </li>


            <li class="menu-header">Reports</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="save"></i><span>Reports</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="user-activity.php">User Activity</a></li>
                    <li><a class="nav-link" href="recharge-history.php">User Payment (Recharge) </a></li>
                    <li><a class="nav-link" href="appointments.php">Doctor Appointment</a></li>
                    <li><a class="nav-link" href="sales.php">Sales Report</a></li>
                    <li><a class="nav-link" href="most-freq-doc.php">Most Frequent Doctor</a></li>
                    <li><a class="nav-link" href="top-search-products.php">Top Search Products</a></li>
                    <li><a class="nav-link" href="latest-orders.php">Latest Orders</a></li>
                    <li><a class="nav-link" href="non-performing-products.php">Non-Performing Products</a></li>
                </ul>
            </li>

            <li class="menu-header"> Notification </li>

            <li><a class="nav-link" href="notify.php"><i data-feather="layout"></i><span>Send New</span></a></li>
            <li><a class="nav-link" href="view-notifications.php"><i data-feather="play"></i><span>View all</span></a></li>

            <li class="menu-header">Feedback</li>

            <li><a class="nav-link" href="feedbacks.php"><i data-feather="package"></i><span>Feedback</span></a></li>
            <br>
            <li>
                <a class="nav-link">
                    <span>
                        <small style="color:tomato;">Last login Recorded
                            <br>
                        </small>
                    </span>
                </a>
            </li>

        </ul>
    </aside>
</div>


<div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                        <span class="selectgroup-button">Light</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                        <span class="selectgroup-button">Dark</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                    <ul class="choose-theme list-unstyled mb-0">
                        <li title="white" class="active">
                            <div class="white"></div>
                        </li>
                        <li title="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li title="black">
                            <div class="black"></div>
                        </li>
                        <li title="purple">
                            <div class="purple"></div>
                        </li>
                        <li title="orange">
                            <div class="orange"></div>
                        </li>
                        <li title="green">
                            <div class="green"></div>
                        </li>
                        <li title="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Mini Sidebar</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Sticky Header</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                    <i class="fas fa-undo"></i> Restore Default
                </a>
            </div>
        </div>
    </div>
</div>