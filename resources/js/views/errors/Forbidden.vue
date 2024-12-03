<template>
    <div
        class="flex flex-col items-center justify-center w-screen h-screen gap-12 py-8 bg-white"
    >
        <ForbiddenIcon />
        <div class="flex flex-col items-center gap-4">
            <h1 class="text-3xl font-medium text-center">
                You are not authorized
            </h1>
            <p class="text-xl text-center">
                You tried to access a page you did not have prior authorization
                for.
            </p>
            <router-link
                :to="{ name: 'Home' }"
                class="bg-primaryColor text-white px-3 py-1 rounded hover:bg-primaryHover"
                >Back to Home</router-link
            >
        </div>
    </div>
</template>

<script setup>
import ForbiddenIcon from "../../components/icons/Forbidden-icon.vue";
</script>

<style></style>
