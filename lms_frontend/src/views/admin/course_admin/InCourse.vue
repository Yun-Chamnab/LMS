<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col sm="12" cols="12">
          <div style="background-color: #fff; padding: 20px 20px 5px">
            <v-row>
              <v-col sm="12" cols="12" class="tab_wrapper py-0">
                <v-tabs>
                  <v-tab>
                    <span class="hidden-sm-and-up">
                      <v-icon left>mdi-pen</v-icon>
                    </span>
                    <span class="hidden-sm-and-down">
                      {{ $t("course") }}
                    </span>
                  </v-tab>
                  <v-tab>
                    <span class="hidden-sm-and-up">
                      <v-icon left>mdi-pen</v-icon>
                    </span>
                    <span class="hidden-sm-and-down">
                      {{ $t("invite_student") }}
                    </span>
                  </v-tab>

                  <v-tab-item>
                    <v-card flat>
                      <v-card-text class="">
                        <AllCourses />
                      </v-card-text>
                    </v-card>
                  </v-tab-item>

                  <v-tab-item>
                    <v-card flat>
                      <v-card-text class="">
                        <InviteStudent />
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
                <!-- Dropdown New-->
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import AllCourses from "./AllCourses";
import InviteStudent from "./InviteStudent";
export default {
  name: "",
  components: {
    AllCourses,
    InviteStudent,
  },
  data: () => ({
    listUser: [],
    dialog: false,
  }),
  watch: {},
  methods: {
    clickMe(data) {
      this.$route.push(data.link);
    },
  },
};
</script>
<style scoped>
/* .v-menu__content {
  top: 141px !important;
  left: 1240px !important;
} */
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
</style>