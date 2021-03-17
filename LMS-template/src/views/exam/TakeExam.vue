<template>
  <v-container>
    <vue-countdown
      v-if="counting"
      :time="10000"
      @end="onCountdownEnd"
      v-slot="{ totalSeconds }"
      >Duration: {{ totalSeconds }} later</vue-countdown
    >

    <div v-for="(quest, index) in items" v-bind:key="index">
      <v-card class="mx-auto mt-1" max-width="400" tile>
        <v-list class="mx-5">
          <v-list-item-group color="indigo darken-4">
            <v-list-item-title class="mb-3"
              ><h4>
                <span class="black--text"
                  >{{ 1 + index++ }}. {{ quest.question }}
                </span>
                <span class="float-right"
                  ><h5>{{ quest.score }}pt</h5></span
                >
              </h4>
            </v-list-item-title>
            
            <v-list-item
              v-for="answ in quest.answer"
              :key="answ"
              v-model="userResponses[answ.status_correct, quest.score]"
              @click.native="checkAnswer(answ.status_correct, quest.score , index)"
            >
              <v-list-item-content>
                <span>
                  <v-list-item-title
                    >{{ answ.answer }}
                    <span v-if="result == true"
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
                    </span>
                  </v-list-item-title>
                </span>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card>
    </div>

    <!-- <div class="callout">
      <div v-for="(question, index) in items" :key="index"> -->
        <!-- Hide all questions, show only the one with index === to current question index -->
        <!-- <div v-show="index === questionIndex">
          <h3>{{ question.question }}</h3>
          <ol> -->
            <!-- for each response of the current question -->
            <!-- <li v-for="response in question.answer" :key="response">
              <label>
                <input
                  type="radio"
                  v-bind:value="response.answer"
                  v-bind:name="index"
                  v-model="userResponses[(index, question.status_correct)]"
                />
                {{ response.answer }}
              </label>
            </li>
          </ol> -->
          <!-- The two navigation buttons -->
          <!-- Note: prev is hidden on first question -->
          <!-- <button
            class="secondary button"
            v-if="questionIndex > 0"
            v-on:click="prev"
          >
            prev
          </button>
          <button class="success button" v-on:click="next">next</button>
        </div>
      </div> -->

      <!-- Last page, quiz is finished, display result -->
      <!-- <div v-show="questionIndex === items.questions.length()"> -->
      <!-- <h3>Your Results</h3>
        <p>You are: {{ score() }}</p> -->
      <!-- </div> -->
    <!-- </div> -->

    <v-layout justify-center v-if="result == false || countdown == false">
      <v-btn
        color="primary darken-1"
        @click="loadResult()"
        max-width="10rem"
        dark
        class="mt-3"
      >
        <h6>Submit</h6>
      </v-btn>
    </v-layout>
    <v-layout justify-center>
      <span v-if="result == true">
        <v-responsive
          class="text-center green lighten-1 rounded-circle d-inline-flex align-center justify-center ma-3"
          height="150"
          width="150"
        >
          <h4>Result: {{ this.point }}/ {{ this.total_score }}</h4>
        </v-responsive>
      </span>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../apiUrl.js");

import VueCountdown from "@chenfengyuan/vue-countdown";
export default {
  components: {
    VueCountdown,
  },
  data() {
    return {
      answer: [],
      items: [],
      itemid: this.$route.params.id,
      question: null,
      // score: null,
      status_correct: null,
      pickedAnswer: null,
      correct: 0,
      wrongAnswer: false,
      point: 0,
      result: false,
      total_score: 0,
      counting: true,
      duration: 1000000,
      countdown: false,
      questionIndex: 0,
      userResponses: Array(),
    };
  },
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      axios
        .get("http://127.0.0.1:8000/api/question/" + this.itemid)
        .then((response) => {
          this.items = response.data.data[0].question;
          this.duration = response.data.data[0].duration;
          this.duration + 10000;
          window.console.log(this.duration);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    async postQuestion() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");

          let strUrl = apiUrl.question_post;
          let method = "post";
          axios({
            method: method,
            url: strUrl,
            data: {
              question: this.question,
              score: this.score,
              status_correct: this.status_correct,
              answer: [this.answer1, this.answer2, this.answer3],
              exam_id: this.$route.params.id,
            },
          })
            .then((response) => {
              this.loadData();
              this.clear();
              window.console.log(response.data);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
    checkAnswer(key, score, ind) {
      window.console.log(key, "KEY");
      window.console.log(score, "score");
      window.console.log(ind, "index");
      this.colAnsw = [key,score,ind];
      window.console.log(this.colAnsw, "allanswer");



      this.total_score = this.total_score + score;
      window.console.log("total", this.total_score);
      if (key == 1) {
        this.point += score;
        this.correct++;
      }

      return this.total_score;
    },
    loadResult() {
      this.checkAnswer(0, 0);
      // window.console.log(this.radioGroup, "picked");
      this.result = true;
    },
    startCountdown: function () {
      this.counting = true;
    },
    onCountdownEnd: function () {
      this.counting = false;
      this.countdown = true;
    },
    // Go to next question
    next: function () {
      this.questionIndex++;
      window.console.log(this.userResponses);
    },
    // Go to previous question
    prev: function () {
      this.questionIndex--;
    },
    score: function () {
      //find the highest occurence in responses
      var modeMap = {};
      var maxEl = this.userResponses[0],
        maxCount = 1;
      for (var i = 0; i < this.userResponses.length; i++) {
        var el = this.userResponses[i];
        if (modeMap[el] == null) modeMap[el] = 1;
        else modeMap[el]++;
        if (modeMap[el] > maxCount) {
          maxEl = el;
          maxCount = modeMap[el];
        }
      }
      return maxEl;
    },
  },
};
</script>