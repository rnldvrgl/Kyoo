/**
 * Back to top button
 */
let backtotop = select(".back-to-top");
if (backtotop) {
    const toggleBacktotop = () => {
        if (window.scrollY > 100) {
            backtotop.classList.add("active");
        } else {
            backtotop.classList.remove("active");
        }
    };
    window.addEventListener("load", toggleBacktotop);
    onscroll(document, toggleBacktotop);
}
