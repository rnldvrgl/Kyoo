$(document).ready(function () {
    // Variables Declaration for TTS, Sound and Viddeo
    var tts = new SpeechSynthesisUtterance();
    tts.lang = "en-US";
    tts.rate = 1;
    var notif_audio = new Audio("assets/sounds/ascend.mp3");
    notif_audio.setAttribute("muted", true);

    // notif_audio.setAttribute("autoplay", true);

    // Text to Speech
    function speak(text) {
        if (text === "") return false;
        tts.text = text;
        notif_audio.setAttribute("muted", false);
        $(notif_audio).trigger("play");
        setTimeout(function () {
            window.speechSynthesis.speak(tts);
        }, 1500);
    }

    $("button#testButton").on("click", function () {
        speak("Queue Number R001, Please proceed to Library.");
    });
});
