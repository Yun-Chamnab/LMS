<template>
  <v-container class="grey lighten-5">
    <h2 style="font-weight: bold; font-size: 35px">
      {{ $t("quizz") }}
    </h2>
    <v-row>
      <v-col
        class="tab_wrapper py-0 mt-5"
        v-for="(item, i) in items"
        :key="i"
        cols="12"
        sm="3"
      >
        <span>
          <v-card
            :to="'quiz/' + item.uuid + '&' + item.duration"
            outlined
            tile
            :class="checkOneSubmite(item.uuid)"
            dark
            :disabled="disable"
            class="mx-auto"
            max-width="800"
            min-height="100"
            @click="$router.push({ name: 'test2', params: { id: item.uuid } })"
          >
            <v-card-title class="headline"> {{ item.name }} </v-card-title>
            <v-card-subtitle>Duration: {{ item.duration }}</v-card-subtitle>
            <v-card-subtitle>{{
              convertDateTime(item.created_at)
            }}</v-card-subtitle>
          </v-card>
        </span>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import TakeExam from "./TakeExam";
import store from "@/store";
const apiUrl = require("../../apiUrl.js");
import { VDigitalTimePicker } from "v-digital-time-picker";
import moment from "moment";

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
      let strUrl = apiUrl.student_list_exam + this.$route.params.uuid;
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
    },
    convertDateTime(value) {
      let dateTime = moment(value);
      let date = dateTime.fromNow();
      return date;
    },
  },
  computed: {},
};
</script>