<template>
    <form @submit.prevent="handleSubmit" class="w-full grid grid-cols-3 gap-4">
        <span class="text-2xl mb-4 col-span-full">Create course</span>
        <ErrorComp
            v-if="error"
            :message="error"
            class="col-span-full"
            @clearError="clearError"
        />
        <SuccessComp
            v-if="successMsg"
            :message="successMsg"
            class="col-span-full"
            @clearSuccess="clearSuccess"
        />
        <label for="course_name" class="flex flex-col gap-2">
            <span>Course name:</span>
            <input
                type="text"
                id="course_name"
                placeholder="Course name"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="courseInfo.name"
            />
        </label>
        <label for="garde" class="flex flex-col gap-2">
            <span>Grade:</span>
            <input
                type="number"
                id="garde"
                placeholder="Course grade"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="courseInfo.grade"
            />
        </label>
        <div class="relative">
            <label class="flex flex-col gap-2 relative">
                <span>Major:</span>
                <input
                    type="text"
                    id="major"
                    placeholder="select a major"
                    v-model="courseInfo.major"
                    class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor cursor-pointer"
                    @click="handleDisplayBoxes('major')"
                    readonly
                />
                <ArrowIcon
                    width="25"
                    height="25"
                    fill="#000"
                    class="absolute right-3 top-10 duration-100 ease-in"
                    :class="displayedBoxes.major ? '-rotate-180' : ''"
                />
            </label>
            <transition name="box-fade">
                <div class="boxes" v-if="displayedBoxes.major">
                    <div
                        class="flex items-center gap-4 py-2 px-2 cursor-pointer relative text-sm text-light-dark"
                    >
                        <SearchIcon
                            width="22px"
                            height="22px"
                            class="absolute top-4 left-3 fill-light-dark pt-[2px]"
                        />
                        <input
                            type="text"
                            class="w-full h-10 px-2 pl-7 border border-gray-300 rounded focus:outline-none"
                            placeholder="Search major"
                            v-model="SearchMajor"
                            @keyup="MajorFilter"
                        />
                    </div>
                    <hr />
                    <span
                        v-for="major in filteredMajors"
                        :key="major.Name"
                        @click="setStudentInfo('major', major.Name)"
                        class="w-full min-h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >{{ major.Name }}</span
                    >
                </div>
            </transition>
        </div>
        <div class="relative">
            <label class="flex flex-col gap-2">
                <span>Academic level:</span>
                <input
                    type="text"
                    :value="courseInfo.ac_level"
                    id="ac_level"
                    placeholder="select an academic level"
                    class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor cursor-pointer"
                    @click="handleDisplayBoxes('ac_level')"
                    readonly
                />
                <ArrowIcon
                    width="25"
                    height="25"
                    fill="#000"
                    class="absolute right-3 top-10 duration-100 ease-in"
                    :class="displayedBoxes.ac_level ? '-rotate-180' : ''"
                />
            </label>
            <transition name="box-fade">
                <div v-if="displayedBoxes.ac_level" class="boxes">
                    <span
                        v-for="level in levels"
                        :key="level"
                        @click="setStudentInfo('ac_level', level.Name)"
                        class="w-full h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >{{ level.Name }}</span
                    >
                </div>
            </transition>
        </div>
        <div class="relative">
            <label class="flex flex-col gap-2 relative">
                <span>Teacher:</span>
                <input
                    type="text"
                    id="Teacher"
                    placeholder="select a teacher"
                    v-model="Teacher_pcd"
                    class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor cursor-pointer"
                    @click="handleDisplayBoxes('teacher')"
                    readonly
                />
                <ArrowIcon
                    width="25"
                    height="25"
                    fill="#000"
                    class="absolute right-3 top-10 duration-100 ease-in"
                    :class="displayedBoxes.teacher ? '-rotate-180' : ''"
                />
            </label>
            <transition name="box-fade">
                <div class="boxes" v-if="displayedBoxes.teacher">
                    <div
                        class="flex items-center gap-4 py-2 px-2 cursor-pointer relative text-sm text-light-dark"
                    >
                        <SearchIcon
                            width="22px"
                            height="22px"
                            class="absolute top-4 left-3 fill-light-dark pt-[2px]"
                        />
                        <input
                            type="text"
                            class="w-full h-10 px-2 pl-7 border border-gray-300 rounded focus:outline-none"
                            placeholder="Search major"
                            v-model="SearchTeacher"
                            @keyup="TeacherFilter"
                        />
                    </div>
                    <hr />
                    <span
                        v-for="teacher in filteredTeachers"
                        :key="teacher.Teacher_id"
                        @click="
                            setTeacherInfo(
                                teacher.Teacher_id,
                                teacher.First_name + ' ' + teacher.Last_name
                            )
                        "
                        class="w-full min-h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >{{ teacher.First_name }} {{ teacher.Last_name }}</span
                    >
                </div>
            </transition>
        </div>
        <div class="col-span-full flex">
            <button
                type="submit"
                class="bg-primaryColor hover:bg-primaryHover ml-auto text-white px-9 py-2 rounded-md"
            >
                Save
            </button>
        </div>
    </form>
