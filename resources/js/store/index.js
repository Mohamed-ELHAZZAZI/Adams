import { createStore } from "vuex";
import axiosClient from "../axios";
const store = createStore({
    // strict: true,
    state: {
        user: {
            token: sessionStorage.getItem("TOKEN"),
            role: sessionStorage.getItem("ROLE"),
        },
    },
    getters: {},
    actions: {
        getMajors: ({ state }) => {
            return axiosClient.get("majors/get").then((res) => {
                return res.data;
            });
        },
        getCountries: ({ state }) => {
            return axiosClient.get("countries/get").then((res) => {
                return res.data;
            });
        },
        getLevels: ({ state }) => {
            return axiosClient.get("levels/get").then((res) => {
                return res.data;
            });
        },
        createStudent: ({ state }, data) => {
            return axiosClient.post("students/create", data).then((res) => {
                return res.data;
            });
        },
        getStudents: ({ state }) => {
            return axiosClient.get("students/get").then((res) => {
                return res.data;
            });
        },
        createTeacher: ({ state }, data) => {
            return axiosClient.post("teaches/create", data).then((res) => {
                return res.data;
            });
        },
        getTeachers: ({ state }) => {
            return axiosClient.get("teachers/get").then((res) => {
                return res.data;
            });
        },
        createCourse: ({ state }, info) => {
            return axiosClient.post("courses/create", info).then((res) => {
                return res.data;
            });
        },

        getCourses: ({ state }) => {
            return axiosClient.get("courses/get").then((res) => {
                return res.data;
            });
        },
        adminLogin: ({ state, commit }, info) => {
            return axiosClient.post("admins/auth/login", info).then((res) => {
                if (res.data.success) {
                    commit("setUser", res.data);
                }
                return res.data;
            });
        },
        getAdminData: ({ state, commit }) => {
            return axiosClient.get("/admin/data").then((res) => {
                if (res.data.success) {
                    commit("setUserInfo", res.data.info);
                }

                return res.data;
            });
        },
        adminLogout: ({ commit }) => {
            return axiosClient.post("admin/logout").then((res) => {
                commit("logout");
                return res;
            });
        },

        teacherLogin: ({ state, commit }, info) => {
            return axiosClient.post("teachers/auth/login", info).then((res) => {
                if (res.data.success) {
                    commit("setUser", res.data);
                }

                return res.data;
            });
        },

        getTeacherData: ({ state, commit }) => {
            return axiosClient.get("/teacher/data").then((res) => {
                if (res.data.success) {
                    commit("setUserInfo", res.data.info);
                }

                return res.data;
            });
        },
        teacherLogout: ({ commit }) => {
            return axiosClient.post("teacher/logout").then((res) => {
                commit("logout");
                return res;
            });
        },
        getTeacherCourses: ({ commit }) => {
            return axiosClient.get("teacher/get-classes").then((res) => {
                return res.data;
            });
        },
        getTClassInfo: ({ commit }, id) => {
            return axiosClient.get("teacher/get-class/" + id).then((res) => {
                return res.data;
            });
        },
        CreateClassSession: ({ commit }, data) => {
            return axiosClient
                .post("class-session/create", data)
                .then((res) => {
                    return res.data;
                });
        },
        getClassSessions: ({ commit }, course_id) => {
            return axiosClient
                .get("class-session/get/" + course_id)
                .then((res) => {
                    return res.data;
                });
        },
        getAttendance: ({ commit }, class_id) => {
            return axiosClient.get("attendance/get/" + class_id).then((res) => {
                return res.data;
            });
        },
        updateAttStatus: ({ commit }, data) => {
            return axiosClient.post("attendance/update", data).then((res) => {
                return res.data;
            });
        },
    },
    mutations: {
        setUser: (state, data) => {
            state.user.info = data.info;
            state.user.token = data.token;
            state.user.role = data.role;

            sessionStorage.setItem("TOKEN", data.token);
            sessionStorage.setItem("ROLE", data.role);
        },
        setUserInfo: (state, info) => {
            state.user.info = info;
        },

        logout: (state) => {
            state.user.info = {};
            state.user.token = null;
            state.user.role = null;
            sessionStorage.removeItem("TOKEN");
            sessionStorage.removeItem("ROLE");
        },
    },
    modules: {},
});

export default store;
