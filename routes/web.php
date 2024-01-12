<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\ServicesController;
use App\Http\Controllers\dashboard\ArticlesController;
use App\Http\Controllers\dashboard\CreateEditorController;
// use App\Http\Controllers\dashboard\ContactController;
use App\Http\Controllers\dashboard\ProfileAdminsController;
use App\Http\Controllers\dashboard\SettigsController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CommentsController;
use App\Http\Controllers\dashboard\RolesController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\PinnedController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Web\SiteController;





Route::get('/link', function() {
    Artisan::call('storage:link'); 
});
Route::get('/opt', function() {
    Artisan::call('optimize:clear'); 
});



Route::get('admin/am/login' , [AdminController::class, 'index'])->name('login_form');
Route::post('admin/am/login/owner' , [AdminController::class, 'Login'])->name('admin.login');
Route::get('am/logout' , [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('am/register/create' , [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
Route::middleware(['auth:admin'])->prefix('admin')->group(function (){
    // for Login and Dashboard
    /* =================================
    Login Admin
    ===================================*/

    Route::get('am/dashboard' , [AdminController::class, 'Dashboard'])->name('admin.dashboard');

    // Route::get('/register' , [AdminController::class, 'AdminRegister'])->name('admin.register');

    /* =================================
    Admins (Show Page)
    ===================================*/
    Route::get('admins/', [SettigsController::class, 'getAdmins'])->name('admins.main');



    /* =================================
    Settings (Page)
    ===================================*/
    Route::get('/sittings', [SettigsController::class, 'getSetting'])->name('show.sittings');
    Route::post('/setter', [SettigsController::class, 'setSittings'])->name('setSittings');

    /* =================================
    Adds (Page)
    ===================================*/
    Route::post('/setAdd', [App\Http\Controllers\dashboard\SetAddsController::class, 'setAdd'])->name('setAdd');
    Route::get('/AddControl', [App\Http\Controllers\dashboard\SetAddsController::class, 'AddControl'])->name('AddControl');

    /* =================================
    Category
    ===================================*/
    Route::get('categories/', [CategoryController::class, 'index'])->name('categories.main');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('create.categories.main');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('store.categories.main');
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('edit.categories.main');
    Route::post('categories/update/{id}', [CategoryController::class, 'update'])->name('update.categories.main');
    Route::get('categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy.categories.main');
    Route::post('subcate/', [CategoryController::class, 'getSubCateAjax'])->name('ajax.subcate.main');

    /* =================================
    articles
    ===================================*/
    Route::get('articles/', [ArticlesController::class, 'index'])->name('articles.main');
    Route::get('articles/create', [ArticlesController::class, 'create'])->name('create.articles.main');
    Route::post('articles/store', [ArticlesController::class, 'store'])->name('store.articles.main');
    Route::get('articles/edit/{id}', [ArticlesController::class, 'edit'])->name('edit.articles.main');
    Route::post('articles/update/{id}', [ArticlesController::class, 'update'])->name('update.articles.main');
    Route::get('articles/destroy/{id}', [ArticlesController::class, 'destroy'])->name('destroy.articles.main');
    Route::get('articles/toggle/{id}', [ArticlesController::class, 'toggle'])->name('toggole.articles.main');
    Route::post('ck/upload/', [ArticlesController::class, 'ckUpload'])->name('ck.upload');
    /* =================================
    articles
    ===================================*/
    Route::get('pinned/', [PinnedController::class, 'index'])->name('pinned.main');
    Route::get('pinned/create', [PinnedController::class, 'create'])->name('create.pinned.main');
    Route::post('pinned/store', [PinnedController::class, 'store'])->name('store.pinned.main');
    Route::get('pinned/edit/{id}', [PinnedController::class, 'edit'])->name('edit.pinned.main');
    Route::post('pinned/update/{id}', [PinnedController::class, 'update'])->name('update.pinned.main');
    Route::get('pinned/destroy/{id}', [PinnedController::class, 'destroy'])->name('destroy.pinned.main');
    Route::post('ck/upload/', [ArticlesController::class, 'ckUpload'])->name('ck.upload');
    /* =================================
    Users
    ===================================*/
    Route::get('users/', [UserController::class, 'index'])->name('user.main');
    Route::get('users/create', [UserController::class, 'create'])->name('create.user.main');
    Route::post('users/store', [UserController::class, 'store'])->name('store.user.main');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('edit.user.main');
    Route::get('users/show/{id}', [UserController::class, 'show'])->name('show.user.main');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('update.user.main');
    Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('destroy.user.main');
    /* =================================
    Roles
    ===================================*/
    Route::get('roles/', [RolesController::class, 'index'])->name('roles.main');
    Route::get('roles/create', [RolesController::class, 'create'])->name('create.roles.main');
    Route::post('roles/store', [RolesController::class, 'store'])->name('store.roles.main');
    Route::get('roles/edit/{id}', [RolesController::class, 'edit'])->name('edit.roles.main');
    Route::get('roles/show/{id}', [RolesController::class, 'show'])->name('show.roles.main');
    Route::post('roles/update/{id}', [RolesController::class, 'update'])->name('update.roles.main');
    Route::delete('roles/destroy/{id}', [RolesController::class, 'destroy'])->name('destroy.roles.main');

    /* =================================
    Create Editor By Admin
    ===================================*/
    // Route::get('create-editor/', [CreateEditorController::class, 'index'])->name('createEditor.main');
    // Route::get('create-editor/create', [CreateEditorController::class, 'create'])->name('create.createEditor.main');
    // Route::post('create-editor/store', [CreateEditorController::class, 'store'])->name('store.createEditor.main');
    // // Route::get('create-editor/edit/{id}', [CreateEditorController::class, 'edit'])->name('edit.createEditor.main');
    // // Route::post('create-editor/update/{id}', [CreateEditorController::class, 'update'])->name('update.createEditor.main');
    // Route::get('create-editor/destroy/{id}', [CreateEditorController::class, 'destroy'])->name('destroy.createEditor.main');

    /* =================================
    Comments
    ===================================*/
    Route::get('comments/', [CommentsController::class, 'index'])->name('comments.main');
    Route::get('comments/show/{id}', [CommentsController::class, 'show'])->name('comments.show.main');
    Route::get('comments/destroy/{id}', [CommentsController::class, 'destroy'])->name('destroy.comments.main');
    Route::get('comments/approve/{id}', [CommentsController::class, 'approve'])->name('toggole.comments.main');
    /* =================================
    Profile (Show)
    ===================================*/
    // Route::get('profile/', [ProfileAdminsController::class, 'index'])->name('profile.main');
    // Route::get('profile/show/{id}', [ProfileAdminsController::class, 'show'])->name('show.profile.main');
    // Route::post('articles/update/{id}', [ProfileAdminsController::class, 'update'])->name('update.profile.main');
    // Route::get('profile/destroy/{id}', [ProfileAdminsController::class, 'destroy'])->name('destroy.profile.main');


    /* =================================
    PDF
    ===================================*/
    // Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('invoice.pdf');

});






Route::get('/', [SiteController::class, 'home'])->name('home.page');
Route::get('article-page/{idCate}/{id}', [SiteController::class, 'getArticlePage'])->name('pageArticle.page');
Route::get('allSubCategory/{slug}', [SiteController::class, 'getShowCategory'])->name('categoryPage.page');
// Route::get('articleofSubCategory/{slug}', [SiteController::class, 'getAllArticleBySubCategory'])->name('article.Bysubcategory.page');
Route::post('store-comments/', [SiteController::class, 'storeComment'])->name('storeComments');
Route::get('opinions/', [SiteController::class, 'getOpinions'])->name('opinions.page');
Route::get('open-opinions/{id}', [SiteController::class, 'getPersonOpinions'])->name('open.opinions.page');
Route::get('about/', [SiteController::class, 'getAboutPage'])->name('about.page');
Route::get('aboutPage/{href}', [SiteController::class, 'getAboutPinnedPage'])->name('aboutPinned.page');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
