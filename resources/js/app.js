import VueRouter from "vue-router";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { Form, HasError, AlertError } from "vform";
import Swal from "sweetalert2";
import moment from "moment";

require("./bootstrap");
var Chart = require("chart.js");
window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(IconsPlugin);
window.Form = Form;
window.Swal = Swal;
window.Chart = Chart;

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  onOpen: toast => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  }
});

const Fire = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: false
});

window.Toast = Toast;
window.Fire = Fire;

//Vue single components
Vue.component(
  "date-timepicker",
  require("./components/dateTimePicker.vue").default
);
Vue.component("login-form", require("./components/LoginForm.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.filter("capitalize", text => text.charAt(0).toUpperCase() + text.slice(1));

//Vue routes
let routes = [
  {
    path: "/dashboard",
    component: require("./components/Dashboard.vue").default
  },
  {
    path: "/management",
    component: require("./components/Management.vue").default
  },
  {
    path: "/calendar",
    component: require("./components/Calendar.vue").default
  },
  { path: "/admin", component: require("./components/Admin.vue").default },
  {
    path: "/attendance",
    component: require("./components/Attendance.vue").default
  },
  { path: "/student", component: require("./components/Student.vue").default },
  { path: "/teacher", component: require("./components/Teacher.vue").default },
  { path: "/module", component: require("./components/Module.vue").default },
  {
    path: "/department",
    component: require("./components/Department.vue").default
  },
  {
    path: "/filliere",
    component: require("./components/Filliere.vue").default
  },
  { path: "/element", component: require("./components/Element.vue").default },
  { path: "/profile", component: require("./components/Profile.vue").default }
];

const router = new VueRouter({
  mode: "history",
  routes
});

const app = new Vue({
  el: "#app",
  data() {
    return {
      currentComponent: this.$route.path
    };
  },
  router
});
