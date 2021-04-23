<template>
  <v-row class>
    <div style="height: 35px; width: 100%"></div>
    <v-col sm="12" cols="12" class="pl-8">
      <h2 style="font-weight: bold; font-size: 35px">
        {{ $t("list_student_in_class") }}
      </h2>
      <div style="height: 30px; width: 100%"></div>
      <!-- <v-row>
        <v-col sm="12" cols="12" class="py-0"> -->
      <v-dialog v-model="dialog" max-width="400px">
        <template v-slot:activator="{ on }">
          <v-btn class="btn_save_att" v-on="on">{{ $t("add_student") }} </v-btn>
        </template>
        <v-card>
          <v-card-title>{{ $t("select_student_to_invite") }}</v-card-title>

          <v-icon class="btn_close" @click="dialog = false">close</v-icon>
          <v-divider />
          <v-card-text
            style="height: 200px; background-color: #edf1f5; color: #333"
          >
            <v-container>
              <v-row>
                <v-col sm="12" cols="12" class>
                  <label class="label">{{ $t("role") }}</label>
                  <v-select
                    v-model="students"
                    :items="listUser"
                    label="Select"
                    item-text="name"
                    multiple
                    chips
                    hint="What are the target regions"
                    persistent-hint
                    return-object
                  ></v-select>
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
      <div style="height: 30px; width: 100%"></div>
      <v-row class="mb-3">
        <v-col sm="12" cols="12" class="py-0">
          <template>
            <v-card>
              <v-data-table
                item-key="name"
                class="elevation-1"
                :headers="headers"
                :items="listStudent"
                :items-per-page="5"
                hide-default-header
              >
                <template v-slot:header="{}">
                  <thead>
                    <tr>
                      <th>{{ $t("no") }}</th>
                      <th>{{ $t("name") }}</th>
                      <th class="text-center">{{ $t("Action") }}</th>
                    </tr>
                  </thead>
                </template>
                <template v-slot:body="{ items }">
                  <tbody style="white-space: nowrap">
                    <tr v-for="(student, index) in items" v-bind:key="index">
                      <td>{{ 1 + index++ }}</td>
                      <td>{{ student.student_name }}</td>
                      <td class="text-center">
                        <v-btn @click="onEditItem(student)">
                          <v-icon size="15" color="#3e0eff">fa fa-pen</v-icon>
                        </v-btn>
                        <v-btn @click="deleteuser(student)">
                          <v-icon size="15" color="#f50d0d">fa fa-trash</v-icon>
                        </v-btn>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-data-table>
            </v-card>
          </template>
        </v-col>
      </v-row>
      <!-- </v-col>
      </v-row> -->
    </v-col>
  </v-row>
</template>

<script>
const axios = require("axios");
const apiUrl = require("../../../apiUrl");
import store from "@/store";
export default {
  data: () => ({
    headers: [
      { text: "No", value: "no" },
      { text: "Username", value: "student_name" },
    ],
    dialog: false,
    listUser: [],
    listStudent: [],
    students: [],
    userId: "",
    student_name: "",
    student_id: "",
    roleNames: "",
    editot: false,
  }),
  props: {},
  watch: {
    dialogm2(val) {
      val || this.close();
    },
  },
  methods: {
    // onNewClick() {
    //   this.taxId = "";
    // },
    getColor(roleNames) {
      if (roleNames === "administrator") {
        return "red";
      } else if (roleNames === "teacher") {
        return "green";
      } else {
        return "orange";
      }
    },

    clickMe(data) {
      // alert(data.link)
      this.$router.push(`${data.link}`);
      //this.$event.target.classList.toggle(active)
      //eslint-disable-next-line no-console
      console.log(data.link);
      //eslint-disable-next-line no-console
      //console.log(data)
    },
    async deleteuser(user) {
      const index = this.listUser.indexOf(user);
      this.deletItems = user;
      const btnCancel = confirm("Are you sure you want to delete this item?");
      if (btnCancel === true) {
        this.listUser.splice(index, 1);
        await this.deleteUser();
      }
    },
    async deleteUser() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let loggedUser = store.getters.getLoggedUser;
          axios
            .post(
              apiUrl.del_user + this.deletItems.id,
              {},
              {
                headers: {
                  "Content-Type": "application/json",
                  Accept: "application/json",
                  Authorization: "Bearer " + loggedUser.data.token,
                },
              }
            )
            .then((response) => {
              window.console.log(response);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
    clear() {
      this.name = "";
      this.email = "";
      this.roleNames = "";
    },
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
                filterRole.roleNames.includes("student")
              );
              window.console.log(this.listUser);
            });
        }, 500);
      });
    },
    async loadStudent() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios
            .get(apiUrl.list_student + this.$route.params.id, {})
            .then((res) => {
              this.listStudent = res.data.data;
              window.console.log(this.listUser);
            });
        }, 500);
      });
    },
    async onSaveClose() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let strUrl = apiUrl.add_student;
          let method = "post";
          let datas = [];
          this.students.forEach((item) => {
            datas.push({
              student_name: item.name,
              class_id: this.$route.params.id,
              student_id: item.id,
            });
          });
          // window.console.log(this.students);
          // let formdata = new FormData();
          // formdata.append("class_id", this.$route.params.id);
          // this.students.forEach((item) => {
          //   formdata.append("student_name", item.name);
          //   formdata.append("student_id", item.id);
          // });
          // axios
          //   .post("http://127.0.0.1:8084/api/student", formdata)
          //   .then((response) => {
          //     this.loadStudent();
          //     // this.clear();
          //     window.console.log(response);
          //   });

          axios({
            method: method,
            url: strUrl,
            data: datas,
          })
            .then((response) => {
              window.console.log(response);

              this.dialog = false;

              // this.isDisabled = false
              this.loadStudent();
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
  },
  components: {},
  async mounted() {
    this.loadUser();
    this.loadStudent();
  },
};
</script>
<style scoped>
table.acc_form {
  border-top: 1px solid #ccc;
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  color: #000;
}
table.acc_form tr th {
  text-transform: uppercase;
  padding: 10px;
  border-top: 1px solid #ccc;
  border-bottom: 3px solid #ccc;
  vertical-align: middle;
}

