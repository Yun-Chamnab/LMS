<template>
  <v-row class>
    <v-col sm="12" cols="12">
      <v-tabs class="tab_setting" slider-color="lightGray">
        <v-tab>
          <span class="hidden-sm-and-up">
            <v-icon left>mdi-pen</v-icon>
          </span>
          <span class="hidden-sm-and-down text-capitalize">{{
            $t("manage_user")
          }}</span>
        </v-tab>
        <v-tab>
          <span class="hidden-sm-and-up">
            <v-icon left>mdi-pen</v-icon>
          </span>
          <span class="hidden-sm-and-down text-capitalize">{{
            $t("manage_role")
          }}</span>
        </v-tab>
        <v-tab>
          <span class="hidden-sm-and-up">
            <v-icon left>mdi-pen</v-icon>
          </span>
          <span class="hidden-sm-and-down text-capitalize">{{
            $t("manage_permissions")
          }}</span>
        </v-tab>

        <v-tab-item>
          <v-card flat class="custom_vcard">
            <v-card-text class="pt-0 bg_white">
              <ManageUser />
            </v-card-text>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat class="custom_vcard">
            <v-card-text class="pt-0 bg_white">
              <RoleManage />
            </v-card-text>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat class="custom_vcard">
            <v-card-text class="pt-0 bg_white">
              <PermissionManage />
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-col>
  </v-row>
</template>

<script>
import ManageUser from "./ManageUser";
import PermissionManage from "./PermissionManage";
import RoleManage from "./RoleManage";
export default {
  name: "",
  components: {
    ManageUser,
    PermissionManage,
    RoleManage,
  },
  data: () => ({}),
  watch: {},
  async mounted() {},
  computed: {},
  methods: {},
};
</script>
<style scoped>
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
  border-bottom: 4px solid #92d050;
  color: #000;
}
.v-tab--active {
  background-color: rgb(255, 255, 255);
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
</style>