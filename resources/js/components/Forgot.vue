<template>
<div id="forgot">
      <div class="container0">
        <form @submit.prevent="Forgot">
          <div class="messageOrerror">
            <div v-if="message" class="alert alert-success" role="alert">
              {{message}}
            </div>
            <Error v-if="error" :error="error"></Error>
          </div>
              <h2>Reset your password:</h2>
              <hr>
              <div class="form-group">
                <BaseInput label="Email:" 
                type="email" 
                v-model="$v.form.email.$model"
                :validator = "$v.form.email"
                ></BaseInput>
              </div>
                <button class="mybtn" type="submit">Submit</button>
            
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Error from './Error';
import { required, email } from 'vuelidate/lib/validators';
import BaseInput from "../components/BaseInput.vue";

export default {
   name: 'Forgot',
   components:{
       Error,
       BaseInput
   },
   data(){
     return{
       form:{
          email: null,
       },
       message: null,
       error: null,
     }
   },
   validations: {
        form: {
            email: {
                required,
                email
            },
        }
   }, 

   methods: {
     async Forgot(){
       try {
          await axios.post('forgot',{ email: this.$v.form.$model.email });

          this.message='The email was sent!';
          this.error='';

        } catch (error) {
          //this.error = 'The email must be a valid email address'
          this.error='Error ocurred';
          console.log(error)
          this.message=''; 
       }
     }   
   }
}
</script>

<style scoped lang="scss">
  @import "../../css/styles.css";

#forgot{
  background-color: #f6f7c7;
  display: block;
  width: 100%;
  height: 90vh;
}

h2{
  margin-top:2vh;
}

.remember{
  margin-right: 2vw;
}
.psw{
  padding: 12.5px;
  padding-bottom: 5px;
}

.container0{
  margin-top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 15px;  
}

.container2{
  
  width: 100%;
  padding-top: 2vh;
  padding-bottom: 0.1vh;
  padding-left: 2vw;
  padding-right: 2vw;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 0;
  background-color:#f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  border-radius: 1vh;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

.mybtn{
  margin-bottom: 0;
}

</style>
