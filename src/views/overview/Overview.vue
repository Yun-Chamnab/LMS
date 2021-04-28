<template>
  <v-container class="grey lighten-5">
    <v-row>
      <v-card class="mx-auto" max-width="400">
        <v-card-text>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="title red--text">
                Total Cases: {{ total_cases }}
              </v-list-item-title>
              <v-list-item-subtitle> {{ date }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-row align="center">
              <h4 class="subtitle-1">New Cases:</h4>

              <v-col class="display-2 red--text" cols="4">
                {{ new_cases }}
              </v-col>
              <v-col cols="4">
                <v-img
                  src="http://covidcp.org/images/logo-icononly.png"
                  alt="Sunny image"
                  width="190"
                ></v-img>
              </v-col>
            </v-row>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <i class="fas fa-circle fa-sm" style="color: green"></i>
            </v-list-item-icon>
            <v-list-item-title
              ><h4 class="subtitle-1">
                New Deaths:
                <span class="red--text font-weight-bold">
                  {{ new_deaths }}</span
                >
              </h4>
            </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <i class="fas fa-circle fa-sm" style="color: red"></i>
            </v-list-item-icon>
            <v-list-item-title
              ><h4 class="subtitle-1">
                Total Deaths:
                <span class="red--text font-weight-bold">
                  {{ total_deaths }}</span
                >
              </h4>
            </v-list-item-title>
          </v-list-item></v-card-text
        >
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";

// const apiUrl = require("../../apiUrl.js");

import { VDigitalTimePicker } from "v-digital-time-picker";

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    VDigitalTimePicker,
  },
  data: () => ({
    items: "",
    dialog: false,
    dialog1: false,
    e1: 1,
    examId: "",
    title: null,
    duration: "",
    timeValue: "",
    publish: false,
    total_cases: "",
    new_cases: "",
    total_deaths: "",
    new_deaths: "",
    date: "",
  }),
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      axios
        .get("https://covid.ourworldindata.org/data/owid-covid-data.json")
        .then((response) => {
          this.items = response.data.KHM.data;
          this.total_case();
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    total_case() {
      this.total_cases = this.items[this.items.length - 1].total_cases;
      this.new_cases = this.items[this.items.length - 1].new_cases;
      this.total_deaths = this.items[this.items.length - 1].total_deaths;
      this.new_deaths = this.items[this.items.length - 1].new_deaths;
      this.date = this.items[this.items.length - 1].date;
    },
  },
  computed: {},
};
</script>