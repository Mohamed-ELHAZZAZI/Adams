<template>
    <div class="flex justify-center gap-3 relative" v-if="!isFormSubmited">
        <span
            @click="showOptions = !showOptions"
            class="min-w-24 py-1.5 rounded-md flex items-center pr-5 justify-center relative bg-gray-200 capitalize"
        >
            {{ newStatus }}
            <ArrowIcon
                width="25"
                height="25"
                fill="#000"
                class="absolute right-2"
            />
        </span>
        <div v-if="newStatus != '-'" class="flex items-center gap-3">
            <button class="cursor-pointer" @click="updateAttendanceStatus">
                <SaveIcon width="25" height="25" fill="#165dff" />
            </button>
            <button class="cursor-pointer" @click="newStatus = '-'">
                <CloseIcon width="18" height="18" fill="#ff0000" />
            </button>
        </div>
        <div
            class="absolute w-full max-w-32 border bg-white top-10 z-50 rounded-md shadow-md"
            v-if="showOptions"
        >
            <ul class="w-full">
                <li
                    v-for="stat in filteredStatusValues"
                    :key="stat"
                    @click="changeStatus(stat)"
                    class="w-full flex items-center h-10 px-3 hover:bg-gray-100 cursor-pointer capitalize"
                >
                    {{ stat }}
                </li>
            </ul>
        </div>
    </div>
    <div class="flex justify-center" v-else>
        <spinIcon fill="#165dff" width="25" height="25" class="animate-spin" />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import ArrowIcon from "../../../icons/Arrow-icon.vue";
import SaveIcon from "../../../icons/Save-icon.vue";
import CloseIcon from "../../../icons/Close-icon.vue";
import spinIcon from "../../../icons/Spin-icon.vue";
import store from "../../../../store";

const props = defineProps(["att_id", "status", "index"]);
const emits = defineEmits(["changeCurrentStatus"]);
const att_id = props.att_id;

const statusValues = ref(["absent", "excused", "late", "present"]);

const filteredStatusValues = computed(() =>
    statusValues.value.filter((q) => q !== props.status)
);

const showOptions = ref(false);
const isFormSubmited = ref(false);
const newStatus = ref("-");

const changeStatus = (newST) => {
    newStatus.value = newST;
    showOptions.value = false;
};

const updateAttendanceStatus = () => {
    isFormSubmited.value = true;
    let data = {
        att_id,
        status: newStatus.value,
    };
    store.dispatch("updateAttStatus", data).then((res) => {
        isFormSubmited.value = false;
        newStatus.value = "-";
        if (res.success) {
            emits("changeCurrentStatus", props.index, res.status);
        }
    });
};
</script>

<style></style>
