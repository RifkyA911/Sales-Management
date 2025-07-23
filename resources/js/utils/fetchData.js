export async function loadSelectData(
    url,
    selectId,
    placeholder,
    valueKey,
    textKey
) {
    try {
        const response = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();

        const select = document.querySelector(selectId);
        if (!select) return;

        select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;

        data.data.forEach((item) => {
            const option = document.createElement("option");
            option.value = item[valueKey];
            option.textContent = item[textKey];
            select.appendChild(option);
        });
    } catch (error) {
        console.error(`Gagal memuat data dari ${url}:`, error);
    }
}
