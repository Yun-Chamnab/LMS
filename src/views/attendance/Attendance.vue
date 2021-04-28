<template>
  <v-app>
    <v-container>
      <p class="display-1 text-center">Exam History</p>
      <div v-for="(item, i) in items" :key="i">
        <v-hover v-slot:default="{ hover }" open-delay="30">
          <v-card
            max-width="600"
            class="mx-auto mt-6 rounded-lg"
            style="border: 1px solid grey !important"
            :elevation="hover ? 8 : 0"
            min-height="80"
          >
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="headline">
                  <h6>Quiz: {{ item.quiz.name }}</h6>
                </v-list-item-title>
                <v-list-item-subtitle class="black--text"
                  >Score:
                  <v-chip
                    class="ma-2"
                    :class="{ success: item.score === item.total_score }"
                  >
                    {{ item.score }}
                  </v-chip>
                  /
                  <v-chip class="ma-2" color="primary">
                    {{ item.total_score }}
                  </v-chip>
                </v-list-item-subtitle>

                <v-list-item-subtitle class="subtitle-2">
                  Submitted: {{ convertDateTime(item.created_at) }}
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-hover>
      </div>
    </v-container>
  </v-app>
</template>

<script>
const axios = require("axios");
const apiUrl = require("../../apiUrl");
import store from "@/store";
import moment from "moment";

export default {
  components: {},
  data: () => ({
    items: [],
  }),
  mounted() {
    this.loadData();
  },
  methods: {
    async loadData() {
      let loggedUser = store.getters.getLoggedUser;
      let userId = loggedUser.data.user.id;

      let strUrl = apiUrl.student_history + userId;
      let method = "get";
      axios({
        method: method,
        url: strUrl,
      })
        .then((response) => {
          this.items = response.data.data;
          window.console.log(this.items);
        })
        .catch((error) => {
          window.console.log(error);
        });
    },
    convertDateTime(value) {
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
