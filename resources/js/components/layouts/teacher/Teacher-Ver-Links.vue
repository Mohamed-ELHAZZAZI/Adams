<template>
    <ul class="flex flex-col w-full">
        <li class="w-full h-10">
            <div @click="handleActiveList('Classes')" class="parrentList">
                <ClassIcon width="20" height="20" fill="#fff" />
                Classes
                <ArrowIcon
                    width="25"
                    height="25"
                    class="ml-auto ease-in duration-100"
                    :class="activeList == 'Classes' ? '-rotate-180' : ''"
                />
            </div>
            <div
                class="w-full bg-primaryHover text-[15px]"
                v-if="activeList == 'Classes'"
            >
                <ul class="flex flex-col w-full">
                    <li class="w-full">
                        <router-link
                            :to="{ name: 'TeacherClasses' }"
                            class="subListLinks"
                        >
                            My classes</router-link
                        >
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</template>

<script setup>
import { ref } from "vue";

import ArrowIcon from "../../icons/Arrow-icon.vue";
import ClassIcon from "../../icons/Class-icon.vue";

const activeList = ref("students");

const handleActiveList = (name) => {
    return activeList.value == name
        ? (activeList.value = "")
        : (activeList.value = name);
};
</script>

<style scoped>
.parrentList {
    @apply h-10 flex gap-3 px-4 w-full items-center cursor-pointer;
}

.subListLinks {
    @apply flex gap-3 px-4 w-full h-11 items-center;
}

.subListLinks::before {
    content: "•";
    color: white;
    display: inline-block;
    font-size: 1.5rem;
    margin-top: 1.5px;
}
</style>
