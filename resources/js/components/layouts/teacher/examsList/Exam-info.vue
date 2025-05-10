resources/js/components/layouts/teacher/classList/Class-studentendance.vue
<template>
    <div
        class="fixed top-0 right-0 bottom-0 left-0 bg-black/20 flex items-center justify-center"
    >
        <div
            class="bg-white w-[1000px] max-h-[900px] rounded-3xl shadow-xl p-5 px-7 relative flex flex-col gap-5"
            id="exam-pdf-content"
        >
            <div
                class="w-full h-10 mb-5 flex justify-between items-center border-b"
            >
                <span class="font-semibold"> Exam info </span>
                <button @click="closeExamInfo" class="no-print">
                    <CloseIcon width="20" height="20" />
                </button>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex items-center justify-between">
                    <div class="grid grid-cols-[100px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Name:</span>
                        <span>{{ exam.name }}</span>
                        <span class="font-semibold">Exam Date:</span>
                        <span>{{ exam.exam_date }}</span>
                    </div>
                    <div class="grid grid-cols-[100px,1fr] gap-4 text-sm">
                        <span class="font-semibold">Start time:</span>
                        <span>{{ exam.start_time }}</span>
                        <span class="font-semibold">End Time:</span>
                        <span>{{ exam.end_time }}</span>
                    </div>
                </div>
            </div>

            <div
                class="justify-between flex border-b-2 border-primaryColor pb-1"
            >
                <span>Students list</span>
                <button
                    @click="downloadPDF"
                    class="bg-green-500 flex gap-2 px-3 rounded py-1 text-white items-center no-print"
                >
                    <DownloadIcon />
                </button>
            </div>
            <div class="">
                <ErrorComp
                    v-if="error"
                    :message="error"
                    class="col-span-full"
                    @clearError="error = null"
                />
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-900 uppercase border-b-2">
                        <tr>
                            <th scope="col" class="px-6 py-3">Student id</th>
                            <th scope="col" class="px-6 py-3">Picture</th>
                            <th scope="col" class="px-6 py-3">Full name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">current Grade</th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-center no-print"
                            >
                                new Grade
                            </th>
                        </tr>
                    </thead>
                    <tbody class="h-full">
                        <tr
                            v-for="(student, index) in exam.students"
                            :key="index"
                            class="odd:bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            <td class="px-6 py-4">
                                {{ student.info.Student_id }}
                            </td>
                            <td class="px-6 py-4">
                                <img
                                    :src="
                                        '../../../../storage/' +
                                        student.info.Picture
                                    "
                                    alt=""
                                    class="h-10 w-10 rounded-md"
                                />
                            </td>
                            <td
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                            >
                                {{
                                    student.info.First_name +
                                    " " +
                                    student.info.Last_name
                                }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    v-if="student.mark !== null"
                                    :class="getStatusClass(student.mark)"
                                    class="text-white px-2 py-1 rounded status"
                                >
                                    {{ getStatusLabel(student.mark) }}
                                </span>
                                <span
                                    v-else
                                    class="flex items-center justify-center text-gray-400"
                                >
                                    -
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="student.mark">
                                    {{ student.mark }}
                                </span>
                                <span
                                    class="flex items-center justify-center"
                                    v-else
                                >
                                    -
                                </span>
                            </td>
                            <td class="px-6 py-4 no-print">
                                <input
                                    type="number"
                                    class="border py-1 outline-none rounded max-w-16 px-1"
                                    v-model="student.new_mark"
                                />
                            </td>

                            <td class="px-6 py-4 no-print">
                                <button
                                    @click="updateMark(student)"
                                    class="bg-primaryColor flex gap-2 px-3 rounded py-1 text-white items-center"
                                >
                                    Update
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import store from "../../../../store";
import CloseIcon from "../../../icons/Close-icon.vue";
import ErrorComp from "../../Error-comp.vue";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import DownloadIcon from "../../../icons/Download-icon.vue";
const emits = defineEmits(["closeExamInfo", "changeValue"]);
const props = defineProps(["exam_info"]);
const exam = props.exam_info;
const studentendance = ref([]);
const error = ref(null);
const setToDownload = ref(false);
const closeExamInfo = () => {
    emits("closeExamInfo");
};

const getStatusLabel = (mark) => {
    if (mark >= 60) return "Passed";
    if (mark >= 40) return "Retake";
    return "Failed";
};

const getStatusClass = (mark) => {
    if (mark >= 60) return "bg-green-700";
    if (mark >= 40) return "bg-yellow-500";
    return "bg-red-500";
};

const changeCurrentStatus = (index, status) => {
    let old_status = studentendance.value[index]["status"];
    studentendance.value[index]["status"] = status;
    emits("changestudentendance", old_status, index, status);
};

const updateMark = async (student) => {
    error.value = null;

    const info = {
        exam_id: exam.id,
        student: student.info.id,
        new_grade: student.new_mark,
        mark_id: student.mark_id,
    };

    try {
        const res = await store.dispatch("setMark", info);

        student.mark = res.mark.grade;
        student.mark_id = res.mark.id;
        student.new_mark = null;
    } catch (err) {
        console.error(err);
        error.value = err.response?.data?.message || "Something went wrong.";
    }
};
const downloadPDF = async () => {
    try {
        setToDownload.value = true;

        const element = document.getElementById("exam-pdf-content");
        if (!element) {
            console.error("Element #exam-pdf-content not found.");
            return;
        }

        const noPrintElements = [...element.querySelectorAll(".no-print")];
        noPrintElements.forEach((el) => {
            el.dataset.originalDisplay = el.style.display;
            el.style.display = "none";
        });

        const statusElements = [...element.querySelectorAll(".status")];
        const originalPadding = statusElements.map(
            (el) => el.style.paddingBottom
        );
        statusElements.forEach((el) => {
            el.style.paddingBottom = "20px";
        });

        await document.fonts.ready;

        const canvas = await html2canvas(element, {
            scale: 2,
            useCORS: true,
        });

        const imgData = canvas.toDataURL("image/png");
        const pdf = new jsPDF("p", "mm", "a4");
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

        pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
        pdf.save("exam_info.pdf");

        // Restore original styles
        noPrintElements.forEach((el) => {
            el.style.display = el.dataset.originalDisplay || "";
        });
        statusElements.forEach((el, i) => {
            el.style.paddingBottom = originalPadding[i];
        });
    } catch (error) {
        console.error("PDF generation failed:", error);
    } finally {
        setToDownload.value = false;
    }
};
</script>

<style></style>
