(function () {
    ("use strict");

    $(window).on("load", function () {
        // Hide the loading screen once the page is fully loaded
        $("#loading-screen").fadeOut(500);
    });

    $(document).on("click", ".refresh-btn", function () {
        window.location.reload();
    });

    // Initialize AOS
    AOS.init();

    // Switch Text
    let statusSwitch = $("#status-switch");
    let statusLabel = $("label[for='status-switch']");
    if (statusSwitch.is(":checked")) {
        statusLabel.text("Active");
    } else {
        statusLabel.text("Inactive");
    }
    statusSwitch.change(function () {
        if ($(this).is(":checked")) {
            statusLabel.text("Active");
        } else {
            statusLabel.text("Inactive");
        }
    });

    $("body").on("change", ".status-switch", function () {
        let isChecked = $(this).is(":checked");
        let serviceStatusLabel = $(this)
            .siblings("label.form-check-label")
            .find(".ms-2");
        if (isChecked) {
            serviceStatusLabel.text("Active");
        } else {
            serviceStatusLabel.text("Inactive");
        }
    });

    let statusSwitchModal = $("#status-switch-modal");
    let statusLabelModal = $("label[for='status-switch-modal']");
    if (statusSwitchModal.is(":checked")) {
        statusLabelModal.text("Active");
    } else {
        statusLabelModal.text("Inactive");
    }
    statusSwitchModal.change(function () {
        if ($(this).is(":checked")) {
            statusLabelModal.text("Active");
        } else {
            statusLabelModal.text("Inactive");
        }
    });

    let isActiveSwitch = $("#is_active_switch_");
    let isActiveLabel = $("label[for='is_active_switch_']");
    if (isActiveSwitch.is(":checked")) {
        isActiveLabel.text("Active");
    } else {
        isActiveLabel.text("Inactive");
    }
    isActiveSwitch.change(function () {
        if ($(this).is(":checked")) {
            isActiveLabel.text("Active");
        } else {
            isActiveLabel.text("Inactive");
        }
    });

    // Get the message element
    var messageElement = $("#message");

    // If the message element exists
    if (messageElement.length) {
        // Hide the message after 4 seconds
        setTimeout(function () {
            messageElement.fadeOut();
        }, 4000);
    }

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

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

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    document
        .querySelectorAll('#nav-tab>[data-bs-toggle="tab"]')
        .forEach((el) => {
            el.addEventListener("shown.bs.tab", () => {
                const target = el.getAttribute("data-bs-target");
                const scrollElem = document.querySelector(
                    `${target} [data-bs-spy="scroll"]`
                );
                bootstrap.ScrollSpy.getOrCreateInstance(scrollElem).refresh();
            });
        });
})();
