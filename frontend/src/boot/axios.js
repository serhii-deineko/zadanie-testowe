import { boot } from "quasar/wrappers";
import axios from "axios";

export default boot(({ app }) => {
    console.log(process.env.APP_API_URL);
    axios.defaults.baseURL = process.env.APP_API_URL;
    app.config.globalProperties.$axios = axios;
});
