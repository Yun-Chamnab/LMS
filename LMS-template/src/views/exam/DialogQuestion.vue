<template>
  <v-container>
    <v-dialog v-model="dialog" max-width="790">
      <v-card>
        <!-- <v-card-title class="headline">{{ $route.params.id }}</v-card-title> -->
        <v-form v-model="valid">
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
                    :items="options"
                    label="Select"
                    data-vv-name="select"
                    v-model="status_correct"
                    required
                  ></v-select>

                  <v-col cols="12" md="8">
                    <v-text-field
                      v-model="status_correct"
                      label="Correct Answer"
                      required
                    ></v-text-field>
                  </v-col>
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
            @click.prevent="postQuestion()"
            @click="dialog = false"
            min-width="20rem"
          >
            <h6>Submit</h6>
          </v-btn>
        </div>
        <div class="text-center">
          <v-btn text v-on:click.stop="dialog = false" min-width="20rem">
            <h6>Cancel</h6>
          </v-btn>
        </div>
      </v-card>
    </v-dialog>

    <v-btn
      color="pink darken-1"
      max-width="9rem"
      dark
      v-on:click.stop="dialog = true"
    >
      <h6>Add New Question</h6>
    </v-btn>
    <!-- 
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title> -->
    <v-data-table
      :headers="headers"
      :items="items"
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      item-key="name"
      show-expand
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Expandable Table</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-switch
            v-model="singleExpand"
            label="Single expand"
            class="mt-2"
          ></v-switch>
        </v-toolbar>
      </template>
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">{{ item.question }}</td>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../apiUrl.js");

export default {
  data() {
    return {
      answer: [],
      e1: 1,
      items: [],
      options: ["A", "B", "C"],
      itemid: this.$route.params.id,
      dialog: false,
      question: null,
      status_correct: null,
      search: "",
      expanded: [],
      singleExpand: false,
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
              status_correct: this.status_correct,
              answer: [this.answer1, this.answer2, this.answer3],
              exam_id: this.$route.params.id,
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
  },
};
</script>