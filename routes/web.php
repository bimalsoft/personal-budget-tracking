<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Web API Routes
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);

// User Logout
Route::get('/logout',[UserController::class,'UserLogout']);
Route::get('/get-users',[UserController::class,'index']);


// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/history',[PageController::class, 'history'])->middleware([TokenVerificationMiddleware::class]);

// admin route get user
Route::get('/users',[PageController::class,'users'])->middleware([TokenVerificationMiddleware::class]);

// Category API
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);

// Expense Api Routes
Route::post('/add-expense', [ExpenseController::class, 'addExpenses'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-expense', [ExpenseController::class, 'updateExpenses'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-expense', [ExpenseController::class, 'ExpenseDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/get-sum-expense', [ExpenseController::class, 'getSumExpenses'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/get-expense', [ExpenseController::class, 'getExpenses'])->middleware([TokenVerificationMiddleware::class]);


// Income Api Routes
Route::post('/add-income',[IncomeController::class,'addIncome'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/get-income',[IncomeController::class,'getIncome'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/showBalance',[IncomeController::class,'showBalance'])->middleware([TokenVerificationMiddleware::class]);



// Page Routes
Route::get('dashboard',[PageController::class, 'dashboard'])->middleware([TokenVerificationMiddleware::class]);
Route::get('login',[PageController::class, 'login']);

// History Api Routes
Route::get('get-history',[HistoryController::class, 'index'])->middleware([TokenVerificationMiddleware::class]);





// this route use tasting purpose!
//Route::get('/test', function (){
//    return view('pages.dashboard.tablePage');
//});



