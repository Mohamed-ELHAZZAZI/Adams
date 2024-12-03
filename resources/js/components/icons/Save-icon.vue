<template>
    <svg
        :width="svgWidth"
        :height="svgHeight"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M4 12.6111L8.92308 17.5L20 6.5"
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
const svgFill = ref(props.fill ? props.fill : "#fff");
</script>

<style></style>
