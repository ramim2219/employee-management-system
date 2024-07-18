<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Professional Sidebar</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        main {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 80px;
            background-color: #343a40;
            color: #fff;
            transition: width 0.3s ease;
            overflow: hidden;
        }
        .sidebar.collapsed {
            width: 250px;
        }
        .sidebar .toggle-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #495057;
            cursor: pointer;
            padding: 16px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px; /* Adjust margin bottom for spacing */
        }
        .sidebar.collapsed .toggle-btn {
            background-color: #343a40; /* Change toggle button background when sidebar is collapsed */
        }
        .sidebar .toggle-btn:hover {
            background-color: #6c757d;
        }
        .sidebar .text {
            display: none;
        }
        .sidebar.collapsed .text {
            display: inline;
        }
        .sidebar .toggle-btn.collapsed i {
            transform: rotate(180deg); /* Rotate icon when sidebar is collapsed */
        }
        .sidebar .toggle-btn i {
            font-size: 1.2rem; /* Adjust icon size */
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li
        {
            display: flex;
            justify-content: center;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 16px 20px;
            transition: background-color 0.3s ease;
            width: 100%; /* Make each link full width of sidebar */
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar li.active {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<main>
    <div class="sidebar">
        <div class="toggle-btn collapsed" onclick="toggleSidebar()">
            <i class="fas fa-bars icon"></i>
        </div>
        <ul>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt icon"></i> <span class="text">Dashboard</span>
                </a>
            </li>
            @auth
                @if (auth()->user()->role == 1)
                    <li class="{{ request()->routeIs('employee_list') ? 'active' : '' }}">
                        <a href="{{ route('employee_list') }}">
                            <i class="fas fa-users icon"></i> <span class="text">Employee List</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('attendence') ? 'active' : '' }}">
                        <a href="{{ route('attendence') }}">
                            <i class="fas fa-calendar-check icon"></i> <span class="text">Attendance</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('signup') ? 'active' : '' }}">
                        <a href="{{ route('signup') }}">
                            <i class="far fa-id-card icon"></i> <span class="text">Add Employee</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('countMonthlySellary') ? 'active' : '' }}">
                        <a href="{{ route('countMonthlySellary') }}">
                            <i class="fas fa-money-check-alt icon"></i> <span class="text">Monthly Payment Count</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('employee_position') ? 'active' : '' }}">
                        <a href="{{ route('employee_position') }}">
                            <i class="fas fa-briefcase icon"></i> <span class="text">Add Employee Position</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('position_details') ? 'active' : '' }}">
                        <a href="{{ route('position_details') }}">
                            <i class="fas fa-info-circle icon"></i> <span class="text">Position Details</span>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 0)
                    <li>
                        <a href="#">
                            <i class="fas fa-money-bill-wave icon"></i> <span class="text">Your Payment Details</span>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>
</main>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.sidebar').classList.toggle('expanded'); // Add expanded class
    }
</script>

</body>
</html>
