<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/posts', function (Request $request) {
        // dd(request()->all());
        $posts = auth()->user()
            ->posts()
            ->when($request->query('search'), function ($query, $q) {
                if (strlen($q) <= 4) {
                    return $query->where('title', 'LIKE', '%' . $q . '%')
                        ->orWhere('body', 'LIKE', '%' . $q . '%');
                }

                return $query->whereFullText(['title', 'body'], $q, ['mode' => 'boolean']);
            })
            ->paginate(6);

        // dd($posts);

        return view('posts.index', compact('posts'));
    })->name('posts.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/profile/avatar/update', function (Request $request) {
        $request->validate([
            'avatar' => ['required', File::image()
                ->max(5 * 1024)]
        ]);

        if (auth()->user()->avatar) {
            Storage::disk('public')->delete(auth()->user()->avatar);
        }

        auth()->user()->update([
            'avatar' => $request->file('avatar')->store('avatars', 'public'),
        ]);

        return back()->with('status', 'avatar-updated');
    })->name('profile.avatar.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
