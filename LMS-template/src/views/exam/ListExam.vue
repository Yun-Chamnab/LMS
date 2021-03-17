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
          :to="'quiz/' + item.id"
        >
          <v-card
            class="rounded"
            outlined
            tile
            color="green darken-1"
            dark
            min-width="200px"
            min-height="100"
            @click="$router.push({ name: 'test2', params: { id: item.id } })"
          >
            <v-card-title class="headline"> {{ item.name }} </v-card-title>
            <v-card-subtitle>Duration: {{ item.duration }}</v-card-subtitle>
          </v-card>
        </router-link>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import TakeExam from "./TakeExam";

// const apiUrl = require("../../apiUrl.js");

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
    examId: "",
    title: null,
    duration: "",
    timeValue: "",
    publish: false,
  }),
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      axios
        .get("http://127.0.0.1:8000/api/exam/student/")
        .then((response) => {
          this.items = response.data.data;
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
  },
  computed: {},
};
</script>