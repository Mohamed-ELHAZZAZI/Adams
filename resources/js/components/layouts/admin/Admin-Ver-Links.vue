<template>
    <ul class="flex flex-col w-full">
        <li class="w-full">
            <div @click="handleActiveList('Students')" class="parrentList">
                <StudentIcon width="20" height="20" fill="#fff" />
                Students
                <ArrowIcon
                    width="25"
                    height="25"
                    class="ml-auto ease-in duration-100"
                    :class="activeList == 'Students' ? '-rotate-180' : ''"
                />
            </div>
            <div
                class="w-full bg-primaryHover text-[15px]"
                v-if="activeList == 'Students'"
            >
                <ul class="flex flex-col w-full">
                    <li class="w-full">
                        <router-link
                            :to="{ name: 'CreateStudent' }"
                            class="subListLinks"
                        >
                            Create student</router-link
                        >
                        <router-link
                            :to="{ name: 'StudentList' }"
                            class="subListLinks"
                        >
                            Student list</router-link
                        >
                    </li>
                </ul>
            </div>
        </li>
        <li class="w-full">
            <div @click="handleActiveList('Teachers')" class="parrentList">
                <PersonIcon width="20" height="20" fill="#fff" />
                Teachers
                <ArrowIcon
                    width="25"
                    height="25"
                    class="ml-auto ease-in duration-100"
                    :class="activeList == 'Teachers' ? '-rotate-180' : ''"
                />
            </div>
            <div
                class="w-full bg-primaryHover text-[15px]"
                v-if="activeList == 'Teachers'"
            >
                <ul class="flex flex-col w-full">
                    <li class="w-full">
                        <router-link
                            :to="{ name: 'CreateTeacher' }"
                            class="subListLinks"
                        >
                            Create Teacher</router-link
                        >
                        <router-link
                            :to="{ name: 'TeacherList' }"
                            class="subListLinks"
                        >
                            Teachers list</router-link
                        >
                    </li>
                </ul>
            </div>
        </li>
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
                            :to="{ name: 'CreateCourse' }"
                            class="subListLinks"
                        >
                            Create Class</router-link
                        >
                        <router-link
                            :to="{ name: 'ClassList' }"
                            class="subListLinks"
                        >
                            Classes list</router-link
                        >
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</template>

<script setup>
import { ref } from "vue";

import StudentIcon from "../../icons/Student-icon.vue";
import ArrowIcon from "../../icons/Arrow-icon.vue";
import PersonIcon from "../../icons/Person-icon.vue";
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
