$(document).ready(function () {
    $("#slide2").hide();
    $("#slide3").hide();

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function Slide(slide) {
        $(".slide").hide();
        $("#slide" + slide).fadeIn("slow");
        $(".slideButton button").removeClass();
        $("#bannerButton" + slide).addClass("buttonActif");
    }

    async function SlideAuto(nbrSlide) {
        let i = 1;
        $("#bannerButton1").on("click", function () {
            i = 1;
        })
        $("#bannerButton2").on("click", function () {
            i = 2;
        })
        $("#bannerButton3").on("click", function () {
            i = 3;
        })
        for (i = i; i <= nbrSlide; i++) {
            Slide(i);
            console.log(i);
            if (i >= nbrSlide) {
                i = 0;
            }
            console.log(i);
            await sleep(4000);
        }
    }

    $("#bannerButton1").on("click", function () {
        Slide("1");
    })
    $("#bannerButton2").on("click", function () {
        Slide("2");
    })
    $("#bannerButton3").on("click", function () {
        Slide("3");
    })

    SlideAuto(3);
})