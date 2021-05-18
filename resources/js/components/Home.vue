
<template>
<div id="home">

 <div class="main">
   <span v-if="$store.state.auth">Hi,  Nadie
    <div class="info" >
     <p> nada </p>
    </div>
   </span>
   <h1 v-else> You are not logged in! <br><router-link to="login">Sign in!</router-link></h1>
   
 </div>

</div>
</template>

<script>
//import axios from 'axios';

export default {
  name: 'Home',  

}

</script>

<style scoped lang="scss">
  @import "../../css/styles.css";

  #home{
  background-color: #f6f7c7;
  display: block;
  width: 100%;
  height: 90vh;
}
</style>
