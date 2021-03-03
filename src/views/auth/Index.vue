<template>
  <div id="app">
    <v-app id="inspire" class="custom_theme">
      <v-main>
        <router-view />
      </v-main>
    </v-app>
  </div>
</template>

<script>
export default {
  name: "index",
  data: () => ({}),
  props: {},
  methods: {},
  components: {},
  created() {
    // Initial Institute
    // instituteHandler.init()
  },
};
</script>