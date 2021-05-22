<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deck;
use App\Models\Pokemon;
use App\Models\MainDeck;
use Decks;
use PhpParser\Node\Stmt\Switch_;

class DeckController extends Controller{

    public function createDeck(Request $request){
        
        $id=\Auth::user()->id;
        $deck = new Deck();
        $user=User::where('id',$id)->first();
        $pokes= unserialize($user->pokemons);

        if($request->id){
            $deck->user_id = $id;
            $deck->name = "New Deck";
            $deck->poke_1 = $request->id;
            $deck->poke_2 = 152;
            $deck->poke_3 = 152;
            $deck->poke_4 = 152;
            $deck->save();
    
        } else{
            $deck->user_id = $id;
            $deck->name = "New Deck";
            $deck->poke_1 = $pokes[0];
            $deck->poke_2 = 152;
            $deck->poke_3 = 152;
            $deck->poke_4 = 152;
            $deck->save();
        }
        $hasDeck=MainDeck::where('user_id',$id)->first();

        if($hasDeck!=null){
            error_log('lo tiene');
        }else{
            $main_deck = new MainDeck();
            $main_deck->user_id=$id;
            $main_deck->deck_id=$deck->id;
            $main_deck->save();
        }
       
        return $deck;
    }

    public function getDecks(){
        $id=\Auth::user()->id;
        $decks=Deck::all()->where('user_id',$id);
        $subarray = array();

        foreach ($decks as $i => $value) {
            $array_poke=[];
            array_push($array_poke, $decks[$i]->poke1);
            array_push($array_poke, $decks[$i]->poke2);
            array_push($array_poke, $decks[$i]->poke3);
            array_push($array_poke, $decks[$i]->poke4);
            $subarray[$decks[$i]->id]=$array_poke;
        }
        
        

        return $subarray;

        }

        public function addPokeDeck(Request $request){
            $id=\Auth::user()->id;
            // $decks=Deck::all()->where('user_id',$id);
            $deck_id=$request->deck_id;
            $poke_id=$request->id;
            
            $decks=Deck::where('id',$deck_id)->first();
            $deck = $decks->toArray();

            $deck_ids= [];

            array_push($deck_ids, $decks->poke_1);
            array_push($deck_ids, $decks->poke_2);
            array_push($deck_ids, $decks->poke_3);
            array_push($deck_ids, $decks->poke_4);
        
            if (in_array($poke_id,$deck_ids)){
                error_log("ya lo tiene");
            }else{
                foreach ($deck as $key => $value) {
                    switch ($key) {
                        case 'poke_1':
                            if ($value == 152){
                                // $deck[$key] == $poke_id;
                                $decks->poke_1 = $poke_id;
                                $decks->save();
                                return $value;
                                
                            }
                            // break;
                        case 'poke_2':
                            if ($value == 152){
                                // $deck[$key] == $poke_id;
                                $decks->poke_2 = $poke_id;
                                $decks->save();
                                return $value;
                            }
                            
                        case 'poke_3':
                            if ($value == 152){
                                // $deck[$key] == $poke_id;
                                $decks->poke_3 = $poke_id;
                                $decks->save(); 
                                return $value;
                            }
                            
                        case 'poke_4':
                            if ($value == 152){
                                // $deck[$key] == $poke_id;
                                $decks->poke_4 = $poke_id;
                                $decks->save();
                                return $value;
                            }
                            
                    }
            }
            
        }
    }

    public function dropPokeDeck(Request $request){
        $id=\Auth::user()->id;
        // $decks=Deck::all()->where('user_id',$id);
        $deck_id=$request->deck_id;
        $poke_id=$request->id;
        
        $decks=Deck::where('id',$deck_id)->first();
        $deck = $decks->toArray();

        $deck_ids= [];

        array_push($deck_ids, $decks->poke_1);
        array_push($deck_ids, $decks->poke_2);
        array_push($deck_ids, $decks->poke_3);
        array_push($deck_ids, $decks->poke_4);
    
  
        foreach ($deck as $key => $value) {
            switch ($key) {
                case 'poke_1':
                    if ($value == $poke_id){
                        // $deck[$key] == $poke_id;
                        $decks->poke_1 = 152;
                        $decks->save();
                        return $value;
                        
                    }
                    // break;
                case 'poke_2':
                    if ($value == $poke_id){
                        // $deck[$key] == $poke_id;
                        $decks->poke_2 = 152;
                        $decks->save();
                        return $value;
                    }
                    
                case 'poke_3':
                    if ($value == $poke_id){
                        // $deck[$key] == $poke_id;
                        $decks->poke_3 = 152;
                        $decks->save(); 
                        return $value;
                    }
                    
                case 'poke_4':
                    if ($value == $poke_id){
                        // $deck[$key] == $poke_id;
                        $decks->poke_4 = 152;
                        $decks->save();
                        return $value;
                    }
                    
            }
        
        
    }
}

public function getDeck($id){
    $deck=Deck::where('id',$id)->first();
    $subarray = [];
    array_push($subarray,$deck->poke1);
    array_push($subarray,$deck->poke2);
    array_push($subarray,$deck->poke3);
    array_push($subarray,$deck->poke4);

    return $subarray;

    }

    public function getMainDeck(){
        $id=\Auth::user()->id;
        $deck=MainDeck::where('user_id',$id)->first();


        $curr_deck=Deck::where('id',$deck->deck_id)->first();

        $pokemons=[];
        $subarray = [];
        array_push($subarray,$curr_deck->poke1);
        array_push($subarray,$curr_deck->poke2);
        array_push($subarray,$curr_deck->poke3);
        array_push($subarray,$curr_deck->poke4);



        for ($i=0; $i < count($subarray); $i++) { 
 
            $subarray[$i]->moves= unserialize($subarray[$i]->moves);
            $moves=$subarray[$i]->moves;
    
            $strjson = '[';
            for ($j=0; $j < count($moves); $j++) { 
                $strjson .= $moves[$j];
                if($j < count($moves)-1) $strjson .= ', ';
            }
            $strjson .= ']';
      
            $subarray[$i]->moves=json_decode($strjson);
            array_push($pokemons, $subarray[$i]);
            //error_log($i);
         }  
 
         //dd($pokemons);
         return $pokemons;

    }

    public function deleteDeck(Request $request){
        
        $id=\Auth::user()->id;

        $deck=Deck::all()->where('id',$request->id)->first();

        $main_deck=MainDeck::where('user_id',$id )->first();
     
        if($deck->id==$main_deck->deck_id){
            return true;
           //return "You can't delete your main deck!";
        }else{
            $deck->delete();
        }

    }

    public function isMainDeck(){
        
        $id=\Auth::user()->id;

        $main_deck=MainDeck::where('user_id',$id )->first();

        return $main_deck->deck_id;
     
    }

    public function changeMainDeck(Request $request){
        
        $id=\Auth::user()->id;

        $main_deck=MainDeck::where('user_id',$id )->first();

        $main_deck->deck_id=$request->id;
        $main_deck->save();
        return true;
     
    }

}