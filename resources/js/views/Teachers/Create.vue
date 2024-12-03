<template>
    <form @submit.prevent="handleSubmit" class="w-full grid grid-cols-3 gap-4">
        <span class="text-2xl mb-4">Create teacher</span>
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
        <div
            class="col-span-full h-32 flex items-center gap-4 max-[500px]:flex-col max-[500px]:h-auto"
        >
            <img
                :src="
                    previewImage
                        ? previewImage
                        : '../../../../storage/assets/imgs/user-place-holder.svg'
                "
                class="w-32 h-32 rounded-full"
            />
            <div class="flex gap-4 mt-auto">
                <label for="file" class="mt-auto">
                    <button
                        type="button"
                        @click.prevent="triggerInput('file')"
                        class="bg-primaryColor hover:bg-primaryHover border border-dark text-white rounded-md px-3 py-2 flex items-center justify-center gap-2"
                    >
                        <UploadIcon
                            height="15"
                            width="15"
                            fill="#fff"
                            class="mt-0.5"
                        />
                        Upload
                    </button>

                    <input
                        type="file"
                        name="file"
                        id="file"
                        class="hidden"
                        accept="image/*"
                        @change="handleFileChange"
                    />
                </label>
                <button
                    @click.prevent="(previewImage = null), (stdImage = null)"
                    class="border-dark hover:bg-[#f3f2f2] min-w-[100px] border bg-white text-dark rounded-md px-3 py-2 flex items-center justify-center gap-2 mt-auto"
                >
                    <CloseIcon
                        height="15"
                        width="15"
                        fill="#000"
                        class="mt-0.5"
                    />
                    Clear
                </button>
            </div>
        </div>
        <label for="first_name" class="flex flex-col gap-2">
            <span>First name:</span>
            <input
                type="text"
                id="first_name"
                placeholder="Enter first name"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="teacherInfo.first_name"
            />
        </label>
        <label for="first_name" class="flex flex-col gap-2">
            <span>Last name:</span>
            <input
                type="text"
                id="last_name"
                placeholder="Enter last name"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="teacherInfo.last_name"
            />
        </label>
        <label for="email" class="flex flex-col gap-2">
            <span>Email:</span>
            <input
                type="text"
                id="email"
                placeholder="Emter email"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="teacherInfo.email"
            />
        </label>
        <label for="birthday" class="flex flex-col gap-2">
            <span>Birthday:</span>
            <input
                type="date"
                id="birthday"
                class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                v-model="teacherInfo.birthday"
            />
        </label>

        <div class="relative">
            <label class="flex flex-col gap-2">
                <span>Gender:</span>
                <input
                    type="text"
                    v-model="teacherInfo.gender"
                    id="gender"
                    placeholder="Select a gender"
                    class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor cursor-pointer"
                    @click="handleDisplayBoxes('gender')"
                    readonly
                />
                <ArrowIcon
                    width="25"
                    height="25"
                    fill="#000"
                    class="absolute right-3 top-10 duration-100 ease-in"
                    :class="displayedBoxes.gender ? '-rotate-180' : ''"
                />
            </label>
            <transition name="box-fade">
                <div v-if="displayedBoxes.gender" class="boxes">
                    <span
                        @click="setStudentInfo('gender', 'Male')"
                        class="w-full h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >Male</span
                    >
                    <span
                        @click="setStudentInfo('gender', 'Female')"
                        class="w-full h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >Female</span
                    >
                </div>
            </transition>
        </div>
        <div class="relative">
            <label class="flex flex-col gap-2 relative">
                <span>Nationality:</span>
                <input
                    type="text"
                    v-model="teacherInfo.nationality"
                    id="nationality"
                    placeholder="select nationality"
                    class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor cursor-pointer"
                    @click="handleDisplayBoxes('nationality')"
                    readonly
                />
                <ArrowIcon
                    width="25"
                    height="25"
                    fill="#000"
                    class="absolute right-3 top-10 duration-100 ease-in"
                    :class="displayedBoxes.nationality ? '-rotate-180' : ''"
                />
            </label>
            <transition name="box-fade">
                <div class="boxes" v-if="displayedBoxes.nationality">
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
                            placeholder="Search country"
                            v-model="SearchCountry"
                            @keyup="CountryFilter"
                        />
                    </div>
                    <hr />
                    <span
                        v-for="country in filteredCountries"
                        :key="country.Name"
                        @click="setStudentInfo('nationality', country.Name)"
                        class="w-full min-h-10 px-4 flex items-center cursor-pointer hover:bg-[#eee]"
                        >{{ country.Name }}</span
                    >
                </div>
            </transition>
        </div>
        <div class="relative">
            <label class="flex flex-col gap-2 relative">
                <span>Major:</span>
                <input
                    type="text"
                    v-model="teacherInfo.major"
                    id="major"
                    placeholder="select a major"
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
                            @keyup="MajorFiltter"
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
import * as Validator from "../../functions/Validators";
import ErrorComp from "../../components/layouts/Error-comp.vue";
import SuccessComp from "../../components/layouts/Success-comp.vue";
import { convertToFormData } from "../../functions/Helpers";
import ArrowIcon from "../../components/icons/Arrow-icon.vue";
import CloseIcon from "../../components/icons/Close-icon.vue";
import UploadIcon from "../../components/icons/Upload-icon.vue";
import SearchIcon from "../../components/icons/Search-icon.vue";

