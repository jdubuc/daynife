<?php
use App\Factura;
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
Route::get('/home', function () {
    return view('home');
});
Route::get('profile', function () {
    // Only authenticated users may enter... START...................................
   
Route::resource('empresa','EmpresaController');
//Route::get('/home', 'HomeController@index')->name('home');

     // Only authenticated users may enter... END....................................
})->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user','UserController');
Route::resource('empresa','empresaController');
Route::resource('factura','facturaController');
Route::resource('tipoFactura','tipoFacturaController');
Route::resource('products','ProductController');
Auth::routes();

Route::get('auth/logout', 'auth\loginController@logout');
/*Route::get('auth/logout', function () {
    return view('welcome');
});*/
//-------------------------------------------------------------------------------------
Route::get('/errors', function () {
    return view('errors');
});
//Route::get( '/', 'PagesController@index' );
Route::get( 'about', 'PagesController@about' );
Route::get( 'contact', 'PagesController@contact' );
//Route::get( 'operator', 'PagesController@contact' );

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'registrationController@confirm'
]);

Route::resource('register', 'registrationController');

Route::group(['middleware' => 'auth'], function () {

});

Route::get('/facturas-csv', function(){
	//$excel = App::make('excel');
	//php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
    $table = Factura::all();
    $filename = "Facturas.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('descripcion','cantidad','precioUnitario','subtotal','idFactura'), ';', ' ');

    foreach($table as $row) {
        fputcsv($handle, array($row['descripcion'], $row['cantidad'],$row['precioUnitario'],$row['subtotal'],$row['idFactura']), ';', ' ');
    }
    fclose($handle);
    $headers = array(
        'Content-Type' => 'text/csv',
    );
    return Response::download($filename, 'Facturas.csv', $headers);
});