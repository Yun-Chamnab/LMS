<template>
  <v-app>
    <v-container>
      <h2 style="font-weight: bold; font-size: 35px">
        {{ $t("Classroom") }}
      </h2>
      <div style="height: 10px; width: 100%"></div>

      <!-- <v-row>
        <v-col sm="12" cols="12" class="py-0"> -->
      <v-dialog v-model="dialog" max-width="400px">
        <template v-slot:activator="{ on }">
          <v-btn class="btn_save_att" v-on="on"
            >{{ $t("create_class") }}
          </v-btn>
        </template>
        <v-card>
          <v-card-title>{{ $t("create_class") }}</v-card-title>

          <v-icon class="btn_close" @click="dialog = false">close</v-icon>
          <v-divider />
          <v-card-text
            style="height: 400px; background-color: #edf1f5; color: #333"
          >
            <v-container>
              <v-row>
                <v-col sm="12" cols="12" class>
                  <label class="label">{{ $t("class_name") }}</label>
                  <v-text-field
                    class="disable_alert my-3"
                    v-model="class_name"
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
                  />
                </v-col>
                <v-col sm="4" cols="12" class>
                  <label class="label">{{ $t("color") }}</label>
                  <v-select
                    v-model="color"
                    single-line
                    :items="bgColor"
                    label="All"
                    item-text="color"
                    item-value="color"
                    outlined
                    hide-details
                  >
                    <template v-slot:selection="{ item }">
                      <v-chip :color="item.color" small></v-chip>
                    </template>
                    <template v-slot:item="{ item, attrs, on }">
                      <v-list-item v-on="on" v-bind="attrs">
                        <v-chip :color="item.color" small></v-chip>
                      </v-list-item>
                    </template>
                  </v-select>
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
      <v-row>
        <template v-if="listClass.length > 0">
          <v-col sm="3" cols="12" v-for="(item, i) in listClass" :key="i">
            <router-link
              style="text-decoration: none"
              :to="'class/' + item.uuid"
              tag="button"
            >
              <v-card
                max-width="400"
                min-width="400"
                :color="item.color"
                dark
                @click="
                  $router.push({ name: 'test2', params: { id: item.uuid } })
                "
              >
                <v-menu bottom left>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      dark
                      icon
                      v-bind="attrs"
                      v-on="on"
                      style="float: right"
                    >
                      <v-icon style="float: right">mdi-dots-vertical</v-icon>
                    </v-btn>
                  </template>

                  <v-list>
                    <v-list-item link @click="onEditItem(item)">
                      <v-list-item-title>Edit</v-list-item-title>
                    </v-list-item>
                    <v-list-item link @click="deleteclass(item)">
                      <v-list-item-title>Delete</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
                <v-card-title style="font-weight: bold; font-size: 20px">
                  {{ item.class_name }}
                </v-card-title>
                <v-divider class="mx-4"></v-divider>
                <v-card-text style="height: 100px" class="font-weight-bold">
                  {{ item.description }}
                </v-card-text>
                <v-divider class="mx-4"></v-divider>

                <v-card-actions>
                  <v-btn color="white" text> Learn More </v-btn>
                </v-card-actions>
              </v-card>
            </router-link>
          </v-col>
        </template>

        <v-col
          v-if="listClass.length === 0"
          cols="12"
          sm="12"
          class="tab_wrapper py-0 mt-5"
        >
          <v-alert border="top" colored-border type="info" elevation="2">
            No classroom available!! Click Create button to create one !!
          </v-alert>
          <v-progress-linear
            color="deep-purple accent-4"
            indeterminate
            rounded
            height="6"
          ></v-progress-linear>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
const axios = require("axios");
const apiUrl = require("../../../apiUrl");
export default {
  components: {},
  data: () => ({
    listClass: [],
    bgColor: [
      { color: "#0306b9" },
      { color: "#f0bf12" },
      { color: "#dc2228" },
      { color: "#1DB014" },
      { color: "#00DCFF" },
      { color: "#da6665" },
      { color: "#34d491" },
    ],
    dialog: false,
    class_name: "",
    classId: "",
    color: "",
    description: "",
  }),
  mounted() {
    this.loadClass();
    document.body.style.background = this.color;
  },
  methods: {
    clear() {
      (this.class_name = ""), (this.description = ""), (this.color = "");
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
    onEditItem(item) {
      this.class_name = item.class_name;
      this.description = item.description;
      this.color = item.color;
      this.classId = item.uuid;
      this.dialog = true;
    },
    async deleteclass(item) {
      const index = this.listClass.indexOf(item);
      this.deletItems = item;
      const btnCancel = confirm("Are you sure you want to delete this item?");
      if (btnCancel === true) {
        this.listClass.splice(index, 1);
        await this.deleteClass();
      }
    },
    async deleteClass() {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          axios
            .delete(apiUrl.delete_class + "/" + this.deletItems.uuid, {})
            .then((response) => {
              window.console.log(response);
            })
            .catch((e) => {
              this.errors.push(e);
            });
        }, 200);
      });
    },
    async onSaveClose(isNew) {
      new Promise((resolve) => {
        setTimeout(() => {
          resolve("resolved");
          let strUrl = apiUrl.class_post;
          let method = "post";

          if (this.classId !== "") {
            strUrl = apiUrl.edit_class + "/" + this.classId;
            method = "put";
          }
          axios({
            method: method,
            url: strUrl,
            data: {
              class_name: this.class_name,
              color: this.color,
              description: this.description,
            },
          })
            .then((response) => {
              window.console.log(response);
              document.body.style.background = this.color;
              if (isNew) {
                (this.class_name = ""),
                  (this.color = ""),
                  (this.description = "");
              } else {
                this.dialog = false;
              }

              // this.isDisabled = false
              this.loadClass();
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