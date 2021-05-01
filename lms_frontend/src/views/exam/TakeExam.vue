<template>
  <v-container>
    <!-- <h3>{{ time }}</h3> -->

    <v-card class="mx-auto mt-1" max-width="400" tile v-if="result == false">
      <v-list class="mx-5">
        <v-list-item-group color="indigo darken-4">
          <v-list-item-title class="mb-3"
            ><h4>
              <span class="black--text"
                >{{ items[currentQuestion].question }}
              </span>
              <span class="float-right"
                ><h5>{{ items[currentQuestion].score }}pt</h5></span
              >
            </h4>
          </v-list-item-title>

          <v-list-item
            v-for="answ in items[currentQuestion].answer"
            :key="answ"
            @click="
              checkAnswer(answ.status_correct, items[currentQuestion].score)
            "
          >
            <v-list-item-content>
              <v-list-item-title class="black--text"
                >{{ answ.answer }}
                <!-- <span v-if="result == true"
                    ><span v-if="answ.status_correct == 1"
                      ><i
                        class="far fa-check-circle float-right"
                        style="color: green"
                      ></i>
                    </span>
                    <span v-else
                      ><i
                        class="far fa-times-circle float-right"
                        style="color: red"
                      ></i>
                    </span>
                  </span> -->
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <span class="float-right"
        >{{ currentQuestion + 1 }} of {{ items.length }}</span
      >
    </v-card>

    <v-layout justify-center v-if="result == true">
      <span>
        <v-responsive
          class="text-center green lighten-1 rounded-circle d-inline-flex align-center justify-center ma-3"
          height="150"
          width="150"
        >
          <h4>Result: {{ this.point }}/ {{ this.total_point }}</h4>
        </v-responsive>
      </span>
    </v-layout>
    <v-layout justify-center>
      <router-link
        v-if="result == true"
        style="display: inline-block; text-decoration: none"
        :to="'../course'"
      >
        <v-btn text class="error">Go Back</v-btn>
      </router-link>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../apiUrl.js");
import moment from "moment";
import store from "@/store";

export default {
  components: {},
  data() {
    return {
      answer: [],
      items: [],
      itemid: this.$route.params.uuid,
      question: null,
      // score: null,
      status_correct: null,
      pickedAnswer: null,
      correct: 0,
      wrongAnswer: false,
      point: 0,
      result: false,
      total_point: 0,
      counting: true,
      duration: this.$route.params.duration,
      countdown: false,
      currentQuestion: 0,
      date: moment(20),
    };
  },
  async mounted() {
    await this.loadData();
    setInterval(() => {
      this.date = moment(this.date.subtract(1, "seconds"));
    }, 1000);
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.question_post + this.itemid;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.items = response.data.data;
          // window.console.log(this.duration);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    async postResult() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");

          let strUrl = apiUrl.result_post;
          let method = "post";
          let loggedUser = store.getters.getLoggedUser;
          axios({
            method: method,
            url: strUrl,
            data: {
              user_id: loggedUser.data.user.id,
              student_name: loggedUser.data.user.name,
              quiz_id: this.itemid,
              score: this.point,
              total_score: this.total_point,
            },
          })
            .then((response) => {
              this.loadData();
              window.console.log(response.data);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
    checkAnswer(key, score) {
      // window.console.log(key, "KEY");
      // window.console.log(score, "score");
      // window.console.log(this.items.length, "item length");
      // this.$event.target.classList.toggle(active);
      this.total_point += score;
      window.console.log("total", this.total_point);
      // this.answ.forEach((element) => {
      //   element.activeClass = "";
      // });
      if (key == 1) {
        this.point += score;
        this.correct++;
      }
      if (this.currentQuestion == this.items.length - 1) {
        this.loadResult();
      }
      this.currentQuestion++;
    },
    loadResult() {
      this.postResult();
      this.result = true;
    },
    startCountdown: function () {
      this.counting = true;
    },
    onCountdownEnd: function () {
      this.counting = false;
      this.countdown = true;
    },
    convertDateTime(value) {
      let dateTime = moment(value);
      window.console.log(dateTime);
      // let date = dateTime.format("hh:mm:i");
      let date = moment.countdown(dateTime).toString();
      return date;
    },
  },
  computed: {
    time: function () {
      return this.date.format("h:mm:ss");
    },
  },
};
</script>
<style scoped>
.v-list-item--active {
  background-color: #fff !important;
  color: #fff !important;
}
</style>