<template>
  <v-container>
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
              @click.native="checkAnswer(answ.status_correct, quest.score)"
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
    <v-layout justify-center>
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

export default {
  data() {
    return {
      answer: [],
      items: [],
      itemid: this.$route.params.id,
      question: null,
      score: null,
      status_correct: null,
      pickedAnswer: null,
      correct: 0,
      wrongAnswer: false,
      point: 0,
      result: false,
      total_score: 0,
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
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    checkAnswer(key, score) {
      window.console.log(key, "KEY");
      window.console.log(score, "score");
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
      this.result = true;
    },
  },
};
</script>