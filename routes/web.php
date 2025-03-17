    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserProfileController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\CommentController;


    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/user-profile', [UserProfileController::class,'show'])->name('userProfile.show');
    Route::post('/file-upload', [UserProfileController::class,'store'])->name('userProfile.store');


    Route::get('/post', [PostController::class,'index'])->name('post.index');
    Route::get('/post/create', [PostController::class,'create'])->name('post.create');
    Route::post('/post', [PostController::class,'store'])->name('post.store');
    Route::get('/post/{post}/edit', [PostController::class,'edit'])->name('post.edit');
    Route::put('/post/{post}', action: [PostController::class,'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class,'destroy'])->name('post.destroy');
    Route::get('/post/{post}', [PostController::class,'show'])->name('post.show');

    Route::post('/post/{post}/comment', [CommentController::class,'store'])->name('comment.store');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
