<template>
    <form
        action="#"
        @submit.prevent="handleSearch"
        class="w-full my-5 h-12 rounded grid grid-cols-[repeat(3,1fr)_150px] gap-4 max-[1250px]:h-28 max-[1250px]:grid-cols-2 max-[800px]:h-60 max-[800px]:grid-cols-1"
    >
        <input
            type="text"
            name="std-name"
            class="border rounded px-4 focus:outline-none focus:border-primaryColor"
            placeholder="search by teacher id"
            v-model="search.s_id"
            @keyup="handleSearch"
        />
        <input
            type="text"
            name="std-name"
            class="border rounded px-4 focus:outline-none focus:border-primaryColor"
            placeholder="search by name"
            v-model="search.name"
            @keyup="handleSearch"
        />
        <input
            type="text"
            name="std-name"
            class="border rounded px-4 focus:outline-none focus:border-primaryColor"
            placeholder="search by major"
            v-model="search.phone"
            @keyup="handleSearch"
        />
        <button
            type="submit"
            class="bg-primaryColor text-white rounded flex items-center justify-center gap-2"
        >
            <SearchIcon height="25" width="25" fill="#fff" />

            Search
        </button>
    </form>
    <div class="w-full grid min-[1700px]:grid-cols-3 grid-cols-2 gap-8">
        <div
            v-for="teacher in teachers"
            :key="teacher.id"
            class="w-full h-44 rounded-md shadow-md grid grid-cols-[125px,1fr] bg-[#faf8f8] items-center p-3 gap-4"
        >
            <div
                class="flex items-center rounded-full h-[125px] overflow-hidden"
            >
                <img :src="'../../../../storage/' + teacher.Picture" alt="" />
            </div>
            <div class="flex flex-col h-full pt-8 pb-3">
                <span class=""
                    >{{ teacher.First_name }} {{ teacher.Last_name }}</span
                >
                <span class="text-sm text-gray-800">{{
                    teacher.Teacher_id
                }}</span>
                <div class="mt-auto flex justify-between">
                    <span
                        class="text-sm text-gray-800 border border-[#302e2e] w-max py-1 px-2 rounded"
                        >2024 | cs</span
                    >
                    <button
                        @click="displayinfoBox(teacher)"
                        class="text-gray-400 hover:underline hover:text-primaryHover px-1 font-semibold"
                    >
                        More
                    </button>
                </div>
            </div>
        </div>
    </div>
    <TeacherInfoBox
        :teacher="infoTodisplay"
        v-if="displayBoxInfo"
        @closeinfoBox="closeinfoBox"
    />
</template>

<script setup>
import { onBeforeMount, ref } from "vue";
import SearchIcon from "../../components/icons/Search-icon.vue";
import TeacherInfoBox from "../../components/layouts/admin/Teacher-Info-Box.vue";
import store from "../../store";
const teachers = ref([]);
const search = ref({
    s_id: "",
    name: "",
    phone: "",
});
const displayBoxInfo = ref(false);
const infoTodisplay = ref(null);

const handleSearch = () => {};
onBeforeMount(() => {
    getTeachers();
});

const getTeachers = ($search = false) => {
    store.dispatch("getTeachers", search.value).then((res) => {
        teachers.value = res.teachers;
    });
};

const closeinfoBox = () => {
    displayBoxInfo.value = false;
};

const displayinfoBox = (teacher) => {
    infoTodisplay.value = teacher;
    displayBoxInfo.value = true;
};
</script>

<style scoped></style>
