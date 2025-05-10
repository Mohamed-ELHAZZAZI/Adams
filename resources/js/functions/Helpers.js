export const convertToFormData = (dataObject) => {
    const formData = new FormData();

    for (const key in dataObject) {
        formData.append(key, dataObject[key]);
    }

    return formData;
};

export const formatTime = (time) => {
    const date = new Date(`0000-01-01T${time}Z`);
    const hours = date.getHours().toString().padStart(2, "0");
    const minutes = date.getMinutes().toString().padStart(2, "0");

    return `${hours}:${minutes}`;
};
