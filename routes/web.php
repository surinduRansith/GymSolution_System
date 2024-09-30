<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\memberScheduleListController;
use App\Http\Controllers\membersController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\schedules_typesController;
use App\Models\Attendance;
use App\Models\Members;
use App\Models\Payments;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;


use Illuminate\Validation\Rule;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function (Request $request) {


    $userscount = Members::count();
    $userscountactive = Members::where('status', 'active')->count();
    $userscountinactive = Members::where('status', 'inactive')->count();


    $monthsnames = [
        "January", "February", "March", "April", "May", "June", 
        "July", "August", "September", "October", "November", "December"
    ];
    $monthindex=Carbon::now()->month-1;
    
    if($request->input('monthcount')=='add'){
        $monthindex=$request->input('month');



        $monthindex++;

        if ($monthindex >= count($monthsnames)) {
            $monthindex = 0; // Wrap around to January
        }

    }
    if($request->input('monthcount')=='min'){

        $monthindex=$request->input('month');



        $monthindex--;

        if ($monthindex < 0) {
            $monthindex = 0; // Wrap around to January
        }

    }
    
    $targetMonth = $monthindex+1;
    $year = Carbon::now()->year;  // Default to the current year

    // Create first and last day of the month based on the provided or default month
    $firstDayOfMonth = Carbon::create($year, $targetMonth)->startOfMonth()->toDateString();
    $lastDayOfMonth = Carbon::create($year, $targetMonth)->endOfMonth()->toDateString();

    
    // Fetch attendance data
    $userAttendancecount = DB::table('attendances')
        ->select(DB::raw('MONTH(attendancedate) as month_number, attendancedate, COUNT(id) as daily_count'))
        ->whereBetween('attendancedate', [$firstDayOfMonth, $lastDayOfMonth])
        ->groupBy('attendancedate')
        ->orderBy('attendancedate', 'asc')
        ->get();
    
        $monthlyincome = Payments::where('created_at', '>=', $firstDayOfMonth)->where('created_at', '<=', $lastDayOfMonth)->sum('amount');

    return view('dashboard', compact('userscount','monthsnames','monthindex','userscountactive','userscountinactive','userAttendancecount','monthlyincome'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/dashboard/{targetMonth}', function ( Request $request,$targetMonth) {

    
    $targetMonth = $request->input('month', Carbon::now()->month);
    $year = Carbon::now()->year;  // Default to the current year

    // Create first and last day of the month based on the provided or default month
    $firstDayOfMonth = Carbon::create($year, $targetMonth)->startOfMonth()->toDateString();
    $lastDayOfMonth = Carbon::create($year, $targetMonth)->endOfMonth()->toDateString();

    // Fetch attendance data
    $userAttendancecount = DB::table('attendances')
        ->select(DB::raw('MONTH(attendancedate) as month_number, attendancedate, COUNT(id) as daily_count'))
        ->whereBetween('attendancedate', [$firstDayOfMonth, $lastDayOfMonth])
        ->groupBy('attendancedate')
        ->orderBy('attendancedate', 'asc')
        ->get();

    return view('dashboard', compact('userAttendancecount'));
})->middleware(['auth', 'verified'])->name('dashboardtna.count');



Route::middleware('auth')->group(function () {
 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/members', [MembersController::class,'ShowMembers'])->name('members.data');
    Route::get('/form', function () {
        return view('form',);
    })->name('membersregistration.data');
    Route::post('/form', [MembersController::class, 'createMember'])->name('insert.data');




Route::get('/members/{id}', [MembersController::class,'ShowMemberDetails'])->name('members.profile');
Route::delete('/members/{id}', [MembersController::class,'deleteMemberDetails'])->name('membersdelete.delete');

Route::put('/members/{id}', [MembersController::class,'weightUpdate'])->name('weight.update');

Route::put('/members/{id}/status', [MembersController::class, 'statusUpdate'])->name('memberstatus.update');


Route::post('/members/{id}', [ExerciseController::class, 'addtype'])->name('scheduletype.add');

Route::post('/members/{id}', [SchedulesController::class, 'storeSchedule'])->name('updateshedule.insert');

Route::get('/members/{id}/edit', [MembersController::class,'EditMember'])->name('members.edit');

Route::put('/members/{id}/edit', [MembersController::class,'EditMemberDetails'])->name('update.data');

Route::get('/scheduletypes', [ExerciseController::class, 'index'])->name('scheduletype.insert');

Route::post('/scheduletypes', [ExerciseController::class, 'addtype'])->name('exersice.add');
Route::get('/scheduletypes', [ExerciseController::class, 'getScheculeType'])->name('scheduletype.insert');
Route::post('/scheduletypes/group', [schedules_typesController::class, 'storeSchedulesTypes'])->name('schedulegroup.data');
Route::get('/members/{id}/editschedule/{scheduleid}', [MembersController::class, 'memberscheduleEditpage'])->name('memberscheduleedit.show');
Route::put('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleUpdate'])->name('memberScheduleedit.update');
Route::delete('/members/{id}/editschedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduleeditpagedelete.delete');
Route::delete('/members/{id}/schedule/{scheduleid}', [SchedulesController::class, 'memberscheduleDelete'])->name('memberscheduledelete.delete');
Route::get('/members/{id}/schedule', [SchedulesController::class, 'memberAllscheduleDelete'])->name('memberallscheduledelete.delete');
Route::get('/members/{id}/generatepdf', [memberScheduleListController::class,'memberScheduleList'])->name('memberschedulelist.data');

Route::get('/members/{id}/payment', [PaymentsController::class,'ShowPaymentPage'])->name('paymentpage.data');
Route::post('/members/{id}/payment', [PaymentsController::class,'addPayment'])->name('paymentpage.insert');
Route::get('/members/{id}/payment/{month}', [PaymentsController::class,'deletePaymentPage'])->name('paymentpage.delete');
Route::delete('/members/{id}/payment/{payment}', [PaymentsController::class,'deletePaymentPageAnnual'])->name('paymentpageAnnual.delete');
Route::get('/members/{id}/attendance', [AttendanceController::class,'show'])->name('attendance.show');
Route::post('/members/{id}/attendance', [AttendanceController::class,'markAttendance'])->name('attendance.insert');

Route::get('/attendancereport', function (Request $request) {

    $members = Members::all();

    
    $userAttendance = Attendance::all()->where('member_id',$request->input('memberid'));

    return view('attendancereport',compact('members','userAttendance'));
})->name('attendancereport.show');



Route::post('/attendancereport', function (Request $request) {

    $members = Members::all();

    $request->validate([
        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
        'memberid' => [
            'required',
            Rule::in($members->pluck('id')->toArray())
        ],
    ]);

    $memberId = $request->input('memberid');
    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');

    $userAttendance = Attendance::join('members', 'attendances.member_id', '=', 'members.id')
        ->select('attendances.*', 'members.name as name')
        ->where('attendances.member_id', $memberId)
        ->whereBetween('attendances.attendancedate', [$startDate, $endDate]) // Use the correct date column name
        ->orderBy('attendances.attendancedate', 'asc')
        ->get();

        

    return view('attendancereport', compact('members', 'userAttendance'));
})->name('attendancereport1.show');


Route::get('/paymentreport', function (Request $request) {

    $members = Members::all();
    $allusers = $request->input('allusers');
    if($allusers == 1){

        $payments =Payments::all();

    }else{

        

        $payments =Payments::all()->where('member_id',$request->input('memberid'));
    }
    $testvalue =1;
    return view('paymentreport',compact('members','payments','testvalue'));
})->name('paymentreport.show');


Route::post('/paymentreport', function (Request $request) {

    $members = Members::all();

    $validatedData = $request->validate([
        'memberid' => [
            'nullable', // memberid is optional
            Rule::in($members->pluck('id')->toArray()) // Validates only if provided
        ],
        'allusers' => 'nullable|boolean', // allusers is optional but should be a boolean if provided
        // Ensure at least one of the fields is present
        'memberid' => 'required_without:allusers',
        'allusers' => 'required_without:memberid',

        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
    ]);

    // Retrieve input values
    $memberId = $request->input('memberid');
    $testvalue = $request->input('testvalue');
    $allusers = $request->input('allusers');
    $startDate1 = $request->input('startdate');
    $endDate1 = $request->input('enddate');

    // Build the query based on input
    if ($allusers) {
        // Fetch all payments if allusers is selected
        $payments = Payments::join('members', 'payments.member_id', '=', 'members.id')
            ->select('payments.*', 'members.name as name')
            ->whereBetween('payments.created_at', [$startDate1, $endDate1]) // Use the correct date column name
        ->orderBy('payments.member_id', 'asc')
            ->get();
    } else {
        // Fetch payments for a specific member
        $payments = Payments::join('members', 'payments.member_id', '=', 'members.id')
            ->select('payments.*', 'members.name as name')
            ->where('payments.member_id', $memberId)
            ->get();
    }

      

    return view('paymentreport',compact('members','payments','testvalue','allusers','startDate1','endDate1'));
})->name('userpaymentreport.show');

Route::get('/paymentreport/{id}/generatepdf', function (Request $request,$id) {

  
    $memberId = $id;

    $payments =Payments::join('members', 'payments.member_id', '=', 'members.id')
        ->select('payments.*', 'members.name as name')
        ->where('payments.member_id', $memberId)
        ->get();

        $data=[
           
            'payments'=> $payments

        ];

        $pdf = Pdf::loadView('Pdf.memberpaymentreportpdf',$data);
        return $pdf->stream('invoice.pdf');
})->name('userpaymentreportpdf.show');

Route::get('/paymentreport/generatepdf/all', function (Request $request) {

    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');


    $payments = Payments::join('members', 'payments.member_id', '=', 'members.id')
    ->select('payments.*', 'members.name as name')
   ->whereBetween('payments.created_at', [$startDate, $endDate]) // Use the correct date column name
->orderBy('payments.member_id', 'asc')
    ->get();

        $data=[
           
            'payments1'=> $payments

        ];

        $pdf = Pdf::loadView('Pdf.alluserspaymentreport',$data);
        return $pdf->stream('payment.pdf');
        
})->name('alluserpaymentreportpdf.show');



Route::get('/auth/login',[RegisteredUserController::class,'showUserLogin'])->name('loginshow.page');


Route::get('/auth/registration',function(){

    return view('registrationpage');
    
    })->name('registration.page');

    Route::post('/auth/registration', [RegisteredUserController::class,'AfterLoginstore'])->name('user.insert');

});

require __DIR__.'/auth.php';
