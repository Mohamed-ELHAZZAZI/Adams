<template>
    <div
        @click.self="closeinfoBox"
        class="fixed right-0 top-0 bottom-0 left-0 bg-[#0000005e] flex justify-center items-center"
    >
        <div
            class="bg-white w-[1000px] h-[600px] rounded-3xl shadow-xl p-9 relative"
        >
            <div class="w-full h-60 grid grid-cols-[225px,1fr,1fr] gap-5">
                <div class="flex flex-col items-center py-3 gap-3">
                    <div
                        class="flex items-center rounded-full h-[125px] w-[125px] overflow-hidden"
                    >
                        <img
                            :src="'../../../../storage/' + student.Picture"
                            alt=""
                        />
                    </div>
                    <span class="font-semibold"
                        >{{ info.First_name }} {{ info.Last_name }}</span
                    >
                </div>
                <div class="flex items-center">
                    <div class="grid grid-cols-[100px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Nationality:</span>
                        <span>{{ info.country.Nationality }}</span>
                        <span class="font-semibold">Gender:</span>
                        <span>{{ info.Gender }}</span>
                        <span class="font-semibold">Email:</span>
                        <span>{{ info.Email }}</span>
                        <span class="font-semibold">Birthday:</span>
                        <span>{{ info.Birthday }}</span>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="grid grid-cols-[150px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Student Id:</span>
                        <span>{{ info.Student_id }}</span>
                        <span class="font-semibold">Grade:</span>
                        <span>{{ info.Grade }}</span>
                        <span class="font-semibold">Major:</span>
                        <span>{{ info.major.Name }}</span>
                        <span class="font-semibold">Academic level:</span>
                        <span>{{ info.academic_level.Name }}</span>
                    </div>
                </div>
            </div>
            <div>
                <span class="text-sm">Enrolled classes</span>
                <div class="w-full h-0.5 bg-primaryColor mb-2.5"></div>
                <div
                    class="w-full h-full flex items-center justify-center"
                    v-if="!info.courses.length"
                >
                    <span class="text-center py-5"
                        >No enrolled classes founded</span
                    >
                </div>

                <div v-else class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Course name
                                </th>
                                <th scope="col" class="px-6 py-3">Teacher</th>
                                <th scope="col" class="px-6 py-3">Grade</th>
                                <th scope="col" class="px-6 py-3">Major</th>
                                <th scope="col" class="px-6 py-3">
                                    Academic level
                                </th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="course in info.courses"
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
            </div>
            <button
                @click.prevent="closeinfoBox"
                class="absolute right-5 top-5 p-1 rounded"
            >
                <CloseIcon width="23" height="23" />
            </button>
        </div>
    </div>
</template>

<script setup>
import CloseIcon from "../../icons/Close-icon.vue";

const emits = defineEmits(["closeinfoBox"]);
const props = defineProps(["student"]);
const info = props.student;
const closeinfoBox = () => {
    emits("closeinfoBox");
};
</script>

<style scoped></style>
