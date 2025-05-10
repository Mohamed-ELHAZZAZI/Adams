<template>
    <div class="w-full">
        <div class="justify-between flex border-b pb-3">
            <span class="font-semibold">Exams List</span>
            <button
                @click="dipslayCreate = true"
                class="bg-primaryColor flex gap-2 px-3 rounded py-1 text-white items-center"
            >
                <AddIcon height="20" width="20" />
                Add
            </button>
        </div>
        <table
            class="w-full text-sm text-left text-gray-500"
            v-if="exams.length"
        >
            <thead class="text-xs text-gray-900 uppercase border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-3">Exam Name</th>
                    <th scope="col" class="px-6 py-3">Exam Date</th>
                    <th scope="col" class="px-6 py-3">Start time</th>
                    <th scope="col" class="px-6 py-3">End time</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="exam in exams"
                    :key="exam.id"
                    class="odd:bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                >
                    <td class="px-6 py-4">{{ exam.name }}</td>
                    <td class="px-6 py-4">{{ exam.exam_date }}</td>
                    <td class="px-6 py-4">{{ formatTime(exam.start_time) }}</td>
                    <td class="px-6 py-4">{{ formatTime(exam.end_time) }}</td>
                    <td class="px-6 py-4">
                        <button
                            @click="exam_info = exam"
                            class="text-gray-400 hover:underline hover:text-primaryHover px-1 font-semibold"
                        >
                            More
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <ExamInfo
        v-if="exam_info"
        :exam_info="exam_info"
        @closeExamInfo="exam_info = null"
    />
    <CreateExam
        v-if="dipslayCreate"
        @closeCreate="dipslayCreate = false"
        @addExam="addExam"
    />
</template>

<script setup>
import { ref } from "vue";
import AddIcon from "../../../icons/Add-icon.vue";
import CreateExam from "./Create-exam.vue";
import { useRoute } from "vue-router";
import store from "../../../../store";
import { formatTime } from "../../../../functions/Helpers";
import ExamInfo from "./Exam-info.vue";
const route = useRoute();
const course_id = route.params.id;
const exams = ref([]);
const exam_info = ref(null);
store.dispatch("getExams", course_id).then((res) => {
    exams.value = res.exams;
});
const dipslayCreate = ref(false);

const addExam = (exam) => {
    exams.value.push(exam);
    sortArrayByDate();
};

const sortArrayByDate = () => {
    exams.value.sort((a, b) => {
        const dateComparison = new Date(a.exam_date) - new Date(b.exam_date);

        if (dateComparison !== 0) {
            return dateComparison;
        }

        return b.start_time.localeCompare(a.start_time);
    });
};
</script>

<style></style>
