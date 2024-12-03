<template>
    <svg
        :width="svgWidth"
        :height="svgHeight"
        viewBox="-0.5 0 25 25"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M3 21.32L21 3.32001"
            :stroke="svgFill"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
        <path
            d="M3 3.32001L21 21.32"
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
const svgFill = ref(props.fill ? props.fill : "#000000");
</script>

<style></style>
