<template>
    <div>
        <form @submit.prevent="onSubmit">
            <BaseInput
                label="Old password"
                type="password"
                v-model="$v.form.opassword.$model"
                :validator="$v.form.opassword"
            ></BaseInput>
            <BaseInput
                label="New password"
                type="password"
                v-model="$v.form.password.$model"
                :validator="$v.form.password"
            ></BaseInput>

            <BaseInput
                label="Confirm password"
                type="password"
                v-model="$v.form.rpassword.$model"
                :validator="$v.form.rpassword"
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
                rpassword: "",
                opassword: ""
            }
        };
    },
    validations: {
        form: {
            password: {
                required,
                minLength: minLength(4)
            },
            rpassword: {
                required,
                sameAsPassword: sameAs("password")
            },
            opassword: {
                required
            }
        }
    },
    methods: {
        onSubmit() {
            // console.log("enviar"+ this.formValidate)
            if (this.formValidate) {
                console.log(this.form);
                console.log("Form enviado");
                console.log(this.$v.form.opassword.$model)

                axios
                    .post("/api/reset", {
                        password: this.$v.form.password.$model,
                        rpassword: this.$v.form.rpassword.$model,
                        opassword: this.$v.form.opassword.$model
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
        }
    },
    computed: {
        formValidate() {
            return !this.$v.$invalid;

            // return  this.form.nick.length > 0 &&
            //         this.form.email.length > 0 &&
            //         this.form.password.length > 4 &&
            //         this.form.rpassword == this.form.password
        }
    }
};
</script>
