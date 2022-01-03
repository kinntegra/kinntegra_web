<?php

use App\Http\Controllers\Admin\MasterSchemeController;
use App\Http\Controllers\Admin\MasterUpload\AmfiIndiaMasterController;
use App\Http\Controllers\Admin\MasterUpload\BankMasterController;
use App\Http\Controllers\Admin\MasterUpload\NavMasterController;
use App\Http\Controllers\Admin\MasterUpload\SchemeMasterController;
use App\Http\Controllers\Admin\MasterUpload\SipSchemeMasterController;
use App\Http\Controllers\Admin\SchemeLogController;
use App\Http\Controllers\Associate\AssociateAddressController;
use App\Http\Controllers\Associate\AssociateController;
use App\Http\Controllers\Associate\AssociateEmployeeController;
use App\Http\Controllers\Associate\AssociateUserController;
use App\Http\Controllers\Associate\EmployeeController;
use App\Http\Controllers\Client\ClientAssetAllocationController;
use App\Http\Controllers\Client\ClientComprehensiveController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientCreationController;
use App\Http\Controllers\Client\ClientDownloadController;
use App\Http\Controllers\Client\ClientIntroduction;
use App\Http\Controllers\Client\ClientIntroductionController;
use App\Http\Controllers\client\ClientKycDetailController;
use App\Http\Controllers\Client\ClientKycInfoController;
use App\Http\Controllers\Client\ClientMandateController;
use App\Http\Controllers\Client\ClientPreferenceController;
use App\Http\Controllers\Client\ClientUploadController;
use App\Http\Controllers\Client\LeadController;
use App\Http\Controllers\EncryptDecryptController;
use App\Http\Controllers\External\ExternalAssociateController;
use App\Http\Controllers\External\ExternalClientController;
use App\Http\Controllers\External\ExternalEmployeeController;
use App\Http\Controllers\Master\AccountTypeController;
use App\Http\Controllers\Master\AddressTypeController;
use App\Http\Controllers\Master\BankcodeController;
use App\Http\Controllers\Master\CountryController;
use App\Http\Controllers\Master\DepartmentController;
use App\Http\Controllers\Master\DesignationController;
use App\Http\Controllers\Master\GrossAnnualIncomeController;
use App\Http\Controllers\Master\IncomeCategoryController;
use App\Http\Controllers\Master\KycStatusController;
use App\Http\Controllers\Master\OccupationController;
use App\Http\Controllers\Master\StateController;
use App\Http\Controllers\Master\TaxSlabController;
use App\Http\Controllers\Master\TaxStatusController;
use App\Http\Controllers\Master\WealthSourceController;
use App\Http\Controllers\Admin\SetPortfolioController;
use App\Http\Controllers\Admin\ViewPortfolioController;
use App\Http\Controllers\External\TransactionBuyOrder;
use App\Http\Controllers\External\TransactionSellOrder;
use App\Http\Controllers\Trade\TradeLogController;
use App\Http\Controllers\Transaction\NewTransactionController;
use App\Http\Controllers\Transaction\TransactionAllocationController;
use App\Http\Controllers\Transaction\TransactionLogTypeController;
use App\Http\Controllers\Transaction\TransactionPaymentController;
use App\Http\Controllers\Transaction\TransactionTypeController;
use App\Http\Controllers\User\UserAssociateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('external.associate-verify');
});

