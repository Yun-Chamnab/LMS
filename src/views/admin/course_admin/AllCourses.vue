<template>
  <v-app>
    <v-container>
      <div style="height: 10px; width: 100%"></div>

      <!-- <v-row>
        <v-col sm="12" cols="12" class="py-0"> -->
      <v-dialog v-model="dialog" max-width="400px">
        <template v-slot:activator="{ on }">
          <v-btn class="btn_save_att" v-on="on"
            >{{ $t("create_course") }}
          </v-btn>
        </template>
        <v-card>
          <v-card-title>{{ $t("create_course") }}</v-card-title>

          <v-icon class="btn_close" @click="dialog = false">close</v-icon>
          <v-divider />
          <v-card-text
            style="height: 400px; background-color: #edf1f5; color: #333"
          >
            <v-container>
              <v-row>
                <v-col sm="12" cols="12" class>
                  <label class="label">{{ $t("title") }}</label>
                  <v-text-field
                    class="disable_alert my-3"
                    v-model="title"
                    append-icon="fa-id-card"
                    precision="3"
                    outlined
                    required
                  />
                  <label class="label">{{ $t("description") }}</label>
                  <v-text-field
                    class="disable_alert my-3"
                    v-model="description"
                    append-icon="fa-id-card"
                    precision="3"
                    outlined
                    required
                  />`
                  <label class="label">{{ $t("teacher") }}</label>
                  <v-select
                    v-model="teacher"
                    single-line
                    item-text="name"
                    :items="listUser"
                    label="All"
                    outlined
                    hide-details
                    return-object
                  >
                  </v-select>
                  <label class="label">{{ $t("image") }}</label>
                  <input type="file" @change="onFileSelected" />
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-divider />
          <v-card-actions class="function_footer">
            <v-btn
              class="btn_cancel float-left"
              @click="(dialog = false), clear()"
              >{{ $t("cancel") }}</v-btn
            >
            <v-btn
              class="btn_save_new float-right"
              @click="onSaveClose(true)"
              >{{ $t("save_new") }}</v-btn
            >
            <v-btn
              class="btn_save_close float-right"
              @click="onSaveClose(false)"
              >{{ $t("save_close") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-row class="masonry">
        <v-col sm="3" cols="12" v-for="(item, i) in listCourses" :key="i">
          <!-- <router-link
            style="display: inline-block; text-decoration: none; float: right"
            :to="'class/' + item.id"
          > -->
          <v-card class="mx-auto" max-width="344">
            <v-img
              :src="imgsrc + item.image_path"
              height="200px"
              width="100%"
            ></v-img>

            <v-card-title> {{ item.title }} </v-card-title>

            <v-card-subtitle> {{ item.teacher_name }} </v-card-subtitle>
          </v-card>
          <!-- </router-link> -->
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

 <script>
const axios = require("axios");
const apiUrl = require("../../../apiUrl");
import store from "@/store";
export default {
  components: {},
  data: () => ({
    chosenItems: [],
    listUser: [],
    listCourses: [],
    dialog: false,
    class_name: "",
    classId: "",
    selectedFile: null,
    color: "",
    filterRole: [],
    description: "",
    imgsrc:
      "http://localhost/LMS-Class/LMS/Class_api/public/uploads/course_img/",
  }),
  mounted() {
    this.loadUser();
    this.loadCourse();
  },

  methods: {
    async loadUser() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let loggedUser = store.getters.getLoggedUser;
          axios
            .get(apiUrl.list_users, {
              headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + loggedUser.data.token,
              },
            })
            .then((res) => {
              const filterRole = res.data.user;
              this.listUser = filterRole.filter((filterRole) =>
                filterRole.roleNames.includes("teacher")
              );
              window.console.log(this.listUser);
            });
        }, 500);
      });
    },
    async loadCourse() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios.get(apiUrl.list_course, {}).then((res) => {
            this.listCourses = res.data.data;
            window.console.log(this.listCourses);
          });
        }, 500);
      });
    },
    clear() {
      (this.teacher.name = ""), (this.teacher.id = ""), (this.description = "");
    },
    // async loadClass() {
    //   new Promise((resolve) => {
    //     setTimeout(() => {
    //       resolve("resolved");
    //       axios.get(apiUrl.list_class, {}).then((res) => {
    //         this.listClass = res.data.data;
    //         //   window.console.log(this.listUser);
    //       });
    //     }, 500);
    //   });
    // },
    // onEditItem(item) {
    //   this.class_name = item.class_name;
    //   this.description = item.description;
    //   this.color = item.color;
    //   this.classId = item.id;
    //   this.dialog = true;
    // },
    // async deleteclass(item) {
    //   const index = this.listClass.indexOf(item);
    //   this.deletItems = item;
    //   const btnCancel = confirm("Are you sure you want to delete this item?");
    //   if (btnCancel === true) {
    //     this.listClass.splice(index, 1);
    //     await this.deleteClass();
    //   }
    // },
    // async deleteClass() {
    //   new Promise((resolve) => {
    //     setTimeout(() => {
    //       resolve("resolved");
    //       axios
    //         .delete(apiUrl.delete_class + "/" + this.deletItems.id, {})
    //         .then((response) => {
    //           window.console.log(response);
    //         })
    //         .catch((e) => {
    //           this.errors.push(e);
    //         });
    //     }, 200);
    //   });
    // },
    onFileSelected(event) {
      this.selectedFile = event.target.files[0];

      window.console.log(this.selectedFile);
    },
    async onSaveClose() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let formdata = new FormData();
          formdata.append("class_id", this.$route.params.id);
          formdata.append("description", this.description);
          formdata.append("teacher_id", this.teacher.id);
          formdata.append("teacher_name", this.teacher.name);
          formdata.append("title", this.title);
          formdata.append("image_path", this.selectedFile);

          axios
            .post("http://127.0.0.1:8085/api/course", formdata)
            .then((response) => {
              this.loadCourse();
              this.dialog = false;
              this.clear();
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