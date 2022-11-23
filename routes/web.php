<?php

use Illuminate\Support\Facades\Route;

require_once('includes/auth.php');

Route::group([
    'middleware' => 'auth',
], function() {
        require_once('includes/dashboard.php');
        require_once('includes/kategori.php');
        require_once('includes/servicecategory.php');
        require_once('includes/shippingmethod.php');
        require_once('includes/paymentmethod.php');
        require_once('includes/addresslabel.php');
        require_once('includes/client.php');
        require_once('includes/taylor.php');
        require_once('includes/convection.php');
        require_once('includes/pengguna.php');
        require_once('includes/role.php');
        });


Route::get('/guzzle', 'BeritaController@guzzle');



