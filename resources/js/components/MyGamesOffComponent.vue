<template>
<div class="mygames">
    <div class="chooseArea">My Game Records</div>
    <!-- {{pedidos}} -->
    <table class="table table-hover table-dark">
        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rewards</th>
                    <th scope="col">Player Poke</th>
                    <th scope="col">Oponent Poke</th>
                    <th scope="col">Coins</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody v-for="game in gamesOff" :key="game.id">
                <tr v-if="game.wins == 1" style="background-color:green;">
                    <th scope="row">{{game.id}}</th>
                    <td>{{game.rewards}}</td>
                    <td><img class="poke_icon" :src="game.pokemon_player.image_path" alt=""></td>
                    <td><img class="poke_icon" :src="game.pokemon_op.image_path" alt=""></td>
                    <td>{{game.coins}}</td>
                    <td>{{game.created_at}}</td>
                </tr>
                <tr v-else style="background-color:tomato;">
                    <th scope="row">{{game.id}}</th>
                    <td>{{game.rewards}}</td>
                    <td><img class="poke_icon" :src="game.pokemon_player.image_path" alt=""></td>
                    <td><img class="poke_icon" :src="game.pokemon_op.image_path" alt=""></td>
                    <td>{{game.coins}}</td>
                    <td>{{game.created_at}}</td>
                </tr>
            </tbody>
    </table>
</div>
</template>

<script>

export default {
    
    name: 'MyGamesOff',
    created () {
        this.getGamesOff () 
    },
    data: function () {
        return {
            gamesOff:"",
        }
    },
    methods:{
        async getGamesOff () {
        //     // this.$awn.asyncBlock(fetch('/api/pokemon?page='+this.currentPage)
            await axios.get('/api/user/getGamesOff')
            .then(response => {
                // console.log(response.data,"MYS GAMES_OFF")
                this.gamesOff = response.data;
                console.log(this.gamesOff,"MYS GAMES_OFF")
            })
            for ( let x=0; x<this.gamesOff.length; x++ ) {
            var date = new Date(this.gamesOff[x].created_at);
            // console.log(this.gamesOff[x].wins)
            this.gamesOff[x].created_at = date.toDateString()
            // console.log(date.toDateString(),' - ', date.toLocaleTimeString())
            }



        // },
        },
    }
}
</script>




<style scoped>

.mygames{
    color: white;
}


.poke_icon{
    width: 50px;
    height: 50px;
}


</style>