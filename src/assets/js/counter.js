// Not working
const counters = document.querySelectorAll('.counter');
const speed = 200;

counters.forEach(counter => {
    const updateCount = () => {
        const target = counter.getAttribute('data-target');

        console.log(typeof target);
    }
});
