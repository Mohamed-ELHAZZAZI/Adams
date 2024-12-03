<template>
    <svg
        :width="svgWidth"
        :height="svgHeight"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
            :stroke="svgFill"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
    </svg>
</template>

<script setup>
import { ref, defineProps } from "vue";

const props = defineProps(["width", "height", "fill"]);

const svgWidth = ref(props.width ? props.width : 100);
const svgHeight = ref(props.height ? props.height : 100);
const svgFill = ref(props.fill ? props.fill : "#000000");
</script>

<style></style>
