<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {

        $data = Product::all();

        $products['products'] = $data;

        return view('index',  $products);
    }


    public function dashboard()
    {

        $user = Auth::user();

        if ($user->role == 1) {

            return view('admindashboard');
        } else {

            return view('dashboard');
        }
    }



    public function viewadd()
    {

        $user = Auth::user();

        if ($user->role == 1) {

            return view('addproducts');
        } else {

            return redirect()->back();
        }
    }

    public function addproducts(Request $request)
    {


        if ($request->hasfile('image')) {

            $file = $request->file('image');

            $image =  $file->getClientOriginalName();

            $file->move('images', $image);
        }



        $products = new Product();

        $products->name = request('name');
        $products->price = request('price');
        $products->details = request('details');
        $products->quantity = request('quantity');
        $products->image = $image;

        $products->save();

        return redirect()->route('manage');
    }


    public function manage()
    {
        $data = Product::all();

        $product['products'] = $data;

        return view('manage', $product);
    }

    public function edit($id)
    {
        $data = Product::find($id);

        $products['product'] = $data;

        return view('edit', $products);
    }

    public function update(Request $request, $id)
    {

        if ($request->hasfile('image')) {

            $file = $request->file('image');

            $image =  $file->getClientOriginalName();

            $file->move('images', $image);
        }

        $data = Product::find($id);

        $data->name = request('name');
        $data->price = request('price');
        $data->details = request('details');

        $data->image = $image;


        $data->save();

        return redirect()->route('manage');
    }

    public function delete($id)
    {
        $data = Product::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function details($id)
    {

        $product = Product::find($id);

        $products['products'] = $product;

        return view('productdetails', $products);
    }


    public function add_to_cart(Request $request, $id)
    {


        $user = auth()->user()->id;

        $session = session()->getId();

        $product = Product::find($id);

        $productid = Cart::pluck('product_id')->toArray();

        if (in_array($request->id, $productid)) {


            $cart = Cart::where('product_id', $request->id)->first();

            $cart->session_id = $session;
            $cart->user_id = $user;
            $cart->quantity = $cart->quantity + request('quantity');

            $cart->save();

            return redirect()->back();
        } else {

            $cart = new Cart();

            $cart->product_id = $product->id;

            $cart->session_id = $session;
            $cart->user_id = $user;
            $cart->product_name = $product->name;

            $cart->product_price = $product->price;

            $cart->image = $product->image;

            $cart->quantity = request('quantity');

            $cart->save();
            return redirect()->back();
        }
    }

    public function deletecart($id)
    {

        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function cartlist()
    {
        if (Auth::check()) {

            $user = auth()->user()->id;

            $cart = Cart::all()->where('user_id', $user);

            $view['carts'] = $cart;


            $total = 0;

            foreach ($cart as $carts) {
                $total +=  $carts->product_price *  $carts->quantity;
            }
            $view['carttotal'] = $total;

            return view('cartlist', $view);
        } else {

            $data = session()->getId();
            $cart = Cart::all()->where('session_id', $data);

            $total = 0;

            foreach ($cart as $carts) {
                $total +=  $carts->product_price *  $carts->quantity;
            }
            $view['carttotal'] = $total;
            $view['carts'] = $cart;
            return view('cartlist', $view);
        }
    }

    public function updatecart(Request $request, $id)
    {

        $cart = Cart::find($id);

        $cart->quantity = request('quantity');

        $cart->save();

        return redirect()->back();
    }

    public function clear()
    {

        $user = auth()->user()->id;

        $cart = Cart::all()->where('user_id', $user);

        foreach ($cart as $carts) {

            $carts->delete();
        }
        return redirect()->back();
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function check(Request $request)
    {
        $user = Auth::user();

        $checkout = new Checkout();

        $checkout->name = $user->name;
        $checkout->email = $user->email;
        $checkout->country = request('country');
        $checkout->state = request('state');
        $checkout->town = request('town');
        $checkout->street = request('street');
        $checkout->apartment = request('apartment');
        $checkout->zipcode = request('zipcode');

        $checkout->save();

        return redirect()->route('payment');
    }
    public function payment()
    {
        return view('payment');
    }
        private function getCartTotal()
    {
        if (Auth::check()) {
            $user = auth()->user()->id;
            $cart = Cart::all()->where('user_id', $user);
        } else {
            $sessionId = session()->getId();
            $cart = Cart::all()->where('session_id', $sessionId);
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item->product_price * $item->quantity;
        }

        return $total;
    }

    public function pay(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;;
        $totalAmount = $this->getCartTotal();
        $status = 'success'; 
        $reference=rand(10,1000);

        $order = new Order();

       
        $order->email = $email;
        $order->amount = $totalAmount;
        $order->status = $status;
        $order->reference = $reference;
       
        $order->save();
        $Carts = Cart::all()->where('user_id', $user->id);

                    foreach ($Carts as $cart) {
    
                        $cartlist = new OrderDetails();
    
                        $cartlist->order_id = $order->id;
    
                        $cartlist->name = $cart->product_name;
                        $cartlist->price = $cart->product_price;
                        $cartlist->image = $cart->image;
                        $cartlist->quantity = $cart->quantity;
    
                        $cartlist->save();
                    }
    
        
        Cart::where('user_id', $user->id)->delete();

        
        return redirect()->route('orderdetails');
}

    // public function redirect(Request $request)
    // {

    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $request->reference,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: Bearer sk_test_0c347db885902a8b49b677ddb3716b69dce6801f",
    //             "Cache-Control: no-cache",
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         $data = json_decode($response, true);

    //         if ($data['status'] == true) {

    //             $email = $data['data']['customer']['email'];
    //             $amount = $data['data']['amount'];
    //             $status = $data['data']['status'];
    //             $refrence = $data['data']['reference'];

    //             $order = new Order();

    //             $order->email = $email;
    //             $order->amount = $amount;
    //             $order->status = $status;
    //             $order->reference = $refrence;

    //             $order->save();

    //             $user = Auth::user();

    //             $Carts = Cart::all()->where('user_id', $user->id);

    //             foreach ($Carts as $cart) {

    //                 $cartlist = new OrderDetails();

    //                 $cartlist->order_id = $order->id;

    //                 $cartlist->name = $cart->product_name;
    //                 $cartlist->price = $cart->product_price;
    //                 $cartlist->image = $cart->image;
    //                 $cartlist->quantity = $cart->quantity;

    //                 $cartlist->save();
    //             }


    //             return redirect()->route('orderdetails');
    //         }
    //     }
    // }

    public function orderdetails()
    {
        $user = auth()->user()->email;
        $order = Order::all()->where('email', $user);

        $view['orders'] = $order;
        return view('orderdetails', $view);
    }

    public function vieworders()
    {
        $view = OrderDetails::all();

        $data['orders'] = $view;

        return view('veiworders', $data);
    }
}