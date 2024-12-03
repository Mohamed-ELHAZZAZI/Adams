<template>
    <div class="max-h-96">
        <Pie :data="data" :options="options" />
    </div>
</template>
<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";
import { Pie } from "vue-chartjs";
const props = defineProps(["attendanceInfo"]);
const info = props.attendanceInfo;
console.table(info);
ChartJS.register(ArcElement, Tooltip, Legend);

const data = {
    labels: ["Present", "Late", "Excused", "Absent"],
    datasets: [
        {
            backgroundColor: ["#047857", "#eab308", "#3b82f6", "#ef4444"],
            data: [info.present, info.late, info.excused, info.absent],
        },
    ],
};

const options = {
    responsive: true,
    maintainAspectRatio: false,
};
</script>