const majors = ref([]);
const countries = ref([]);
const filteredMajors = ref([]);
const filteredCountries = ref([]);
const SearchMajor = ref(null);
const SearchCountry = ref(null);
const previewImage = ref(null);
const error = ref(null);
const successMsg = ref(null);
const teacherInfo = ref({
    first_name: "",
    last_name: "",
    email: "",
    birthday: "",
    gender: "",
    nationality: "",
    major: "",
});
const stdPictue = ref(null);

const displayedBoxes = ref({
    gender: false,
    major: false,
});

const handleDisplayBoxes = (name) => {
    displayedBoxes.value[name] = !displayedBoxes.value[name];
};

const setStudentInfo = (key, value) => {
    teacherInfo.value[key] = value;
    handleDisplayBoxes(key);
};

onBeforeMount(() => {
    store.dispatch("getMajors").then((res) => {
        majors.value = res;
        filteredMajors.value = res;
    });

    store.dispatch("getCountries").then((res) => {
        countries.value = res;
        filteredCountries.value = res;
    });
});

const MajorFiltter = () => {
    filteredMajors.value = majors.value.filter((major) =>
        major.Name.toLowerCase().includes(SearchMajor.value.toLowerCase())
    );
};

const CountryFilter = () => {
    filteredCountries.value = countries.value.filter((country) =>
        country.Name.toLowerCase().includes(SearchCountry.value.toLowerCase())
    );
};

const triggerInput = () => {
    const input = document.getElementById("file");
    input.click();
};

const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];

    if (selectedFile && Validator.isImageFile(selectedFile)) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.value = e.target.result;
        };
        reader.readAsDataURL(selectedFile);
        stdPictue.value = event.target.files[0];
    } else {
        error.value = "Please select a valid image file.";
        event.target.value = "";
    }
};

const clearError = () => {
    error.value = null;
};

const clearSuccess = () => {
    successMsg.value = null;
};

const validateForm = () => {
    error.value = null;

    const validationRules = [
        {
            condition: Validator.isFieldNotEmpty,
            message: "Please ensure all fields are filled out.",
        },
        {
            condition: Validator.isFullNameValid,
            field: "first_name",
            message: "Invalid full name. Please provide a valid full name.",
        },
        {
            condition: Validator.isFullNameValid,
            field: "last_name",
            message: "Invalid full name. Please provide a valid full name.",
        },
        {
            condition: Validator.isEmailValid,
            field: "email",
            message: "Invalid email address. Please enter a valid email.",
        },
        {
            condition: Validator.isDateValid,
            field: "birthday",
            message: "Invalid birthday date format. Please enter a valid date.",
        },
        {
            condition: Validator.isGenderValid,
            field: "gender",
            message: "Invalid gender. Please select a valid gender.",
        },
        {
            condition: Validator.isDataInObj,
            field: "nationality",
            meta: {
                key: "Name",
                obj: countries.value,
            },
            message: "Invalid nationality. Please select a valid nationality.",
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
                teacherInfo.value[rule.field],
                rule.meta.obj,
                rule.meta.key
            );
        } else {
            check = rule.condition(teacherInfo.value[rule.field]);
        }

        if (!check) {
            error.value = rule.message;
            return false;
        }
    }

    return true;
};

const handleSubmit = () => {
    if (!previewImage.value) {
        return (error.value = "Please choose an image for the student");
    }
    if (validateForm()) {
        const data = convertToFormData(teacherInfo.value);
        data.append("picture", stdPictue.value);
        store.dispatch("createTeacher", data).then((res) => {
            if (res.teacher) {
                successMsg.value = "teacher created successfuly!";
                resetValues();
            }
        });
    }
};

const resetValues = () => {
    error.value = "";
    teacherInfo.value = {
        first_name: "",
        last_name: "",
        email: "",
        birthday: "",
        gender: "",
        nationality: "",
        major: "",
    };
    stdPictue.value = null;
    previewImage.value = null;
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
