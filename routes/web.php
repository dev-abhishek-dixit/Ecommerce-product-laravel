<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

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

Route::get('/', function () {

    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $role = $user->roles[0]->name;
    if ($role == 'Admin' || $role == 'Manager') {
        return view('admindashboard');
    } else {
        $products = Product::select('id', 'image', 'product_name', 'rate', 'available_stocks')->get();
        return view('dashboard', compact('products'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','Admin')->group(function () {
    Route::post('/product/store', [Controller::class, 'store_product']);
    Route::get('/user-list', function () {
        $users = User::whereHas('roles', function ($query) {
            $query->where('role_id', 4);
        })->get();
        return view('Admin.userDetails', compact('users'));
    })->name('user.list');

    Route::get('/product-list', function () {
        $product = Product::all();
        return view('Admin.productDetails', compact('product'));
    })->name('product.list');

    Route::get('/user-active/{id}', function ($id) {
        $user = User::find($id);
        $user->status = 'Active';
        $user->save();
        return redirect()->back()->with('success', 'user acount updated!');
    })->name('users.activate');

    Route::get('/user-deactive/{id}', function ($id) {
        $user = User::find($id);
        $user->status = 'Deactive';
        $user->save();
        return redirect()->back()->with('success', 'user account updated!');
    })->name('users.deactivate');

    Route::get('/product-delete/{id}', function ($id) {
        $product = Product::find($id)->delete();
        return redirect()->back()->with('success', 'Product deleted!');
    })->name('product.delete');

});
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/cart/add/{id}', [Controller::class, 'add_to_cart'])->name('cart.add');
});

require __DIR__ . '/auth.php';
