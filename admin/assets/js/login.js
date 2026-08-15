document.addEventListener("DOMContentLoaded", () => {

    /*
    ==========================================
    LOGIN LOADER
    ==========================================
    */

    const loginForm = document.getElementById("loginFormElement");

    if (loginForm) {

        loginForm.addEventListener("submit", function () {

            const email = this.querySelector("input[name='email']").value.trim();
            const password = this.querySelector("input[name='password']").value;

            if (email === "" || password === "") {
                return;
            }

            Swal.fire({

                title: "Please Wait",

                html: `
                    Checking Credentials...
                    <br><br>
                    Please wait...
                `,

                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,

                didOpen: () => {

                    Swal.showLoading();

                }

            });

        });

    }

    /*
    ==========================================
    OTP BOXES
    ==========================================
    */

    const otpBoxes = document.querySelectorAll(".otp-box");
    const otpValue = document.getElementById("otpValue");

    if (otpBoxes.length > 0) {

        otpBoxes.forEach((box, index) => {

            box.addEventListener("input", function () {

                this.value = this.value.replace(/\D/g, "");

                if (this.value && index < otpBoxes.length - 1) {

                    otpBoxes[index + 1].focus();

                }

                otpValue.value = [...otpBoxes]
                    .map(box => box.value)
                    .join("");

            });

            box.addEventListener("keydown", function (event) {

                if (
                    event.key === "Backspace" &&
                    this.value === "" &&
                    index > 0
                ) {

                    otpBoxes[index - 1].focus();

                }

            });

        });

        otpBoxes[0].addEventListener("paste", function (event) {

            event.preventDefault();

            const data = event.clipboardData
                .getData("text")
                .replace(/\D/g, "")
                .slice(0, 6);

            data.split("").forEach((digit, index) => {

                if (otpBoxes[index]) {

                    otpBoxes[index].value = digit;

                }

            });

            otpValue.value = data;

        });

    }

    /*
=========================================
OTP TIMER
=========================================
*/

const timer = document.getElementById("otpTimer");

if (timer && timer.dataset.expiry) {

    const expiry = parseInt(timer.dataset.expiry);

    function updateTimer() {

        const now = Math.floor(Date.now() / 1000);

        const remaining = expiry - now;

        if (remaining <= 0) {

            timer.innerHTML = "Expired";

            timer.style.color = "#dc2626";

            return;

        }

        const minutes = Math.floor(remaining / 60);

        const seconds = remaining % 60;

        timer.innerHTML =
            `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;

    }

    updateTimer();

    const interval = setInterval(() => {

        updateTimer();

        if (timer.innerHTML === "Expired") {

            clearInterval(interval);

        }

    }, 1000);

}
/*
    ==========================================
    PASSWORD TOGGLE
    ==========================================
    */

    const password = document.getElementById("password");
    const toggle = document.getElementById("togglePassword");

    if (password && toggle) {

        toggle.addEventListener("click", function () {

            const icon = toggle.querySelector("i");

            if (password.type === "password") {

                password.type = "text";

                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");

            } else {

                password.type = "password";

                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");

            }

        });

    }

});