export const isFieldNotEmpty = (data) => {
    for (const key in data) {
        if (data[key].trim() === "") {
            return false;
        }
    }
    return true;
};

export const isFullNameValid = (name) => {
    const regex = /^[a-zA-Z -]*$/;
    const fullName = name;

    return (
        fullName !== "" &&
        regex.test(fullName) &&
        fullName.length >= 3 &&
        fullName.length <= 50
    );
};

export const isEmailValid = (email) => {
    const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/gm;

    return regex.test(email);
};

export const isDateValid = (date) => {
    const regex = /^\d{4}-\d{2}-\d{2}$/;

    return regex.test(date);
};

export const isGenderValid = (gender) => {
    const validGender = ["male", "female"];

    return validGender.includes(gender.toLowerCase());
};

export const isImageFile = (file) => {
    const acceptedImageTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
        "image/svg+xml",
    ];
    return file && acceptedImageTypes.includes(file.type);
};

export const isDataInObj = (value, obj, key = null) => {
    if (key != null) {
        let arr = Object.values(obj).map((e) => e[key]);
        obj = arr;
    }

    return obj.includes(value);
};

export const isNumberValid = (num, min = 2014, max = 2025) => {
    const regex = /^[0-9]+$/;
    if (!regex.test(num)) return false;

    return num >= min && num <= max;
};
