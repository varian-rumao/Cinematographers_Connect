import 'bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '..css/app.css';
import Parallax from 'parallax-js';
import Rellax from 'rellax';

AOS.init()

document.addEventListener('DOMContentLoaded', function () {
    const parallaxElements = document.querySelectorAll('.parallax-image');
    parallaxElements.forEach((element) => {
        new Parallax(element);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const rellax = new Rellax('.parallax-image', {
        speed: -2, // Adjust the speed as needed
        center: true,
        wrapper: null,
        round: true,
        vertical: true,
        horizontal: false
    });
});