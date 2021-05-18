<template>
<div class="tienda">
    <div class="container">
            <pokemon-component v-if="total > 0"
                :pokemons="pokemons"
                :total="total"
                @getCurrentPage="getCurrentPage"
                @addPokemon="addPokemon"
                >
            </pokemon-component>
    </div>

    <div class="baul">
            <baul-component>
                
            </baul-component>
    </div>
 
</div>
</template>

<script>
import PokemonComponent from './PokemonComponent';
import BaulComponent from './BaulComponent';
    export default {
        components: { PokemonComponent, BaulComponent },
        
        name: 'TiendaPokeComponent',
        created () {
            this.getPoke();
        },
        data: function () {
            return {
                pokemons: [],
                total:0,
                currentPage:1,
                pokeAdd:[],
            }
        },
        methods:{
            async getPoke () {
                // this.$awn.asyncBlock(fetch('/api/pokemon?page='+this.currentPage)
                await fetch('/api/pokemon?page='+this.currentPage)
                .then(response => {
                    return response.json()
                    })
                .then(json => {
                    console.log(json.data,"paginacion");
                    console.log(json.data)
                    this.pokemons = json.data.data;
                    this.total = json.data.last_page
                    // console.log(this.total)
                    })
                .catch (error => {
                    console.log("ERROR ",error);
                    return this.$router.push('signin')
                })
            },
            getCurrentPage (page){
                this.currentPage=page
                console.log("pokeList: "+page)
                this.getPoke()
            },
            addPokemon(poke){
                console.log(poke,"tienda")
                this.pokeAdd.push(poke)
            }
        },

    }
</script>
<style scoped>
.tienda{
    display: flex;
    width: 100%;
}

.container{
    width: 70%;
}
.baul{
    background: rgb(176, 138, 42) !important;
    width: 30%;
}
</style>