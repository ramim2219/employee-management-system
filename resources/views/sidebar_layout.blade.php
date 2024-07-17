<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Sidebar Toggle</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        main {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            transition: width 0.3s ease;
            overflow: hidden;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a .icon {
            margin-right: 15px;
        }
        .sidebar.collapsed a .text {
            display: none;
        }
        .sidebar.collapsed a {
            justify-content: center;
        }
        .sidebar .toggle-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #495057;
            cursor: pointer;
            padding: 15px;
            transition: background-color 0.3s ease;
        }
        .sidebar .toggle-btn:hover {
            background-color: #6c757d;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<main>
    <div class="sidebar d-flex flex-column p-3">
        <div class="toggle-btn" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </div>
        <ul class="nav nav-pills flex-column mb-auto mt-3">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-tachometer-alt icon"></i> <span class="text">Dashboard</span>
                </a>
            </li>
            @auth
                @if (auth()->user()->role == 1)
                    <li>
                        <a href="{{ route('employee_list') }}" class="nav-link {{ request()->routeIs('employee_list') ? 'active' : '' }}">
                            <i class="fa-solid fa-users icon"></i> <span class="text">Employee List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendence') }}" class="nav-link {{ request()->routeIs('attendence') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-check icon"></i> <span class="text">Attendance</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('signup') ? 'active' : '' }}" href="{{ route('signup') }}">
                            <i class="fa-regular fa-id-card icon"></i> <span class="text">Add Employee</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('countMonthlySellary') }}" class="nav-link {{ request()->routeIs('countMonthlySellary') ? 'active' : '' }}">
                            <i class="fa-solid fa-money-check-alt icon"></i> <span class="text">Monthly Payment Count</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee_position') }}" class="nav-link {{ request()->routeIs('employee_position') ? 'active' : '' }}">
                            <i class="fa-solid fa-briefcase icon"></i> <span class="text">Add Employee Position</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('position_details') }}" class="nav-link {{ request()->routeIs('position_details') ? 'active' : '' }}">
                            <i class="fa-solid fa-info-circle icon"></i> <span class="text">Position Details</span>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 0)
                    <li>
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-money-bill-wave icon"></i> <span class="text">Your Payment Details</span>
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
    }
</script>

</body>
</html>
