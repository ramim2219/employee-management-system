<style>
    main {
        display: flex;
        min-height: 100vh;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
    }
    .sidebar a {
        color: #fff;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .content {
        flex-grow: 1;
        padding: 20px;
    }
</style>
<div class="sidebar d-flex flex-column p-3">
    <h2>Sidebar</h2>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        @auth
            @if (auth()->user()->role==1)
                <li>
                    <a href="{{ route('employee_list') }}" class="nav-link {{ request()->routeIs('employee_list') ? 'active' : '' }}">
                        Employee List
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendence') }}" class="nav-link {{ request()->routeIs('attendence') ? 'active' : '' }}">
                        Attendence
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('signup') ? 'active' : '' }}" href="{{ route('signup') }}">
                        <i class="fa-regular fa-id-card"></i> Add Employee
                    </a>
                </li>
                <li>
                    <a href="{{ route('countMonthlySellary') }}" class="nav-link {{ request()->routeIs('countMonthlySellary') ? 'active' : '' }}" aria-current="page">
                        Monthly Payment Count
                    </a>
                </li>
            @elseif (auth()->user()->role==0)
                <li>
                    <a href="#" class="nav-link">
                        Your Payment Details
                    </a>
                </li>
            @endif
            
        @endauth
    </ul>
</div>
