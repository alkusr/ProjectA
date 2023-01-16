<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminTestController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminQuestionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\API\Participant\APIParticipantTestController;
use App\Http\Controllers\Participant\ParticipantTestController;
use App\Http\Controllers\Participant\ParticipantDashboardController;
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

// // get all test result category
// $testResultCategories = \App\Models\TestResultCategory::get(['id', 'name']);
// // clone test result category
// $testResultCategoriesClone = $testResultCategories->map(function ($testResultCategory) {
//     return $testResultCategory;
// });
// // create new empty collection for each test result category with key name
// $testResultCategories = $testResultCategories->mapWithKeys(function ($item) {
//     return [$item->name => collect()];
// });
// // get first participant
// $participant = \App\Models\Participant::first();
// $answer = $participant->participantTest->participantTestQuestionAnswers;

// $dataresult = $answer->load('testResultCategory')->groupBy('testResultCategory.name');
// // union test result category with data result
// $dataresult = $dataresult->union($testResultCategories);
// // create variable total and get total of all item in collection
// $total = $dataresult->sum(function ($item) {
//     return $item->count();
// });
// // get percent of each item in collection
// $dataresult = $dataresult->map(function ($item) use ($total) {
//     return $item->count() / $total * 100;
// });
// DB::beginTransaction();
// try {
//     // create participant test result
//     $participantTestResult = $participant->participantTest->participantTestResult()->create([
//         'participant_id' => $participant->id,
//     ]);

//     // create participant test result detail
//     $dataresult->each(function ($item, $key) use ($participantTestResult, $testResultCategoriesClone) {
//         $testResultCategory = $testResultCategoriesClone->where('name', $key)->first();
//         $participantTestResult->participantTestResultDetails()->create([
//             'test_result_category_id' => $testResultCategory->id,
//             'percent' => $item,
//         ]);
//     });
//     // commit transaction
//     DB::commit();
// } catch (\Exception $e) {
//     DB::rollback();
//     throw $e;
// }

// dd($dataresult);
// dd(1);
// $firstData = collect([
//     1 => collect(),
//     2 => collect(),
//     3 => collect(),
//     4 => collect(),
// ]);
// $data = collect([
//     [
//         'nama' => 'Muhammad Rizal',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad saiful',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad zain',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad anwar',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad ansari',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad alif',
//         'kelas' => 1,
//     ],
//     [
//         'nama' => 'Muhammad erfan',
//         'kelas' => 1,
//     ],
// ]);
// $data = $data->groupBy('kelas');
// $data = $data->union($firstData);
// // dd($data);
// // check if data not empty
// $kelas1 = $data[1]->count();
// $kelas2 = $data[2]->count();
// $kelas3 = $data[3]->count();
// $kelas4 = $data[4]->count();
// $alldata = $kelas1 + $kelas2 + $kelas3 + $kelas4;
// // get percentage
// $percentage1 = ($kelas1 / ($alldata)) * 100;
// $percentage2 = ($kelas2 / ($alldata)) * 100;
// $percentage3 = ($kelas3 / ($alldata)) * 100;
// $percentage4 = ($kelas4 / ($alldata)) * 100;
// // dump both
// dump($data);
// dump($kelas1);
// dump($kelas2);
// dump($kelas3);
// dump($kelas4);

// dump($percentage1);
// dump($percentage2);
// dump($percentage3);
// dump($percentage4);


Route::get('/demo', function () {
    // $data["email"] = "muhammadansari180@gmail.com";
    // $data["title"] = env('APP_NAME');
    // $data["body"] = "This is Demo";

    // $files = [
    //     public_path('files/160031367318.pdf'),
    //     public_path('files/1599882252.png'),
    // ];
    auth()->user()->participant->sendResult();
    // dd(1);
    // $participant_test = auth()->user()->participant->participantTest;
    // $pdf = PDF::loadView('emails.pdf-template', compact('participant_test'));
    // return $pdf->stream();
    // Mail::send('emails.hasil-test', $data, function ($message) use ($data, $pdf) {
    //     $message->to($data["email"], $data["email"])
    //         ->subject($data["title"])->attachData($pdf->stream(), 'HASIL_TEST.pdf', [
    //             'mime' => 'application/pdf',
    //         ]);
    // });
    // get all user has participant
    // return Excel::download(new UsersExport, 'users.xlsx');
    // $users = \App\Models\User::has('participant')->get();
    // return view('exports.reports-test', compact('users'));
});
Route::get('/', function () {
    return redirect(route('register'));
});

Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::name('test.')->group(function () {
        Route::get('/test', [AdminTestController::class, 'index'])->name('index');
    });
    Route::name('user.')->group(function () {
        Route::get('/user', [AdminUserController::class, 'index'])->name('index');
        // destroy
        Route::delete('/user/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        // export
        Route::get('/user/export', [AdminUserController::class, 'export'])->name('export');
        Route::post('/user/reset', [AdminUserController::class, 'reset'])->name('reset');
    });

    Route::resource('question', AdminQuestionController::class);
});

Route::name('participant.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', ParticipantDashboardController::class)->name('dashboard');
    Route::get('/test', [ParticipantTestController::class, 'index'])->name('test');

    Route::post('/test/set-answer', [APIParticipantTestController::class, 'setAnswer'])->name('api.set-answer');
    Route::post('/test/set-answer-confidence', [APIParticipantTestController::class, 'setAnswerConfidence'])->name('api.set-answer-confidence');
    Route::post('/test/set-answer-reason', [APIParticipantTestController::class, 'setAnswerReason'])->name('api.set-answer-reason');
    Route::post('/test/set-answer-reason-confidence', [APIParticipantTestController::class, 'setAnswerReasonConfidence'])->name('api.set-answer-reason-confidence');

    Route::get('/test-preview', [ParticipantTestController::class, 'preview'])->name('preview');
    Route::post('/send-answer', [ParticipantTestController::class, 'calculate'])->name('test.calculate');
});


require __DIR__ . '/auth.php';
