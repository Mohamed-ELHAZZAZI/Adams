<template>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Student ID</th>
                <th scope="col" class="px-6 py-3">Picture</th>
                <th scope="col" class="px-6 py-3">Fullname</th>
                <th scope="col" class="px-6 py-3">Gender</th>
                <th scope="col" class="px-6 py-3">Grade</th>
                <th scope="col" class="px-6 py-3">Major</th>
                <th scope="col" class="px-6 py-3">Academic level</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="student in students"
                :key="student.Student_id"
                class="odd:bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
            >
                <td class="px-6 py-4">
                    {{ student.Student_id }}
                </td>
                <td>
                    <img
                        :src="'../../../../storage/' + student.Picture"
                        alt=""
                        class="h-10 w-10 ml-8 rounded-md"
                    />
                </td>
                <td
                    scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                >
                    {{ student.First_name + " " + student.Last_name }}
                </td>
                <td class="px-6 py-4">
                    {{ student.Gender }}
                </td>
                <td class="px-6 py-4">
                    {{ student.Grade }}
                </td>
                <td class="px-6 py-4">
                    {{ student.major.Name }}
                </td>
                <td class="px-6 py-4">
                    {{ student.academic_level.Name }}
                </td>
                <td class="px-6 py-4">
                    <button
                        @click="displayinfoBox(student)"
                        class="text-gray-400 hover:underline hover:text-primaryHover px-1 font-semibold"
                    >
                        More
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <StudentsSideinfoBox
        :info="displayedInfo"
        v-if="displayedInfo"
        @closeInfoBox="closeInfoBox"
    />
</template>

<script setup>
import { ref } from "vue";
import StudentsSideinfoBox from "./Students-Side-Info-Box.vue";

const props = defineProps(["students"]);
const students = props.students;
const displayedInfo = ref(null);

const displayinfoBox = (val) => {
    displayedInfo.value = val;
};

const closeInfoBox = () => {
    displayedInfo.value = null;
};
</script>

<style></style>
