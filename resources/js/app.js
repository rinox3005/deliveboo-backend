import "./bootstrap";

import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

// gestione modalitá chiaro-scuro

document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const themeIcon = document.getElementById("theme-icon");
    const dropdownMenu = document.getElementById("theme-dropdown-menu");

    function updateThemeToggleText() {
        if (localStorage.getItem("theme") === "dark") {
            themeToggle.innerHTML =
                '<i id="theme-icon" class="fas fa-sun"></i> Light mode';
        } else {
            themeToggle.innerHTML =
                '<i id="theme-icon" class="fas fa-moon"></i> Dark mode';
        }
    }

    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("bg-dark", "text-white");

        const nav = document.querySelector("nav");
        nav.classList.add("bg-dark", "text-white", "navbar-dark");
        nav.classList.remove("navbar-light");

        dropdownMenu.classList.add("bg-dark", "text-white");
        dropdownMenu.querySelectorAll(".dropdown-item").forEach((item) => {
            item.classList.add("dropdown-item-dark");
        });

        document.querySelectorAll("ul.list-group").forEach((ul) => {
            ul.classList.add("bg-dark", "text-white");
        });
        document.querySelectorAll("li.list-group-item").forEach((li) => {
            li.classList.add("bg-dark", "text-white");
        });
        document.querySelectorAll(".card").forEach((card) => {
            card.classList.add(
                "bg-dark",
                "text-white",
                "border",
                "border-secondary",
            );
        });
        document.querySelectorAll(".card-header").forEach((header) => {
            header.classList.add(
                "bg-dark",
                "text-white",
                "border",
                "border-secondary",
            );
        });
        document.querySelectorAll(".card-body").forEach((body) => {
            body.classList.add(
                "bg-dark",
                "text-white",
                "border",
                "border-secondary",
            );
        });
    } else {
        document.body.classList.add("bg-white", "text-dark");

        const nav = document.querySelector("nav");
        nav.classList.add("bg-white", "text-dark", "navbar-light");
        nav.classList.remove("navbar-dark");

        dropdownMenu.classList.add("bg-white", "text-dark");
        dropdownMenu.querySelectorAll(".dropdown-item").forEach((item) => {
            item.classList.remove("dropdown-item-dark");
        });

        document.querySelectorAll("ul.list-group").forEach((ul) => {
            ul.classList.add("bg-white", "text-dark");
        });
        document.querySelectorAll("li.list-group-item").forEach((li) => {
            li.classList.add("bg-white", "text-dark");
        });
        document.querySelectorAll(".card").forEach((card) => {
            card.classList.add("bg-white", "text-dark");
            card.classList.remove("border", "border-secondary");
        });
        document.querySelectorAll(".card-header").forEach((header) => {
            header.classList.add("bg-white", "text-dark");
            header.classList.remove("border", "border-secondary");
        });
        document.querySelectorAll(".card-body").forEach((body) => {
            body.classList.add("bg-white", "text-dark");
            body.classList.remove("border", "border-secondary");
        });
    }

    updateThemeToggleText();

    themeToggle.addEventListener("click", function (e) {
        e.preventDefault();
        const nav = document.querySelector("nav");

        if (document.body.classList.contains("bg-dark")) {
            // Switch to light mode
            document.body.classList.replace("bg-dark", "bg-white");
            document.body.classList.replace("text-white", "text-dark");

            nav.classList.replace("bg-dark", "bg-white");
            nav.classList.replace("text-white", "text-dark");
            nav.classList.remove("navbar-dark");
            nav.classList.add("navbar-light");

            dropdownMenu.classList.replace("bg-dark", "bg-white");
            dropdownMenu.classList.replace("text-white", "text-dark");
            dropdownMenu.querySelectorAll(".dropdown-item").forEach((item) => {
                item.classList.remove("dropdown-item-dark");
            });

            document.querySelectorAll("ul.list-group").forEach((ul) => {
                ul.classList.replace("bg-dark", "bg-white");
                ul.classList.replace("text-white", "text-dark");
            });

            document.querySelectorAll("li.list-group-item").forEach((li) => {
                li.classList.replace("bg-dark", "bg-white");
                li.classList.replace("text-white", "text-dark");
            });

            document.querySelectorAll(".card").forEach((card) => {
                card.classList.replace("bg-dark", "bg-white");
                card.classList.replace("text-white", "text-dark");
                card.classList.remove("border", "border-secondary");
            });
            document.querySelectorAll(".card-header").forEach((header) => {
                header.classList.replace("bg-dark", "bg-white");
                header.classList.replace("text-white", "text-dark");
                header.classList.remove("border", "border-secondary");
            });
            document.querySelectorAll(".card-body").forEach((body) => {
                body.classList.replace("bg-dark", "bg-white");
                body.classList.replace("text-white", "text-dark");
                body.classList.remove("border", "border-secondary");
            });

            localStorage.setItem("theme", "light");
        } else {
            // Switch to dark mode
            document.body.classList.replace("bg-white", "bg-dark");
            document.body.classList.replace("text-dark", "text-white");

            nav.classList.replace("bg-white", "bg-dark");
            nav.classList.replace("text-dark", "text-white");
            nav.classList.remove("navbar-light");
            nav.classList.add("navbar-dark");

            dropdownMenu.classList.replace("bg-white", "bg-dark");
            dropdownMenu.classList.replace("text-dark", "text-white");
            dropdownMenu.querySelectorAll(".dropdown-item").forEach((item) => {
                item.classList.add("dropdown-item-dark");
            });

            document.querySelectorAll("ul.list-group").forEach((ul) => {
                ul.classList.replace("bg-white", "bg-dark");
                ul.classList.replace("text-dark", "text-white");
            });

            document.querySelectorAll("li.list-group-item").forEach((li) => {
                li.classList.replace("bg-white", "bg-dark");
                li.classList.replace("text-dark", "text-white");
            });

            document.querySelectorAll(".card").forEach((card) => {
                card.classList.replace("bg-white", "bg-dark");
                card.classList.replace("text-dark", "text-white");
                card.classList.add("border", "border-secondary");
            });
            document.querySelectorAll(".card-header").forEach((header) => {
                header.classList.replace("bg-white", "bg-dark");
                header.classList.replace("text-dark", "text-white");
                header.classList.add("border", "border-secondary");
            });
            document.querySelectorAll(".card-body").forEach((body) => {
                body.classList.replace("bg-white", "bg-dark");
                body.classList.replace("text-dark", "text-white");
                body.classList.add("border", "border-secondary");
            });

            localStorage.setItem("theme", "dark");
        }

        updateThemeToggleText();
    });
});
