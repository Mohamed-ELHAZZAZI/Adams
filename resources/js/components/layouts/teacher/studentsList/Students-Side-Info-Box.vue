<template>
    <div
        @click.self="closeInfoBox"
        class="fixed right-0 left-0 top-0 bottom-0 bg-black/20"
    >
        <div
            class="bg-white h-full w-[350px] flex flex-col gap-5 overflow-auto"
        >
            <div
                class="bg-gray-100 min-h-12 flex items-center justify-between px-3 border-b w-full"
            >
                <span class="font-semibold uppercase">Student Info</span>
                <button @click="closeInfoBox">
                    <CloseIcon width="25" height="25" />
                </button>
            </div>
            <div class="flex flex-col items-center gap-3">
                <img
                    :src="'../../../../storage/' + info.Picture"
                    alt=""
                    class="w-40 h-40 rounded-full"
                />

                <span class="capitalize font-semibold">{{
                    info.First_name + " " + info.Last_name
                }}</span>
                <div class="flex items-center mt-5">
                    <div
                        class="grid grid-cols-[100px,1fr] gap-4 text-sm ml-5 w-full"
                    >
                        <span class="font-semibold">Student id:</span>
                        <span>{{ info.Student_id }}</span>
                        <span class="font-semibold">Nationality:</span>
                        <span>{{ info.country.Nationality }}</span>
                        <span class="font-semibold">Gender:</span>
                        <span>{{ info.Gender }}</span>
                        <span class="font-semibold">Birthday:</span>
                        <span>{{ info.Birthday }}</span>
                        <span class="font-semibold">Major:</span>
                        <span>{{ info.major.Name }}</span>
                        <hr class="col-span-full" />
                        <span class="font-semibold">Email:</span>
                        <span>{{ info.Email }}</span>
                        <div class="col-span-full pt-5">
                            <span
                                class="text-lg font-[500] border-b-2 w-full flex border-b-primaryColor mb-3 col-span-full"
                                >Attendance summary</span
                            >
                            <AttendanceChartVue
                                :attendanceInfo="info.attendance_summary"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import CloseIcon from "../../../icons/Close-icon.vue";
import AttendanceChartVue from "./Attendance-Chart.vue";
const props = defineProps(["info"]);
const emits = defineEmits(["closeInfoBox"]);
const info = props.info;

const closeInfoBox = () => {
    emits("closeInfoBox");
};
</script>

<style></style>
