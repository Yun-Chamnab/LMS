<template>
  <v-container class="grey lighten-5">
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="deep-orange accent-3 mt-2"
            dark
            v-bind="attrs"
            v-on="on"
          >
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
                  <h4>Duration</h4>
                  <span class="border">
                    <v-digital-time-picker
                      v-model="duration"
                      rounded
                      filled
                      outlined
                      color="info"
                    />
                  </span>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-checkbox
                    v-model="publish"
                    :label="`Publish: ${publish.toString()}`"
                  ></v-checkbox>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue darken-1"
              text
              @click="
                dialog = false;
                clear();
              "
            >
              Close
            </v-btn>
            <v-btn
              color="blue darken-1"
              text
              @click="
                dialog = false;
                onSaveClose();
              "
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>

    <v-row>
      <div
        class="mx-3 mt-3"
        v-for="(item, i) in items"
        :key="i"
        cols="12"
        sm="4"
      >
        <!-- Delete Dialog -->
        <v-dialog v-model="dialog2" max-width="290">
          <v-card>
            <v-card-title class="headline">Are you sure?</v-card-title>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="dialog2 = false">
                Cancel
              </v-btn>

              <v-btn
                color="green darken-1"
                text
                @click="deleteexam(item)"
                @click.prevent="dialog2 = false"
              >
                Agree
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <!-- =====END delete====== -->
        <router-link
          style="display: inline-block; text-decoration: none; float: right"
          :to="'question/' + item.id"
        >
          <v-card
            class="rounded"
            outlined
            tile
            color="light-blue accent-4"
            dark
            min-width="230px"
            @click="$router.push({ name: 'test2', params: { id: item.id } })"
          >
            <v-card-title class="headline mb-2"> {{ item.name }} </v-card-title>
            <v-card-subtitle class="text-center"
              ><i class="fas fa-stopwatch fa-2x" style="color: white"></i>
              <h3>{{ item.duration }}</h3></v-card-subtitle
            >
            <v-card-subtitle class=""
              >Publish:
              <span class="yellow--text">
                {{ item.publish }}
              </span></v-card-subtitle
            >
          </v-card>
        </router-link>
        <div></div>
        <i
          class="far fa-trash-alt float-right mx-1"
          style="color: red"
          @click.stop="dialog2 = true"
        ></i>
        <i
          class="far fa-edit float-right"
          style="color: green"
          color="primary"
          @click="onEditItem(item)"
        ></i>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";

import DialogQuestion from "./DialogQuestion";
const apiUrl = require("../../../apiUrl");
import { VDigitalTimePicker } from "v-digital-time-picker";

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    DialogQuestion,

    VDigitalTimePicker,
  },
  data: () => ({
    items: [],
    dialog: false,
    dialog1: false,
    dialog2: false,
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
      let strUrl = apiUrl.exam_post;
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
    async onEditItem(exam) {
      this.title = exam.name;
      this.duration = exam.duration;
      this.publish = exam.publish;
      this.examId = exam.id;
      this.dialog = true;
    },
    async onSaveClose() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");

          let strUrl = apiUrl.exam_post;
          let method = "post";

          if (this.examId !== "") {
            strUrl = apiUrl.exam_edit + this.examId;
            method = "patch";
          }
          axios({
            method: method,
            url: strUrl,
            data: {
              name: this.title,
              duration: this.duration,
              publish: this.publish,
            },
          })
            .then((response) => {
              this.loadData();
              this.clear();
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
    clear() {
      (this.title = ""), (this.duration = ""), (this.publish = false);
    },

    async deleteexam(item) {
      const index = this.items.indexOf(item);
      this.deletItems = item;
      this.items.splice(index, 1);
      await this.deleteExam();
    },
    async deleteExam() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios
            .delete(apiUrl.exam_post + this.deletItems.id, {})
            .then((response) => {
              window.console.log(response);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
  },
  computed: {},
};
</script>