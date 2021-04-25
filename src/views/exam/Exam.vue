<template>
  <v-container class="grey lighten-5">
    <v-row>
      <div
        class="mx-3 mt-3"
        v-for="(item, i) in items"
        :key="i"
        cols="12"
        sm="4"
      >
        <!-- <router-link
          style="display: inline-block; text-decoration: none"
          :to="disable ? '' : 'quiz/' + item.uuid + '&' + item.duration"
        > -->
        <span>
          <v-card
            :to="'quiz/' + item.uuid + '&' + item.duration"
            outlined
            tile
            :class="checkOneSubmite(item.uuid)"
            dark
            :disabled="disable"
            min-width="200px"
            min-height="100"
            @click="$router.push({ name: 'test2', params: { id: item.uuid } })"
          >
            <v-card-title class="headline"> {{ item.name }} </v-card-title>
            <v-card-subtitle>Duration: {{ item.duration }}</v-card-subtitle>
          </v-card>
        </span>
        <!-- </router-link> -->
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import TakeExam from "./TakeExam";
import store from "@/store";
const apiUrl = require("../../apiUrl.js");
import { VDigitalTimePicker } from "v-digital-time-picker";

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    TakeExam,
    // eslint-disable-next-line vue/no-unused-components
    VDigitalTimePicker,
  },
  data: () => ({
    items: [],
    dialog: false,
    dialog1: false,
    e1: 1,
    backHoverColor: "",

    examId: "",
    title: null,
    duration: "",
    publish: false,
    result: [],
    // disable: false,
  }),
  async mounted() {
    await this.loadData();
    await this.loadStudentResult();
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.student_list_exam;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.items = response.data.data;
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    async loadStudentResult() {
      let strUrl = apiUrl.result_post;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.result = response.data.data;

          window.console.log(this.result);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    checkOneSubmite(i) {
      let already = false;
      this.result.forEach((element) => {
        let loggedUser = store.getters.getLoggedUser;
        let userId = loggedUser.data.user.id;
        let userID = element.user_id;
        let quizzDID = element.quiz_id;

        if (userID === userId && quizzDID === i) {
          already = true;
        }
      });
      let already1 = already;
      // this.isDisabled = already;
      this.isDisabled(already);

      let color = already1 == false ? "blue" : "red";
      return "disable rounded color: " + color;
    },

    isDisabled: function (e) {
      if (e === true) {
        return (this.disable = e);
      } else {
        return (this.disable = e);
      }
      // return (this.disable = e);
    },

    // colorClass() {
    //   let color = this.already == false ? "green" : "red";
    //   return "rounded color: " + color;
    // },
  },
  computed: {
    // isDisabled: function (value) {
    //   if (value === true) {
    //     return true;
    //   } else {
    //     return false;
    //   }
    // },
  },
};
</script>