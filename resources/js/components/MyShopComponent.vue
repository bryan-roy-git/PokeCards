<template>
<div class="contianer">
    <h1>Mis compras</h1>
    <!-- {{pedidos}} -->
    <table class="table table-hover">
        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pokemon</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <!-- <span v-for="pedido in pedidos" :key="pedido.id"> -->
                <tbody  v-for="pedido in pedidos" :key="pedido.id">
                    <tr>
                        <th scope="row">{{pedido.id}}</th>
                        <td>{{pedido.pokemon.name}}</td>
                        <td>{{pedido.created_at}}</td>
                        <td>{{pedido.price}}</td>
                    </tr>
                </tbody>
            <!-- </span> -->
    </table>
</div>
</template>

<script>

    export default {
        
        name: 'MyShopComponent',
        created () {
            this.getMyShop () 
        },
        data: function () {
            return {
                pedidos:"",
            }
        },
        methods:{
            async getMyShop () {
                // this.$awn.asyncBlock(fetch('/api/pokemon?page='+this.currentPage)
                await axios.get('/api/user/getMyShops')
                .then(response => {
                    console.log(response.data,"MYS COMPRAS")
                    this.pedidos = response.data;
                    })
                for ( let x=0; x<this.pedidos.length; x++ ) {
                    var date = new Date(this.pedidos[x].created_at);
                    // console.log(f)
                    this.pedidos[x].created_at = date.toDateString()
                    // this.pedidos[x].created_at = date.toDateString()+' - '+date.toLocaleTimeString()
                    console.log(date.toDateString(),' - ', date.toLocaleTimeString())

                }
    
            },
        },

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