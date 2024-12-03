<template>
    <div class="flex justify-end w-screen h-screen text-sm">
        <form
            @submit.prevent="loginFun"
            class="w-[400px] max-h-max backdrop-blur-sm bg-white mt-32 mr-52 rounded-md flex flex-col gap-3 p-5"
        >
            <span class="text-2xl mx-auto">Login</span>
            <span class="col-span-full"> Login as: </span>
            <div class="flex w-full gap-2 justify-around">
                <div
                    @click.prevent="setLogAs('admin')"
                    :class="
                        loginAs == 'admin'
                            ? 'border-2 border-primaryColor'
                            : 'border-[#292D32]/20'
                    "
                    class="border h-20 w-32 rounded flex items-center justify-center flex-col gap-1 cursor-pointer"
                >
                    <svg
                        width="27px"
                        height="27px"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M20.91 11.12C20.91 16.01 17.36 20.59 12.51 21.93C12.18 22.02 11.82 22.02 11.49 21.93C6.63996 20.59 3.08997 16.01 3.08997 11.12V6.72997C3.08997 5.90997 3.70998 4.97998 4.47998 4.66998L10.05 2.39001C11.3 1.88001 12.71 1.88001 13.96 2.39001L19.53 4.66998C20.29 4.97998 20.92 5.90997 20.92 6.72997L20.91 11.12Z"
                            :stroke="loginAs == 'admin' ? '#165dff' : '#292D32'"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M12 12.5C13.1046 12.5 14 11.6046 14 10.5C14 9.39543 13.1046 8.5 12 8.5C10.8954 8.5 10 9.39543 10 10.5C10 11.6046 10.8954 12.5 12 12.5Z"
                            :stroke="loginAs == 'admin' ? '#165dff' : '#292D32'"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M12 12.5V15.5"
                            :stroke="loginAs == 'admin' ? '#165dff' : '#292D32'"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <span
                        :class="
                            loginAs == 'admin' ? 'text-primaryColor' : '#292D32'
                        "
                        >Admin</span
                    >
                </div>
                <div
                    @click.prevent="setLogAs('teacher')"
                    :class="
                        loginAs == 'teacher'
                            ? 'border-2 border-primaryColor '
                            : 'border-[#292D32]/20'
                    "
                    class="border h-20 w-32 rounded flex items-center justify-center flex-col gap-1 cursor-pointer"
                >
                    <svg
                        width="27px"
                        height="27px"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16.8311 15.6402C17.5011 15.2002 18.3811 15.6802 18.3811 16.4802V17.7702C18.3811 19.0402 17.3911 20.4002 16.2011 20.8002L13.0111 21.8602C12.4511 22.0502 11.5411 22.0502 10.9911 21.8602L7.80109 20.8002C6.60109 20.4002 5.62109 19.0402 5.62109 17.7702V16.4702C5.62109 15.6802 6.50109 15.2002 7.16109 15.6302L9.22109 16.9702C10.0111 17.5002 11.0111 17.7602 12.0111 17.7602C13.0111 17.7602 14.0111 17.5002 14.8011 16.9702L16.8311 15.6402Z"
                            :fill="loginAs == 'teacher' ? '#165dff' : '#292D32'"
                        />
                        <path
                            d="M19.9795 6.45859L13.9895 2.52859C12.9095 1.81859 11.1295 1.81859 10.0495 2.52859L4.02953 6.45859C2.09953 7.70859 2.09953 10.5386 4.02953 11.7986L5.62953 12.8386L10.0495 15.7186C11.1295 16.4286 12.9095 16.4286 13.9895 15.7186L18.3795 12.8386L19.7495 11.9386V14.9986C19.7495 15.4086 20.0895 15.7486 20.4995 15.7486C20.9095 15.7486 21.2495 15.4086 21.2495 14.9986V10.0786C21.6495 8.78859 21.2395 7.28859 19.9795 6.45859Z"
                            :fill="loginAs == 'teacher' ? '#165dff' : '#292D32'"
                        />
                    </svg>
                    <span
                        :class="loginAs == 'teacher' ? 'text-primaryColor' : ''"
                        >Teacher</span
                    >
                </div>
            </div>
            <ErrorComp v-if="error" :message="error" @clearError="clearError" />
            <div class="flex flex-col gap-1">
                <label>Email</label>
                <input
                    type="text"
                    class="outline-none p-2 rounded border border-b-2 border-transparent border-b-gray-300 focus:border-blue-500"
                    placeholder="Enter your email"
                    v-model="info.email"
                />
            </div>
            <div class="flex flex-col gap-1">
                <label>Password</label>
                <input
                    type="password"
                    class="outline-none p-2 rounded border border-b-2 border-transparent border-b-gray-300 focus:border-blue-500"
                    placeholder="Enter your password"
                    v-model="info.password"
                />
            </div>
            <button
                type="submit"
                class="bg-primaryColor hover:bg-primaryHover text-white px-9 py-3 rounded-md mt-5 text-base"
            >
                Login
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import store from "../../store";
import ErrorComp from "../../components/layouts/Error-comp.vue";
import { useRouter } from "vue-router";

const router = useRouter();
const loginAs = ref("admin");
const error = ref(null);
const setLogAs = (val) => {
    loginAs.value = val;
};

const info = ref({
    email: "",
    password: "",
});

const loginFun = () => {
    clearError();
    if (loginAs.value == "admin") {
        AdminLogin();
    } else if (loginAs.value == "teacher") {
        TeacherLogin();
    }
};

const TeacherLogin = () => {
    store.dispatch("teacherLogin", info.value).then((res) => {
        if (!res.success) {
            error.value = "Invalid credentials";
        } else {
            router.push({ name: "TeacherClasses" });
        }
    });
};

const AdminLogin = () => {
    store.dispatch("adminLogin", info.value).then((res) => {
        if (res.success) {
            router.push({ name: "Home" });
        } else {
            error.value = "Invalid credentials";
        }
    });
};
const clearError = () => (error.value = null);
</script>

<style>
body {
    background-size: cover;
    background-image: url("../../../../public/storage/assets/imgs/LoginBackground.jpg");
}
</style>
