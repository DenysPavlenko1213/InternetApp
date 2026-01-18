document.addEventListener("DOMContentLoaded", () => {

    // 1. Płynne przewijanie
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // 2. Walidacja formularza
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.querySelector('input[placeholder="Wpisz imię"]');
        const email = document.querySelector('input[placeholder="Wpisz email"]');
        const message = document.querySelector('input[placeholder="Treść wiadomości"]');

        let errors = [];

        if (!name.value.trim()) errors.push("Pole 'Imię' jest puste");
        if (!email.value.trim()) errors.push("Pole 'Email' jest puste");
        if (!email.value.includes("@")) errors.push("Email musi zawierać znak @");
        if (!message.value.trim()) errors.push("Pole 'Treść' jest puste");

        if (errors.length > 0) {
            alert("Błędy:\n" + errors.join("\n"));
            return;
        }

        alert("Dziękujemy za wiadomość!");
        form.reset();
    });

    // 3. Podświetlanie aktywnego linku
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    window.addEventListener("scroll", () => {
        let current = "";

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (scrollY >= sectionTop) current = section.getAttribute("id");
        });

        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href") === "#" + current) {
                link.classList.add("active");
            }
        });
    });

});
