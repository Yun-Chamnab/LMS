<template>
  <v-app>
    <v-container>
      <v-layout>
        <v-tabs center-active color="basil">
          <v-tab>Lesson</v-tab>
          <v-tab>Quiz</v-tab>
          <v-tab-item>
            <v-row>
              <div class="mx-3 mt-6" cols="12" sm="4">
                <v-card
                  class="mx-6"
                  color="pink lighten-1"
                  width="1000"
                  min-height="270"
                  outlined
                  rounded="xl"
                >
                  <v-list-item three-line>
                    <v-list-item-content class="white--text">
                      <v-list-item-title class="headline mb-1 white--text">
                        <h2 class="white--text">Course Name</h2>
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">
                        Teacher: Mr. Bean
                      </v-list-item-subtitle>
                      <v-list-item-subtitle
                        class="white--text mt-16 float-left"
                      >
                        IP Address: {{ this.clientIp }}
                      </v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="auto">
                      <i
                        class="fas fa-journal-whills fa-5x"
                        style="color: white"
                      ></i>
                    </v-list-item-avatar>
                  </v-list-item>

                  <v-menu origin="center center" transition="scale-transition">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        bottom
                        color="indigo darken-4"
                        class="rounded-pill float-right mr-4"
                        width="110"
                        min-height="60"
                        dark
                        v-bind="attrs"
                        v-on="on"
                      >
                        <h5>Create</h5>
                        <i class="fas fa-sort-down fa-lg mb-2"></i>
                      </v-btn>
                    </template>

                    <v-list>
                      <v-dialog v-model="dialog" width="500">
                        <template v-slot:activator="{ on, attrs }">
                          <v-list-item v-bind="attrs" v-on="on"
                            >New Lesson</v-list-item
                          >
                        </template>

                        <v-card fluid>
                          <v-card-title class="headline grey lighten-2">
                            Create Lesson
                          </v-card-title>

                          <v-card-text>
                            <v-form v-model="valid">
                              <v-container>
                                <v-row>
                                  <v-col cols="12" md="12">
                                    <v-text-field
                                      v-model="lesson"
                                      label="Title of Lesson"
                                      required
                                      outlined
                                    ></v-text-field>
                                  </v-col>

                                  <v-col cols="12" md="12">
                                    <v-textarea
                                      label="Description"
                                      auto-grow
                                      outlined
                                      v-model="description"
                                      rows="3"
                                      row-height="15"
                                      class="height: auto"
                                    ></v-textarea>
                                  </v-col>

                                  <v-col cols="12" md="12">
                                    <input
                                      type="file"
                                      multiple
                                      @change="onFileSelected"
                                    />
                                  </v-col>
                                  <v-col cols="12" md="12">
                                    <v-text-field
                                      label="Link"
                                      v-model="video_link"
                                      outlined
                                    ></v-text-field>
                                  </v-col>
                                </v-row>
                              </v-container>
                            </v-form>
                          </v-card-text>

                          <v-divider></v-divider>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text @click="dialog = false">
                              Cancel
                            </v-btn>
                            <v-btn
                              color="primary"
                              text
                              @click="
                                dialog = false;
                                onSaveClose();
                              "
                            >
                              Create
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </v-list>
                  </v-menu>
                </v-card>
              </div>
            </v-row>

            <div v-for="(item, i) in items" :key="i">
              <v-hover v-slot:default="{ hover }" open-delay="80">
                <v-card
                  outlined
                  max-width="600"
                  class="mx-auto mt-6 rounded-lg border"
                  style="border: 2px solid pink !important"
                  :elevation="hover ? 8 : 0"
                  min-height="150"
                  @click="
                    $router.push({ name: 'test2', params: { id: item.uuid } })
                  "
                >
                  <router-link
                    class="text-decoration-none"
                    :to="'courseservice/detail/' + item.uuid"
                  >
                    <v-list-item>
                      <v-avatar color="pink" size="40" class="mr-3"
                        ><i
                          class="fas fa-file-alt fa-lg"
                          style="color: white"
                        ></i
                      ></v-avatar>
                      <v-list-item-content>
                        <v-list-item-title class="headline"
                          ><h6>{{ item.lesson }}</h6></v-list-item-title
                        >
                        <v-list-item-subtitle class="gray--text">{{
                          convertDateTime(item.created_at)
                        }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-divider class="my-2"></v-divider>

                    <v-card-text class="black--text">
                      {{ item.description }}
                    </v-card-text>
                  </router-link>
                </v-card>
              </v-hover>
            </div>
          </v-tab-item>
          <v-tab-item><ExamManage /></v-tab-item
        ></v-tabs>
      </v-layout>
    </v-container>
  </v-app>
</template>

<script>
import axios from "axios";
const apiUrl = require("../../../apiUrl");
import moment from "moment";
import LessonDetail from "./LessonDetail";
import ExamManage from "../exam_admin/ExamManage";
export default {
  // eslint-disable-next-line vue/no-unused-components
  components: { LessonDetail, ExamManage },
  data: () => ({
    items: [],
    dialog: false,
    selectedFile: [],
    lesson: "",
    description: "",
    imagePath: "",
    course_id: 1,
    host: window.location.protocol + "//" + window.location.host,
    clientIp: "",
    video_link: "",
  }),
  async mounted() {
    await this.loadData();
    fetch("https://api.ipify.org?format=json")
      .then((response) => response.json())
      .then((response) => {
        this.clientIp = response.ip;
      });
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.lesson;
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
    async onSaveClose() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");

          // let strUrl = apiUrl.lesson;
          // let method = "post";

          let formdata = new FormData();
          formdata.append("course_id", this.course_id);
          formdata.append("lesson", this.lesson);
          formdata.append("description", this.description);
          formdata.append("video_link[]", this.video_link);
          for (let i = 0; i < this.selectedFile.length; i++) {
            formdata.append("file_path[]", this.selectedFile[i]);
          }
          axios
            .post("http://127.0.0.1:8002/api/lesson/", formdata)
            .then((resp) => {
              this.imagePath = resp.data.path;
              this.loadData();
              this.clear();
            });

          // if (this.examId !== "") {
          //   strUrl = apiUrl.exam_edit + this.examId;
          //   method = "patch";
          // }
        }, 200);
      });
    },
    clear() {
      (this.lesson = ""),
        (this.description = ""),
        (this.selectedFile = null),
        (this.video_link = "");
    },
    convertDateTime(value) {
      let dateTime = moment(value);
      // let date = dateTime.format("DD MMM, hh:mma");
      return dateTime.fromNow();
    },
    onFileSelected(event) {
      var selfile = event.target.files;
      for (let i = 0; i < selfile.length; i++) {
        this.selectedFile.push(selfile[i]);
      }
      // let formdata = new FormData();
      // formdata.append("file_path", img);
      // axios.post("http://127.0.0.1:8002/api/lesson/", formdata).then((resp) => {
      //   this.imagePath = resp.data.path;
      // });
      window.console.log(this.selectedFile);
      // window.console.log(this.filename);
    },
  },
  computed: {},
};
</script>
<style scoped>
@media (max-width: 576px) {
}
</style>