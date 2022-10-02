<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception\InvalidOrderException;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{

    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            throw new InvalidOrderException('Cart is empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {

        // event(new OrderCreated(new Order()));
        $dd=$request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }
                foreach ($request->post('addr') as $type => $address) {
                    $address['order_id'] = $order->id;
                    $address['type'] = $type;
                    $order->addresses()->create($address);

                }
            }

            DB::commit();

            // event('order.created', $order, Auth::user()); //we can create event with name and pass params
            event(new OrderCreated($order));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

       // return redirect()->route('home');//->route('orders.payments.create', $order->id);
    }
}
