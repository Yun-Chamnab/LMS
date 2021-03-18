<template>
  <v-container class="grey lighten-5">
    <v-row>
      <div class="mx-3 mt-3" cols="12" sm="4">
        <v-card class="mx-auto" color="amber darken-2" min-width="300" outlined>
          <v-list-item three-line>
            <v-list-item-content class="white--text">
              <v-list-item-title class="headline mb-1">
                3
              </v-list-item-title>
              <!-- <span color="light-green accent-3"
                ><i class="fas fa-circle fa-xs" style="color: #0000CD"></i> {{ items.examPublish }}</span
              > -->
              <v-list-item-subtitle class="white--text"
                >Quiz</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-list-item-avatar tile size="auto"
              ><i class="fas fa-graduation-cap fa-3x" style="color: white"></i
            ></v-list-item-avatar>
          </v-list-item>
        </v-card>
      </div>
      <div class="mx-3 mt-3" cols="12" sm="4">
        <v-card class="mx-auto" color="teal accent-4" min-width="300" outlined>
          <v-list-item three-line>
            <v-list-item-content class="white--text">
              <v-list-item-title class="headline mb-1">
                3
              </v-list-item-title>
              <v-list-item-subtitle class="white--text"
                >Student</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-list-item-avatar tile size="auto"
              ><i class="fas fa-user-graduate fa-3x" style="color: white"></i
            ></v-list-item-avatar>
          </v-list-item>
        </v-card>
      </div>
      <div class="mx-3 mt-3" cols="12" sm="4">
        <v-card class="mx-auto" color="pink lighten-1" min-width="300" outlined>
          <v-list-item three-line>
            <v-list-item-content class="white--text">
              <v-list-item-title class="headline mb-1">
                3
              </v-list-item-title>
              <v-list-item-subtitle class="white--text"
                >Courses</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-list-item-avatar tile size="auto"
              ><i class="fas fa-shapes fa-3x" style="color: white"></i
            ></v-list-item-avatar>
          </v-list-item>
        </v-card>
      </div>
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
        .get("http://127.0.0.1:8000/api/exam/overview/")
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