<template>
<div class="contianer">
    <h1>Mis Games Offline</h1>
    <!-- {{pedidos}} -->
    <table class="table table-hover ">
        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rewards</th>
                    <th scope="col">Coins</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <!-- <span v-for="game in gamesOff" :key="game.id"> -->
                <tbody v-for="game in gamesOff" :key="game.id">
                    <tr v-if="game.wins == 1" style="backgound:red">
                        <th scope="row">{{game.id}}</th>
                        <td>{{game.rewards}}</td>
                        <td>{{game.coins}}</td>
                        <td>{{game.created_at}}</td>
                    </tr>
                    <tr v-else style="backgound:green">
                        <th scope="row">{{game.id}}</th>
                        <td>{{game.rewards}}</td>
                        <td>{{game.coins}}</td>
                        <td>{{game.created_at}}</td>
                    </tr>
                </tbody>
            <!-- </span> -->
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
                console.log(response.data,"MYS GAMES_OFF")
                this.gamesOff = response.data;
            })
            for ( let x=0; x<this.gamesOff.length; x++ ) {
            var date = new Date(this.gamesOff[x].created_at);
            console.log(this.gamesOff[x].wins)
            this.gamesOff[x].created_at = date.toDateString()
            console.log(date.toDateString(),' - ', date.toLocaleTimeString())
            }



        // },
        },
    }
}
</script>
<style>
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