table.acc_form tr td {
  border-bottom: 1px solid #ccc;
  padding: 8px;
  vertical-align: middle;
}

table.acc_form tr td:first-child {
  font-weight: 700;
}

table.acc_form tr td:last-child {
  text-align: center;
}

.btn_edit {
  background-color: #4e6470 !important;
  color: #fff !important;
  height: 35px;
}

.v-card__actions .v-btn.v-btn {
  padding: 0 16px;
}

.function_footer {
  padding: 15px;
  display: inline-block;
}

.bg_white {
  background-color: #fff;
  padding-left: 0;
  padding-top: 0;
}

.wrapper_form {
  width: 99%;
  margin: 0 auto;
}

.wrapper_form .header .logo_company {
  text-align: center;
  padding-top: 0;
}

.wrapper_form .header .logo_company img {
  width: 100px;
  height: auto;
}

.wrapper_form .header h2 {
  text-align: center;
  text-transform: uppercase;
  font-size: 30px;
}

.wrapper_form .header p {
  text-align: center;
  margin-bottom: 8px;
  width: 93%;
  margin: 0 auto;
}

.wrapper_form .header p.phone_email {
  text-align: center;
}

.wrapper_form .content h3.title {
  text-transform: uppercase;
  text-align: center;
  font-size: 25px !important;
  font-weight: 700 !important;
}

.new_line {
  clear: both;
}

table.tbl_form {
  border-top: 1px solid #ccc;
  width: 95%;
  padding: 0 10px;
  border-collapse: collapse;
  margin-top: 10px;
  color: #000;
  margin-left: 10px;
}

table.tbl_form tr th {
  text-transform: uppercase;
  padding: 10px;
  border-top: 1px solid #ccc;
  border-bottom: 3px solid #ccc;
  vertical-align: middle;
}

table.tbl_form tr td {
  border: 1px solid #ccc;
  padding: 8px;
  vertical-align: middle;
}

table.tbl_form tr td:first-child {
  border-left: none;
  text-align: center;
}

table.tbl_form tr td:last-child {
  border-right: none;
}

.v-menu__content {
  top: 141px !important;
  left: 1098px !important;
}

.v-menu__content .v-list .v-list-item {
  min-height: 35px !important;
}

.tab_wrapper {
  position: relative;
  display: inherit;
}

.v-tab {
  min-width: 30px;
  font-size: 15px;
  text-transform: capitalize;
}

.v-icon--left {
  margin-right: 0px;
}

.theme--light.v-tabs > .v-tabs-bar {
  border-bottom: 1px solid #ddd !important;
}

.dropdown_transactions.v-btn {
  background-color: #2ca01c !important;
  height: 40px !important;
  width: auto !important;
  border-radius: 0 !important;
  padding: 0px 10px 0px 10px !important;
  color: #fff !important;
  right: 12px;
  position: absolute;
  top: 7px;
}

.v-tab--active {
  background-color: #e5effa;
  color: #000;
}

.theme--light.v-tabs >>> .v-tabs-bar {
  border-bottom: 1px solid #ddd !important;
}

.v-card__text {
  padding: 0 !important;
}

.return-type-table.theme--light.v-data-table {
  background-color: transparent !important;
}

/*.return-type-table.theme--light.v-data-table > .v-data-table__wrapper > table > tbody > tr:not(:last-child) > td:not(.v-data-table__mobile-row),*/
/*.return-type-table.theme--light.v-data-table > .v-data-table__wrapper > table > tbody > tr:not(:last-child) > th:not(.v-data-table__mobile-row) {*/
/*    border-bottom: 0 !important;*/
/*}*/
.return-type-table.v-data-table
  > .v-data-table__wrapper
  > table
  > thead
  > tr
  > th {
  font-family: "Krasar-Bold", serif;
  text-transform: uppercase;
  color: #000;
}

.return-type-table.v-data-table
  > .v-data-table__wrapper
  > table
  > tbody
  > tr
  > td {
  height: 25px !important;
  border: thin solid rgba(0, 0, 0, 0.2) !important;
}

@media (max-width: 576px) {
}
</style>