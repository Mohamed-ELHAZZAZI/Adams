<template>
    <div
        class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 relative"
        role="alert"
    >
        <svg
            aria-hidden="true"
            class="flex-shrink-0 inline w-5 h-5 mr-3"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"
            ></path>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">{{ props.message }}</span>
        </div>
        <button
            @click.prevent="clearError"
            type="button"
            class="absolute right-4 top-3 p-1 cursor-pointer"
        >
            <CloseIcon fill="#991b1b" width="20" height="20" />
        </button>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import CloseIcon from "../icons/Close-icon.vue";
const props = defineProps(["message"]);
const emits = defineEmits(["clearError"]);

const clearError = () => {
    emits("clearError");
};
</script>

<style></style>
