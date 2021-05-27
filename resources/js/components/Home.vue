
<template>
<div id="home">

 <div class="main">

<section id="carrusel" class="zpos" >      
  <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
  
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="zapdos" src="https://cdn.alfabetajuega.com/wp-content/uploads/2019/12/Zapdos-3-1280x720-780x405.jpg" alt="1">
        <div class="carousel-caption trickcenter">
          <div>
            <button class="plusButtonCarousel" v-on:click="mostrarToast()"><span id="bt">Gameplay</span></button>
        </div>
        </div>
      </div>

       <div class="carousel-item ">
        <img src="https://guiltybit.com/wp-content/uploads/2020/10/cabecera-2-1.jpg" alt="1">
        <div class="carousel-caption trickcenter">
          <div>
              <button class="plusButtonCarousel" v-on:click="mostrarToast()"><span id="bt">Gameplay</span></button>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://www.beahero.gg/wp-content/uploads/2021/03/BP5GOSYU4ZFOVIP2C3GM43VKSA.jpg" alt="3">
        <div class="carousel-caption trickcenter">
          <div>
              <button class="plusButtonCarousel" v-on:click="mostrarToast()"><span id="bt">Gameplay</span></button>
          </div>
        </div>
      </div>
  
    <!-- Left and right controls -->
    <a id="leftcontrol" class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a id=rightcontrol class="carousel-control-next" href="#demo" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
  </div>
  
      
</section>
   
 </div>
 <div class="text" v-if="gameplay">
   <div class="cabecera"><span class="title">¡Welcome to PokeCards!</span><br></div>
   <p>Our web application is a card collection game with a battle system based on the classic games of the Pokémon franchise, where our players battle throught the use of a deck of their choice;  </p><br>
   <p>We have also designed a juicy pokecards Shop where with the pokeCoins gained in the offline battles you can buy and obtain your favorite pokecards!</p>
   <br>
   <p>Our players right now have an offline battle mode where to enjoy a 1 vs 1 turn based fight with a chance of dropping the opponent pokemon!  <br>
      They also have a place where to create and customize their decks!
      In the future we are thinking of implementing online battles with a pointbased ranking system where the top scorers can obtain juicy rewards! </p>
   
    <p>We hope you like it!</p>
   </div>

</div>
</template>

<script>
//import axios from 'axios';

export default {
  data () {
    return {
      gameplay: false
    }
  },
  name: 'Home',
  methods: {
  mostrarToast(){
    this.gameplay=true
  },
  cerrar() {
    this.gameplay=false
  }
  }  

}

</script>

<style scoped lang="scss">
  @import "../../css/styles.css";

  .butin {
    position: absolute;
    top: 510px;
    right: 0;
  }

  .cabecera {
    display: inline-block;
  }

  .text {
    width: 100vw;
    height: 500px;
    background-color: black;
    border: solid 1px white;
    color: white;
  }
  .title {
    font-size: 25px;
    color: yellow;
  }

  #home{
  background-color: none;
  display: block;
  width: 100%;
  height: 100vh;
}

.tamaño {
  height: 1000px!important;
}

.bodyForm{
    background-color: rgb(195, 236, 229);
    
  }
  
  .bodyIndex{
    background-color: rgb(48, 184, 166);
  }

  .carousel-inner img {
    width: 100%;
    height: 85vh;
  }

  h2, h3{
    color: rgb(192, 190, 190);
  }

  #mesInformacio{
    background-color: white;
  }

  .plusButton{
    background-color: rgb(48, 184, 166);
        border-radius: 0.5vh;
    cursor: pointer;
    color: rgb(248, 247, 247);
    padding: 6px 6px;
    
  }

  .plusButton:link{
    text-decoration: none;
  }

  .plusButtonCarousel{
    position: relative;
    background-color: black;
    border-radius: 0.5vh;
    cursor: pointer;
    color: rgb(248, 247, 247);
    padding: 10px 20px;
    border: solid 1px white;
    top: 20vh;
    
  }


  #bt {
     color:white;

  }

  .plusButtonCarousel:link{
    text-decoration: none;
  }

  .carousel-caption {
  position: absolute;
  z-index: 3;
  display:table;
  width:100%;
  height:100%;
}

