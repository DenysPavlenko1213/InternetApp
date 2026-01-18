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
$(function () {

    // ============================
    // 1. Licznik znaków
    // ============================
    $('#message').on('input', function () {
        const max = 500;
        const len = $(this).val().length;
        $('#charCount').text(len + '/' + max);
        $('#charCount').toggleClass('text-danger', len > max);
    });

    // ============================
    // 2. FAQ – slideToggle
    // ============================
    $('.faq-question').on('click', function () {
        $(this).toggleClass('active');
        $(this).next('.faq-answer').slideToggle();
    });

    // ============================
    // 3. AJAX – wczytywanie newsów
    // ============================
    $('#loadNews').on('click', function () {
        $.ajax({
            url: 'news.json',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                const $container = $('#newsContainer');
                $container.empty();

                data.forEach(function (item) {
                    const card = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="h5 card-title">${item.title}</h3>
                                    <p class="text-muted mb-1">${item.date}</p>
                                    <p class="card-text">${item.content}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    const $card = $(card);
                    $container.append($card.hide().fadeIn(300));
                });
            },
            error: function () {
                alert('Nie udało się wczytać aktualności.');
            }
        });
    });

    // ============================
    // 4. Animowane pojawianie sekcji
    // ============================
    function revealOnScroll() {
        $('section').each(function () {
            const top = $(this).offset().top;
            const scroll = $(window).scrollTop();
            const height = $(window).height();

            if (top < scroll + height - 100) {
                $(this).addClass('section-visible');
            }
        });
    }

    $(window).on('scroll', revealOnScroll);
    revealOnScroll();
});

