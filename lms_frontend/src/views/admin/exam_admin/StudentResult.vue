<template>
  <v-row>
    <div class="mx-3 mt-6" cols="12" sm="4">
      <v-card
        class="mx-auto mb-3"
        color="teal lighten-1"
        min-width="250"
        outlined
      >
        <v-list-item three-line>
          <v-list-item-content class="white--text">
            <v-list-item-title class="headline mb-1">
              {{ this.items.length }}
            </v-list-item-title>
            <v-list-item-subtitle class="white--text"
              >Total Submit</v-list-item-subtitle
            >
          </v-list-item-content>

          <v-list-item-avatar tile size="auto"
            ><i class="fas fa-user-graduate fa-3x" style="color: white"></i
          ></v-list-item-avatar>
        </v-list-item>
      </v-card>

      <v-card class="" color="blue lighten-4" max-width="250" outlined>
        <v-list-item class="white--text">
          <v-col cols="12">
            <v-row>
              <v-col cols="4">
                <h3 class="text-center">{{ this.student90 }}</h3></v-col
              >
              <v-col cols="4">
                <h3 class="text-center">{{ this.student50 }}</h3></v-col
              >
              <v-col cols="4">
                <h3 class="text-center">{{ this.studentfail }}</h3></v-col
              >
              <v-col cols="4">
                <h4 class="green--text">
                  <i class="fas fa-caret-up"></i> 90%
                </h4></v-col
              >
              <v-col cols="4">
                <h4 class="orange--text">
                  <i class="fas fa-caret-up"></i> 50%
                </h4></v-col
              >
              <v-col cols="4">
                <h4 class="red--text">
                  <i class="fas fa-caret-down"></i> 50%
                </h4></v-col
              >
            </v-row>
          </v-col>
          <v-list-item-avatar tile size="auto"
            ><i class="fas fa-shapes fa-3x" style="color: white"></i
          ></v-list-item-avatar>
        </v-list-item>
      </v-card>
    </div>

    <v-col>
      <v-card-title>
        <JsonCSV
          class="btn btn-default"
          :data="items"
          name="student_result.csv"
        >
          <v-btn
            bottom
            color="indigo darken-4"
            class="rounded-pill"
            width="120"
            dark
          >
            <h6>Export in CSV</h6>
          </v-btn>
        </JsonCSV>

        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="items"
        :items-per-page="10"
        item-key="name"
        :search="search"
        class="elevation-1 blue lighten-5"
        :footer-props="{
          showFirstLastPage: true,
          firstIcon: 'mdi-arrow-collapse-left',
          lastIcon: 'mdi-arrow-collapse-right',
          prevIcon: 'mdi-minus',
          nextIcon: 'mdi-plus',
        }"
      >
        <template v-slot:item.score="{ item }">
          <v-chip :color="getColor(item.score)" dark>{{ item.score }}</v-chip>
        </template>
        <template v-slot:item.created_at="{ item }">
          {{ convertDateTime(item.created_at) }}
        </template>
      </v-data-table>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../../apiUrl");
import moment from "moment";
import JsonCSV from "vue-json-csv";
export default {
  components: { JsonCSV },
  data() {
    return {
      score: [],
      total_score: [],
      studentfail: 0,
      student50: 0,
      student90: 0,
      percent: 0,
      itemid: this.$route.params.id,
      items: [],
      headers: [
        { text: "Student Name", value: "student_name" },
        { text: "Score", value: "score" },
        { text: "Total Score", value: "total_score" },
        { text: "Submit Time", value: "created_at" },
      ],
      search: "",
    };
  },
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.result_post + this.$route.params.uuid;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.items = response.data.data;
          this.total_score = response.data.data[0].total_score;
          window.console.log(this.items);
          this.calculatePass();
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    getColor(score) {
      var percent = (score * 100) / this.total_score;
      // window.console.log(this.total_score, "total");
      // window.console.log(percent, "%");
      if (percent > 90) {
        return "green";
      } else if (percent > 50) {
        return "orange";
      } else {
        return "red";
      }
    },
    calculatePass() {
      for (let index = 0; index < this.items.length; index++) {
        const element = this.items[index];
        // window.console.log(element, "this");
        this.percent = (element.score * 100) / this.total_score;
        // window.console.log(this.percent, "%$");
        if (this.percent > 90) {
          this.student90 += 1;
          // return this.student90;
        } else if (this.percent > 50) {
          this.student50 += 1;
          // return this.student50;
        } else {
          this.studentfail += 1;
          // return this.studentfail;
        }
      }
    },
    convertDateTime(value) {
      let dateTime = moment(value);
      return dateTime.format("DD-MM-YYYY, hh:mm:ss a");
    },
  },
};
</script>