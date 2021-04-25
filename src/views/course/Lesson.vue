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
                      <v-list-item-subtitle class="white--text mt-4 float-left">
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
                  <v-dialog v-model="dialog1" max-width="900">
                    <template v-slot:activator="{ on }">
                      <v-btn
                        v-on="on"
                        color="transparent"
                        class="black--text mt-12 ml-4"
                        max-width="100"
                        min-height="40"
                        dark
                        @click="dialog1 = true"
                        ><h5>calendar</h5>
                      </v-btn>
                    </template>

                    <iframe
                      src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;src=bXJybmFibWF4aUBnbWFpbC5jb20&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y2xhc3Nyb29tMTA3MzcwMDg4ODc1OTk5ODk4NTQ1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=Y2xhc3Nyb29tMTA4NzU2MjY2MjM2NTk1MTUyMjY2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=Y2xhc3Nyb29tMTA1NTU0OTkzNDMwMTUzMjQ5OTMwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tN2E2NTljNGJAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tNzE1MDYyY2JAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tZjQ1NjExNDRAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tMjBlYmJlMzZAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tYTUxZGUzNGVAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tYzgyMTU4NzdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tNDgyMDRkOWJAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=Y2xhc3Nyb29tMTA4ODkzMjgxNjcyMDczNjk0NTM1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tZDY5M2M5YzNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=Y2xhc3Nyb29tMTEyMTA1MDMzMTU4NzI3NTk4NzA5QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=ZW4ua2gjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=Y2xhc3Nyb29tMTE1MzQwNDkyMDYyNDcxMzIwMDA0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=Y2xhc3Nyb29tMTE2NTI0NzU4Mzg1MTk2MjM1ODA3QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tNTI3NzY1NTNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tYWFlMTkxNGVAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=bmlwdGljdC5lZHUua2hfY2xhc3Nyb29tNWNkMDgyMWJAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=am5obmR0ZGhtZzJmazl0ZTlsbWtobGh2bGI2NzZubHZAaW1wb3J0LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%23137333&amp;color=%23202124&amp;color=%230047a8&amp;color=%23007b83&amp;color=%230047a8&amp;color=%230047a8&amp;color=%23c26401&amp;color=%23c26401&amp;color=%23007b83&amp;color=%230047a8&amp;color=%23202124&amp;color=%230047a8&amp;color=%231c3aa9&amp;color=%230B8043&amp;color=%23137333&amp;color=%23c26401&amp;color=%23c26401&amp;color=%23c26401&amp;color=%23c26401&amp;color=%23A79B8E&amp;showTitle=0&amp;showNav=1&amp;showDate=1&amp;showPrint=0&amp;showTabs=1&amp;showCalendars=0&amp;showTz=1"
                      style="border: solid 1px #777"
                      width="600"
                      height="550"
                      frameborder="0"
                      scrolling="no"
                    ></iframe>
                  </v-dialog>
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

                      <!-- <span class="float-right">{{
                        convertDate(item.created_at)
                      }}</span> -->
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
const apiUrl = require("../../apiUrl");
import moment from "moment";
import LessonDetail from "./LessonDetail";
import ExamManage from "../exam/Exam";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: { LessonDetail, ExamManage },
  data: () => ({
    items: [],
    dialog1: false,
    lesson: "",
    description: "",
    course_id: "",
    host: window.location.protocol + "//" + window.location.host,
    clientIp: "",
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
          // window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    convertDateTime(value) {
      let dateTime = moment(value);
      return dateTime.fromNow();
    },
    convertDate(value) {
      let dateTime = moment(value);
      let date = dateTime.format("DD MMMM YYYY, hh:mm a");
      return date;
    },
  },
  computed: {},
};
</script>

<style scoped>
@media (max-width: 576px) {
}
</style>