// Toggle Dark Mode
document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.createElement("button");
    darkModeToggle.textContent = "Dark Mode";
    darkModeToggle.classList.add("dark-mode-toggle");
    document.body.prepend(darkModeToggle);

    darkModeToggle.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        document.querySelectorAll('.navbar, .banner, .kartu-produk, .footer').forEach((el) => {
            el.classList.toggle("dark-mode");
        });
    });
});

// Live Search
document.getElementById("input-pencarian").addEventListener("input", function () {
    const query = this.value.toLowerCase();
    const produk = document.querySelectorAll(".kartu-produk");

    produk.forEach(item => {
        const namaProduk = item.querySelector(".info-produk h3").textContent.toLowerCase();
        if (namaProduk.includes(query)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
});

// Hamburger Menu Toggle
document.getElementById("hamburger-menu").addEventListener("click", function () {
    document.querySelector(".navbar .link-nav").classList.toggle("active");
});
