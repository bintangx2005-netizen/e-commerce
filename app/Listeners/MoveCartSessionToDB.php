<?php

namespace App\Listeners;

use App\Events\CartProcceed;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MoveCartSessionToDB
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CartProcceed $event): void
    {
        $carts = session()->get('carts', []);
        foreach ($carts as $cart) {
            $id = (int)$cart['product_id'];
            Cart::updateOrCreate([
                'product_id' => $id
            ], [
                'user_id' => $event->user->id,
                'product_id' => $id
            ]);
        }
    }
}
