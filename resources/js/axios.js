import axios from "axios";
import store from "./store";
import { useRouter } from "vue-router";

const axiosClient = axios.create({
    baseURL: "http://localhost:8000/api",
});

axiosClient.interceptors.request.use((config) => {
    config.headers.Authorization = `Bearer ${store.state.user.token}`;
    return config;
});

axiosClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 403) {
            console.log("403 error detected");
            window.location.href = "/forbidden";
        }

        return Promise.reject(error);
    }
);

export default axiosClient;
