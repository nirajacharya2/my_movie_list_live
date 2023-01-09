<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\dataentry;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;
use App\Models\Staff;
use App\Models\User;
use App\Models\UsersTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

use function Psy\sh;

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

// Route::get('/', [HomeController::class, 'show'])->name('/');

// Route::get('/', function () {
//     return view('aa')->with('a','cum');
// });


Route::get('/', [HomeController::class, 'show'])->name('/');



Route::get('/oauth', function () {
    return view('oauth');
})->name('review');
Route::get('/top', [TopPageController::class, 'topRating'])->name('top');
Route::get('/favorite', [TopPageController::class, 'topFavorited'])->name('favorite');
Route::get('/popular', [TopPageController::class, 'topMembers'])->name('popular');

Route::get('/testpage', function () {
    return view('testpage')->with('aaa', 'aaa');
});

Route::get('/title/{title:title_id}/{sort?}', [TitleController::class, 'show'])->name('title');

Route::get('/character/{character:char_id}', [CharacterController::class, 'show'])->name('character');

Route::get('/staff/{staff:staff_id}', [StaffController::class, 'show'])->name('staff');

Route::get('/user/{user:username}/{sort?}', [UserController::class, 'show'])->name('user');

Route::get('/userList/{username}/{sort?}', [UserListController::class, 'show'])->name('userList');

// Route::get('/dataentry', [dataentry::class, 'index2'])->name('dataentry');

Route::get('/userreviews', function () {
    return view('userreviews');
})->name('review');

Route::get('/genre/{genres:genre_id}', [GenreController::class, 'show'])->name('genre');

Route::post('/searchS', function ($searchText = null) {
    $searchText = addslashes(request('st'));
    $title = null;
    $staff = null;
    $users = null;
    $character = null;
    if ($searchText != '' && $searchText != null) {
        $title = DB::select("select * from titles where titlename LIKE '%" . addslashes($searchText) . "%' or sypnosis like '%" . addslashes($searchText) . "%';");
        $staff = DB::select("select * from staff where firstname LIKE '%" . addslashes($searchText) . "%' or miiddlename like '%" . addslashes($searchText) . "%' or lastname like '%" . addslashes($searchText) . "%';");
        $users = DB::select("select * from users where username LIKE '%" . addslashes($searchText) . "%' ;");
        $character = DB::select("select * from characters where characterName LIKE '%" . addslashes($searchText) . "%' or characterDescription like '%" . addslashes($searchText) . "%';");
    } else {
        $title = [];
        $staff = [];
        $users = [];
        $character = [];
    }


    return view('searchresults')
        ->with('searchTitles', $title)
        ->with('searchStaff', $staff)
        ->with('serchCharacter', $character)
        ->with('searchUsers', $users)
        ->with('searchText', $searchText);
})->name('searchS');

Route::get('/search/{searchText?}', function ($searchText = null) {
    $searchText = addslashes($searchText);
    $title = DB::select("select * from titles where titlename LIKE '%" . addslashes($searchText) . "%' or sypnosis like '%" . addslashes($searchText) . "%';");
    $staff = DB::select("select * from staff where firstname LIKE '%" . addslashes($searchText) . "%' or miiddlename like '%" . addslashes($searchText) . "%' or lastname like '%" . addslashes($searchText) . "%';");
    $users = DB::select("select * from users where username LIKE '%" . addslashes($searchText) . "%' ;");
    $character = DB::select("select * from characters where characterName LIKE '%" . addslashes($searchText) . "%' or characterDescription like '%" . addslashes($searchText) . "%';");

    return response()->json([
        'searchTitles' => $title,
        'searchStaff' => $staff,
        'searchUsers' => $users,
        'serchCharacter' => $character,
        'searchText' => $searchText
    ]);
})->name('searchText')->where('searchText', '(.*)');




Route::get('/staffcom', function () {
    $comments = Staff::join('staff_comments', 'staff.staff_id', '=', 'staff_comments.sco_staff_id')
        ->join('users', 'users.user_id', '=', 'staff_comments.sco_user_id')
        ->where('staff.staff_id', 1)
        ->orderBy('staff_comments.created_at', 'desc')
        ->limit(10)
        ->get();

    // return response()->json([
    //     'Comments' => $comments,
    // ]);
    return view('staff');
})->name('staffcom');


