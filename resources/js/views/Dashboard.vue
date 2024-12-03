<template>
    <div class="h-screen w-screen flex flex-col bg-[#eee] overflow-auto">
        <HorizontalNav class="col-span-full" />
        <div class="grid grid-cols-[220px,1fr] h-full gap-4 mx-4 my-8">
            <VerticalNav />
            <div class="w-full rounded-3xl p-6 px-7 bg-white relative">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script setup>
import HorizontalNav from "../components/layouts/Horizontal-nav.vue";
import VerticalNav from "../components/layouts/Vertical-nav.vue";
</script>

<style></style>
