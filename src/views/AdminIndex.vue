<template>
  <div id="app">
    <v-app id="inspire" class="custom_theme">
      <AdminHeader />
      <router-view />
    </v-app>
  </div>
</template>

<script>
import AdminHeader from "../components/AdminHeader.vue";
export default {
  name: "Index",
  data: () => ({}),
  props: {},
  methods: {},
  components: {
    AdminHeader,
  },
  created() {},
};
</script>