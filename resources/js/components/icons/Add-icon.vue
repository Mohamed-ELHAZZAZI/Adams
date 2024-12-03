<template>
    <svg
        :width="svgWidth"
        :height="svgHeight"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
    >
        <g id="Complete">
            <g data-name="add" id="add-2">
                <g>
                    <line
                        fill="none"
                        :stroke="svgFill"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        x1="12"
                        x2="12"
                        y1="19"
                        y2="5"
                    />

                    <line
                        fill="none"
                        :stroke="svgFill"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        x1="5"
                        x2="19"
                        y1="12"
                        y2="12"
                    />
                </g>
            </g>
        </g>
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
