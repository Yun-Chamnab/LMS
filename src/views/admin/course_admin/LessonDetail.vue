<template>
  <v-app>
    <v-container height="auto">
      <h2 class="text-lg" onclick="window.history.go(-1); return false;">
        {{ this.$route.params.title }}
      </h2>

      <v-card
        :elevation="0"
        class="mx-auto"
        max-width="700"
        color="transparent"
      >
        <v-card-text>
          <v-card-title>
            <h3 class="display-1 text--primary">
              <v-avatar color="light-blue" size="40" class="mr-2"
                ><i
                  class="far fa-file-alt fa-xs text-center"
                  style="color: white; font-size: 1.3rem"
                ></i
              ></v-avatar>
              <span class="light-blue--text"> {{ items.lesson }}</span>
            </h3>
            <v-layout align-end>
              <v-spacer></v-spacer>
              <h6>
                {{ convertDateTime(items.created_at) }}
              </h6>
            </v-layout>
          </v-card-title>

          <v-card-text>
            <hr class="light-blue mb-6" />
            <p>{{ items.description }}</p>
          </v-card-text>
          <!-- <v-card-text v-if="items.file_path !== 'null'">
            <span v-if="getFileExtension3(items.file_path)"> -->
          <!-- <span>
                <v-img max-width="200" :src="imgsrc + items.file_path"></v-img>
              </span> -->
          <!-- <span v-if="pic != null"> -->
          <div v-for="(p, i) in pic" :key="i">
            <v-dialog
              v-model="dialog"
              min-width="200"
              v-if="p.file_path != null"
            >
              <v-btn
                color="transparent"
                class="black--text mr-8 mb-8"
                width="250"
                min-height="80"
                dark
                style="text-transform: capitalize"
                slot="activator"
                @click="dialog = true"
              >
                <v-avatar color="light-blue" size="40" class="mr-2 float-left"
                  ><i
                    class="fas fa-file-alt fa-sm text-center"
                    style="color: white; font-size: 1.3rem"
                  ></i
                ></v-avatar>
                <!-- <label class="label" style="text-transform: capitalize">{{
                  p.file_path
                }}</label> -->
                <div v-if="p.file_path.length >= 33">
                  <div class="float-left" style="text-transform: capitalize">
                    {{ p.file_path.substring(33, 48) }}
                  </div>
                </div>
              </v-btn>
              <iframe
                v-on="dialog"
                :src="imgsrc_path + p.file_path"
                allowfullscreen
                loading="lazy"
                height="600"
              ></iframe>
            </v-dialog>

            <v-dialog
              v-model="dialog1"
              v-if="p.video_link != null"
              max-width="590"
            >
              <v-btn
                v-if="p.video_link"
                color="transparent"
                class="black--text mr-8 mb-8"
                width="250"
                min-height="80"
                dark
                slot="activator"
                @click="dialog1 = true"
                ><v-avatar color="light-blue" size="40" class="mr-2"
                  ><i
                    class="fas fa-video fa-sm text-center"
                    style="color: white; font-size: 1.3rem"
                  ></i
                ></v-avatar>
                <span class="text-capitalize">view video</span></v-btn
              >
              <iframe
                height="350"
                :src="p.video_link"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              ></iframe>
            </v-dialog>
          </div>
          <!-- </span> -->
          <!-- </v-card-text> -->
        </v-card-text>
      </v-card>
    </v-container>
  </v-app>
</template>
<script>
import axios from "axios";
const apiUrl = require("../../../apiUrl");
import moment from "moment";
// import pdf from "vue-pdf";
// import VuetifyPdf from "vuetify-pdfjs/src/App.vue";

export default {
  components: {},
  data: () => ({
    items: [],
    dialog: false,
    dialog1: false,
    selectedFile: null,
    imgsrc: "http://localhost/LMS-Class/LMS/Class_api/public/uploads/img/",
    imgsrc_path: "http://localhost/LMS-Class/LMS/Class_api/public/uploads/img/",
    lesson: "",
    description: "",
    imagePath: "",
    download: false,
    ext: "",
    pic: "",
  }),
  async mounted() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      let strUrl = apiUrl.lesson + this.$route.params.uuid;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.items = response.data.data[0];
          this.pic = response.data.data[0].filestore;
          window.console.log(this.pic, "response");
        })
        .catch((error) => {
          window.console.log(error);
        });
    },

    convertDateTime(value) {
      let dateTime = moment(value);
      let date = dateTime.format("DD MMM, hh:mma");
      return date;
    },

    downloadfile() {
      return (this.download = true);
    },
    getFileExtension3(filename) {
      this.ext = filename.slice(((filename.lastIndexOf(".") - 1) >>> 0) + 2);
      window.console.log(this.ext);
      return this.ext;
    },
  },
  computed: {},
};
</script>

<style scoped>
@media (max-width: 576px) {
}
</style>
