window.showToast = function (message, type = "info") {
    const toast = document.createElement("div");
    const iconMap = {
        info: "fa-info-circle",
        success: "fa-check-circle",
        warning: "fa-exclamation-triangle",
        error: "fa-times-circle",
    };

    toast.className = `alert alert-${type}`;
    toast.innerHTML = `<i class="fa ${iconMap[type]} mr-2"></i><span>${message}</span>`;
    toast.style.marginTop = "10px";

    let container = document.getElementById("toast-container");
    if (!container) {
        container = document.createElement("div");
        container.id = "toast-container";
        container.style.position = "fixed";
        container.style.top = "20px";
        container.style.right = "20px";
        container.style.zIndex = "9999";
        document.body.appendChild(container);
    }

    container.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
};
