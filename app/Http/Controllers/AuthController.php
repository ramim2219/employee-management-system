<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function make_admin()
    {
        return view('make_admin');
    }
    public function signup()
    {
        return view('login_signUp_page.signup');
    }
    public function login()
    {
        return view('login_signUp_page.login');
    }
    public function employeeDetails($id)
    {
        $employee = DB::table('users')->find($id);

        if (!$employee) {
            abort(404);
        }
        $positions = Position::all();
        return view('login_signUp_page.employee_details', compact('employee', 'id', 'positions'));
    }
    public function employeeDetailsSave(Request $req, $id)
    {
        $req->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'image' => 'required|mimes:png,jpg,jpeg|max:3000',
            'position_id' => 'required'
        ]);
        if ($req->hasFile('image')) {
            $path = $req->file('image')->store('images', 'public');
            $user = DB::table('employee')->insert([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'Address' => $req->address,
                'phone_number' => $req->phone_number,
                'user_id' => $id,
                'file' => $path,
                'employee_position' => $req->position_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            if ($user) {
                return redirect()->route('dashboard')->with('success', 'Employee details saved successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Image upload failed');
        }
    }

    public function registration(Request $req)
    {
        $data = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Hash the password before saving
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        if ($user) {
            // Ensure the query includes the 'id' column
            $toEmail = $req->email;
            $message = "Hello,".$req->name." Welcome to our Website";
            $subject = "Welcome to ramim's website ";

            Mail::to($toEmail)->send(new WelcomeEmail($message,$subject));
            $lastInsertedUser = DB::table('users')->select('id')->latest()->first();
            if ($lastInsertedUser)
            {
                return redirect()->route('employee_details', ['id' => $lastInsertedUser->id]);
            }
            else
            {
                return redirect()->route('signup')->with('error', 'No user found');
            }
        } else {
            return redirect()->route('signup');
        }
    }
    
    public function registrationAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);
        if($user)
        {
            return redirect()->route('login');
        }
        else
        {
            return redirect()->route('signup');
        }
    }
    public function loginMatch(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $checkLoginCredentials = $request->only('email', 'password');
        
        if (Auth::attempt($checkLoginCredentials)) {
            return redirect()->route('dashboard')->with('success', 'You are logged in successfully.');
        }
        return redirect()->route('login')->withErrors('Your login credentials are incorrect.');
    }
    public function dashboardPage()
    {
        if (auth()->check()) 
        {
            if (auth()->user()->role == 1) 
            {
                $employees = DB::table('attendances as a')
                    ->join('employee as e', 'a.user_id', '=', 'e.employee_id')
                    ->select(
                        'e.employee_id',
                        DB::raw("CONCAT(e.first_name, ' ', e.last_name) AS employee_name"),
                        DB::raw("SUM(TIMESTAMPDIFF(HOUR, a.check_in, a.check_out)) AS total_hours_worked"),
                        DB::raw("MONTHNAME(CURRENT_DATE()) AS present_month")
                    )
                    ->whereMonth('a.date', date('m'))
                    ->whereYear('a.date', date('Y'))
                    ->whereNotNull('a.check_in')
                    ->whereNotNull('a.check_out')
                    ->groupBy('e.employee_id', 'e.first_name', 'e.last_name')
                    ->get();

                return view('admin_page.dashboard', ['employees' => $employees]);
            } 
            else if (auth()->user()->role == 0) 
            {
                $user = Auth::user();
                $employee = DB::table('employee')
                    ->where('user_id', $user->id)
                    ->first();
                $pos = DB::table('position')->where('id', $employee->employee_position)->first();
                return view('employee_page.dashboard', [
                    'user' => $user,
                    'employee' => $employee,
                    'position' => $pos,
                ]);
            } 
            else 
            {
                return redirect()->route('login');
            }
        } 
        else 
        {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('login_signUp_page.login');
    }

    // Employee Position
    public function employee_position()
    {
        $user2 = Position::orderBy('created_at','DESC')->get();
        return view('admin_page.add_new_position',[
            'position' => $user2
        ]);
    }
    public function positionSave(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:50',
            'selary' => 'required'
        ]);
        $user = DB::table('position')->insert([
            'name' => $req->name,
            'selary' => $req->selary,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        if($user)
        {
            return redirect()->route('position_details');
        }
    }
    public function position_details()
    {
        $user2 = Position::orderBy('created_at','DESC')->get();
        return view('admin_page.position_details',[
            'position' => $user2
        ]);
    }
    public function position_Delete(string $id)
    {
        $deletePosition = DB::table('position')
                        ->where('id', $id) 
                        ->delete();
        if($deletePosition)
        {
            return redirect()->route('position_details');
        }
    }

    // position
    public function UpdatePositionPage(string $id)
    {
        $user = DB::table('position')->where('id',$id)->get();
        return view('admin_page.UpdatePositionPage',[
            'data'=>$user
        ]);
    }
    public function UpdatePosition(Request $req,$id)
    {
        $user = DB::table('position')->where('id', $id)->first();
        $req->validate([
            'name' => 'required|string|max:50',
            'Salary' => 'required|integer'
        ]);

        $updateData = [
            'selary' => $req->Salary,
            'name' => $req->name,
            'updated_at' => now(),
        ];
        $user2 = DB::table('position')->where('id', $id)->update($updateData);

        if ($user2) {
            return redirect()->route('position_details')->with('success', 'Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Update failed');
        }
    }
    
    //employee crud
    public function employee_list()
    {
        $employees = DB::table('employee')
            ->join('position', 'employee.employee_position', '=', 'position.id')
            ->select(
                'employee.*',
                'position.name as position_name'
            )
            ->orderBy('employee.created_at', 'DESC')
            ->get();

        return view('admin_page.employee_list', [
            'employees' => $employees
        ]);
    }
    public function UpdateEmployeePage(string $id)
    {
        $user=DB::table('employee')->where('employee_id',$id)->get();
        $positions = DB::table('position')->get();
        return view('admin_page.UpdateEmployeePage', [
            'data' => $user,
            'positions' => $positions
        ]);
    }
    public function updateEmployee(Request $req, $id)
    {
        $user = DB::table('employee')->where('employee_id', $id)->first();
        $req->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'position_id' => 'required|integer|exists:position,id', // Validate position_id
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:3000'
        ]);

        $updateData = [
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'Address' => $req->address,
            'phone_number' => $req->phone_number,
            'employee_position' => $req->position_id, // Update position ID
            'updated_at' => now(),
        ];

        if ($req->hasFile('image')) {
            $image_path = public_path("storage/") . $user->file;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $path = $req->file('image')->store('images', 'public');
            $updateData['file'] = $path;
        }

        $user2 = DB::table('employee')->where('employee_id', $id)->update($updateData);

        if ($user2) {
            return redirect()->route('employee_list')->with('success', 'Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Update failed');
        }
    }

    public function deleteEmployee(string $id)
    {
        $user = DB::table('employee')
                ->where('employee_id', $id)
                ->first();
        $image_path = public_path("storage/") . $user->file;
        @unlink($image_path);
        $user_id = $user->user_id;
        $deleteUser = DB::table('users')
                ->where('id', $user_id) // Use employee_id instead of id
                ->delete();
        $deleteEmployee = DB::table('employee')
                    ->where('employee_id', $id) // Use employee_id instead of id
                    ->delete();
        if($deleteUser && $deleteEmployee)
        {
            ?>
                <script>
                    alert("deleted successfully")
                </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    alert("not deleted")
                </script>
            <?php
        }
        return redirect()->route('employee_list');
    }

    //attendence
    public function attendence()
    {
        $data = Employee::all();
        return view('admin_page.attendence',compact('data'));
    }
    public function EmployeeAttendenceSave(Request $request)
    {
        $employeesData = $request->input('employee');
        foreach($employeesData as $employeeData)
        {
            DB::table('attendances')->insert([
                'user_id' => $employeeData['user_id'],
                'attendence' => $employeeData['attendence'], 
                'check_in' => $employeeData['check_in'] ?? null,
                'check_out' => $employeeData['check_out'] ?? null,
                'date' => $employeeData['date'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('dashboard');
    }

    //payroll
    public function countMonthlySellary()
    {
        return view('admin_page.paymentCount');
    }
    public function paymentCountResult(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $offday = $request->input('offday');
        $hoursPerDay = $request->input('hours_per_day');

        // Query to calculate hours worked and get salary for each employee
        $results = DB::table('attendances')
            ->join('employee', 'attendances.user_id', '=', 'employee.employee_id')
            ->join('position', 'employee.employee_position', '=', 'position.id')
            ->select(
                'employee.employee_id',
                'employee.first_name',
                'employee.last_name',
                'position.selary as salary',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in, check_out)) AS hours_worked')
            )
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy('employee.employee_id', 'employee.first_name', 'employee.last_name', 'position.selary')
            ->get();

        // Calculate total days in the specified month
        $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Calculate overtime and salary for each employee
        foreach ($results as $result) {
            $overtime = $result->hours_worked - (($totalDaysInMonth - $offday) * $hoursPerDay);
            $result->overtime = max(0, $overtime);
            $result->salary = ($result->hours_worked + $result->overtime) * $result->salary; // Assuming $result->salary is the hourly rate
            $result->payment_status = $this->getPaymentStatus($result->employee_id, $year, $month);
        }

        // Pass data to the view
        return view('admin_page.paymentCountResult', compact('year', 'month', 'offday', 'hoursPerDay', 'results'));
    }

    private function getPaymentStatus($employee_id, $year, $month)
    {
        $payment = DB::table('payment_details')
                    ->where('employee_id', $employee_id)
                    ->where('year', $year)
                    ->where('month', $month)
                    ->first();

        return $payment ? $payment->status : 0;
    }
    public function pay_monthly_bill(Request $request, $employeeId)
    {
        $employee = Employee::where('employee_id', $employeeId)->first();
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        $fullName = $employee->first_name . ' ' . $employee->last_name;
        $phoneNumber = $employee->phone_number;
        return view('stripe', compact('employeeId', 'fullName', 'phoneNumber'));
    }



    //task
    public function give_task()
    {
        $employees = DB::table('employee')
            ->join('position', 'employee.employee_position', '=', 'position.id')
            ->select(
                DB::raw("CONCAT(employee.first_name, ' ', employee.last_name) as full_name"),
                'employee.user_id',
                'position.name as position_name'
            )
            ->get();
        return view('admin_page.give_task_page', [
            'employees' => $employees
        ]);
    }
    public function saveTask(Request $req)
    {
        $data = $req->validate([
            'employee_id' => 'required',
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string'
        ]);
        DB::table('assign_task')->insert([
            'employee_id' => $data['employee_id'],
            'title' => $data['task_title'],
            'description' => $data['task_description'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success', 'Task has been assigned successfully.');
    }
    public function taskShow()
    {
        $userId = auth()->user()->id;
        $tasks = DB::table('assign_task')
            ->where('employee_id', $userId)
            ->get();
        //dd($tasks);
        return view('employee_page.showTask', ['tasks' => $tasks]);

    }
    public function getEmployeesByPosition($positionId)
    {
        $employees = Employee::where('employee_position', $positionId)->get();
        return response()->json($employees);
    }
    public function updateTaskStatus($id)
    {
        $task = DB::table('assign_task')->where('id', $id)->first();
        return view('employee_page.taskReport', compact('task'));
    }
    public function updateTask(Request $req)
    {
        // Validate the incoming request data
        $req->validate([
            'task_id' => 'required|integer',
            'task_report' => 'required|string',
        ]);

        // Update the task using the DB facade
        $updated = DB::table('assign_task')
        ->where('id', $req->task_id)
        ->update([
            'task_report' => $req->task_report,
            'status' => 1, // Set status to 1
        ]);

        if ($updated) {
            // Optionally redirect or return a response
            return redirect()->back()->with('success', 'Task updated successfully.');
        } else {
            // Handle the case where the task is not found or no update was made
            return redirect()->back()->with('error', 'Task not found or no changes made.');
        }
    }
    public function ApproveTask($id)
    {
        $task = DB::table('assign_task')->where('id', $id)->first();
        if ($task) {
            DB::table('assign_task')->where('id', $id)->update(['status' => 2]);
            return redirect()->back()->with('success', 'Task approved successfully.');
        } else {
            return redirect()->back()->with('error', 'Task not found.');
        }
    }

    public function CancelTask($id)
    {
        $task = DB::table('assign_task')->where('id', $id)->first();
        if ($task) {
            DB::table('assign_task')->where('id', $id)->update(['status' => 0]);
            return redirect()->back()->with('success', 'Task canceled successfully.');
        } else {
            return redirect()->back()->with('error', 'Task not found.');
        }
    }


    public function allAssignedTasks()
    {
        $tasks = DB::table('assign_task')
            ->join('employee', 'employee.user_id', '=', 'assign_task.employee_id')
            ->select('assign_task.*', DB::raw("CONCAT(employee.first_name, ' ', employee.last_name) AS full_name"))
            ->get()
            ->map(function($task) {
                $task->created_at = Carbon::parse($task->created_at)->format('d M Y, h:i A');
                return $task;
            });

        return view('admin_page.allAsignedTask', compact('tasks'));
    }


    //employee payment details 
    public function payment_details()
    {
        // Fetch the employee ID based on the authenticated user
        $employeeId = DB::table('employee as e')
                    ->join('users as u', 'e.user_id', '=', 'u.id')
                    ->where('u.id', auth()->user()->id)
                    ->value('e.employee_id');

        // Fetch monthly salaries
        $monthlySalaries = DB::table('attendances as a')
                        ->join('employee as e', 'a.user_id', '=', 'e.employee_id')
                        ->join('position as p', 'e.employee_position', '=', 'p.id')
                        ->select(
                            'e.employee_id',
                            DB::raw("CONCAT(e.first_name, ' ', e.last_name) as employee_name"),
                            DB::raw("DATE_FORMAT(a.date, '%Y-%m') as month"),
                            DB::raw('SUM(p.selary) as total_salary')
                        )
                        ->where('a.user_id', $employeeId)
                        ->groupBy('e.employee_id', 'employee_name', 'month')
                        ->orderBy('month', 'desc')
                        ->get();

        // Add payment status, year, and month to each record
        $monthlySalaries = $monthlySalaries->map(function ($salary) {
            $year = substr($salary->month, 0, 4);
            $month = substr($salary->month, 5, 2);
            $salary->payment_status = $this->getPaymentStatus($salary->employee_id, $year, $month);
            $salary->year = $year;
            $salary->month = $month;
            return $salary;
        });
        // Pass to view
        return view('employee_page.payment_details', ['monthlySalaries' => $monthlySalaries]);


        return view('employee_page.payment_details',compact('monthlySalaries'));
    }
}