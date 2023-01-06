<?php





use App\Http\Livewire\Main;

use App\Http\Controllers\Auth\Employer\AuthenticatedEmployerController;

use App\Http\Controllers\Auth\Employer\RegisteredEmployerController;

use App\Http\Controllers\Auth\OAuthController;

use App\Http\Controllers\Employer\ProfilEmployer;

use App\Http\Livewire\Search;

use App\Http\Livewire\SearchSingle;

use App\Http\Livewire\SearchIndex;

use App\Http\Livewire\ProvilNav;

use App\Http\Livewire\NavBot;

use App\Http\Livewire\Profil\Account;

use App\Http\Livewire\NavigationDropdown;

use App\Http\Livewire\Categories\Categories;

use App\Http\Livewire\Categories\Categoryposts;

use App\Http\Livewire\Profile\CompleteData;

use App\Http\Livewire\Profile\MyClass;

use App\Http\Livewire\Profile\Profile;

use App\Http\Livewire\Profile\SimpanLoker;

use App\Http\Livewire\Profile\KeterampilanUser;

use App\Http\Livewire\Profile\PengalamanUser;

use App\Http\Livewire\Profile\PendidikanUser;

use App\Http\Livewire\Notif\NotifList;

use App\Http\Livewire\Notif\NotifStar;

use App\Http\Livewire\Chat\Chat;

use App\Http\Livewire\Posts\Berita;

use App\Http\Livewire\Posts\Posts;

use App\Http\Livewire\Search\SearchShow;

use App\Http\Livewire\Posts\Post as p;

use App\Http\Livewire\Tags\Tagposts;

use App\Http\Livewire\Tags\Tags;

use App\Http\Livewire\Payment\Payments;

use App\Http\Livewire\Payment\Method;

use App\Http\Livewire\Payment\PayOn;

use App\Http\Livewire\Payment\PaymentClass;

use App\Http\Livewire\OnClass\OnClass;

use App\Http\Livewire\OnClass\OnClasses;

use App\Http\Livewire\OnClass\Classes;

use App\Http\Livewire\Pdf\Mpdf;

use App\Http\Livewire\Filter\CommponentFilter as Filter;

use Illuminate\Support\Facades\Route;

use Laravel\Fortify\Http\Controllers\RegisteredUserController;


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



// Route::get('test', function () {

//     $category = App\Models\Category::find(3);

//     // return $category->posts;



//     $comment = App\Models\Comment::find(152);

//     // return $comment->author;

//     // return $comment->post;



//     $post = App\Models\Post::find(152);

//     // return $post->category;

//     // return $post->author;

//     // return $post->images;

//     // return $post->comments;

//     // return $post->tags;



//     $tag = App\Models\Tag::find(5);

//     // return $tag->posts;



//     $author = App\Models\User::find(88);

//     // return $author->posts;

//     return $author->comments;

// });





Route::get('/dashboard', Main::class);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Main::class)->name('dashboard');


Route::get('/registerchoice', function(){
    return view("auth.registerchoice");
});
Route::get('/choice', function(){
    return view("auth.choice");
});

Route::get('/join/{id}', [RegisteredUserController::class, 'create'])
    ->middleware(['guest:'.config('fortify.guard')])
    ->name('register.join');
Route::get('/search/show/{id}',SearchShow::class)->name('search.show');
Route::get('auth/{id}', [OAuthController::class, 'redirectToProvider'])->name('auth');
Route::get('auth/{id}/callback', [OAuthController::class, 'handleProviderCallback'])->name('auth.clbk');

Route::prefix('/')->group(function(){

    Route::get('/', Main::class)->name('dashboard');

    

    // Route::get('/categories', Categories::class)->name('categories');

    // Route::get('/categories/{id}/posts', Categoryposts::class);

    

    
    Route::group(['middleware' => ['auth:web', 'verified']], function () {

        Route::get('/posts', Posts::class)->name('posts');

        Route::get('/filter', Filter::class)->name('tags');
        
        Route::get('/onclasses', OnClasses::class)->name('onclasses');
        Route::get('/complete/data', CompleteData::class)->name('complete.data');

        Route::prefix('payment')->group(function(){
            Route::get('/class/{id}', PaymentClass::class)->name('payment.class');
        });


    });
    
    Route::get('/posts/{id}', p::class);
    Route::get('/onclass/{id}', OnClass::class)->name('onclass');
    Route::get('/class', Classes::class)->name('class');
    Route::get('/class/{data}', Classes::class)->name('class.data');
    // Route::get('/lowongan/{id}', Berita::class)->name('lowongan');

    Route::get('/lowongan/{id}', Berita::class)->name('lowongan/{id}');

    Route::get('/search', Search::class)->name('search');

    Route::get('/range', SearchSingle::class);

    // Route::get('/about', function(){
    //     return view("livewire.about-us");
    // });
    Route::view('/about', 'livewire.about-us');

    // Route::get('/navprov', ProvilNav::class)->name('navprov');

    Route::get('/navbot',Navbot::class)->name('navbot');
    Route::get('/account',Account::class)->name('account');
    
    Route::get('/autocomplete-search', [Main::class, 'autocompleteSearch']);
    Route::get('/autocomplete2-search', [SearchIndex::class, 'autocompleteSearch']);



    Route::prefix('payment')->group(function(){

        Route::get('/',Payments::class)->name('payment');

        Route::get('/payon', PayOn::class);

        Route::get('/detail/{id}', [Mpdf::class, 'detailPayPdf']);

        Route::get('/{id}', Method::class);

    });

});



Route::get('users/{id}', Profile::class)->name('profile.info');
Route::prefix('user')->group(function(){

    // Route::get('/profile/{id}', Profile::class)->name('profile.info');
    Route::group(['middleware' => ['auth', 'verified']], function () {
        
        Route::get('/saveloker', SimpanLoker::class)->name('saveloker');
        Route::get('/pengalaman', PengalamanUser::class)->name('pengalaman');
        Route::get('/pendidikan', PendidikanUser::class)->name('pendidikan');
        Route::get('/keterampilan', KeterampilanUser::class)->name('keterampilan');
        Route::get('/notif', NotifList::class)->name('notif');
        Route::get('/notif-berbintang', NotifStar::class)->name('notif.star');
        Route::get('/chat', Chat::class)->name('chat');
        Route::get('/chat/{id}', Chat::class)->name('chat.open');
        Route::get('/myclass', MyClass::class)->name('myclass');

    });

});




Route::get('/cleareverything', function () {

    $clearcache = Artisan::call('cache:clear');

    echo "Cache cleared<br>";



    $clearview = Artisan::call('view:clear');

    echo "View cleared<br>";



    $clearconfig = Artisan::call('config:cache');

    echo "Config cleared<br>";



    $clearconfig = Artisan::call('route:clear');

    echo "route cleared<br>";
    
    
    
    $clearconfig = Artisan::call('optimize');

    echo "optimize<br>";

});
Route::get('/symlink', function () {
   $target =$_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
   $link = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
   symlink($target, $link);
   echo "Done";
});

require __DIR__ . "/employer.php";