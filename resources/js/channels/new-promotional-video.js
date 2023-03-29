const promotionalVideoChannel = window.Echo.channel("public.promotional-video");

promotionalVideoChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".new-promotional-video", (e) => {
        let newVideo = e.promotionalVideo;

        console.log(newVideo);
    });
