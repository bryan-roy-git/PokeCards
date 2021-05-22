<template>
    <div>
        <i class="fa fa-ruble-sign"> </i>  {{current_coins}}
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                <th scope="col">Pokemon</th>
                <th scope="col">Icon</th>
                <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pokemon in pokemons_cart" :key="pokemon.id">
                    <th scope="row">{{pokemon.name}}</th>
                    <td><img class="rounded" :src=pokemon.image_path width="40"></td>
                    <td>{{pokemon.price}}
                        <i class="fa fa-trash text-danger" @click="delPokemon(pokemon)"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col"><dt>Total to pay: <i class="fa fa-ruble-sign"> </i>  {{total_cart}}</dt></th>
                    <th scope="col" v-if="total_cart > 0">
                            <button class="btn btn-success" data-abc="true" @click="comprar()"> Proceed to Pay</button>
                        </th>
                        <th scope="col" v-else>
                            <button class="btn btn-success" data-abc="true" @click="comprar()" disabled> Proceed to Pay</button>
                        </th>
                </tr>
            </thead>
        </table>
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
        
        current_coins: function () {
                //console.log("coin total")
                return user.state.monedas
        },

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

    // @import "../../css/styles.css";
</style>
