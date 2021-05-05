<template>
  <v-container style="background-color: white">
    <v-row class="">
      <v-col sm="7" cols="12">
        <v-row>
          <v-col sm="6" cols="12">
            <v-card
              outlined
              dense
              color="#0306b9"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listClass.length }}
                    </h3>
                  </v-card>
                </v-col>

                <v-col>
                  <i
                    class="fas fa-archway fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 30px"
                  >
                    {{ $t("class") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
            <v-card
              outlined
              dense
              color="#ec525e"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listCourses.length }}
                    </h3>
                  </v-card>
                </v-col>
                <v-col>
                  <i
                    class="fas fa-book-open fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 30px"
                  >
                    {{ $t("course") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
            <v-card
              outlined
              dense
              color="#2fbb74"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listQuizz.length }}
                    </h3>
                  </v-card>
                </v-col>

                <v-col>
                  <i
                    class="fas fa-brain fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 30px"
                  >
                    {{ $t("quiz") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
          <v-col sm="6" cols="12">
            <v-card
              outlined
              dense
              color="#f2a730"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listTeacher.length }}
                    </h3>
                  </v-card>
                </v-col>
                <v-col>
                  <i
                    class="fas fa-user-graduate fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 30px"
                  >
                    {{ $t("teacher") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
            <v-card
              outlined
              dense
              color="#26c6da"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listStudent.length }}
                    </h3>
                  </v-card>
                </v-col>
                <v-col>
                  <i
                    class="fas fa-users fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 25px"
                  >
                    {{ $t("student") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
            <v-card
              outlined
              dense
              color="#9de219"
              class="pa-3 mb-4 no_border"
              min-height="92px"
            >
              <v-row>
                <v-col sm="4" cols="6" class="py-0">
                  <v-card
                    width="66"
                    height="66"
                    outlined
                    dense
                    color="white"
                    class="no_border align-center justify-center d-flex rounded-circle"
                  >
                    <h3 class="mt-2" style="font-size: 40px">
                      {{ listRoles.length }}
                    </h3>
                  </v-card>
                </v-col>
                <v-col>
                  <i
                    class="fas fa-user-tag fa-3x float-right"
                    style="color: white"
                  ></i>
                </v-col>
                <v-col sm="12">
                  <h4
                    class="white--text text-right text-uppercase float-right"
                    style="font-size: 30px"
                  >
                    {{ $t("role") }}
                  </h4>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col sm="12" cols="12" class="py-0">
            <template>
              <v-card>
                <v-data-table
                  item-key="name"
                  class="elevation-1"
                  :headers="headers"
                  :items="listUser"
                  :items-per-page="5"
                  hide-default-header
                >
                  <template v-slot:header="{}">
                    <thead>
                      <tr>
                        <th>{{ $t("no") }}</th>
                        <th>{{ $t("name") }}</th>
                        <th>{{ $t("email") }}</th>
                        <th>{{ $t("role") }}</th>
                      </tr>
                    </thead>
                  </template>
                  <template v-slot:body="{ items }">
                    <tbody style="white-space: nowrap">
                      <tr v-for="(user, index) in items" v-bind:key="index">
                        <td>{{ 1 + index++ }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                          <v-chip :color="getColor(user.roleNames[0])" dark>
                            {{ user.roleNames[0] }}
                          </v-chip>
                        </td>
                      </tr>
                    </tbody>
                  </template>
                </v-data-table>
              </v-card>
            </template>
          </v-col>
        </v-row>
      </v-col>
      <v-col sm="5" cols="12">
        <v-row>
          <v-col sm="12" cols="12">
            <v-card class="mx-auto">
              <v-card-text>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title class="title red--text">
                     {{$t("totalcases")}} {{ total_cases }}
                    </v-list-item-title>
                    <v-list-item-subtitle> {{ date }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-row align="center">
                    <h4 class="subtitle-1">{{$t("newcase")}}</h4>

                    <v-col class="display-2 red--text" cols="4">
                      {{ new_cases }}
                    </v-col>
                    <v-col cols="4">
                      <v-img
                        src="http://covidcp.org/images/logo-icononly.png"
                        alt="Sunny image"
                        width="190"
                      ></v-img>
                    </v-col>
                  </v-row>
                </v-list-item>
                <v-list-item>
                  <v-list-item-icon>
                    <i class="fas fa-circle fa-sm" style="color: green"></i>
                  </v-list-item-icon>
                  <v-list-item-title
                    ><h4 class="subtitle-1">
                      {{$t("newdeath")}}
                      <span class="red--text font-weight-bold">
                        {{ new_deaths }}</span
                      >
                    </h4>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item>
                  <v-list-item-icon>
                    <i class="fas fa-circle fa-sm" style="color: red"></i>
                  </v-list-item-icon>
                  <v-list-item-title
                    ><h4 class="subtitle-1">
                      {{$t("totaldeath")}}
                      <span class="red--text font-weight-bold">
                        {{ total_deaths }}</span
                      >
                    </h4>
                  </v-list-item-title>
                </v-list-item></v-card-text
              >
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col sm="12" cols="12" class="py-0">
            <v-card
              outlined
              dense
              color="#B2DFDB"
              class="pa-5 no_border"
              min-height="410px"
            >
              <v-row>
                <v-col sm="12" cols="12" class="py-0 text-center">
                  <h3>{{ $t("statistics") }}</h3>
                  <h3 style="font-size: 30px" class="my-5">500,000</h3>
                </v-col>
                <v-col cols="12" class="py-0">
                  <chart
                    ref="chart"
                    title-text="'Learning Magement System , 2020 - 2021'"
                    :title-position="'bottom'"
                    :chart-area-background="''"
                    :legend-visible="false"
                    :series-defaults-labels-visible="true"
                    :series-defaults-labels-background="'transparent'"
                    :series-defaults-labels-template="labelTemplate"
                    :series="series"
                    :tooltip-visible="true"
                    :theme="'sass'"
                  >
                  </chart>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <div>
      <chart
        title-text= "Number of student in each class"
        :data-source="studentperclass"
        :series="series1"
        :legend-position="'bottom'"
        :theme="'sass'"
      >
      </chart>
    </div>
  </v-container>
</template>

<script>
const axios = require("axios");
const apiUrl = require("../../../apiUrl");
const state = require("../../../query.js");
import { i18n } from "@/i18n";
import store from "@/store";
import { Chart } from "@progress/kendo-charts-vue-wrapper";
export default {
  components: {
    chart: Chart,
  },
  data: () => ({
    headers: [
      { text: "No", value: "no" },
      { text: "Username", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "roleNames" },
    ],
    listCourses: [],
    listClass: [],
    listQuizz: [],
    listUser: [],
    listStudent: [],
    listTeacher: [],
    listRoles: [],
    value: [10, 50, 30, 40, 50, 40, 20],
    labelTemplate: "#= category # #= value #%",
    series: [
      {
        type: "pie",
        startAngle: 100,
        data: [
          {
            category: "Teacher",
            value: 20,
            color: "#f2a730",
          },
          {
            category: "Student",
            value: 78,
            color: "#26c6da",
          },
        ],
      },
    ],
    studentperclass: [],
    series1: [
      {
        field: "stuperclass_count",
        labels: {
          visible: true,
        },
        categoryField: "class_name",
      },
    ],
    total_cases: "",
    new_cases: "",
    total_deaths: "",
    new_deaths: "",
    date: "",
  }),
  mounted() {
    this.loadUser();
    this.loadCourse();
    this.loadStudent();
    this.loadTeacher();
    this.loadClass();
    this.loadRole();
    this.loadQuiz();
    this.studentPerClass();
    this.loadCovid();
  },
  methods: {
    getColor(roleNames) {
      if (roleNames === "administrator") {
        return "red";
      } else if (roleNames === "teacher") {
        return "green";
      } else {
        return "orange";
      }
    },
    async loadQuiz() {
      let strUrl = apiUrl.exam_post;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.listQuizz = response.data.data;
          window.console.log(this.listQuizz);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    async loadClass() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios.get(apiUrl.list_class).then((res) => {
            this.listClass = res.data.data;
            window.console.log(this.listClass);
          });
        }, 500);
      });
    },
    async loadRole() {
      this.loading = true;
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let fromState = state.default.getters.getRole;
          let loggedUser = store.getters.getLoggedUser;
          if (fromState.length > 0) {
            this.listRoles = fromState;
            window.console.log("am form state", fromState);
          } else {
            axios
              .get(apiUrl.list_roles, {
                headers: {
                  "Content-Type": "application/json",
                  Accept: "application/json",
                  Authorization: "Bearer " + loggedUser.data.token,
                },
              })
              .then((res) => {
                this.listRoles = res.data.data.role;
                state.default.commit("setRole", res.data.data.role);
                window.console.log("set state", fromState);
              });
          }
        }, 100);
      });
    },
    async loadCourse() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios.get(apiUrl.list_course).then((res) => {
            this.listCourses = res.data.data;
            window.console.log(this.listCourses);
          });
        }, 500);
      });
    },
    async loadStudent() {
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
              this.listStudent = filterRole.filter((filterRole) =>
                filterRole.roleNames.includes("student")
              );
              window.console.log(this.listStudent);
            });
        }, 500);
      });
    },
    async loadTeacher() {
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
              this.listTeacher = filterRole.filter((filterRole) =>
                filterRole.roleNames.includes("teacher")
              );
              window.console.log(this.listStudent);
            });
        }, 500);
      });
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
              this.listUser = res.data.user;
              //   window.console.log(this.listUser);
            });
        }, 500);
      });
    },
    async studentPerClass() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios.get(apiUrl.student_per_class).then((res) => {
            this.studentperclass = res.data.data;
            // this.className = res.data.data;
            window.console.log(this.studentperclass);
          });
        }, 500);
      });
    },
    async loadCovid() {
      axios
        .get("https://covid.ourworldindata.org/data/owid-covid-data.json")
        .then((response) => {
          this.items = response.data.KHM.data;
          this.total_case();
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    total_case() {
      this.total_cases = this.items[this.items.length - 1].total_cases;
      this.new_cases = this.items[this.items.length - 1].new_cases;
      this.total_deaths = this.items[this.items.length - 1].total_deaths;
      this.new_deaths = this.items[this.items.length - 1].new_deaths;
      this.date = this.items[this.items.length - 1].date;
    },
  },
  computed: {
    fields() {
      return ["30 " + i18n.t("days_summary"), "60 " + i18n.t("days_summary")];
    },
  },
};
</script>
<style scoped>
.theme--light.v-data-table {
  background-color: transparent !important;
}
.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  height: 32px !important;
}
.k-chart {
  height: 190px !important;
}
.theme--light.v-data-table
  > .v-data-table__wrapper
  > table
  > tbody
  > tr:hover:not(.v-data-table__expanded__content):not(.v-data-table__empty-wrapper) {
  background-color: transparent !important;
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
  padding: 0px 5px 0px 10px !important;
  color: #fff !important;
  right: 12px;
  position: absolute;
  top: 7px;
}
.v-tab--active {
  background-color: #f3f8ff;
  color: #000;
}
.t {
  color: #00b050;
}
.theme--light.v-tabs >>> .v-tabs-bar {
  border-bottom: 1px solid #ddd !important;
}
.v-card__text {
  padding: 0 !important;
}

@media (max-width: 576px) {
}
</style>