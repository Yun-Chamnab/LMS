<template>
  <v-app>
    <v-container>
      <h2 style="font-weight: bold; font-size: 35px">
        {{ $t("Classroom") }}
      </h2>
      <div v-for="(val, i) in listCourses" :key="i">
        <v-row>
          <v-col cols="16" sm="3" v-for="(item, j) in val" :key="j">
            <router-link
              style="text-decoration: none"
              :to="
                'lesson/' +
                item.uuid +
                '&' +
                item.title +
                '&' +
                item.teacher_name
              "
            >
              <v-card class="mx-auto" max-width="344">
                <v-img
                  :src="imgsrc + item.image_path"
                  height="200px"
                  width="100%"
                ></v-img>

                <v-card-title> {{ item.title }} </v-card-title>

                <v-card-subtitle> {{ item.teacher_name }} </v-card-subtitle>
              </v-card>
            </router-link>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </v-app>
</template>

<script>
const axios = require("axios");
const apiUrl = require("../../apiUrl");
import store from "@/store";
export default {
  components: {},
  data: () => ({
    listCourses: [],
    description: "",
    imgsrc: apiUrl.file_path,
  }),
  mounted() {
    this.loadCourse();
  },
  methods: {
    async loadCourse() {
      new Promise((resolve) => {
        setTimeout(() => {
          let loggedUser = store.getters.getLoggedUser;
          let userId = loggedUser.data.user.id;
          resolve("resolved");
          axios.get(apiUrl.student_course + userId).then((res) => {
            this.listCourses = res.data.data;
            window.console.log(this.listCourses);
          });
        }, 500);
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
