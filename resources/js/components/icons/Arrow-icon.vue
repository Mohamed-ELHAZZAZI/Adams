<template>
    <svg
        :width="svgWidth"
        :height="svgHeight"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M7 10L12 15L17 10"
            :stroke="svgFill"
            stroke-width="1.5"
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
