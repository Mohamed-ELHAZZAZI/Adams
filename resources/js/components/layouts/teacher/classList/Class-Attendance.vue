<template>
    <div
        class="fixed top-0 right-0 bottom-0 left-0 bg-black/20 flex items-center justify-center"
    >
        <div
            class="bg-white w-[1000px] max-h-[900px] rounded-3xl shadow-xl p-5 px-7 relative flex flex-col gap-5"
        >
            <div
                class="w-full h-10 mb-5 flex justify-between items-center border-b"
            >
                <span class="font-semibold"> Class Info </span>
                <button @click.prevent="closeAttendaceInfo">
                    <CloseIcon width="20" height="20" />
                </button>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex items-center justify-between">
                    <div class="grid grid-cols-[100px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Label:</span>
                        <span>{{ session.title }}</span>
                        <span class="font-semibold">Class Date:</span>
                        <span>{{ session.class_date }}</span>
                    </div>
                    <div class="grid grid-cols-[100px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Start time:</span>
                        <span>{{ session.start_time }}</span>
                        <span class="font-semibold">End Time:</span>
                        <span>{{ session.end_time }}</span>
                    </div>
                </div>
            </div>

            <div
                class="justify-between flex border-b-2 border-primaryColor pb-1"
            >
                <span>Attendance list</span>
            </div>
            <div class="">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-900 uppercase border-b-2">
                        <tr>
                            <th scope="col" class="px-6 py-3">Student id</th>
                            <th scope="col" class="px-6 py-3">Picture</th>
                            <th scope="col" class="px-6 py-3">Full name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Change status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="h-full">
                        <tr
                            v-for="(att, index) in attendance"
                            :key="att.id"
                            class="odd:bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            <td class="px-6 py-4">
                                {{ att.student.Student_id }}
                            </td>
                            <td class="px-6 py-4">
                                <img
                                    :src="
                                        '../../../../storage/' +
                                        att.student.Picture
                                    "
                                    alt=""
                                    class="h-10 w-10 rounded-md"
                                />
                            </td>
                            <td
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                            >
                                {{
                                    att.student.First_name +
                                    " " +
                                    att.student.Last_name
                                }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    :class="[
                                        statusClass(att.status),
                                        'p-2',
                                        'text-white',
                                        'rounded-md',
                                        'capitalize',
                                    ]"
                                >
                                    {{ att.status }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <ChangeStatus
                                    :att_id="att.id"
                                    :status="att.status"
                                    :index="index"
                                    @changeCurrentStatus="changeCurrentStatus"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import store from "../../../../store";
import CloseIcon from "../../../icons/Close-icon.vue";
import ChangeStatus from "./Change-Attendance-Status.vue";
const emits = defineEmits(["closeAttendaceInfo", "changeValue"]);
const props = defineProps(["session_info"]);
const session = props.session_info;
const attendance = ref([]);

const closeAttendaceInfo = () => {
    emits("closeAttendaceInfo");
};

const statusColors = {
    absent: "bg-red-500",
    late: "bg-yellow-500",
    excused: "bg-blue-500",
    default: "bg-green-700",
};

const statusClass = (status) => statusColors[status] || statusColors.default;

onMounted(() => {
    store.dispatch("getAttendance", session.id).then((res) => {
        attendance.value = res.attendance;
    });
});

const changeCurrentStatus = (index, status) => {
    let old_status = attendance.value[index]["status"];
    attendance.value[index]["status"] = status;
    emits("changeAttendance", old_status, index, status);
};
</script>

<style></style>
