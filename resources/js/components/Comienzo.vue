<template>
<div id="Comenzando">
  <div class="main">
    <h1 class="welcome">
      <span class="centerWelcome">
      Welcome to the world of PokeCards!
      </span>
    </h1>
    <h2>Choose your starter:</h2>
  </div>
  <div>
</div>

<div class="chooseOne">
  <div class="center">

    <router-link class="router" to="/tutorial/Bulbasaur">
    <div @click="isBulbasaur" class="card starting carta">
      <img class="card-img-top" :src="Bulbasaur.image_path" alt="bulbasaur">
      <span class="card-name">{{Bulbasaur.name}}</span>
      <span class="card-text">HP: {{Bulbasaur.hp}}</span>
      <span class="card-text">ATK: {{Bulbasaur.atk}}</span>
      <span class="card-text">DEF: {{Bulbasaur.def}}</span>
      <span class="card-attack">SPD: {{Bulbasaur.spd}}</span>
    </div>
    </router-link>

    <router-link class="router" to="/tutorial/Charmander">
    <div @click="isCharmander" class="card starting carta">
      <img class="card-img-top" :src="Charmander.image_path" alt="charmander">
      <span class="card-name"><img class="types-icon" :src="IconsPath+'Fire.png'" /> 
       Charmander 
     <img class="types-icon" :src="IconsPath+'Fire.png'" /> </span>
      <span class="card-text">HP: {{Charmander.hp}}</span>
      <span class="card-text">ATK: {{Charmander.atk}}</span>
      <span class="card-text">DEF: {{Charmander.def}}</span>
      <span class="card-attack">SPD: {{Charmander.spd}}</span>
    </div>
    </router-link>
    
    <router-link class="router" to="/tutorial/Squirtle">
    <div @click="isSquirtle" class="card starting carta">
      <img class="card-img-top" :src="Squirtle.image_path" alt="squirtle">
      <span class="card-name">{{Squirtle.name}}</span>
      <span class="card-text">HP: {{Squirtle.hp}}</span>
      <span class="card-text">ATK: {{Squirtle.atk}}</span>
      <span class="card-text">DEF: {{Squirtle.def}}</span>
      <span class="card-attack">SPD: {{Squirtle.spd}}</span>
    </div>
    </router-link>
  </div>
</div>
</div>
</template>

<script>
//import axios from 'axios';
import $ from 'jquery';

$(document).ready(function () {
  //Desactiva cortar, copiar y pegar
  $(document).bind('cut copy paste', function (e) {
      e.preventDefault();        
  });

  //Desactiva click dret
  $(document).on("contextmenu",function(e){
      console.log(e)
      return false;
      });
});

export default {
  name: 'Comenzando',
  components:{
  },
  data(){
    return{
      pokemon:'',
      Bulbasaur:'',
      Charmander:'',
      Squirtle:'',
      IconsPath: "https://raw.githubusercontent.com/HoussamBenali/Assets/b09577915f44df2007555b8f23d58850cf26b696/images/Types/",
    }
  },
  mounted(){
    this.getPokeData()
  },
  methods:{
    async getPokeData(){
                const resB = await axios.get('/api/pokemon/1')
                console.log(resB)
                console.log(resB.data)
                this.Bulbasaur = resB.data.data
                console.log(this.Bulbasaur)

                const resC= await axios.get('/api/pokemon/4')
                this.Charmander = resC.data.data
              
                const resS = await axios.get('/api/pokemon/'+7)
                this.Squirtle = resS.data.data
  
    },

    isCharmander(){
      return this.pokemon = 'Charmander'
    },
    isBulbasaur(){
      return this.pokemon = 'Bulbasaur'
    },
    isSquirtle(){
      return this.pokemon = 'Squirtle'
    }
  },
  beforeRouteLeave (to, from, next) {
			this.$dialog.confirm('Are you sure you want to pick '+this.pokemon+'?')
			.then(function () {
				next();
			})
			.catch(function () {
				next(false);
			});
		},

    
    
}


</script>

<style scoped lang="scss">
@import "../../css/cards.css";
@import "../../css/cardsMobile.css";

//background: linear-gradient(45deg, #17ead9, #6078ea);
@media (min-width: 630px) {
.chooseOne{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}
.router{
    text-decoration: none !important;
    color: black !important;
    margin-right: 1.5vw !important;
}


.router:hover{

  text-decoration: none;
}

.carta{
    min-width: 120px;
    max-width: 150px;
    width: 10vw;
    height: 220px;
    font-size: 40px;
    background: linear-gradient( to top left, rgb(77, 76, 76), white, rgb(90, 90, 90));
    background-size:300% 300%;
    margin: 0vw;
    border-radius: 5px;
    border: solid black 2px !important;
    animation: reflect 3s infinite linear;
    /*animation-direction: alternate;*/
}
}

</style>
