<template>
    <div id="main">
        <div>
        <div class="container">
            <div class="row justify-content">
                <div class="col-md-8">
                    <div class="card cambios" style="background-color:  #85c1e9; width: 100vw">
                        <h1>
                            <div class="card-header text-center izquierda">
                                PERFIL
                                <div class="dropdown">
                                    <div>
                                        <img
                                            :src="'/api/getAvatar'"
                                            style="max-width: 100px; max-height: 100px; min-width: 100px; min-height: 100px"
                                        />
                                        <div class="cuadro_perfil">
                                        <form @submit="formSubmit" enctype="multipart/form-data" style='background: #f7dc6f'>
                                            <div class="form-group">
                                                <strong class="change">Change it</strong>
                                                <input type="file" class="form-control" v-on:change="uploadImage" style='background:  #ccd1d1'>
                                            </div>
                                            <button type="submit" class="btn-primary btn">Send</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, sameAs, email } from "vuelidate/lib/validators";
import BaseInput from "../components/BaseInput.vue";
import ChangePass from "./ChangePass.vue";
import ChangeProfile from "./ChangeProfile.vue";

export default {
    components: { BaseInput, ChangeProfile, ChangePass},
    data() {
        return {
            form: {
                nick: "",
                email: "",
                password: "",
                rpassword: ""
            },
            name: '',
            image: '',
            success: '',
            menu: [
                {
                    title: "Reset Password",
                    icon: "fa fa-user"
                },
                {
                    title: "Change of dates",
                    icon: "fa fa-chart-area"
                }
            ],
            reset: false,
            change: false,
            img: null,
            CardsPath: "/images/Cartas/",
            IconsPath: "/images/Types/",
            maxHP: this.HP,
            notFlipped: true,
            player: {
                name: "Charmander",
                type: "",
                hp: 100,
                maxHP: 100,
                level: 5,
                attacks: ["Hoja", "Fotosintesis", "Rama", "Fruta"],
                attacksDamage: [15, 40, 50, 25],
                HpBar: { width: "100%" },
                ATK: 15,
                DEF: 15,
                SPD: 15
            },
            player2: {
                name: "Squirtle",
                type: "",
                hp: 100,
                maxHP: 100,
                level: 5,
                attacks: ["Hoja", "Fotosintesis", "Rama", "Fruta"],
                attacksDamage: [15, 40, 50, 25],
                HpBar: { width: "100%" },
                ATK: 15,
                DEF: 15,
                SPD: 15
            },
            player3: {
                name: "Bulbasaur",
                type: "",
                hp: 100,
                maxHP: 100,
                level: 5,
                attacks: ["Hoja", "Fotosintesis", "Rama", "Fruta"],
                attacksDamage: [15, 40, 50, 25],
                HpBar: { width: "100%" },
                ATK: 15,
                DEF: 15,
                SPD: 15
            }
        };
    },
    validations: {
        form: {
            nick: {
                required,
                minLength: minLength(3)
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(4)
            },
            rpassword: {
                required,
                sameAsPassword: sameAs("password")
            }
        }
    },
    methods: {
        onSubmit() {
            if (this.formValidate) {
                console.log(this.form);
                console.log("Form enviado");
                axios.get("/api/avatar/indice.jpeg").then(function(response) {
                    console.log(response);
                });
            } else {
                console.log("Form error");
            }
        },
        uploadImage(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            let formData = new FormData();
            formData.append('image', this.image);
            axios.post('api/updateAvatar', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                    console.log(currentObj.success)
                }).catch(function (error) {

                    currentObj.output = error;
                });
            console.log("Hola");
            this.$router.go('perfil');
        },
        boolean_reset() {
            this.reset = true;
            this.change = false;
        },
        boolean_change() {
            this.reset = false;
            this.change = true;
        }
    },
    computed: {
        formValidate() {
            return !this.$v.$invalid;
        }
    }
};
</script>
<style scoped>
.cuadro_perfil {
    display: flex;
    justify-content: center;
    align-items: center;
}
.card-body {
    width: 90vw!important;
}
#main {
    display: flex;
    justify-content: left;
}
.izquierda {
    height: 70vh;
    margin: 0!important;
    padding: 0!important;
    background-color:  #85c1e9;

}
.cambios {
    padding: 0;
    margin-top: 50px;
}
.change {
    color: black;
    font-size: 20px;
    width: 100%;
    text-decoration: underline;
}
</style>
