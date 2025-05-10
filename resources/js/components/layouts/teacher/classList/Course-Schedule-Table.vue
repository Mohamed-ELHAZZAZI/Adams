<template>
    <div class="w-full">
        <div class="justify-between flex border-b pb-3">
            <span class="font-semibold">Classes schedule List</span>
            <button
                @click.prevent="dipslayCreate = true"
                class="bg-primaryColor flex gap-2 px-3 rounded py-1 text-white items-center"
            >
                <AddIcon height="20" width="20" />
                Add
            </button>
        </div>
        <SuccessComp
            v-if="displaySuccess"
            @clearSuccess="displaySuccess = false"
            class="my-4"
            message="Class time created successfuly"
        />
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-900 uppercase border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-3">Label</th>
                    <th scope="col" class="px-6 py-3">Class date</th>
                    <th scope="col" class="px-6 py-3">Start time</th>
                    <th scope="col" class="px-6 py-3">End time</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="C_Session in classSessions"
                    :key="C_Session.id"
                    class="odd:bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                >
                    <td class="px-6 py-4">{{ C_Session.title }}</td>
                    <td class="px-6 py-4">{{ C_Session.class_date }}</td>
                    <td class="px-6 py-4">
                        {{ formatTime(C_Session.start_time) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ formatTime(C_Session.end_time) }}
                    </td>
                    <td class="px-6 py-4">
                        <button
                            @click.prevent="handleSessionInfo(C_Session)"
                            class="text-gray-400 hover:underline hover:text-primaryHover px-1 font-semibold"
                        >
                            More
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <SessionInfo
        v-if="session_info"
        :session_info="session_info"
        @closeAttendaceInfo="session_info = null"
        @changeAttendance="updateAttendance"
    />
    <CreateClassSession
        v-if="dipslayCreate"
        @closeCreate="dipslayCreate = false"
        @addSession="addSession"
    />
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";
import CreateClassSession from "./Create-Class.vue";
import store from "../../../../store";
import AddIcon from "../../../icons/Add-icon.vue";
import SuccessComp from "../../Success-comp.vue";
import SessionInfo from "./Class-Attendance.vue";
import { formatTime } from "../../../../functions/Helpers";
defineProps(["updateAttendance"]);

const route = useRoute();
const course_id = route.params.id;
const displaySuccess = ref(null);
const classSessions = ref([]);
const session_info = ref(null);

store.dispatch("getClassSessions", course_id).then((res) => {
    classSessions.value = res;
    sortArrayByDate();
});

const dipslayCreate = ref(false);

const addSession = (session) => {
    displaySuccess.value = true;
    classSessions.value.unshift(session);
    sortArrayByDate();
};

const sortArrayByDate = () => {
    classSessions.value.sort((a, b) => {
        const dateComparison = new Date(b.class_date) - new Date(a.class_date);

        if (dateComparison !== 0) {
            return dateComparison;
        }

        return a.start_time.localeCompare(b.start_time);
    });
};

const handleSessionInfo = (id) => {
    session_info.value = id;
};
</script>

<style></style>
