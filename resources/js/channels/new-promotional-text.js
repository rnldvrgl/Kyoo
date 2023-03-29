const promotionalTextChannel = window.Echo.channel("public.promotional-text");

promotionalTextChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".new-promotional-text", (e) => {
        let newPromotionalText = e.promotionalText;

        let promotionalTextDisplay = $(".promotional-text");

        promotionalTextDisplay.html(newPromotionalText.text);

        // console.log(newPromotionalText.text);
    });
