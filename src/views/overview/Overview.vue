<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col
          sm="12"
          cols="12"
          style="background-color: #fff"
          class="ma-3 mt-4 pt-3 px-5"
        >
          <h2 class="text-uppercase mb-0" style="color: #0306b9">
            {{ $t("welcome_to_niptict_lms") }}
          </h2>
        </v-col>
      </v-row>
      <template>
        <v-carousel
          cycle
          height="350"
          hide-delimiter-background
          show-arrows-on-hover
        >
          <v-carousel-item
            v-for="(item, i) in items"
            :key="i"
            cycle
            reverse-transition="fade-transition"
            transition="fade-transition"
            :src="item.src"
          >
            <v-card
              class="mx-auto ml-16 mt-15"
              max-width="344"
              max-height="500"
              color="#0306b9"
            >
              <v-card-text class="headline font-weight-black">
                {{ item.txt }}</v-card-text
              >
              <v-card-actions>
                <v-btn depressed color="error"> Learn More > </v-btn>
              </v-card-actions>
            </v-card>
          </v-carousel-item>
        </v-carousel>
      </template>
      <v-row class="mansonry mt-6">
        <v-col cols="12" sm="3">
          <v-card class="mx-auto" max-width="344">
            <v-img
              src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://niptict.edu.kh/wp-content/uploads/2019/06/Bach1.png"
              height="200px"
            ></v-img>

            <v-card-title> Bachelor Programs </v-card-title>

            <v-card-subtitle>
              Acquire a comprehensive knowledge of the digital and
              entrepreneurship world.
            </v-card-subtitle>
            <v-card-actions>
              <v-btn text color="teal accent-4"> Learn More </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" sm="3">
          <v-card class="mx-auto" max-width="344">
            <v-img
              src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://niptict.edu.kh/wp-content/uploads/2019/06/Training1.png"
              height="200px"
            ></v-img>

            <v-card-title> Training </v-card-title>

            <v-card-subtitle>
              Expand your knowledge through our range of ICT courses
            </v-card-subtitle>
            <v-card-actions>
              <v-btn text color="teal accent-4"> Learn More </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" sm="3">
          <v-card class="mx-auto" max-width="344">
            <v-img
              src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://niptict.edu.kh/wp-content/uploads/2019/12/1-2.jpg"
              height="200px"
            ></v-img>

            <v-card-title> R&D </v-card-title>

            <v-card-subtitle>
              Work with us on research, development, design and engineering.
            </v-card-subtitle>
            <v-card-actions>
              <v-btn text color="teal accent-4"> Learn More </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" sm="3">
          <v-card class="mx-auto" max-width="344">
            <v-img
              src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://niptict.edu.kh/wp-content/uploads/2019/12/5-1.jpg"
              height="200px"
            ></v-img>

            <v-card-title> Entrepreneurship </v-card-title>

            <v-card-subtitle>
              Expand your connection through our range of tech & startup event
              program.
            </v-card-subtitle>
            <v-card-actions>
              <v-btn text color="teal accent-4"> Learn More </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

	

<script>
export default {
  components: {},
  data: () => ({
    items: [
      {
        src:
          "https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1800,h_600/https://niptict.edu.kh/wp-content/uploads/2020/06/feature3.jpg",
        txt: "Build up your digital skills",
      },
      {
        src:
          "https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1800,h_600/https://niptict.edu.kh/wp-content/uploads/2019/06/feature1.jpg",
        txt:
          "Learn the skills you require to stand out from the crowd in Digital Age",
      },
      {
        src:
          "https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1800,h_600/https://niptict.edu.kh/wp-content/uploads/2019/06/Slider2.png",
        txt:
          "Online learning is not the next big thing, it is the now big thing",
      },
      {
        src:
          "https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1800,h_600/https://niptict.edu.kh/wp-content/uploads/2020/06/feature3.jpg",
        txt:
          "Teaching in the Internet age means we must teach tomorrow’s skills today.",
      },
    ],
  }),
  mounted() {},
  computed: {},
};
</script>
<style scoped>
@media (max-width: 576px) {
}
</style>