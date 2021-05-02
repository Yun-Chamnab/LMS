import Vue from "vue";
import VueRouter from "vue-router";
import { Trans } from "@/plugins/Translation";
import store from "../store";
// const axios = require("axios");
import { i18n } from "../i18n";
// let historyPages 	= store.default.getters.getHistoryPages

function load(component) {
  // '@' is aliased to src/components
  return () => import(`@/views/${component}.vue`);
}
function loadAdmin(component) {
  // '@' is aliased to src/components
  return () => import(`@/views/admin/${component}.vue`);
}

Vue.use(VueRouter);

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch((err) => err);
};
const routes = [
  {
    path: "/:locale",
    beforeEnter: Trans.routeMiddleware,
    component: {
      template: "<keep-alive><router-view></router-view></keep-alive>",
    },
    children: [
      {
        path: "/",
        component: load("Index"),
        name: "Index",
        children: [
          {
            path: "",
            name: "Overview",
            component: load("overview/Overview"),
            meta: {
              mainMenu: "overview",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "user",
            name: "User",
            component: load("user/User"),
            meta: {
              mainMenu: "user",
              auth: true,
              adminAuth: false,
              studentAuth: true,
              guest: false,
            },
          },
          {
            path: "exam",
            name: "Exam",
            component: load("exam/Exam"),
            meta: {
              mainMenu: "Exam",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "lesson/quiz/:uuid&:duration",
            name: "Quiz",
            component: load("exam/TakeExam"),
            meta: {
              mainMenu: "exam",
            },
          },
          {
            path: "course",
            name: "Course",
            component: load("course/Course"),
            meta: {
              mainMenu: "Course",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "lesson/:uuid&:title&:teacher",
            name: "Lesson",
            component: load("course/Lesson"),
            meta: {
              mainMenu: "Course",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "lesson/detail/:uuid&:title",
            name: "Detail",
            component: load("course/LessonDetail"),
            meta: {
              mainMenu: "Course",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "feedback",
            name: "Feedback",
            component: load("feedback/Feedback"),
            meta: {
              mainMenu: "Feedback",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
          {
            path: "exam_history",
            name: "Attendance",
            component: load("attendance/Attendance"),
            meta: {
              mainMenu: "Exam History",
              auth: true,
              adminAuth: false,
              guest: false,
              studentAuth: true,
            },
          },
        ],
      },
      {
        path: "admin/",
        component: load("AdminIndex"),
        name: "Admin",
        children: [
          {
            path: "",
            name: "OverviewAdmin",
            component: loadAdmin("admin_overview/OverviewAdmin"),
            meta: {
              mainMenu: "OverviewAdmin",
              auth: true,
              adminAuth: true,
              guest: false,
              studentAuth: false,
            },
          },
          {
            path: "userservice",
            name: "UserService",
            component: loadAdmin("user_admin/UserManage"),
            meta: {
              mainMenu: "UserService",
              auth: true,
              guest: false,
              adminAuth: true,
              studentAuth: false,
            },
          },
          {
            path: "examservice",
            name: "ExamService",
            component: loadAdmin("exam_admin/ExamManage"),
            meta: {
              mainMenu: "ExamService",
              auth: true,
              guest: false,
              adminAuth: true,
              studentAuth: false,
            },
          },
          {
            path: "class/course/question/:uuid",
            name: "Dialogue",
            component: loadAdmin("exam_admin/DialogQuestion"),
            meta: {
              mainMenu: "ExamService",
              auth: true,
              guest: false,
              adminAuth: true,
              studentAuth: false,
            },
          },
          {
            path: "courseservice",
            name: "CourseService",
            component: loadAdmin("course_admin/CourseManage"),
            meta: {
              mainMenu: "CourseService",
              auth: true,
              adminAuth: true,
              guest: false,
              studentAuth: false,
            },
          },
          {
            path: "class/course/:uuid&:title&:teacher",
            name: "CourseDetail",
            component: loadAdmin("course_admin/CourseDetail"),
            meta: {
              mainMenu: "CourseService",
              auth: true,
              adminAuth: true,
              guest: false,
              studentAuth: false,
            },
          },
          {
            path: "class/:id",
            name: "InCourse",
            component: loadAdmin("course_admin/InCourse"),
            meta: {
              mainMenu: "CourseService",
              auth: true,
              guest: false,
              adminAuth: true,
              studentAuth: false,
            },
          },
          {
            path: "class/course/detail/:uuid&:title",
            name: "LessonDetail",
            component: loadAdmin("course_admin/LessonDetail"),
            meta: {
              mainMenu: "CourseService",
              auth: true,
              adminAuth: true,
              guest: false,
              studentAuth: false,
            },
          },
          {
            path: "feedbackservice",
            name: "FeedbackService",
            component: loadAdmin("feedback_admin/FeedbackManage"),
            meta: {
              mainMenu: "FeedbackService",
              auth: true,
              adminAuth: true,
              guest: false,
              studentAuth: false,
            },
          },
          {
            path: "attendanceservice",
            name: "AttendanceService",
            component: loadAdmin("attendance_admin/AttendanceManage"),
            meta: {
              mainMenu: "AttendanceService",
              auth: true,
              guest: false,
              adminAuth: true,
              studentAuth: false,
            },
          },
        ],
      },
      {
        path: "signin",
        component: load("auth/SignIn"),
        name: "SignIn",
        meta: {
          guest: true,
        },
      },
      {
        path: "signup",
        component: load("auth/SignUp"),
        name: "SignUp",
        meta: {
          guest: true,
        },
      },
    ],
  },
  {
    path: "*",
    redirect() {
      return Trans.defaultLocale;
    },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  // Redirect to route
  let redirectToRoute = function(name) {
    if (name === from.name) {
      next();
      return;
    }

    next({ name: name, params: { locale: i18n.locale } });
  };

  // Get logged user
  let loggedUser = store.getters.getLoggedUser;

  // Check if access token expired
  if (loggedUser) {
    // axios.interceptors.response.use(
    //   (response) => {
    //     return response;
    //   },
    //   function(error) {
    //     if (error.response.status === 401) {
    //       store.dispatch("logOut");
    //       return redirectToRoute("SignIn");
    //     }
    //     return Promise.reject(error.response);
    //   }
    // );
    // window.console.log("ex", test)
  }

  if (to.meta.auth) {
    if (!loggedUser || !loggedUser.data.token) {
      return redirectToRoute("SignIn");
    } else if (to.meta.adminAuth) {
      if (loggedUser.data.user.roleNames == "administrator") {
        next();
      } else {
        return redirectToRoute("Index");
      }
    } else if (to.meta.studentAuth) {
      if (loggedUser.data.user.roleNames == "student") {
        next();
      } else {
        return redirectToRoute("Admin");
      }
    } else {
      return next();
    }
  }

  // Guest
  if (to.meta.guest) {
    if (loggedUser)
      if (loggedUser.data.user.roleNames == "administrator") {
        return redirectToRoute("Admin");
      } else if (loggedUser.data.user.roleNames == "student") {
        return redirectToRoute("Index");
      } else return next();
  }

  next();
});

export default router;
