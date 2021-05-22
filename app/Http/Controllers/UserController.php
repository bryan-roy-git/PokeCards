<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pokemon;
use App\Models\Cart;
use App\Models\Shop;
use App\Models\GamesOffline;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $users=User::all();
        return $users;
    }

    public function store(Request $request){
        $user=User::create($request->all());
        return $user;
    }

    public function setPokemon(Request $request){
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();
        $pokemons= unserialize($user->pokemons);
        //dd($pokemons);
        if ($pokemons == null){
            $pokemons = [$request->id];
        } else{
            if(in_array($request->id, $pokemons )){
                return false;
            }
            else{
                array_push($pokemons, $request->id);
            }   
        }

        $poke_array = serialize($pokemons);
            $poke= DB::table('users')
            ->where('id',$id)
            ->update(['pokemons' => $poke_array]);
        

        return $poke;
    }

    public function setRewards(Request $request){
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();
        // dd($request);

        $gmOff = new GamesOffline();
        // dd($gmOff);
       
        $gmOff->user_id = $id;
        $gmOff->poke_player = $request->poke_player;
        $gmOff->poke_op = $request->poke_op;
        $gmOff->wins = $request->wins;
        $pokemons= unserialize($user->pokemons);
        error_log($request->coins);
        error_log($request->droppedPokemon);
        $coins=$request->coins;

        $gmOff->coins = $coins;

        $coins=$coins+$user->coins;
        error_log($coins);
        DB::table('users')
            ->where('id',$id)
            ->update(['coins' => $coins]); 
        
        if (in_array($request->droppedPokemon, $pokemons) || $request->droppedPokemon==null){
            error_log('already owned');
            $gmOff->rewards = null;
            $request->droppedPokemon=null;
            // return $request->droppedPokemon=null;
        } else{
            $gmOff->rewards = $request->droppedPokemon;
            array_push($pokemons, $request->droppedPokemon);
            $poke_array = serialize($pokemons);
            DB::table('users')
            ->where('id',$id)
            ->update(['pokemons' => $poke_array]); 
        }
        
        $gmOff->save();
        // return $user;
    }

    public function restar_price (Request $request) {
        // dd($request->all()['price']);
        $price = $request->all()['price'];
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();

        // dd($price,$user->coins);
        $res = $user->coins -= $price;
        // $res = $user->coins -= 1;
        // dd($user);
        $user->save();
      
        return $res;

    }

    public function sumar_price (Request $request) {
        // dd($request->all()['price']);
        $price = $request->all()['price'];
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();
        // dd($price,$user->coins);
        $res = $user->coins += $price;
        // $res = $user->coins += 1;
        // dd($user);
        $user->save();
        return $res;
    }

    public function save_poke (Request $request) {
        $total = $request->all()['price_total'];
        $pokes_id = $request->all()['pokes_id'];
        $ids=[];
        // dd($total,$pokes_id);
        for ($x=0; $x<count($pokes_id); $x++){
            // dd($pokes_id[$x]["id"]);
            array_push($ids, $pokes_id[$x]["id"]);
        }
        // dd($ids);

        
        
        

        
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();

        if ($user->pokemons == null){
            $user->pokemons = serialize($ids);
        }else{
            $new_array = unserialize($user->pokemons);
            // dd($new_array);
            for ($x=0; $x<count($pokes_id); $x++){
                array_push($new_array, $ids[$x]);
                $shop = new Shop();
                $shop->user_id = $id;
                $shop->poke_id = $ids[$x];
                $shop->price = $total;
                $shop->save();
            }
            $user->pokemons = serialize($new_array);
        }
        // dd($user,$shop);
        
        $user->save();
        

        $this->resetCart();

        return "Compra realizada correctamente";
        // dump($user);
        // dd($user);
    }


    public function resetCart () {
        $id_user=\Auth::user()->id;
        $cart=Cart::where('user_id',$id_user)->delete();
    }

    public function pokesUser(){
        $id=\Auth::user()->id;
        $user=User::where('id',$id)->first();
        $pokemons= unserialize($user->pokemons);
        return $pokemons;
    }

    public function PricePoke (){
        $pokemons = Pokemon::all();
        for ($x=0; $x<count($pokemons); $x++){
            $rare = $pokemons[$x]->rarity;
            switch ($rare) {
                case 'common':
                    $pokemons[$x]->price = 5000;
                    $pokemons[$x]->save();
                    break;
                case 'rare':
                    $pokemons[$x]->price = 15000;
                    $pokemons[$x]->save();
                    break;
                case 'superrare':
                    $pokemons[$x]->price = 25000;
                    $pokemons[$x]->save();
                    break;
                case 'unique':
                    $pokemons[$x]->price = 50000;
                    $pokemons[$x]->save();
                    break;
                case 'legend':
                    $pokemons[$x]->price = 100000;
                    $pokemons[$x]->save();
                    break;
            }
        }
        //dd($pokemons);
    }



}