.carousel-caption div {
    display:table-cell;
    vertical-align: middle;
    text-align:center;
}

.trickcenter {
    position: absolute;
    top: 60%; 
    left: 50%;
    transform: translate(-50%, -50%);
}

.img-max {
max-width: 1vw;
max-height: 4vh;
}

#leftcontrol{
background: black;
z-index: 3;

}

#rightcontrol{
background: black;
z-index: 3;
}

h5{
color: rgb(248, 247, 247);
margin-right: 1vw;
font-weight: normal;
}

#navcolor{
color: rgb(248, 247, 247);
margin-right: 1vw;
font-weight: normal;
background-color: rgb(48, 184, 166);
padding: 0.5vw;
}

#navcolor:hover{
background-color: black;
border-radius: 1vh;
}

h4{
color: rgb(248, 248, 248);
font-weight: normal;
}

.toast-header{
 width: 308px;
}

#mitoast {
  visibility: hidden;
  position: fixed;
  z-index: 4;
  right: 32vw;
  top: 12vh;
  border: 1px solid rgba(0,0,0,.1);
  border-radius: .25rem;
  box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.1);
  max-width: 310px;
  width: 310px;
  background-color: #ffffff;
  opacity: 1;
}
 
#mitoast.mostrar {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 4.6s;
  animation: fadein 0.5s, fadeout 0.5s 4.6s;
}
 
@-webkit-keyframes fadein {
  from {right: 0; opacity: 0;} 
  to {right: 33vw; opacity: 1;}
}
 
@keyframes fadein {
  from {right: 0; opacity: 0;}
  to {right: 33vw; opacity: 1;}
}
 
@-webkit-keyframes fadeout {
  from {right: 33vw; opacity: 1;} 
  to {right: 0; opacity: 0;}
}
 
@keyframes fadeout {
  from {right: 33vw; opacity: 1;}
  to {right: 0; opacity: 0;}
}
 
#mitoast.cerrar {
  /* visibility: visible; */
  -webkit-animation: fadeout 0.5s 4.8s;
  animation: fadeout 0.5s 4.8s;
}
 
@-webkit-keyframes fadeout {
  from {right: 33vw; opacity: 1;} 
  to {right: 0; opacity: 0;}
}
 
@keyframes fadeout {
  from {right: 33vw; opacity: 1;}
  to {right: 0; opacity: 0;}
}

#toastColor{
  background-color: rgb(48, 184, 166);
}

input {
  box-sizing: border-box;
  width: 80%;
  height: 5vh;
  border-radius: 1vh;
  border-color: lightgray;
  margin-bottom: 3.5vh;
  padding-left: 2vh;
}

textarea {
  box-sizing: border-box;
  width: 80%;
  height: 20vh;
  border-radius: 1vh;
  border-color: lightgray;
  padding-left: 2vh;
  padding-top: 1vh ;
}

#ico {
  border-radius: 1vh;
  color: dodgerblue;
  font-size: 6vh;
  vertical-align: middle;
  margin-right: 2vw;
  margin-bottom: 1.5vh;

}

#icon {
  border-radius: 1vh;
  color:dodgerblue;
  font-size: 6vh;
  vertical-align: middle;
  margin-top: -33vh;
  margin-right: 2.5vw;
  
}

#tlfIcon{
  border-radius: 1vh;
  color: dodgerblue;
  font-size: 6vh;
  vertical-align: middle;
  margin-right: 2.5vw;
  margin-bottom: 1.5vh;
  
}

#send{
text-align: center;
}


form{
  width: 50%; 
  margin-left: auto; 
  margin-right: auto;
  margin-top: 4vh;
  min-width: 400px;
}

h1{
  margin-top: 3vh;
  text-align: center;
  color: dodgerblue;
}

#sendButton{
  padding-left: 1vw;
  padding-right: 1vw;
  font-size: x-large;
  margin-top: 1.5vh;
}

#loading{
  text-align: center;
}
</style>
