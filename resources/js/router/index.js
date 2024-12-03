import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

import Dashboard from "../views/Dashboard.vue";

import CreateStudent from "../views/students/Create.vue";
import StudentList from "../views/students/List.vue";

import CreateTeacher from "../views/Teachers/Create.vue";
import TeacherList from "../views/Teachers/List.vue";
import TeacherClasses from "../views/Teachers/Classes.vue";
import TClasseInfo from "../views/Teachers/ClassInfo.vue";

import CreateCourse from "../views/courses/Create.vue";
import ClassList from "../views/courses/List.vue";

import Login from "../views/auth/login.vue";

import Forbidden from "../views/errors/Forbidden.vue";

const routes = [
    {
        path: "/home",
        redirect: "/",
        component: Dashboard,
        children: [
            {
                path: "/",
                name: "Home",
                redirect: "/students/list",
            },

            {
                path: "/students/create",
                component: CreateStudent,
                name: "CreateStudent",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/students/list",
                component: StudentList,
                name: "StudentList",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/teachers/create",
                component: CreateTeacher,
                name: "CreateTeacher",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/teachers/list",
                component: TeacherList,
                name: "TeacherList",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/courses/create",
                component: CreateCourse,
                name: "CreateCourse",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/courses/list",
                component: ClassList,
                name: "ClassList",
                meta: {
                    RequiresAuth: true,
                    Access: "admin",
                },
            },
            {
                path: "/teacher/courses",
                component: TeacherClasses,
                name: "TeacherClasses",
                meta: {
                    RequiresAuth: true,
                    Access: "teacher",
                },
            },
            {
                path: "/teacher/courses/:id",
                component: TClasseInfo,
                name: "TClasseInfo",
                props: true,
                meta: {
                    RequiresAuth: true,
                    Access: "teacher",
                },
            },
        ],
    },
    {
        path: "/login",
        component: Login,
        name: "LoginPage",
        meta: {
            RequiresGuess: true,
        },
    },
    {
        path: "/forbidden",
        name: "Forbidden",
        component: Forbidden,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.RequiresGuess && store.state.user.token) {
        next({ name: "Home" });
    } else if (to.meta.RequiresAuth && !store.state.user.token) {
        next({ name: "LoginPage" });
    }
    if (to.meta.Access && to.meta.Access != store.state.user.role) {
        next({ name: "Forbidden" });
    } else {
        next();
    }
});

export default router;
