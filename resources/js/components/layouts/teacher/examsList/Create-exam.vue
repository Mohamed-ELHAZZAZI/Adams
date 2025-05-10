<template>
    <div
        class="fixed top-0 right-0 bottom-0 left-0 bg-black/20 flex items-center justify-center"
    >
        <div class="bg-white w-[900px] rounded-3xl shadow-xl p-5 px-7 relative">
            <div class="w-full h-10 flex justify-between items-center border-b">
                <span class="font-semibold"> Add Exam </span>
                <button @click.prevent="closeCreate">
                    <CloseIcon width="20" height="20" />
                </button>
            </div>
            <form
                @submit.prevent="handleSubmit"
                class="w-full grid grid-cols-2 gap-4 mt-6"
            >
                <ErrorComp
                    v-if="error"
                    :message="error"
                    class="col-span-full"
                    @clearError="error = null"
                />
                <label for="title" class="flex flex-col gap-2">
                    <span>Exam label:</span>
                    <input
                        type="text"
                        id="title"
                        v-model="info.label"
                        class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                    />
                </label>
                <label for="exam_date" class="flex flex-col gap-2">
                    <span>Exam date:</span>
                    <input
                        type="date"
                        v-model="info.exam_date"
                        :min="minDate"
                        id="exam_date"
                        class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                    />
                </label>
                <label for="start_time" class="flex flex-col gap-2">
                    <span>Start time:</span>
                    <input
                        type="time"
                        id="start_time"
                        v-model="info.start_time"
                        class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                    />
                </label>
                <label for="end_time" class="flex flex-col gap-2">
                    <span>End time:</span>
                    <input
                        type="time"
                        id="end_time"
                        v-model="info.end_time"
                        class="h-10 border border-gray-300 rounded px-2 outline-none focus:border-primaryColor"
                    />
                </label>

                <div class="col-span-full flex">
                    <button
                        type="submit"
                        class="bg-primaryColor hover:bg-primaryHover ml-auto text-white px-9 py-2 rounded-md"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";
import store from "../../../../store";
import CloseIcon from "../../../icons/Close-icon.vue";
import { isFieldNotEmpty } from "../../../../functions/Validators";
import ErrorComp from "../../Error-comp.vue";

const route = useRoute();
const course_id = route.params.id;

const props = defineProps(["course_id"]);
const emits = defineEmits(["closeCreate", "addSession"]);
const error = ref(null);
const today = new Date();
const minDate = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(
    2,
    "0"
)}-${String(today.getDate()).padStart(2, "0")}`;

const info = ref({
    exam_date: minDate,
    start_time: "",
    end_time: "",
    label: "Class on " + minDate,
    course_id,
});

const closeCreate = () => {
    emits("closeCreate");
};

const parseTimeToMinutes = (time) => {
    if (!time) return 0;
    const [hours, minutes] = time.split(":").map(Number);
    return hours * 60 + minutes;
};

const handleSubmit = () => {
    if (!isFieldNotEmpty(info.value)) {
        error.value = "Please select valid values for the fields.";
        return;
    }

    const selectedDate = new Date(info.value.exam_date);
    const currentTime = today.getHours() * 60 + today.getMinutes();
    const startMinutes = parseTimeToMinutes(info.value.start_time);

    if (
        selectedDate.toDateString() === today.toDateString() &&
        startMinutes <= currentTime
    ) {
        error.value = "Start time must be in the future.";
        return;
    }

    const endMinutes = parseTimeToMinutes(info.value.end_time);
    if (endMinutes <= startMinutes) {
        error.value = "End time must be greater than start time.";
        return;
    }

    error.value = null;
    store.dispatch("CreateExam", info.value).then((res) => {
        console.log(res);

        // if (res.success) {
        //     emits("addSession", res.classSession);
        //     closeCreate();
        // } else {
        //     error.value = "An error has accured, please try again";
        // }
    });
};
</script>

<style></style>
