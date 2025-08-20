document.addEventListener("DOMContentLoaded", function () {
    let header = document.getElementById("header-topo-fixo");
    let headerContato = document.getElementById("headerContato");
    let limiteScroll = 80;

    window.addEventListener("scroll", function () {
        let scrollY = window.scrollY;

        // Adiciona ou remove a classe fundo-escuro no header
        if (scrollY >= limiteScroll) {
            header.classList.add("fundo-escuro");
        } else {
            header.classList.remove("fundo-escuro");
        }

        // Oculta ou exibe o conteúdo de header-contato
        if (scrollY >= limiteScroll) {
            headerContato.style.opacity = "0";
            headerContato.style.transition = "opacity 0.4s ease-in-out";
        } else {
            headerContato.style.opacity = "1";
        }
    });
});

$(document).ready(function () {
    $('.carrossel-imagens').slick({
        infinite: true,
        slidesToShow: 10,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 2000,
        cssEase: 'linear',
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const submenus = document.querySelectorAll(".submenu");
    submenus.forEach(submenu => {
        submenu.style.display = "none";
    });

    const menuItems = document.querySelectorAll(".menu-item > a");

    menuItems.forEach(item => {
        item.addEventListener("click", function (event) {
            event.preventDefault();

            document.querySelectorAll(".submenu").forEach(submenu => {
                if (submenu !== this.nextElementSibling) {
                    submenu.style.display = "none";
                }
            });

            const submenu = this.nextElementSibling;
            if (submenu && submenu.style.display === "block") {
                submenu.style.display = "none";
            } else if (submenu) {
                submenu.style.display = "block";
            }
        });
    });

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".menu-item")) {
            document.querySelectorAll(".submenu").forEach(submenu => {
                submenu.style.display = "none";
            });
        }
    });

    document.querySelectorAll(".menu-item > a").forEach(item => {
        item.classList.remove("ativo");
    });
});

// botão de voltar ao topo [v]

document.addEventListener("DOMContentLoaded", function () {
    const btnVoltarTopo = document.getElementById("btn-voltar-topo");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            btnVoltarTopo.style.display = "flex";
        } else {
            btnVoltarTopo.style.display = "none";
        }
    });

    btnVoltarTopo.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const btnAbrir = document.getElementById('abrirLogin');
    const modal = document.getElementById('loginModal');
    const btnFechar = modal.querySelector('.fechar');
    const abrirCadastro = document.getElementById('abrirCadastro');
    const cadastroBox = document.getElementById('cadastroBox');

    btnAbrir.addEventListener('click', function(e) {
        e.preventDefault();
        // Toggle: se estiver visível, fecha; se não, abre
        if (modal.style.display === 'block') {
            modal.style.display = 'none';
        } else {
            modal.style.display = 'block';
            cadastroBox.style.display = 'none';
        }
    });

    btnFechar.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    abrirCadastro.addEventListener('click', function(e) {
        e.preventDefault();
        cadastroBox.style.display = 'block';
    });
});