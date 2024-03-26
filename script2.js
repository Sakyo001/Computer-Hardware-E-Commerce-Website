document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("[data-multi-step]");
    const formSteps = [...form.querySelectorAll(".form-step")];

    let currentStep = 0;

    form.addEventListener("click", (e) => {
        if (e.target.matches("[data-next]")) {
            currentStep++;
        } else if (e.target.matches("[data-previous]")) {
            currentStep--;
        }

        updateForm();
    });

    function updateForm() {
        formSteps.forEach((step, index) => {
            step.style.display = index === currentStep ? "block" : "none";
        });

        updateProgress();
    }

    function updateProgress() {
        const steps = formSteps.length;
        const progress = (currentStep / (steps - 1)) * 100;

        document.documentElement.style.setProperty("--progress", `${progress}%`);
    }

    updateForm();
});
