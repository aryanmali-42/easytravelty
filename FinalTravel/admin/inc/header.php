<style>
    /* Improved Dashboard CSS */
    .admin-header {
        background: linear-gradient(135deg, #2c3e50, #3498db);
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .admin-header h3 {
        color: white;
        font-weight: 600;
        letter-spacing: 1.5px;
    }

    #dashboard-menu {
        background: #f8f9fa;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.02);
        min-height: 100vh;
    }

    .nav-pills {
        gap: 8px;
        padding: 15px;
    }

    .nav-link {
        color: #495057;
        font-weight: 500;
        border-radius: 8px;
        padding: 12px 20px !important;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .nav-link:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .nav-link.active {
        background: #3498db !important;
        color: white !important;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-top: -5px;
        border-radius: 8px;
        padding: 8px;
        min-width: 230px;
    }

    .dropdown-item {
        padding: 10px 20px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        transform: translateX(3px);
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .admin-panel-title {
        color: #2c3e50;
        font-weight: 700;
        padding: 20px 15px;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .logout-btn {
        background: #e74c3c;
        color: white !important;
        padding: 8px 25px !important;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: #c0392b;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid admin-header p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0">
        <i class="fas fa-compass me-2"></i>EaSyTrAvEl
    </h3>
    <a href="logout.php" class="btn logout-btn shadow-sm">
        <i class="fas fa-sign-out-alt me-2"></i>LOG OUT
    </a>
</div>

<div class="col-lg-2     bg-light shadow-sm" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-light rounded">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="admin-panel-title">
                <i class="fas fa-user-shield me-2"></i>Admin Panel
            </h4>
            <div class="collapse navbar-collapse w-100 mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fas fa-calendar-check me-2"></i>Booking
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="newbookings.php">
                                    <i class="fas fa-plus-circle me-2"></i>New Bookings
                                </a></li>
                            <li><a class="dropdown-item" href="refundbookings.php">
                                    <i class="fas fa-undo me-2"></i>Refund Bookings
                                </a></li>
                            <li><a class="dropdown-item" href="bookingrecords.php">
                                    <i class="fas fa-database me-2"></i>Booking Records
                                </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-users me-2"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_question.php">
                            <i class="fas fa-question-circle me-2"></i>User Questions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rate_review.php">
                            <i class="fas fa-ticket"></i>Reatings And Reviews
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fas fa-cube me-2"></i>Packages
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="packages.php">
                                    <i class="fas fa-box-open me-2"></i>Packages
                                </a></li>
                            <li><a class="dropdown-item" href="packagefeatures.php">
                                    <i class="fas fa-star me-2"></i>Package Features
                                </a></li>
                            <li><a class="dropdown-item" href="packagefacilities.php">
                                    <i class="fas fa-hotel me-2"></i>Package Facilities
                                </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>



<!-- 
<style>
    /* Ensure the dropdown is visible when hovering over the parent */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Ensure the dropdown menu is hidden by default */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
    }
</style>
<div class="container-fluid bg-light text-dark p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">
        EaSyTrAvEl </h3>
    <a href="logout.php" class="btn  border-dark btn-sm">LOGG OUT</a>
</div>

<div class="col-lg-2  bg-light border-top border-3 border-secondary shadow" id="dashboard-menu">
    <nav class="navbar   navbar-expand-lg navbar-light bg-light rounded  border-3 ">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-dark">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminDropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse align-self-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="packagesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Packages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="packagesDropdown">
                            <li><a class="dropdown-item" href="packages.php">Packages</a></li>
                            <li><a class="dropdown-item" href="packagefeatures.php">Package Features</a></li>
                            <li><a class="dropdown-item" href="packagefacilities.php">Package Facilities</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="user_question.php">Users Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</div> -->