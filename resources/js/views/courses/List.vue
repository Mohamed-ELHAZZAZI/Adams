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
            placeholder="searchby teacher id"
            v-model="search.c_id"
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
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Course name</th>
                    <th scope="col" class="px-6 py-3">Teacher</th>
                    <th scope="col" class="px-6 py-3">Grade</th>
                    <th scope="col" class="px-6 py-3">Major</th>
                    <th scope="col" class="px-6 py-3">Academic level</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="course in classes"
                    :key="course.id"
                    class="odd:bg-white even:bg-gray-50 border-b"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                    >
                        {{ course.Name }}
                    </th>
                    <td class="px-6 py-4">
                        {{
                            course.teacher.First_name +
                            " " +
                            course.teacher.Last_name
                        }}
                    </td>
                    <td class="px-6 py-4">{{ course.Grade }}</td>
                    <td class="px-6 py-4">
                        {{ course.major.Name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ course.academic_level.Name }}
                    </td>
                    <td class="px-6 py-4">
                        <a
                            href="#"
                            class="font-medium text-blue-600 hover:underline"
                            >More</a
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import store from "../../store";
import SearchIcon from "../../components/icons/Search-icon.vue";

const classes = ref([]);
const search = ref({
    c_id: "",
    name: "",
    major: "",
});

onMounted(() => {
    store.dispatch("getCourses").then((res) => {
        classes.value = res.classes;
    });
});

const handleSearch = () => {};
</script>

<style></style>
