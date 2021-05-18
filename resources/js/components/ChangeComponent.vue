<template>
    <div>
        <form @submit.prevent="onSubmit">
            <p class="lead"><img src="" /></p>
            <BaseInput
                label="Nick change"
                v-model="$v.form.nick.$model"
                :validator="$v.form.nick"
            ></BaseInput>
            <BaseInput
                label="Email change"
                type="email"
                v-model="$v.form.email.$model"
                :validator="$v.form.email"
            ></BaseInput>
            <button
                :disabled="!formValidate"
                type="submit"
                class="btn btn-primary"
            >
                Enviar
            </button>
        </form>
    </div>
</template>

<script>
import { required, minLength, sameAs, email } from "vuelidate/lib/validators";
import BaseInput from "./BaseInput.vue";
export default {
    components: { BaseInput },
    data() {
        return {
            form: {
                nick: "",
                email: "",
                password: "",
                rpassword: ""
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
        }
    },
    methods: {
        onSubmit() {
            if (this.formValidate) {
                console.log(this.form);
                console.log("Form enviado");
                axios
                    .post("/api/update", {
                        nick: this.$v.form.nick.$model,
                        email: this.$v.form.email.$model,
                    })
                    .then(function(response) {
                        console.log(response);
                        this.resetForm();
                        this.message = "";
                        this.$awn.success("Registro realizado con exito");
                    });
            } else {
                console.log("Form error");
            }
        },
        getAvatar(nombre) {
            var imagen = "";
            axios
                .get("/avatar/" + nombre)
                .then(function(response) {
                    imagen = response.data;
                })
                .catch(function(error) {
                    fail(error);
                });
            return imagen;
        }
    },
    computed: {
        formValidate() {
            return !this.$v.$invalid;
        }
    }
};
</script>
