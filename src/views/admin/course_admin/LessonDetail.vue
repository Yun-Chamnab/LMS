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

          <div>
            <span v-for="(p, i) in pic" :key="i">
              <v-dialog
                max-width="1000"
                v-model="dialog"
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
                  @click="
                    dialog = true;
                    changeFile(p.file_path);
                  "
                >
                  <v-avatar color="light-blue" size="40" class="mr-2 float-left"
                    ><i
                      class="fas fa-file-alt fa-sm text-center"
                      style="color: white; font-size: 1.3rem"
                    ></i
                  ></v-avatar>

                  <div v-if="p.file_path.length >= 33">
                    <div class="float-left" style="text-transform: capitalize">
                      {{ p.file_path.substring(33, 50) }}
                    </div>
                  </div>
                </v-btn>

                <iframe
                  id="iframe_id"
                  v-on="dialog"
                  :src="imgsrc_path + srcfile"
                  allowfullscreen
                  loading="lazy"
                  frameborder="0"
                  height="590"
                  overflow="hidden"
                  position="absolute"
                  contenteditable="true"
                ></iframe>
              </v-dialog>
            </span>
            <span v-for="(p, i) in items.videostore" :key="i">
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
                >
                  <span class="text-capitalize">{{
                    getYoutubeTitle(p.video_link.substring(30, 41))
                  }}</span>

                  <v-img
                    max-width="100"
                    max-height="80"
                    class="float-left mr-1 rounded-l"
                    contain
                    :src="
                      'https://img.youtube.com/vi/' +
                      p.video_link.substring(30, 41) +
                      '/hqdefault.jpg'
                    "
                  ></v-img>
                  <div class="" style="text-transform: capitalize">
                    {{ video.substring(0, 16) }}
                  </div>
                </v-btn>
                <iframe
                  height="350"
                  :src="p.video_link"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </v-dialog>
            </span>
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
export default {
  components: {},
  data: () => ({
    items: [],
    dialog: false,
    dialog1: false,
    selectedFile: null,
    imgsrc_path: apiUrl.file_path1,
    lesson: "",
    description: "",
    imagePath: "",
    video_link: "",
    download: false,
    ext: "",
    pic: "",
    file_path: "",
    vTitle: "",
    srcfile: "",
    video: "",
  }),
  async mounted() {
    await this.loadData();
    this.changeFile();
    // this.fetchVideoList();
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
    changeFile(file) {
      return (this.srcfile = file);
    },
    getYoutubeTitle(title) {
      let myApiKey = "AIzaSyCvSwNZRXPT9r8jXapH5pVTA_bdvPDcyPk";
      let url =
        "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" +
        title +
        "&key=" +
        myApiKey;
      // window.console.log(title);
      let strUrl = url;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.video = response.data.items[0].snippet.title;
          window.console.log(this.video);
        })
        .catch((error) => {
          window.console.log(error);
        });
      // window.console.log(url.items.snippet.title);
      // return url.items.snippet.title;
    },
  },
  computed: {},
};
</script>


<style scoped>
@media (max-width: 576px) {
}
</style>