Route::get('/saveEditTitle/{title_id}/{watSts}/{score}/{episode}/{stDate}/{edDate}', function ($title_id, $watSts, $score, $eposodes, $stDate, $edDate) {
    DB::statement("update users_titles set  ut_watchingstatus='" . $watSts . "', ut_episodewatched=" . $eposodes . ", ut_score=" . $score . ", updated_at=NOW(), ut_startdate='" . $stDate . "', ut_enddate='" . $edDate . "' where ut_user_id = " .
        Session::get('userInfo')->user_id . " and ut_title_id=" . $title_id . " ;");
})->name('saveEditTitle');



Route::post('/addUserTitle/{title_id}/{watSts}/{score}/{episode}', function ($title_id, $watSts, $score, $eposodes) {
    if ($score == 'null') {
        DB::insert(
            'insert into users_titles (ut_user_id,ut_title_id,username, ut_watchingstatus,ut_episodewatched,CREATED_at,updated_at) values (?, ?,?,?,?,?,?);',
            [Session::get('userInfo')->user_id, $title_id, Session::get('userInfo')->username, $watSts, $eposodes, now(), now()]
        );
    } else {
        DB::insert(
            'insert into users_titles (ut_user_id,ut_title_id,username, ut_watchingstatus,ut_score,ut_episodewatched,CREATED_at,updated_at) values (?, ?,?,?,?,?,?,?);',
            [Session::get('userInfo')->user_id, $title_id, Session::get('userInfo')->username, $watSts, $score, $eposodes, now(), now()]
        );
    }
    $userTitelDetail = DB::table('users_titles')
        ->where('ut_user_id', Session::get('userInfo')->user_id)
        ->where('ut_title_id', $title_id)
        ->get();

    return response()->json([
        'userTitelDetail' => $userTitelDetail,
    ]);
})->name('addUserTitle');

Route::get('/updateWtchStatus/{title_id}/{watSts}/{score}/{episode}', function ($title_id, $watSts, $score, $eposodes) {
    DB::statement("update users_titles set  ut_watchingstatus='" . $watSts . "', ut_episodewatched=" . $eposodes . ", ut_score=" . $score . ", updated_at=NOW() where ut_user_id = " . Session::get('userInfo')->user_id . " and ut_title_id=" . $title_id . ";");

    $userTitelDetail = DB::table('users_titles')
        ->where('ut_user_id', Session::get('userInfo')->user_id)
        ->where('ut_title_id', $title_id)
        ->get();

    return response()->json([
        'userTitelDetail' => $userTitelDetail,
    ]);
})->name('updateWtchStatus');

Route::get('/addToFaviourite/{title_id}/{addOrRemove}', function ($title_id, $addOrRemove) {
    if ($addOrRemove) {
        if (DB::table('users_titles')->where('ut_user_id', Session::get('userInfo')->user_id)->where('ut_faviourite', 1)->count() < 10) {
            DB::statement("update users_titles set ut_faviourite = 1 where ut_user_id = " . Session::get('userInfo')->user_id . " and ut_title_id=" . $title_id . ";");
        } else {
            return response()->json([
                'responseErr' => 'Already have max favorite movie added',
            ]);
        }
    } else {
        DB::statement("update users_titles set ut_faviourite = 0 where ut_user_id = " . Session::get('userInfo')->user_id . " and ut_title_id=" . $title_id . ";");
    }
})->name('addToFaviourite');

Route::get('/addToFaviouriteChar/{char_id}/{addOrRemove}', function ($char_id, $addOrRemove) {
    if ($addOrRemove) {
        if (DB::table('favorite_characters')->where('fc_user_id', Session::get('userInfo')->user_id)->count() < 10) {
            DB::insert('insert into favorite_characters (fc_staff_id, fc_user_id) values (?, ?)', [$char_id, Session::get('userInfo')->user_id]);
        } else {
            return response()->json([
                'responseErr' => 'Already have max favorite movie added',
            ]);
        }
    } else {
        DB::table('favorite_characters')->where('fc_user_id', Session::get('userInfo')->user_id)->where('fc_staff_id', $char_id)->delete();
    }
})->name('addToFaviouriteChar');

Route::get('/addToFaviouriteStaff/{staff_id}/{addOrRemove}', function ($staff_id, $addOrRemove) {
    if ($addOrRemove) {
        if (DB::table('favorite_staffs')->where('f_user_id', Session::get('userInfo')->user_id)->count() < 10) {
            DB::insert('insert into favorite_staffs (f_staff_id, f_user_id) values (?, ?)', [$staff_id, Session::get('userInfo')->user_id]);
        } else {
            return response()->json([
                'responseErr' => 'Already have max favorite movie added',
            ]);
        }
    } else {
        DB::table('favorite_staffs')->where('f_user_id', Session::get('userInfo')->user_id)->where('f_staff_id', $staff_id)->delete();
    }
})->name('addToFaviouriteStaff');



