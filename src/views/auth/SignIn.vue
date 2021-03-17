<template>
  <v-app
    id="login"
    style="
      background-image: url(https://niptict.edu.kh/wp-content/uploads/2019/08/photo_2019-02-25_15-43-29.jpg);
      background-repeat: no-repeat;
      background-attachment: fixed;  
      background-size: cover;
      }
    "
  >
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4 lg4>
            <v-card class="elevation-1 pa-3">
              <v-card-text>
                <div class="layout column align-center">
                  <img
                    background-color="#3d4f7e"
                    src="https://niptict.edu.kh/wp-content/uploads/2019/07/512x512.png"
                    alt="NIPTICT LMS SYSTEM"
                    width="180"
                    height="180"
                  />
                  <h1 class="flex my-4 primary--text">NIPTICT LMS SYSTEM</h1>
                </div>
                <v-form>
                  <v-text-field
                    append-icon="person"
                    name="email"
                    label="Email"
                    type="text"
                    v-model="email"
                    :error="error"
                    :rules="[rules.required]"
                  />
                  <v-text-field
                    :type="hidePassword ? 'password' : 'text'"
                    :append-icon="
                      hidePassword ? 'visibility_off' : 'visibility'
                    "
                    name="password"
                    label="Password"
                    id="password"
                    :rules="[rules.required]"
                    v-model="password"
                    :error="error"
                    @click:append="hidePassword = !hidePassword"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn block color="primary" @click="login" :loading="loading"
                  >Login</v-btn
                >
              </v-card-actions>
              <!-- <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn block color="secondary" :loading="loading"
                  ><router-link :to="{ name: 'SignUp' }"
                    >Register</router-link
                  ></v-btn
                >
              </v-card-actions> -->
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
      <v-snackbar v-model="showResult" :timeout="2000" top>
        {{ result }}
      </v-snackbar>
    </v-content>
  </v-app>
</template>

<script>
// const axios = require("axios");
// import store from "@/store";
import httpAxios from "@/httpAxios.js";
export default {
  data() {
    return {
      loading: false,
      email: "",
      password: "",
      hidePassword: true,
      error: false,
      showResult: false,
      result: "",
      rules: {
        required: (value) => !!value || "Required.",
      },
    };
  },
  methods: {
    // login() {
    //   const vm = this;
    //   if (!vm.email || !vm.password) {
    //     vm.result = "Email and Password can't be null.";
    //     vm.showResult = true;
    //     return;
    //   }
    //   if (
    //     vm.email === vm.$root.email &&
    //     vm.password === vm.$root.password
    //   ) {
    //     vm.$router.push({ name: "Overview" });
    //   } else {
    //     vm.error = true;
    //     vm.result = "Email or Password is incorrect.";
    //     vm.showResult = true;
    //   }
    // },
    login: function () {
      const self = this;
      // Clear Errors
      // Object.keys(this.errors).forEach(function (key) {
      //   self.errors[key] = false;
      // });
      // Ajax Request
      // const vm = this;
      // if (
      //   this.email != this.$root.email &&
      //   this.password != this.$root.password
      // ) {
      //   this.error = true;
      //   this.result = "Email and Password is incorrect.";
      //   this.showResult = true;
      // }
      if (!this.email || !this.password) {
        this.result = "Email and Password can't be null";
        this.showResult = true;
        return;
      }
      httpAxios({
        url: "http://localhost:8000/auth/login",
        method: "POST",
        data: {
          email: this.email,
          password: this.password,
        },
      })
        .then((response) => {
          if (response.status === 200) {
            self.$store.commit("LOGGED_USER", response.data);
            // let loggedUser = store.getters.getLoggedUser;
            if (response.data.data.user.roleNames == "administrator") {
              self.$router.push({ name: "Admin" });
              self.$store.commit("LOGGED_USER", response.data);
            } else if (response.data.data.user.roleNames == "student") {
              self.$router.push({ name: "Index" });
              self.$store.commit("LOGGED_USER", response.data);
            }
          }
          window.console.log(response);
        })
        .catch((error) => {
          try {
            if (error.response !== 200) {
              this.error = true;
              this.result = "Email or Password is incorrect";
              this.showResult = true;
              window.console.log(error, "ERROR");
            }
          } catch (e) {
            this.errors.push(e);
            window.console.log(error, "ERROR");
          }
        });
    },
  },
};
</script>

<style scoped lang="css">
#login {
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  content: "";
  z-index: 0;
}
</style>