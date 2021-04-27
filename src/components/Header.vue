<template>
  <div class="">
    <div
      class="sidebar"
      v-on:mouseover="onMouseOver"
      v-on:mouseleave="onMouseLeave"
    >
      <v-navigation-drawer
        style="background-color: #0306b9"
        v-model="drawer"
        :mini-variant="miniVariant"
        :expand-on-hover="handOver"
        :mini-variant-width="60"
        :app="isApp"
        :fixed="isAbsolute"
        color=""
      >
        <v-list dense class="pa-0">
          <span class="hidden-sm-and-down">
            <a v-if="isAccountLogo" href="/" class="main_logo pl-7 pt-1">
              <h1 class="mb-0">
                <img
                  src="../assets/images/NIPTICT-Webiste-logo-1.png"
                  height="75"
                  alt="Niptict Logo"
                />
              </h1>
            </a>
            <a v-if="!isAccountLogo" href="/" class="">
              <h1 class="mb-0">
                <img
                  class="small_img fade-in"
                  src="../assets/images/NIPTICT-Webiste-logo-1.png"
                  height="25"
                  alt="Niptict Logo"
                />
              </h1>
            </a>
            <span
              v-bind:class="{
                angle_action_small: miniVariant,
                angle_action: !miniVariant,
              }"
            >
              <v-icon
                size="16"
                class="arr_icon"
                @click="hideSidebar"
                v-if="!miniVariant"
                >fa fa-chevron-circle-left</v-icon
              >
              <v-icon
                size="16"
                class="arr_icon"
                @click="hideSidebar"
                v-if="miniVariant"
                >fa fa-chevron-circle-right</v-icon
              >
            </span>
            <v-divider
              class="ma-2 mt-0"
              color="white"
              v-bind:class="{ devide_with: !miniVariant }"
            />
          </span>
          <div class="hidden-sm-and-up search_phone">
            <v-divider class="ma-2 mt-0" />
            <v-text-field
              style="margin-right: 10%; background-color: #fff"
              cols="6"
              flat
              solo-inverted
              hide-details
              prepend-inner-icon="search"
              label="Search"
              class="custom_search_phone"
            />
            <v-divider />
          </div>

          <div class="block_menu">
            <template v-for="item in items">
              <v-row v-if="item.heading" :key="item.heading" align="center">
                <v-col cols="6">
                  <v-subheader v-if="item.heading">{{
                    item.heading
                  }}</v-subheader>
                </v-col>
              </v-row>
              <v-list-group
                v-else-if="item.children"
                :key="item.id"
                v-model="item.path"
              >
                <template v-slot:activator>
                  <v-list-item-content>
                    <v-list-item-title>{{ item.text }}</v-list-item-title>
                  </v-list-item-content>
                </template>
              </v-list-group>
              <v-list-item
                v-else
                router
                :id="'id' + item.id"
                :to="item.path ? lang + item.path : ''"
                :class="item.class + ' ' + item.activeClass"
                :style="{ 'background-color': backHoverColor }"
                :key="item.id"
                @click.native="clickMe(item)"
              >
                <v-list-item-icon>
                  <v-icon v-text="item.icon"></v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>{{ $t(item.menuTex) }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
          </div>
        </v-list>
        <template v-slot:append>
          <div
            class="pl-6 link_buttom"
            v-bind:class="{ hide_item_samll: miniVariant }"
          >
            <v-list-item-title
              ><a target="_blank" href="https://niptict.edu.kh"
                >Support & learning Hub</a
              ></v-list-item-title
            >
          </div>
        </template>
      </v-navigation-drawer>
    </div>

    <v-app-bar
      app
      color="backgroundWhite"
      v-bind:class="{ sidebar_small: miniVariant }"
    >
      <div class="hidden-lg-and-up">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-spacer />
      </div>
      <h1 v-if="this.$route.meta.mainMenu" class="ml-2 hidden-sm-and-down">
        {{ $t(this.$route.meta.mainMenu) }}
      </h1>

      <v-spacer />

      <div class="hidden-sm-and-down header_icon">
        <v-menu bottom left>
          <v-list>
            <v-list-item
              v-for="(item, i) in historyPages"
              :key="i"
              class="history_link"
            >
              <v-list-item-title @click="onHistoryClick(item)">{{
                item.name
              }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>

        <v-btn icon @click="toggle">
          <i
            style="font-size: 18px"
            :class="[fullscreen ? 'b-mini' : 'b-full']"
          />
        </v-btn>
      </div>
      <v-menu left bottom>
        <template v-slot:activator="{ on }">
          <v-btn icon v-on="on">
            <v-avatar size="32px">
              <v-img src="../assets/images/user.jpg" alt="User"
            /></v-avatar>
          </v-btn>
        </template>
        <v-list>
          <v-list-item
            link
            style="min-height: 35px"
            @change="switchLocale('kh')"
          >
            <v-img
              src="/images/flags/kh.svg"
              class="mr-2"
              width="19"
              height="14"
            />
            <v-list-item-title>ភាសាខ្មែរ</v-list-item-title>
          </v-list-item>
          <v-list-item
            link
            style="min-height: 35px"
            @change="switchLocale('en')"
          >
            <v-img
              src="/images/flags/us.svg"
              class="mr-2"
              width="19"
              height="14"
            />
            <v-list-item-title>English</v-list-item-title>
          </v-list-item>
          <v-list-item link style="min-height: 35px" @click="logOut">
            <v-icon class="mr-1">mdi-logout</v-icon>
            <v-list-item-title>Log Out</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </div>
</template>

<script>
const store = require("../institute.js");
import { Trans } from "@/plugins/Translation";
import { i18n } from "../i18n";

export default {
  data: () => ({
    drawer: null,
    miniVariant: false,
    handOver: false,
    isApp: true,
    isAbsolute: false,
    isAccountLogo: true,
    backHoverColor: "",
    items: [
      {
        id: 1,
        class: "",
        icon: "mdi-view-dashboard",
        activeClass: "active",
        name: "Overview",
        menuTex: "overview",
        path: "/en",
      },
      // {
      //   id: 2,
      //   class: "",
      //   icon: "mdi-account-multiple",
      //   activeClass: "",
      //   name: "User",
      //   menuTex: "user",
      //   path: "/user",
      // },
      {
        id: 3,
        class: "",
        activeClass: "",
        icon: "mdi-cash-usd",
        name: "Exam",
        menuTex: "exam",
        path: "/exam",
      },
      {
        id: 4,
        class: "",
        activeClass: "",
        icon: "mdi-message-draw",
        name: "Course",
        menuTex: "course",
        path: "/course",
      },
      // {
      //   id: 5,
      //   class: "",
      //   activeClass: "",
      //   icon: "mdi-file-multiple",
      //   name: "Feedback",
      //   menuTex: "feedback",
      //   path: "/feedback",
      // },
      // {
      //   id: 6,
      //   class: "",
      //   activeClass: "",
      //   icon: "settings",
      //   name: "Attendance",
      //   menuTex: "attendance",
      //   path: "/attendance",
      // },
      { class: "ma-3 v-divider white" },
    ],
    previous_active_id: 1,
    fullscreen: false,
    pages: [],
  }),
  props: {
    source: String,
  },
  methods: {
    // History
    onHistoryClick(page) {
      if (page.name) {
        this.$router.push({ name: page.name });
      }
      this.items.forEach((element) => {
        element.activeClass = "";
      });
    },
    clickMe(data) {
      // alert(data.link)
      // this.$router.push(`${i18n.locale + data.path}`);
      // this.$router.push(`${data.link}`);
      //this.$event.target.classList.toggle(active)
      //eslint-disable-next-line no-console
      // console.log(i18n.locale + data.path)
      if (data.id == 1) {
        this.$router.push(`${i18n.locale}`);
      }

      // // eslint-disable-next-line no-console
      this.items.forEach((element) => {
        element.activeClass = "";
      });
      // this.items.find((item) => item.id === data.id).activeClass = "active"; //set active class to new li
      // this.previous_active_id = data.id; //store the new active li id
    },
    toggle() {
      this.$fullscreen.toggle(document.getElementsByTagName("body")[0], {
        wrap: false,
        callback: this.fullscreenChange,
      });
    },
    fullscreenChange(fullscreen) {
      this.fullscreen = fullscreen;
    },
    switchLocale(locale) {
      if (this.$i18n.locale !== locale) {
        const to = this.$router.resolve({ params: { locale } });
        return Trans.changeLocale(locale).then(() => {
          this.$router.push(to.location);
        });
      }
    },
    logOut() {
      this.$store.dispatch("logOut");
      this.$router.push({ name: "SignIn" });
    },
    hideSidebar() {
      this.miniVariant = !this.miniVariant;
      this.miniVariant ? (this.handOver = true) : (this.handOver = false);
      if (this.miniVariant) {
        this.isAbsolute = true;
        this.isAccountLogo = true;
        this.isApp = false;
      } else {
        this.isAbsolute = false;
        this.isAccountLogo = false;
        this.isApp = true;
      }
      this.isAccountLogo = true;
    },
    onMouseOver() {
      if (this.miniVariant) {
        this.isAccountLogo = true;
        this.backHoverColor = "";
      }
    },
    onMouseLeave: function () {
      if (this.miniVariant) {
        this.isAccountLogo = false;
        this.backHoverColor = "#0306b9 !important";
      }
    },
    setActiveSideNav() {
      let pathURL = window.location.pathname;
      //eslint-disable-next-line no-console
      if (pathURL == "/") {
        pathURL = "/en";
      }
      this.items.forEach((element) => {
        element.activeClass = "";
        let path = element.path;
        if (path == "/en") {
          path = "";
        }
        if ("/" + i18n.locale + path == pathURL) {
          element.activeClass = "active";
        }
        // if(element.children){
        // element.children.forEach(child => {
        // 	child.class=''
        // 	if('/'+i18n.locale+child.link ==  pathURL){
        // 		element.active = true
        // 		child.class =  'active'
        // 	}
        // });
        // }
      });
    },
  },
  components: {},
  computed: {
    // History Page
    historyPages: {
      set(historyPages) {
        store.commit("setHistoryPage", historyPages);
      },
      get() {
        return store.default.getters.getHistoryPages; //store.default.state.historyPages
      },
    },
    supportedLocales() {
      return Trans.supportedLocales;
    },
    currentRouteName() {
      return this.$route.name;
    },
    lang() {
      return "/" + i18n.locale;
    },
  },
  mounted() {
    this.setActiveSideNav();
  },
};
</script>
<style scoped>
/* .theme--light.v-input{
		background-color: transparent !important;
	} */
.v-application a {
  color: rgb(255, 255, 255) !important;
  text-decoration: none;
}
.v-application .link_buttom {
  margin-bottom: 10px;
}
h1.ml-2 a {
  text-decoration: none;
  color: #333;
}
.v-text-field.hidden-sm-and-down .v-input__control {
  background-color: #fff;
}
.v-app-bar--is-scrolled {
  -webkit-box-shadow: 0px 8px 15px -10px rgba(150, 150, 150, 0.25) !important;
  -moz-box-shadow: 0px 8px 15px -10px rgba(150, 150, 150, 0.25) !important;
  box-shadow: 0px 8px 15px -10px rgba(150, 150, 150, 0.25) !important;
}
.theme--light.v-text-field--solo-inverted .v-input__control .v-input__slot {
  background-color: #fff !important;
}
.line_right {
  border-right: 1px solid #ccc;
}
.theme--light.v-app-bar.v-toolbar.v-sheet {
  background-color: #edf1f5;
  border-bottom: 1px solid #fff;
}
.v-toolbar {
  box-shadow: none;
}
.main_logo {
  width: 100%;
  display: inline-block;
}
.main_logo .v-responsive.v-image {
  float: left;
  text-align: left;
  width: 100%;
  padding-left: 0;
}
.menu_right {
  float: right;
}
.block_menu .v-list-item__content > *,
.block_menu1 .v-list-item__content > * {
  color: #fff;
  font-size: 16px !important;
  font-weight: 700 !important;
  line-height: 35px !important;
  text-transform: uppercase;
  font-family: "Krasar-Bold", serif !important;
}
.block_menu1 .v-list-item__content > * {
  color: #2ca01c;
  text-transform: capitalize;
}

.v-list-item--dense .v-list-item__content,
.v-list--dense .v-list-item .v-list-item__content {
  padding: 0px 0 0 10px !important;
}

.v-list .v-list-item__icon i {
  color: #54667a;
}
.v-list .v-list-item--active .v-list-item__content .v-list-item__title {
  color: #2ca01c;
}
.v-list .v-list-item--active .v-list-item__title,
.v-list .v-list-item--active i,
.v-list .v-list-item--active .v-list-item__action i {
  color: #009efb;
}
.theme--light.v-app-bar.v-toolbar.v-sheet {
  border-bottom: none !important;
}
/* .header_i con .v-btn{ height: 35px !important; width: 35px !important; } */
.menuable__content__active[data-v-61dd7a3d] {
  top: 50px !important;
}
.v-list-item.theme--light.active {
  background-color: #edf1f5 !important;
}
.v-list-item.theme--light.active .v-list-item__title {
  color: #2ca01c !important;
}
.v-list .v-list-item--active {
  background-color: #edf1f5;
  color: #edf1f5 !important;
}
.sidebar_small {
  margin-left: 32px !important;
}
.angle_action {
  right: 0;
  z-index: 10;
  position: absolute;
  top: 50px;
}
.angle_action_small {
  right: 12px;
  z-index: 10;
  position: absolute;
  top: 52px;
}
.sidebar:hover .angle_action_small {
  right: 0px;
}
.angle_action .arr_icon {
  font-size: 16px;
  color: #dad5d5;
}
.sidebar:hover .angle_action .arr_icon {
  color: #4c9aff;
}
.sidebar:hover .angle_action_small .arr_icon {
  color: #4c9aff;
}
.small_img {
  margin: 9px 0;
  transition: 0.6s ease-in;
}
.hide_item_samll {
  display: none;
}
.sidebar:hover .hide_item_samll {
  display: block;
}
.devide_with {
  width: 90%;
}
.history_link {
  cursor: pointer;
}
.v-list-item--dense,
.v-list--dense .v-list-item.v-divider {
  min-height: 0 !important;
}
.v-list--dense .more-from-niptict .v-list-item__content .v-list-item__title {
  color: #fff !important;
  text-transform: capitalize !important;
  font-size: 16px;
  font-family: "Krasar-Regular", serif !important;
}
.v-list--dense .text-green .v-list-item__content .v-list-item__title {
  color: #2ca01c !important;
  text-transform: capitalize !important;
}
.block_menu a:nth-of-type(8) .v-list-item__content .v-list-item__title,
.block_menu a:nth-of-type(9) .v-list-item__content .v-list-item__title,
.block_menu a:nth-of-type(10) .v-list-item__content .v-list-item__title {
  color: #2ca01c !important;
  text-transform: capitalize !important;
}
@media (max-width: 576px) {
  .backgroundWhite >>> .v-toolbar__content {
    padding-left: 0;
  }
  .custom_search_phone {
    border: #d6d6d6 1px solid !important;
    border-radius: 9px;
  }
}
</style>