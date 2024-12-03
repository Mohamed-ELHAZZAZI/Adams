<template>
    <div class="w-full h-full bg-primaryColor flex rounded-3xl py-4 text-white">
        <AdminLinks v-if="role == 'admin'" />
        <TeacherLinks v-else-if="role == 'teacher'" />
    </div>
</template>

<script setup>
import AdminLinks from "./admin/Admin-Ver-Links.vue";
import TeacherLinks from "./teacher/Teacher-Ver-Links.vue";
import store from "../../store";

const role = store.state.user.role;
</script>

<style scoped></style>
