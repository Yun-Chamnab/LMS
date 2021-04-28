<template>
  <v-container>
    <v-dialog v-model="dialog" max-width="790">
      <v-card>
        <v-form>
          <v-container>
            <v-row>
              <v-col cols="12" md="7">
                <v-form>
                  <v-text-field
                    v-model="question"
                    label="Question"
                    required
                  ></v-text-field>

                  <v-select
                    label="Select Correct Answer"
                    v-bind:items="[answer1, answer2, answer3]"
                    v-model="status_correct"
                    required
                  ></v-select>

                  <v-text-field
                    v-model="score"
                    label="Score"
                    required
                  ></v-text-field>
                </v-form>
              </v-col>

              <v-col cols="12" md="5">
                <v-form>
                  <v-text-field
                    v-model="answer1"
                    label="Answer Option A"
                    required
                  ></v-text-field>

                  <v-text-field
                    v-model="answer2"
                    label="Answer Option B"
                  ></v-text-field>

                  <v-text-field
                    v-model="answer3"
                    label="Answer Option C"
                  ></v-text-field>
                </v-form>
              </v-col>
            </v-row>
          </v-container>
        </v-form>

        <div class="text-center">
          <v-btn
            color="error"
            class=""
            @click="postQuestion()"
            @click.stop="dialog = false"
            min-width="20rem"
          >
            <h6>Submit</h6>
          </v-btn>
        </div>
        <div class="text-center">
          <v-btn
            text
            v-on:click.stop="
              dialog = false;
              clear();
            "
            min-width="20rem"
          >
            <h6>Cancel</h6>
          </v-btn>
        </div>
      </v-card>
    </v-dialog>
    <v-card>
      <v-tabs background-color="transparent" center-active color="basil">
        <v-tab>Add Question</v-tab>
        <v-tab>Student Response</v-tab>
        <v-tab-item>
          <v-btn
            color="pink darken-1"
            max-width="9rem"
            dark
            class="mb-5 mt-3"
            v-on:click.stop="dialog = true"
          >
            <h6>Add New Question</h6>
          </v-btn>

          <v-data-table
            class="elevation-1"
            :headers="headers"
            show-expand
            :items="items"
            :single-expand="singleExpand"
            :expanded.sync="expanded"
            :items-per-page="5"
            hide-default-header
            :sort-by="['question']"
          >
            <template v-slot:header="{}">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Question</th>
                  <th>Score</th>
                  <th colspan="3">Answer</th>
                </tr>
              </thead>
            </template>
            <template v-slot:body="{ items }">
              <tbody style="white-space: nowrap">
                <tr v-for="(quest, index) in items" v-bind:key="index">
                  <td>{{ 1 + index++ }}</td>
                  <td>{{ quest.question }}</td>
                  <td>{{ quest.score }}</td>
                  <td v-for="(answ, i) in quest.answer" v-bind:key="i">
                    <span v-if="answ.status_correct == 1">
                      <i
                        class="fas fa-check-circle fa-lg float-left mr-2"
                        style="color: green"
                      ></i>
                      {{ answ.answer }}
                    </span>
                    <span v-else>
                      {{ answ.answer }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-data-table>
        </v-tab-item>
        <v-tab-item>
          <StudentResult />
        </v-tab-item>
      </v-tabs>
    </v-card>
  </v-container>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../../apiUrl");

import StudentResult from "./StudentResult";

export default {
  components: {
    StudentResult,
  },
  data() {
    return {
      answer: [],
      e1: 1,
      items: [],
      answer1: "",
      answer2: "",
      answer3: "",
      options: [this.answer1, this.answer2, this.answer3],
      itemid: this.$route.params.uuid,
      dialog: false,
      question: null,
      score: null,
      status_correct: [],
      search: "",
      expanded: [],
      singleExpand: false,
      headers: [
        { text: "N", value: "" },
        {
          text: "Question",
          align: "start",
          filterable: false,
          value: "question",
        },
        { text: "Answer", value: "[question.answer.answer]" },
        { text: "Correct Answer", value: "status_correct" },
        { text: "Created Date", value: "created_at" },
      ],
      subItems: [{ text: "Answer", value: "answer" }],
    };
  },
  async mounted() {
    await this.loadData();
  },
  methods: {
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
              exam_id: this.$route.params.uuid,
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
    clear() {
      (this.question = ""),
        (this.status_correct = ""),
        (this.answer1 = ""),
        (this.answer2 = ""),
        (this.answer3 = ""),
        (this.score = "");
    },
    async loadData() {
      let strUrl = apiUrl.question_post + this.$route.params.uuid;
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
  },
};
</script>