</template>

<script setup>
import { onBeforeMount, ref } from "vue";
import store from "../../store";
import SearchIcon from "../../components/icons/Search-icon.vue";
import ArrowIcon from "../../components/icons/Arrow-icon.vue";
import * as Validator from "../../functions/Validators";

import ErrorComp from "../../components/layouts/Error-comp.vue";
import SuccessComp from "../../components/layouts/Success-comp.vue";

const error = ref(null);
const successMsg = ref(null);
const filteredMajors = ref([]);
const SearchMajor = ref(null);
const majors = ref([]);
const levels = ref([]);
const teachers = ref([]);
const filteredTeachers = ref([]);
const SearchTeacher = ref([]);
const displayedBoxes = ref({
    major: false,
    ac_level: false,
    teacher: false,
});
const courseInfo = ref({
    name: "",
    grade: "",
    major: "",
    ac_level: "",
    teacher: "",
});
const Teacher_pcd = ref(null);

const clearSuccess = () => {
    successMsg.value = null;
};

const clearError = () => {
    error.value = null;
};

onBeforeMount(() => {
    store.dispatch("getMajors").then((res) => {
        majors.value = res;
        filteredMajors.value = res;
    });

    store.dispatch("getLevels").then((res) => {
        levels.value = res;
    });

    store.dispatch("getTeachers").then((res) => {
        teachers.value = res.teachers;
        filteredTeachers.value = res.teachers;
    });
});

const MajorFilter = () => {
    filteredMajors.value = majors.value.filter((major) =>
        major.Name.toLowerCase().includes(SearchMajor.value.toLowerCase())
    );
};

const TeacherFilter = () => {
    filteredTeachers.value = teachers.value.filter((teacher) => {
        let full_name = teacher.First_name + " " + teacher.Last_name;
        return full_name
            .toLowerCase()
            .includes(SearchTeacher.value.toLowerCase());
    });
};

const setStudentInfo = (key, value) => {
    courseInfo.value[key] = value;
    handleDisplayBoxes(key);
};

const setTeacherInfo = (id, name) => {
    courseInfo.value.teacher = id;
    Teacher_pcd.value = name;
    handleDisplayBoxes("teacher");
};

const handleDisplayBoxes = (name) => {
    displayedBoxes.value[name] = !displayedBoxes.value[name];
};
const validateForm = () => {
    error.value = null;

    const validationRules = [
        {
            condition: Validator.isFullNameValid,
            field: "name",
            message: "Invalid course name. Please provide a valid course name.",
        },
        {
            condition: Validator.isNumberValid,
            field: "grade",
            message: "Invalid grade. Please select a valid grade.",
        },
        {
            condition: Validator.isDataInObj,
            field: "major",
            meta: {
                key: "Name",
                obj: majors.value,
            },
            message: "Invalid major. Please select a valid major.",
        },
    ];

    for (const rule of validationRules) {
        let check = false;

        if (rule.meta) {
            check = rule.condition(
                courseInfo.value[rule.field],
                rule.meta.obj,
                rule.meta.key
            );
        } else {
            check = rule.condition(courseInfo.value[rule.field]);
        }

        if (!check) {
            error.value = rule.message;
            return false;
        }
    }

    return true;
};

const handleSubmit = () => {
    successMsg.value = null;
    if (validateForm()) {
        store.dispatch("createCourse", courseInfo.value).then((res) => {
            if (res.success) {
                successMsg.value = "Course created successfuly.";
            }
            resetValues();
        });
    }
};

const resetValues = () => {
    courseInfo.value = {
        name: "",
        grade: "",
        major: "",
    };
};
</script>

<style scoped>
.boxes {
    @apply absolute right-0 left-0 top-20 h-auto bg-white border shadow-lg rounded flex flex-col overflow-hidden max-h-52 overflow-y-auto z-30;
}

.box-fade-enter-active {
    transition: all 0.3s ease;
}
.box-fade-enter-from {
    top: 90px;
    opacity: 0;
}
.box-fade-enter-to {
    top: 80px;
    opacity: 1;
}
</style>