Route::get('/dashboard', function () {
    //dd(Auth::check());
    if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
    {
        return view('dashboard');
    }
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('associate', AssociateController::class)->middleware(['auth']);
Route::get('associate/{id}/details', [AssociateController::class, 'showDetail'])->name('showDetail');
Route::get('associate/{id}/logs', [AssociateController::class, 'showLogs'])->name('showLogs');
Route::get('associate/{id}/resetpassword', [AssociateController::class, 'resetPassword'])->name('resetPassword');
Route::get('associate/{id}/message', [AssociateController::class, 'showMessage'])->name('showMessage');
Route::post('associate/{id}/message', [AssociateController::class, 'sendMessage'])->name('sendMessage');
Route::resource('associate.address', AssociateAddressController::class, ['only' => ['index']]);
Route::resource('associate.employee', AssociateEmployeeController::class, ['only' => ['index','edit','create','show']]);
Route::resource('associate.user', AssociateUserController::class, ['only' => ['index']]);
Route::resource('employee', EmployeeController::class);
Route::get('associate/{aid}/employee/{eid}/details', [AssociateEmployeeController::class, 'showDetail'])->name('showEmployeeDetail');
Route::get('employee/{id}/logs', [EmployeeController::class, 'showLogs'])->name('showEmployeeLogs');
Route::get('employee/{id}/resetpassword', [EmployeeController::class, 'resetPassword'])->name('resetEmployeePassword');
Route::get('employee/{id}/message', [EmployeeController::class, 'showMessage'])->name('showEmployeeMessage');
//External Associate
Route::resource('external-associate', ExternalAssociateController::class, ['only' => ['edit','show','store','update','create']]);
Route::get('external-associate/{id}/rejected', [ExternalAssociateController::class, 'rejected']);
//External Employee
Route::resource('external-employee', ExternalEmployeeController::class, ['only' => ['edit','show','store','update','create']]);
Route::get('external-employee/{id}/rejected', [ExternalEmployeeController::class, 'rejected']);
//Route::resource('user', 'UserController');
Route::resource('user.associate', UserAssociateController::class, ['only' => ['index']]);


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'master'], function () {
        Route::resource('countries', CountryController::class, ['only' => ['index','store','show']]);
        Route::resource('countries.states', StateController::class, ['only' => ['index','store']]);
        Route::resource('bankcode', BankcodeController::class, ['only' => ['index', 'store', 'show']]);
        Route::resource('department',DepartmentController::class, ['only' => ['index', 'store', 'show']]);
        Route::resource('designation',DesignationController::class,['only' => ['index', 'store']]);
        Route::resource('taxstatus', TaxStatusController::class, ['only' => ['index', 'store']]);
        Route::resource('kycstatus', KycStatusController::class, ['only' => ['index','store']]);
        Route::resource('taxslab', TaxSlabController::class, ['only' => ['index','store']]);
        Route::resource('wealthsource', WealthSourceController::class, ['only' => ['index','store']]);
        Route::resource('addresstype', AddressTypeController::class, ['only' => ['index','store']]);
        Route::resource('accounttype', AccountTypeController::class, ['only' => ['index','store']]);
        Route::resource('incomecategory', IncomeCategoryController::class, ['only' => ['index','store']]);
        Route::resource('occupation', OccupationController::class, ['only' => ['index','store']]);
        Route::resource('grossannualincome', GrossAnnualIncomeController::class, ['only' => ['index','store']]);
        Route::resource('amfiindia_upload',AmfiIndiaMasterController::class,['only' => ['index','create','show','store']]);
        Route::resource('bank_upload',BankMasterController::class,['only' => ['index','create','show','store']]);
        Route::resource('scheme_upload',SchemeMasterController::class,['only' => ['index','create','show','store']]);
        Route::resource('sipscheme_upload',SipSchemeMasterController::class,['only' => ['index','create','show','store']]);
        Route::resource('nav_upload',NavMasterController::class,['only' => ['index','create','show','store']]);
    });
    Route::group(['prefix' => 'modelportfolio'], function () {
        Route::resource('masterscheme',MasterSchemeController::class,['only' => ['index','show','store']]);
        Route::resource('setportfolio',SetPortfolioController::class,['only' => ['index','show','store','create']]);
        Route::resource('viewportfolio',ViewPortfolioController::class,['only' => ['index']]);
        Route::resource('viewschemelog',SchemeLogController::class,['only' => ['index','show','store']]);
    });
    // Route::group(['prefix' => 'masterupload'], function () {

    // });
});

//Client MOdule
Route::resource('leads', LeadController::class);

Route::group(['prefix' => 'client'], function () {
    Route::resource('introduction',ClientIntroductionController::class,['only' => ['index','show','store']]);
    Route::resource('comprehensive',ClientComprehensiveController::class,['only' => ['show','store']]);
    Route::resource('kycdetail',ClientKycDetailController::class,['only' => ['show','store']]);
    Route::resource('kycinformation',ClientKycInfoController::class,['only' => ['index','show','store']]);
    Route::resource('assetallocation',ClientAssetAllocationController::class,['only' => ['show','store']]);
    Route::resource('creation',ClientCreationController::class,['only' => ['index','create','show','store']]);
    Route::resource('mandate',ClientMandateController::class,['only' => ['index','show','store']]);
    Route::resource('download',ClientDownloadController::class,['only' => ['index','show','store']]);
    Route::resource('upload',ClientUploadController::class,['only' => ['index','show','store']]);
    Route::resource('preference',ClientPreferenceController::class,['only' => ['index','show','store']]);
});

Route::get('client/{client_id}/profile/{profile_id}/verify', [ExternalClientController::class, 'verify']);
Route::post('client/{client_id}/profile/{profile_id}/verify', [ExternalClientController::class, 'postVerify'])->name('postverify');
Route::get('client/{client_id}/profile/{profile_id}/rejected', [ExternalClientController::class, 'rejected']);
Route::get('client/{client_id}/profile/{profile_id}/approved', [ExternalClientController::class, 'approved']);

Route::get('encrypt',[EncryptDecryptController::class, 'encrypt']);

Route::get('decrypt',[EncryptDecryptController::class, 'decrypt']);

Route::get('printpdf', [EncryptDecryptController::class, 'printPDF']);

Route::get('encryptno',[EncryptDecryptController::class, 'encryptNo']);

Route::get('decryptno',[EncryptDecryptController::class, 'decryptNo']);
//External Resource

/**
 * Transaction Related Route
 */
//Route::group(['prefix' => 'transaction'], function () {
    Route::resource('transaction',NewTransactionController::class);
    Route::resource('transaction.allocation', TransactionAllocationController::class);
    Route::resource('transaction.type',TransactionTypeController::class);
    Route::resource('transaction.payment',TransactionPaymentController::class);
    Route::resource('transactionlog.type', TransactionLogTypeController::class);
    Route::resource('tradelog', TradeLogController::class);
    Route::get('tradelog_group/{trans_buy_clients_id}/{ucc}/{type}', [TradeLogController::class, 'GetOrderLogs'])
    ->name('tradelog_group');

//Route::resource('', UserController::class);
//});
//
Route::resource('confirmorderbuy',TransactionBuyOrder::class);
Route::get('confirmorderbuy/{status}/message', [TransactionBuyOrder::class, 'OrderStatus']);
Route::post('paymentorderbuy', [TransactionBuyOrder::class, 'paymentorderbuy'])->name('paymentorderbuy');
Route::resource('confirmordersell',TransactionSellOrder::class);
