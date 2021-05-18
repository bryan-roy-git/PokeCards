<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Pokemon;

class CartController extends ApiResponseController
{
    //
    public function getCart(){
        $id_user=\Auth::user()->id;
        $cart=Cart::where('user_id',$id_user)->get();
        // dd($cart->pokemon);
        $cart_poke = [];
        if (count($cart) > 0){
            for ( $x=0; $x < count($cart); $x++ ){
                array_push($cart_poke,$cart[$x]->pokemon);
            }
        }else{
            
            return $cart_poke;
        }

        for ($x = 0; $x < count($cart_poke); $x++){
            $array_moves=  explode("*", $cart_poke[$x]->moves);
            for ($i = 0; $i < count($array_moves); $i++){
                $array_moves[$i] = json_decode($array_moves[$i]);
            }
            $cart_poke[$x]->moves=$array_moves;
        }


        // dd($cart_poke);
        return $this->successResponse($cart_poke);
    }

    public function addPoke(Request $request)
    {
        //dd($request->all());
        $id_user=\Auth::user()->id;
        $id_poke = $request->all()['id_poke'];
        

        $cart = new Cart();
        $cart->user_id = $id_user;
        $cart->poke_id = $id_poke;
        
        $stat = $cart->save();

        if (!$stat) {
            return $this->errorResponse("No se pudo añadir el pokemon");
        }
        // dd($cart);
        return $this->successResponse($cart);
    }

    public function delPoke(Request $request)
    {
        // dd($request->all());
        $id_user=\Auth::user()->id;
        $id_poke = $request->all()['id_poke'];
        
        // $reg=Cart::where('user_id',$id_user)->where('poke_id',$id_poke)->get();
        $reg=Cart::where('user_id',$id_user)->where('poke_id',$id_poke)->delete();
        // dd($reg);

        if ($reg == 0) {
            return $this->errorResponse("No se escontro ese pokemon en el carrito");
        }
        // dd($cart);
        return $this->successResponse("pokemon eliminado del carrito");
    }

    // public function shop_register (Request $request) {
    //     $total = $request->all()['price_total'];
    //     $pokes_id = $request->all()['pokes_id'];

    // }
}
