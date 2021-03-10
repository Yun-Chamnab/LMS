<template>
  <v-container class="grey lighten-5">
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="deep-orange accent-3" dark v-bind="attrs" v-on="on">
            Create Quiz
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">Create Quiz</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="Title"
                    v-model="title"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field
                    label="Duration"
                    v-model="duration"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field
                    label="Publish"
                    v-model="publish"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
            <!-- <small>*indicates required field</small> -->
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              Close
            </v-btn>
            <v-btn
              color="blue darken-1"
              text
              @click.prevent="onSaveClose()"
              @click="dialog = false"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>

    <v-row>
      <div class="mx-3 mt-3" v-for="(item, i) in items" :key="i" cols="12" sm="4">
        <router-link
          style="display: inline-block; text-decoration: none"
          :to="'question/' + item.id"
        >
          <v-card
            class="rounded"
            outlined
            tile
            color="purple darken-4"
            dark
            min-width="230px"
          >
            <v-card-title class="headline"> {{ item.name }} </v-card-title>
            <v-card-subtitle>Duration: {{ item.duration }}</v-card-subtitle>
            <v-card-subtitle>Publish: {{ item.publish }}</v-card-subtitle>
          </v-card>
        </router-link>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
// import { Grid, GridToolbar, GridNoRecords } from "@progress/kendo-vue-grid";
import DialogQuestion from "./DialogQuestion";

const apiUrl = require("../../apiUrl.js");

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    DialogQuestion,
  },
  data: () => ({
    items: [],
    dialog: false,
    dialog1: false,
    e1: 1,
    title: null,
    duration: null,
    publish: null,
  }),
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      axios
        .get("http://127.0.0.1:8000/api/exam")
        .then((response) => {
          this.items = response.data.data;
          window.console.log(this.items);
          // this.loading = false;
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    async onSaveClose() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");

          let strUrl = apiUrl.exam_post;
          let method = "post";
          axios({
            method: method,
            url: strUrl,
            data: {
              name: this.title,
              duration: this.duration,
              publish: this.publish,
              //   question: this.question,
            },
          })
            .then((response) => {
              this.loadData();
              window.console.log(response);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
    openModal() {
      this.$refs.modal.showModal();
    },
  },
  computed: {},
};
</script>