<template>
    <nav
        class="w-full min-h-16 bg-primaryColor pl-20 pr-6 grid grid-cols-2 text-white"
    >
        <ul class="flex items-centerS h-full text-lg text-white">
            <li class="h-full flex items-center">
                <a class="navBar-links" href="#">首页</a>
            </li>
            <li><a class="navBar-links" href="#">培养</a></li>
            <li><a class="navBar-links" href="#">运行</a></li>
            <li><a class="navBar-links" href="#">学籍</a></li>
            <li><a class="navBar-links" href="#">成绩</a></li>
            <li><a class="navBar-links" href="#">质量</a></li>
            <li><a class="navBar-links" href="#">毕设</a></li>
            <li><a class="navBar-links" href="#">Panel</a></li>
        </ul>
        <div class="h-full w-full flex items-center gap-4">
            <div class="relative max-w-[200px] ml-auto">
                <SearchIcon
                    fill="#fff"
                    width="25"
                    height="25"
                    class="absolute top-1.5 left-2"
                />
                <input
                    type="text"
                    class="bg-primaryHover rounded-full h-9 outline-none pl-9 pr-4 w-full"
                />
            </div>
            <button class="bg-primaryHover p-2 rounded-full">
                <ThemeIcon width="20" height="20" fill="#fff" />
            </button>
            <div
                class="bg-primaryHover w-36 h-9 rounded-full flex items-center px-4"
            >
                学生
            </div>
            <div
                @click.prevent="displayUserBox = !displayUserBox"
                class="flex items-center gap-2 relative w-44 cursor-pointer"
            >
                <img
                    :src="'../../../../storage/' + userInfo?.Picture"
                    alt=""
                    class="w-8 h-8 rounded-full"
                />
                <div class="flex flex-col">
                    <span class="font-semibold text-xs">
                        {{
                            userInfo?.First_name + " " + userInfo?.Last_name
                        }}</span
                    >
                    <span class="text-xs capitalize">{{ userInfo?.role }}</span>
                </div>
                <ArrowIcon width="25" height="25" class="ml-auto" />
                <transition name="box-fade">
                    <div
                        v-if="displayUserBox"
                        class="bg-white w-full absolute top-[52px] z-50 text-black text-sm border shadow-2xl"
                    >
                        <ul>
                            <li class="h-10">
                                <a
                                    href=""
                                    class="w-full h-full flex items-center gap-2 px-2 hover:bg-[#eee]"
                                >
                                    <ProfileIcon
                                        fill="#000000"
                                        width="22"
                                        height="22"
                                    />
                                    Profile</a
                                >
                            </li>
                            <li class="h-10">
                                <button
                                    @click="logout"
                                    class="w-full h-full flex items-center gap-2 px-2 hover:bg-[#eee]"
                                >
                                    <LogoutIcon
                                        fill="#000000"
                                        width="22"
                                        height="22"
                                    />
                                    Logout
                                </button>
                            </li>
                        </ul>
                    </div>
                </transition>
            </div>
        </div>
    </nav>
</template>

<script setup>
import store from "../../store";
import { onBeforeMount, ref } from "vue";
import { useRouter } from "vue-router";

import ThemeIcon from "../icons/Theme-icon.vue";
import SearchIcon from "../icons/Search-icon.vue";
import ArrowIcon from "../icons/Arrow-icon.vue";
import ProfileIcon from "../icons/Profile-icon.vue";
import LogoutIcon from "../icons/Logout-icon.vue";

const router = useRouter();

const displayUserBox = ref(false);
const userInfo = ref(null);
const role = store.state.user.role;

onBeforeMount(() => {
    loadData();
});

const loadData = () => {
    const action = role === "admin" ? "getAdminData" : "getTeacherData";
    store.dispatch(action).then((res) => {
        userInfo.value = res.info;
    });
};

const logout = () => {
    const action = role === "admin" ? "adminLogout" : "teacherLogout";
    store.dispatch(action).then(() => {
        router.push({ name: "LoginPage" });
    });
};
</script>

<style scoped>
.navBar-links {
    @apply px-4 hover:bg-primaryHover h-full flex items-center;
}

nav {
    background-image: url("../../../../public/storage/assets/imgs/navBackground.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top;
}

.box-fade-enter-active {
    transition: all 0.3s ease;
}
.box-fade-enter-from {
    top: 62px;
    opacity: 0;
}
.box-fade-enter-to {
    top: 52px;
    opacity: 1;
}
</style>
