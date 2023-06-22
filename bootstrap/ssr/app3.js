import "bootstrap";
import axios from "axios";
import "laravel-datatables-vite";
import { createApp } from "vue";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
require("sweetalert2");
const app = createApp({});
app.mount("#app");
