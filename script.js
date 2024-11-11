document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('header nav ul li a');
    const orderButton = document.querySelector('.order-button');
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');
    const registerButton = document.getElementById('registerButton');

    navLinks.forEach(link => {
        link.addEventListener('mouseover', () => {
            link.style.color = '#925a3c';
        });

        link.addEventListener('mouseout', () => {
            link.style.color = '#ffffff';
        });

        link.addEventListener('click', (event) => {
            const targetHref = link.getAttribute('href');

            if (targetHref === "create.php") {
                event.preventDefault();
                window.location.href = 'create.php';
            } else if (targetHref === "#history") {
                event.preventDefault();
                document.getElementById('history').scrollIntoView({ behavior: 'smooth' });
            } else if (targetHref.startsWith('#')) {
                const targetId = targetHref.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    event.preventDefault();
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    orderButton.addEventListener('mouseover', () => {
        orderButton.style.backgroundColor = '#e0ccbf';
        orderButton.style.color = '#925a3c';
    });

    orderButton.addEventListener('mouseout', () => {
        orderButton.style.backgroundColor = '#925a3c';
        orderButton.style.color = '#ffffff';
    });

    if (dropdown) {
        dropdown.addEventListener('mouseenter', () => {
            dropdownContent.style.display = 'block';
        });

        dropdown.addEventListener('mouseleave', () => {
            dropdownContent.style.display = 'none';
        });
    }

    if (registerButton) {
        registerButton.addEventListener('click', () => {
            window.location.href = 'register.html';
        });
    }
});
