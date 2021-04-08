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
        <router-link
          style="display: inline-block; text-decoration: none"
          :to="'quiz/' + item.uuid"
        >
          <!-- <span v-for="(r, j) in res" :key="j">
            <div v-if="loggedUser == r.user_id"> -->
          <v-card
            class="rounded"
            outlined
            tile
            color="green darken-1"
            dark
            min-width="200px"
            min-height="100"
            @click="$router.push({ name: 'test2', params: { id: item.uuid } })"
          >
            <v-card-title class="headline"> {{ item.name }} </v-card-title>
            <v-card-subtitle
              >Duration: {{ item.duration }}</v-card-subtitle
            >
          </v-card>
          <!-- </div> -->

          <!-- <div v-else>
              <v-card
                class="rounded red"
                outlined
                tile
                color="red darken-1"
                dark
                min-width="200px"
                min-height="100"
                @click="
                  $router.push({ name: 'test2', params: { id: item.uuid } })
                "
              >
                <v-card-title class="headline"> {{ item.name }} </v-card-title>
                <v-card-subtitle
                  >Duration:
                  {{ convertDateTime(item.duration) }}</v-card-subtitle
                >
              </v-card>
            </div> -->
          <!-- </span> -->
        </router-link>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import TakeExam from "./TakeExam";
const apiUrl = require("../../apiUrl.js");
import { VDigitalTimePicker } from "v-digital-time-picker";
import moment from "moment";
import store from "@/store";

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
    examId: "",
    title: null,
    duration: "",
    timeValue: "",
    publish: false,
    loggedUser: store.getters.getLoggedUser.data.user.id,
    res: "",
  }),
  async mounted() {
    await this.loadData();
    this.checkAlreadySubmit();
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
    convertDateTime(value) {
      let dateTime = moment(value);
      return dateTime;
    },
    checkAlreadySubmit() {
      let strUrl = apiUrl.result_post;
      let method = "get";

      let loggedUser = store.getters.getLoggedUser.data.user.id;

      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.res = response.data.data;
          // alluser_id.forEach((element) => {
          //   this.res = element.user_id;
          // });
          // this.already = true;
          window.console.log(this.res);
          // window.console.log(this.already1);
          // window.console.log(alluser_id, "user_id");
          window.console.log(loggedUser, "student_id");
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
  },
  computed: {},
};
</script>