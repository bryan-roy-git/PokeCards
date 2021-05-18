<template>
<div class="container mt-5 mb-5">

    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="p-2">
                <h4>PokeCart</h4>
            </div>
            <div v-for="pokemon in pokemons_cart" :key="pokemon.id">
            <!-- <span v-for="(pokemon, key) in cartpokes_db">
                {{ key }}: {{ pokemon }} -->
                <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                    <div class="mr-1"><img class="rounded" :src=pokemon.image_path width="70"></div>
                    <div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold">{{pokemon.name}}</span>
                        <div class="d-flex flex-row product-desc">
                            <h5 class="text-grey">{{ pokemon.price }}</h5>
                            <i class="fa fa-trash mb-1 text-danger btn" @click="delPokemon(pokemon)"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                <p>{{ total_cart }}</p>                
                <button class="btn btn-warning btn-block btn-lg ml-2 pay-button" type="button" @click="comprar()">Proceed to Pay</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
import cart from '../store/index'
import user from '../store/store'
// import Vuex from 'vuex'
export default {
    name: 'BaulComponent',

    data: function () {
            return {
                total:0,
                user:user.state.user,
                coins:'',
            }
    },
    methods:{
    
        async delPokemon (pokemon) { // todo lo que usemos en la vista hay que retornarlo
            await axios.post('api/cart/delpoke',{
                id_poke:pokemon.id
            })
            // .then(() => {
                
            // })
            await axios.post('api/user/sumarPrice',{
                price:pokemon.price
            })
            // .then((res) => {
            //     this.coins = res.data
            // })
            cart.dispatch('delPoke',pokemon)
            user.dispatch('del_poke',pokemon.price)
        },
   
        async comprar () {
            var pokes = cart.state.pokemons_cart
            //console.log(this.total_cart)
            // console.log("comprar",this.pokemons_cart)
            //console.log(pokes)
            // console.log(pokes[x].id)
            await axios.post('api/user/savePoke',{
                pokes_id:pokes,
                price_total:this.total_cart
            })
            .then(res =>{
                console.log(res)
                
            })
            // await axios.post('api/')
            cart.dispatch('resetCart')
            user.dispatch("getUser")
            this.$awn.success("Compra realizada corretamente")

            
        }
 
    },
    computed:{
        pokemons_cart: function () {
            // cart.dispatch('fetcCart')
            // this.cart=this.pokemons_cart
            //console.log(cart.state.pokemons_cart,"computed_Baul")
            return cart.state.pokemons_cart
        },
        
        total_cart: function () {
            var total = 0
            for (let index = 0; index < cart.state.pokemons_cart.length; index++) {
                total += cart.state.pokemons_cart[index].price
            }
            return total
        },
      
        total_user: function () {
            //console.log("entra precio")
            var calc = this.user.price -= this.total_cart
            //console.log(calc)
            return calc
        },
        
        coins_total: function () {
            return this.coins
        }
       
    },
     
    created () { // antes de pintar el template ejecuta el created
        //console.log(this.user,"autenticado created")
        // await cart.dispatch('fetcCart')
    }, 
   
    
    mounted () { // una vez creado y montado el componente 
        cart.dispatch('fetcCart')
        if (this.user != null){
            this.coins=user.state.user.coins
        }  
     
    },
}
</script>
<style scoped lang="scss">

    @import "../../css/styles.css";
</style>