"use strict";

$(document).ready(function() {
    $('.tabs').on('click', function() {
        $('.tabs').removeClass('active')
        $(this).addClass('active')
        let array = $(this).attr('tab-name')
        $('.tab-item').removeClass('active')
        $('.tab-item').each(function() {
            if ($(this).hasClass(array)) {
                $(this).addClass('active')
            }
        })
    })

    function textCount() {
        if ($('body').find('.trumbowyg-editor')) {
            $(document).on('keyup', function(e) {
                let sum = 0
                let array = []
                $('.trumbowyg-editor p').each(function() {
                    array.push($(this).text().length)
                })
                for (var i = 0; i < array.length; i++) {
                    sum = sum + parseInt(array[i]);
                }
                $('.trumbowyg-count').text(sum)
            })
        }
    }
    textCount()


    $(".visa").each(function() {
        $(this).on("click", function() {
            console.log($(".visa.active").length);
            if ($(".visa.active").length > 0) {
                $(".visa").removeClass("active");
            }
            $(this).addClass("active");
            if ($(".visa").hasClass("active")) {
                $(".rss__wrapper__block__content__last").css(
                    "display",
                    "block"
                );
            } else {
                $(".rss__wrapper__block__content__last").css("display", "none");
            }
        });
    });
    $(
        ".stats__selector, .set-form__select, .sup-form__select, .site_domain_select"
    ).select2({
        // $('.stats__selector, .filter__selector, .set-form__select, .sup-form__select, .site_domain_select').select2({
        minimumResultsForSearch: -1,
        placeholder: "Выбрать"
    });

    $(".close-notif").on("click", function() {
        $(".notification").removeClass("all-active");
        $(".notification").fadeOut(700);
        $(".notification__item").removeClass("this-active");
    });

    $('.time').mask('00');

    $(".notification__item").on("click", function() {
        $(this).toggleClass("this-active");
        $(".notification").addClass("all-active");
    });

    $(".notif-btn").on("click", function(e) {
        $(".notification").addClass("all-active");
    });

    $(".createmailing-select__current").on("click", function() {
        $(this)
            .parent()
            .children(".createmailing-select__menus")
            .slideToggle();
        $(this)
            .parent()
            .toggleClass("active");
    });

    $(".select-item").on("click", function() {
        const container = $(this)
            .parent()
            .siblings(".createmailing-select__current");
        const input = container.children(".hidden_input_for_data");
        const id = $(this).attr("data-id");
        const list =
            input
            .attr("value")
            .split(",")
            .filter(item => item) || [];
        const text = container
            .children(".set-select")
            .text()
            .split(",")
            .filter(item => item.toLowerCase() !== "выбрать");
        const selectName = container.attr("data-name");
        if (container.attr("data-selectMode") === "multiple") {
            const isSelected =
                $(this).attr("data-isSelected") === "0" ? false : true;
            if (isSelected) {
                const candidate = list.indexOf(id);
                const idxOfExistingText = text.indexOf($(this).text());
                if (candidate !== -1) list.splice(candidate, 1);
                text.splice(idxOfExistingText, 1);
                $(this).attr("data-isSelected", "0");
                container.children(".set-select").text(text.join(", "));
                const deletedElem = document.getElementById(
                    `${selectName}-${id}`
                );
                deletedElem.parentNode.removeChild(deletedElem);
            } else {
                list.push(id);
                text.push($(this).text());
                container.children(".set-select").text(text.join(", "));
                $(this).attr("data-isSelected", "1");
                container.append(
                    `<input type="hidden" data-name='${selectName}-${id}' name="${selectName}[]" value='${id}'/>`
                );
            }
        } else {
            container.children(".set-select").text($(this).text());
            container.append(
                `<input type="hidden" data-name='${selectName}-${id}' name="${selectName}[]" value='${id}'/>`
            );
        }
        if (!text.length) {
            container.children(".set-select").text("Выбрать");
        }
        $(this)
            .parent()
            .slideUp();
        $(this)
            .parent()
            .parent()
            .removeClass("active");
    });
    $(document).ready(function() {
        $(".tooltip").tooltipster({
            side: ["left", "bottom"],
            trigger: "click",
            contentCloning: false,
            interactive: true
        });

        $(".header__account").click(function(e) {
            e.preventDefault();
            $(".account__popup").fadeToggle(300);
            $(".header__popup").fadeOut(300);
        });

        $(".bell").click(function(e) {
            e.preventDefault();
            $(".notification").fadeToggle(300);
        });

        $(".header__burger").click(function() {
            $(".header__popup").fadeToggle(300);
            $("body").toggleClass("fixer");
        });

        $(".button_green_inner").mouseenter(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".green_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".green_button_circle")
                .removeClass("desplode-circle");
            $(this)
                .prev(".green_button_circle")
                .addClass("explode-circle");
        });
        $(".button_green_inner").mouseleave(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".green_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".green_button_circle")
                .removeClass("explode-circle");
            $(this)
                .prev(".green_button_circle")
                .addClass("desplode-circle");
        });

        $(".button_lb_inner").mouseenter(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".lb_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".lb_button_circle")
                .removeClass("desplode-circle-lb");
            $(this)
                .prev(".lb_button_circle")
                .addClass("explode-circle-lb");
        });
        $(".button_lb_inner").mouseleave(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".lb_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".lb_button_circle")
                .removeClass("explode-circle-lb");
            $(this)
                .prev(".lb_button_circle")
                .addClass("desplode-circle-lb");
        });

        $(".button_rb_inner").mouseenter(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".rb_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".rb_button_circle")
                .removeClass("desplode-circle-rb");
            $(this)
                .prev(".rb_button_circle")
                .addClass("explode-circle-rb");
        });
        $(".button_rb_inner").mouseleave(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".rb_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".rb_button_circle")
                .removeClass("explode-circle-rb");
            $(this)
                .prev(".rb_button_circle")
                .addClass("desplode-circle-rb");
        });

        $(".button_white_inner").mouseenter(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".white_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".white_button_circle")
                .removeClass("desplode-circle-w");
            $(this)
                .prev(".white_button_circle")
                .addClass("explode-circle-w");
        });
        $(".button_white_inner").mouseleave(function(e) {
            var parentOffset = $(this).offset();
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            $(this)
                .prev(".white_button_circle")
                .css({
                    left: relX,
                    top: relY
                });
            $(this)
                .prev(".white_button_circle")
                .removeClass("explode-circle-w");
            $(this)
                .prev(".white_button_circle")
                .addClass("desplode-circle-w");
        });

        $(".button").click(function() {
            $(".button").removeClass("selected");
            $(this).addClass("selected");
        });

        $("#filter").click(function() {
            $(".filter__popup").fadeToggle(300);
        });
        $("#btn_select").click(function() {
            $(".filter__popup").fadeToggle(300);
            if (
                $("#firstDate-input").val() !== "" &&
                $("#lastDate-input").val() !== ""
            ) {
                var fD = $("#firstDate-input").val();
                var lD = $("#lastDate-input").val();

                $("#firstDate").addClass("activated");
                $("#first-date").text(fD);

                $("#lastDate").addClass("activated");
                $("#last-date").text(lD);

                $(".mails__reset").fadeIn(300);
            }
        });

        function checkEmpty() {
            if (
                $("#firstDate-input").val() == 0 &&
                $("#lastDate-input").val() == 0
            ) {
                $(".mails__reset").fadeOut(300);
            }
        }

        $(".mails__reset").click(function() {
            $("#firstDate").removeClass("activated");
            $("#lastDate").removeClass("activated");
            $(".filter__input").val("");
            $(this).fadeOut(300);
        });

        $(".button_lb").click(function() {
            $(".filter__input").val("");
        });

        $("#first-date-del").click(function() {
            $("#firstDate").removeClass("activated");
            $("#firstDate-input").val("");
            checkEmpty();
        });

        $("#last-date-del").click(function() {
            $("#lastDate").removeClass("activated");
            $("#lastDate-input").val("");
            checkEmpty();
        });

        var days = [
            "Понедельник",
            "Вторник",
            "Среда",
            "Четверг",
            "Пятница",
            "Суббота",
            "Воскресенье"
        ];
        var weeks = [
            "1 - 8 июня",
            "9 - 16 июня",
            "17 - 24 июня",
            "25 - 30 июня"
        ];
        var months = [
            "Янв.",
            "Фев.",
            "Мар.",
            "Апр.",
            "Июн.",
            "Июл.",
            "Авг.",
            "Сен.",
            "Окт.",
            "Ноя.",
            "Дек."
        ];
        var dataMailing = [1, 30, 45, 60, 90, 139, 12, 38, 3, 15];
        var dataSent = [1, 30, 45, 60, 39, 87, 12, 38, 3, 15];
        var dataDelivery = [1, 30, 45, 60, 55, 54, 12, 38, 3, 15];
        var dataGo = [1, 22, 45, 39, 59, 12, 12, 38, 3, 15];

        document.addEventListener("keydown", function(e) {
            if (e.keyCode === 27) {
                $(".account__popup").fadeOut(300);
                $(".filter__popup").fadeOut(300);
            }
        });

        $(document).click(function(e) {
            if (!$(e.target).closest(
                    "#filter, .header__account, .datepicker--cell, .datepicker, .datepicker--nav, .datepicker--nav-action, .datepicker--nav-title, .filter__popup, .account__popup, .createmailing-select__current, .createmailing-select__menus"
                ).length) {
                $(
                    ".filter__popup, .account__popup, .createmailing-select__menus"
                ).fadeOut(250);
                $(".createmailing-select").removeClass("active");
            }
        });
        $(document).click(function(e) {
            if (!$(e.target).closest("#filter, .bell, .notification").length) {
                $(".notification").fadeOut(250);
                $(".notification").removeClass("all-active");
            }
        });
        $(".copy_command__button").on("click", function() {
            const inputAttr = $(this).attr("data-input-id");
            const input = $(
                `input.copy_command__text[data-id=${inputAttr}]`
            ).select();
            $(this).find('.button_text_container').text('Скопировано')
            document.execCommand("copy");
        });
        $(".setgen__buttons_link").click(function() {
            let id = $(this).attr("id");
            $("section").removeClass("choosen");
            $("#" + id + "-sec").addClass("choosen");
        });

        $("#sale").change(function() {
            $(this).toggleClass("true");
            //          let price = $('#tariff-price').text();
            //          sale(price);
            //          if (!$('#sale').hasClass('true')) {
            //              sale(price / 0.8);
            // }
        });

        function sale(e) {
            if ($("#sale").hasClass("true")) {
                $("#tariff-price").text(e * 0.8);
            } else {
                $("#tariff-price").text(e);
            }
            $(".followsCount").val(e);
        }

        $(".change-email").on("click", function() {
            $(".set-change").fadeOut(400);
            $(".email input")
                .removeAttr("disabled")
                .focus()
                .removeClass("disable");
        });

        if ($(".tariff-slider").length != 0) {
            $(".tariff-slider")
                .slider({
                    animate: "fast",
                    value: 0,
                    min: 0,
                    max: 3,
                    step: 1,
                    change: function(event, ui) {
                        let item = $(".tariff-slider__item ").eq(ui.value);
                        let price = item.data("price");
                        let text = item.data("text");

                        $(".number-followers").text(text);
                        sale(price);
                    }
                })
                .each(function() {
                    var opt = $(this).data().uiSlider.options;
                    var vals = opt.max - opt.min;

                    for (var i = 0; i <= vals; i++) {
                        var el = $(".tariff-slider__item ").eq(i);
                        var elWidth = el.width();
                        var pointWidth = $(".ui-slider-handle").width();
                        el.css("left", `${(i / vals) * 100}%`);
                    }
                });

            $(".tariff-slider__item ").on("click", function() {
                console.log("click some item slider");
                let index = $(this).index();
                let slider = $(".tariff-slider");
                slider.slider("value", index);
            });
        }

        function handleFileSelect(evt) {
            var file = evt.target.files; // FileList object
            var f = file[0];
            // Only process image files.
            if (!f.type.match("image.*")) {
                alert("Image only please....");
            }
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var figure = document.createElement("figure");
                    figure.innerHTML = [
                        '<img class="thumb" title="',
                        escape(theFile.name),
                        '" src="',
                        e.target.result,
                        '" />'
                    ].join("");
                    document
                        .getElementById("output")
                        .insertBefore(figure, null);
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }

        if ($("#photo").length != 0) {
            document
                .getElementById("photo")
                .addEventListener("change", handleFileSelect, false);
        }

        let h = $(".push-check").height();
        $("#radio1, #radio2").change(function() {
            if ($("#radio2").prop("checked")) {
                $(".push-check").css({
                    "max-height": h
                });
            } else {
                h = $(".push-check").height();
                $(".push-check").css({
                    "max-height": "0px"
                });
            }
        });

        $(".file-img-remove").click(function(e) {
            e.preventDefault();
            $("#ticketFile").val("");
            $(".ticket-fileName").text("");
            $(".file-img").fadeIn(0);
            $(this).fadeOut(0);
        });

        $("#ticketFile").on("change", function() {
            var splittedFakePath = this.value.split("\\");
            $(".ticket-fileName").text(
                splittedFakePath[splittedFakePath.length - 1]
            );
            $(".file-img-remove").fadeIn(0);
            $(".file-img").fadeOut(0);
        });

        const changeBtnText = () => {
            let btns = document.querySelector(".settings-body");
            if (btns) {
                btns.querySelectorAll(".sett-btn div");

                if (window.matchMedia("(max-width: 556px)").matches) {
                    btns[0].textContent = "Общие";
                    btns[1].textContent = "Интеграция";
                    btns[2].textContent = "Подписка";
                    btns[3].textContent = "Общие";
                    btns[4].textContent = "Интеграция";
                    btns[5].textContent = "Подписка";
                    btns[6].textContent = "Общие";
                    btns[7].textContent = "Интеграция";
                    btns[8].textContent = "Подписка";
                } else {
                    btns[0].textContent = "Общие настройки";
                    btns[1].textContent = "Интеграция с сайтом";
                    btns[2].textContent = "Запрос подписки";
                    btns[3].textContent = "Общие настройки";
                    btns[4].textContent = "Интеграция с сайтом";
                    btns[5].textContent = "Запрос подписки";
                    btns[6].textContent = "Общие настройки";
                    btns[7].textContent = "Интеграция с сайтом";
                    btns[8].textContent = "Запрос подписки";
                }
            }
        };

        window.addEventListener("resize", () => {
            changeBtnText();
        });
        changeBtnText();
    });

    // Lang-toggle
    $(".lang-toggle").on("click", function() {
        $(this).toggleClass("active");
        $(".lang-toggle ul").slideToggle();
    });
    $(".lang-toggle li").on("click", function() {
        let lang = $(this).attr("data-lang");
        $(".lang-toggle span").html(lang);
    });
    $(".lang--toggle").on("click", function() {
        $(this)
            .find("ul")
            .slideToggle();
    });

    //mysitepop
    $(".general__sites_item-more").on("click", ".general__sites_item-more_imgcontsd", function() {
        let active = $(".general__sites_item-more.active");
        let menu = $(this).closest(".general__sites_item-more");

        menu.toggleClass("active");
        active.removeClass("active");
    });
});