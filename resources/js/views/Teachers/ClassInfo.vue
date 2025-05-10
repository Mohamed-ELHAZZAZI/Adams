<template>
    <div class="w-full flex flex-col gap-6">
        <div
            class="w-full h-12 grid grid-cols-3 rounded-md overflow-hidden border-b text-gray-700 uppercase bg-gray-50 shadow-md"
        >
            <div
                @click="handleTab('schedule')"
                :class="{
                    'bg-primaryColor text-white': activeTab == 'schedule',
                }"
                class="flex items-center justify-center cursor-pointer"
            >
                classes list
            </div>
            <div
                @click="handleTab('sdtList')"
                :class="{
                    'bg-primaryColor text-white': activeTab == 'sdtList',
                }"
                class="flex items-center justify-center cursor-pointer"
            >
                Students list ({{ students?.length }})
            </div>
            <div
                @click="handleTab('examList')"
                :class="{
                    'bg-primaryColor text-white': activeTab == 'examList',
                }"
                class="flex items-center justify-center cursor-pointer"
            >
                Exams
            </div>
        </div>
        <div v-if="activeTab == 'sdtList'" class="overflow-x-auto">
            <StudentsTable :students="students" />
        </div>

        <div v-if="activeTab == 'schedule'">
            <ScheduleTable :updateAttendance="updateAttendance" />
        </div>

        <div v-if="activeTab == 'examList'">
            <ExamsTable />
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import store from "../../store";
import StudentsTable from "../../components/layouts/teacher/studentsList/Students-Table.vue";
import ScheduleTable from "../../components/layouts/teacher/classList/Course-Schedule-Table.vue";
import ExamsTable from "../../components/layouts/teacher/examsList/ExamsTable.vue";
const props = defineProps(["id"]);
const id = props.id;
const activeTab = ref("schedule");

const students = ref(null);
onMounted(() => {
    store.dispatch("getTClassInfo", id).then((res) => {
        students.value = res.students;
        console.log(students.value);
    });
});
const handleTab = (val) => {
    activeTab.value = val;
};

const updateAttendance = (old_status, index, new_status) => {
    students.value[index]["attendance_summary"][old_status]--;
    students.value[index]["attendance_summary"][new_status]++;
};
</script>

<style></style>
