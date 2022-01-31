<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    //
    public function cart()
    {
        $val = session()->get("coba");

        if (!isset($val)) {
            return redirect('/login');
        }

        $user = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/user');


        $cart = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/carts', [
            'id_user' => $user['profile']['id']
        ]);

        $cart = $cart['cart'];


        $total = 0;

        foreach ($cart as $c) {
<<<<<<< HEAD
            $total = $total + $c['spec']['publish_price'] * $c['qty'];
        }


=======
            $total = $total + $c['spec'][0]['publish_price'] * $c['qty'];
        }

        
>>>>>>> f357add6d02aa7ded8622f0ab3229b42de7aee18
        return view('user/cart', compact('cart', 'total'));
    }

    public function cartAdd(Request $request, $id)
    {

        $val = session()->get("coba");

        if (!isset($val)) {
            return redirect('/login');
        }


        $user = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/user');

        $cart = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->post('https://api.isitaman.com/api/cart/trystore', [
            'id_user' => $user['profile']['id'],
            'id_product' => $id,
            'id_spec' => $request->input('spec'),
            'qty' => $request->input('qty')
        ]);



        return redirect()->back();
    }

    public function cartDel(Request $request)
    {
        $val = session()->get("coba");

        if (!isset($val)) {
            return redirect('/login');
        }

        $user = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/user');

        $delete = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
<<<<<<< HEAD
        ])->get('https://api.isitaman.com/api/cart/delete', [
            'id_product' => $request->input('product_id'),
            'id_user' => $user['profile']['id']
=======
        ])->post('https://api.isitaman.com/api/cart/store', [
            'id_user' => $user['profile']['id'],
            'id_product' => $id,
            'qty' => $request->input('qty')
>>>>>>> f357add6d02aa7ded8622f0ab3229b42de7aee18
        ]);

        return $delete;

        return redirect('/cart');
    }
<<<<<<< HEAD
}
=======

    public function cartDel(Request $request)
    {
        $val = session()->get("coba");

        if (!isset($val)) {
            return redirect('/login');
        }

        $user = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/user');

        $delete = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('https://api.isitaman.com/api/cart/delete', [
            'id_product' => $request->input('product_id'),
            'id_user' => $user['profile']['id']
        ]);

        return $delete;

        return redirect('/cart');
    }
}
>>>>>>> f357add6d02aa7ded8622f0ab3229b42de7aee18
