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
        // Assuming you have a separate employee table
        $employee = DB::table('users')->find($id);

        if (!$employee) {
            abort(404); // Handle the case where the employee is not found
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

        // Debugging log to check if file is being uploaded
        if ($req->hasFile('image')) {
            $path = $req->file('image')->store('images', 'public');
            // Log the stored file path
            // Log::info('Image Path: ' . $path);

            // Create a new employee using the validated data
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
        if(auth()->user()->role == 1)
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
        else if(auth()->user()->role == 0)
        {
            $user = Auth::user();
            $employee = DB::table('employee')
                ->where('user_id', $user->id)
                ->first();
                $pos = DB::table('position')->where('id', $employee->employee_position)->first();
            return view('employee_page.dashboard', [
                'user' => $user,
                'employee' => $employee,
                'position' =>$pos,
            ]);
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
        return redirect()->route('dashboardPage');
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

        // Query to calculate hours worked for each employee
        $results = DB::table('attendances')
                    ->join('employee', 'attendances.user_id', '=', 'employee.employee_id')
                    ->select('employee.employee_id', 'employee.first_name', 'employee.last_name',
                            DB::raw('SUM(TIMESTAMPDIFF(HOUR, check_in, check_out)) AS hours_worked'))
                    ->whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->groupBy('employee.employee_id', 'employee.first_name', 'employee.last_name')
                    ->get();

        // Calculate total days in the specified month
        $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Calculate overtime and salary for each employee
        foreach ($results as $result) {
            $overtime = $result->hours_worked - (($totalDaysInMonth - $offday) * $hoursPerDay);
            $result->overtime = max(0, $overtime);
            $result->salary = ($result->hours_worked + $result->overtime) * 100;
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
    public function pay_monthly_bill(Request $request)
    {
        return view('admin_page.pay_monthly_bill');
    }
}