Route::post('/addStaffcomment/{staff_id}/{comment}', function ($staff_id, $comment) {
    DB::insert(
        'insert into staff_comments (sco_user_id,sco_staff_id,commentText,created_at) values (?, ?,?,?);',
        [Session::get('userInfo')->user_id, $staff_id, addslashes($comment), NOW()]
    );
})->name('addStaffcomment')->where('comment', '(.*)');

Route::post('/deleteUserTitle/{title_id}', function ($title_id) {
    DB::table('users_titles')->where('ut_user_id', Session::get('userInfo')->user_id)->where('ut_title_id', $title_id)->delete();
    return redirect(route('title', ['title' => $title_id]));
})->name('deleteUserTitle');

Route::post('/deleteUserComment/{comment_id}', function ($comment_id) {
    DB::table('user_comments')->where('ur_comment_id', $comment_id)->delete();
})->name('deleteUserComment');

Route::post('/addUsercomment/{user_id}/{comment}', function ($user_id, $comment) {
    DB::insert(
        'insert into user_comments (u1_user_id,u2_user_id,commentText,created_at) values (?, ?,?,?);',
        [Session::get('userInfo')->user_id, $user_id, $comment, NOW()]
    );
})->name('addUsercomment')->where('comment', '(.*)');


Route::post('/addTitleReview/{title_id}/{comment}/{commentType}', function ($title_id, $comment, $commentType = null) {
    DB::insert(
        'insert into reviews (ut_user_id,ut_title_id,rw_content,rw_type,created_at,updated_at) values (?, ?,?,?,?,?);',
        [Session::get('userInfo')->user_id, $title_id, addslashes($comment), $commentType, NOW(), now()]
    );
})->name('addTitleReview')->where('comment', '(.*)');
Route::post('/editTitleReview/{title_id}/{comment}/{commentType}', function ($title_id, $comment, $commentType = null) {
    DB::table('reviews')
        ->where('ut_user_id', Session::get('userInfo')->user_id)
        ->where('ut_title_id', $title_id)
        ->update(['rw_content' => addslashes($comment), 'rw_type' => $commentType]);
})->name('editTitleReview')->where('comment', '(.*)');

Route::post('/deleteTitleReview/{title_id}', function ($title_id) {
    DB::table('reviews')->where('ut_user_id', Session::get('userInfo')->user_id)->where('ut_title_id', $title_id)->delete();
})->name('deleteTitleReview');


Route::post('/updateUser', function (Request $request) {
    $request->validate([
        'sex' => ['required', 'boolean'],
        'username' => ['required'],
        'dob' => 'required|date',
        'location' => '',
        'socialmedia' => '',
        'aboutme' => '',
    ]);

    User::where('username', $request->username)->update([
        'user_sex' => $request->sex, 'user_dob' => $request->dob, 'user_image' => $request->pfpPicture, 'user_location' => $request->location, 'user_socialmedia' => $request->socialmedia, 'user_aboutme' => $request->aboutme
    ]);
    return back();
})->name('updateUser');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('loginPost');
    Route::post('signup', 'signup');
    Route::post('reVerify', 'reVerify')->name('reVerify');
    Route::get('logout', 'logout')->name('logout');
    Route::post('verifyEmail', 'verifyEmail')->name('verifyEmail');
});
Route::controller(PasswordResetController::class)->group(function () {
    Route::post('sendresetmail', 'sendresetmail')->name('sendresetmail');
    Route::post('passwordresetconformation', 'passwordresetconformation')->name('passwordresetconformation');
});


Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/signup', function () {
        // return view('sugnupnotworking');
        return view('signup');
    })->name('signup');
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/forgotpasswordmail', function () {
        return view('forgotpasswordmail');
    })->name('forgotpasswordmail');
    Route::get(
        '/forgotpassword/{token}/{email}',
        function (Request $request, $token = null) {
            return view('forgotpassword')
                ->with('token', $token)
                ->with('email', $request->email);
        }
    )->name('forgotpassword');
});





Route::get('/confirmverifyEmail/{token}/{email}', [AuthController::class, 'confirmverifyEmail'])->name('confirmverifyEmail');
// Route::post('/verifyEmail', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
// Route::get('/dataentry', [dataentry::class, 'index']);