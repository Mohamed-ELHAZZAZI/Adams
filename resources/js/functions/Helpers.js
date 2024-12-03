export const convertToFormData = (dataObject) => {
    const formData = new FormData();

    for (const key in dataObject) {
        formData.append(key, dataObject[key]);
    }

    return formData;
};
