<template>
    <div
        @click.self="closeinfoBox"
        class="fixed right-0 top-0 bottom-0 left-0 bg-[#0000005e] flex justify-center items-center"
    >
        <div
            class="bg-white w-[1000px] h-[600px] rounded-3xl shadow-xl p-9 relative"
        >
            <div class="w-full h-full grid grid-cols-[300px,1fr] gap-5">
                <div class="flex flex-col items-center py-3 gap-3">
                    <div
                        class="flex items-center rounded-full h-[125px] w-[125px] overflow-hidden"
                    >
                        <img
                            :src="'../../../../storage/' + info.Picture"
                            alt=""
                        />
                    </div>
                    <span class="font-semibold"
                        >{{ info.First_name }} {{ info.Last_name }}</span
                    >
                    <div class="flex items-center mt-5">
                        <div
                            class="grid grid-cols-[100px,1fr] gap-4 text-sm ml-5 w-full"
                        >
                            <span class="font-semibold">Nationality:</span>
                            <span>{{ info.country.Nationality }}</span>
                            <span class="font-semibold">Gender:</span>
                            <span>{{ info.Gender }}</span>
                            <span class="font-semibold">Birthday:</span>
                            <span>{{ info.Birthday }}</span>
                            <span class="font-semibold">Student Id:</span>
                            <span>{{ info.Teacher_id }}</span>
                            <span class="font-semibold">Major:</span>
                            <span>{{ info.major.Name }}</span>
                            <hr class="col-span-full" />
                            <span class="font-semibold">Email:</span>
                            <span>{{ info.Email }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div>
                        <span class="text-sm">Teaching classes</span>
                        <div class="w-full h-0.5 bg-primaryColor"></div>
                        <div
                            v-if="!info.courses.length"
                            class="w-full h-full flex items-center justify-center"
                        >
                            <span class="text-center py-5"
                                >No teaching classes founded</span
                            >
                        </div>

                        <div
                            v-else
                            class="relative overflow-x-auto sm:rounded-lg pt-5"
                        >
                            <table
                                class="w-full text-sm text-left text-gray-500"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50"
                                >
                                    <tr>
                                        <th scope="col" class="py-3">Name</th>
                                        <th scope="col" class="py-3">
                                            students
                                        </th>
                                        <th scope="col" class="py-3">Grade</th>
                                        <th scope="col" class="py-3">Major</th>
                                        <th
                                            scope="col"
                                            class="py-3 text-ellipsis text-nowrap"
                                        >
                                            Academic level
                                        </th>
                                        <th scope="col" class="py-3">Action</th>
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
                                            class="py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ course.Name }}
                                        </th>
                                        <td class="py-4">
                                            {{ course.students.length }}
                                        </td>
                                        <td class="py-4">
                                            {{ course.Grade }}
                                        </td>
                                        <td class="py-4">
                                            {{ course.major.Short_name }}
                                        </td>
                                        <td class="py-4">
                                            {{ course.academic_level.Name }}
                                        </td>
                                        <td class="py-4">
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
                </div>
                <button
                    @click.prevent="closeinfoBox"
                    class="absolute right-5 top-5 p-1 rounded"
                >
                    <CloseIcon width="20" height="20" />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import CloseIcon from "../../icons/Close-icon.vue";

const emits = defineEmits(["closeinfoBox"]);
const props = defineProps(["teacher"]);
const isPassHidden = ref(true);
const info = props.teacher;

const closeinfoBox = () => {
    emits("closeinfoBox");
};
</script>

<style></style>
