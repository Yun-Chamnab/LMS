<template>
  <v-app>
    <v-container>
      <v-layout>
        <v-tabs center-active color="basil">
          <v-tab>Lesson</v-tab>
          <v-tab>Quiz</v-tab>
          <v-tab-item>
            <v-row>
              <v-col class="tab_wrapper py-0" cols="12" sm="12">
                <v-card
                  class="mx-6 mt-4"
                  color="pink lighten-1"
                  width="auto"
                  min-height="270"
                  outlined
                  rounded="xl"
                >
                  <v-list-item three-line>
                    <v-list-item-content class="white--text">
                      <v-list-item-title class="headline mb-1 white--text">
                        <h2 class="white--text">
                          {{ this.$route.params.title }}
                        </h2>
                      </v-list-item-title>
                      <v-list-item-subtitle class="white--text">
                        Teacher: {{ this.$route.params.teacher }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle class="white--text mt-3 float-left">
                        IP Address: {{ this.clientIp }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle> </v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="auto">
                      <i
                        class="fas fa-journal-whills fa-5x"
                        style="color: white"
                      ></i>
                    </v-list-item-avatar>
                  </v-list-item>
                  <v-dialog v-model="dialog1">
                    <v-btn
                      color="transparent"
                      class="black--text mt-12 ml-4"
                      max-width="100"
                      min-height="40"
                      dark
                      slot="activator"
                      @click="dialog1 = true"
                      ><h5>calendar</h5>
                    </v-btn>

                    <iframe
                      src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;src=Y2hhbW5hYi55dW5Ac3R1ZGVudC5uaXB0aWN0LmVkdS5raA&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb20xNDc1YmRmY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb21hYmQxOWY1OUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb20zYTQ3ODU4YUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb20yM2IwNzEyOUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb21kMGQ4NTIyMkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb202NGRkZGU1NUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb20yZWYwMDgyYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y19jbGFzc3Jvb203ZTkzOGIwZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=ZW4ua2gjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%230047a8&amp;color=%230047a8&amp;color=%23c26401&amp;color=%23137333&amp;color=%23137333&amp;color=%230047a8&amp;color=%23202124&amp;color=%230047a8&amp;color=%230B8043"
                      style="border-width: 0"
                      max-width="500"
                      height="600"
                      frameborder="0"
                      scrolling="no"
                    ></iframe>
                  </v-dialog>
                  <v-menu origin="center center" transition="scale-transition">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        bottom
                        color="indigo darken-4"
                        class="rounded-pill float-right mr-4 mt-10"
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
              </v-col>
            </v-row>

            <div v-for="(item, i) in items" :key="i">
              <v-hover v-slot:default="{ hover }" open-delay="80">
                <v-card
                  outlined
                  max-width="800"
                  class="mx-auto mt-6 rounded-lg border"
                  style="border: 2px solid pink !important"
                  :elevation="hover ? 8 : 0"
                  min-height="150"
                >
                  <!-- Delete -->
                  <v-dialog v-model="dialog3" max-width="290">
                    <v-card>
                      <v-card-title class="headline"
                        >Are you sure?</v-card-title
                      >

                      <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                          color="green darken-1"
                          text
                          @click="dialog3 = false"
                        >
                          Cancel
                        </v-btn>

                        <v-btn
                          color="green darken-1"
                          text
                          @click="deleteexam(item)"
                          @click.prevent="dialog3 = false"
                        >
                          Agree
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                  <!-- End Delete Dialog -->
                  <router-link
                    class="text-decoration-none"
                    :to="'detail/' + item.uuid + '&' + title"
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
                        <v-list-item-subtitle class="blue--text"
                          ><h5>
                            {{ convertDateTime(item.created_at) }}
                          </h5></v-list-item-subtitle
                        >
                      </v-list-item-content>

                      <!-- <i
                        class="fa fa-trash float-right mx-1 align-top"
                        style="color: red"
                        @click="dialog3 = true"
                      ></i> -->
                      <v-btn color="black" link bottom icon>
                        <i
                          class="fa fa-trash float-right mx-1 align-top"
                          style="color: red"
                          @click="dialog3 = true"
                        ></i>
                      </v-btn>

                      <!-- <span class="float-right">{{
                        convertDate(item.created_at)
                      }}</span> -->
                    </v-list-item>
                    <v-divider class="my-2"></v-divider>

                    <v-card-text class="black--text">
                      {{ item.description }}
                    </v-card-text>
                  </router-link>

                  <!-- <i
                    class="far fa-edit float-right"
                    style="color: green"
                    color="primary"
                    @click="onEditItem(item)"
                  ></i> -->
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
    dialog1: false,
    dialog3: false,
    selectedFile: [],
    lesson: "",
    description: "",
    imagePath: "",
    course_id: "",
    host: window.location.protocol + "//" + window.location.host,
    clientIp: "",
    video_link: "",
    title: "",
  }),
  async mounted() {
    (this.title = this.$route.params.title),
      (this.course_id = this.$route.params.uuid),
      await this.loadData();
    fetch("https://api.ipify.org?format=json")
      .then((response) => response.json())
      .then((response) => {
        this.clientIp = response.ip;
      });
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.show_lesson + this.$route.params.uuid;
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
            .post("http://127.0.0.1:8085/api/lesson/", formdata)
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
    convertDate(value) {
      let dateTime = moment(value);
      let date = dateTime.format("DD MMMM YYYY, hh:mm a");
      return date;
    },
    onFileSelected(event) {
      var selfile = event.target.files;
      for (let i = 0; i < selfile.length; i++) {
        this.selectedFile.push(selfile[i]);
      }
      // window.console.log(this.selectedFile);
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
            .delete(apiUrl.lesson + this.deletItems.uuid, {})
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

<style scoped>
@media (max-width: 576px) {
}
</style>