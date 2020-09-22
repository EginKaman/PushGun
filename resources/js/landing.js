$(document).ready(function () {

    const count = 892; // Устанавливаем значение счетчика


    //slider
    let section1 = $('.section1__content__slider');
    if (section1.length) {
        section1.slick({
            autoplay: true,
            dots: true,
            arrows: false,
        });
    }


    $('.menu__btn').on('click', () => {
        $('.menu__btn').toggleClass('active');
    });

    $('.btn_dwn').on('click', event => {
        event.preventDefault();
        let id = $('.btn_dwn').attr('href');
        let topElem = $(id).offset().top;
        $('body,html').animate({
            scrollTop: topElem
        }, 1000);
    });


    function anim(top) {
        let scale = ((top / 1000) + 0.8).toFixed(2)
        $('.hero-img2').css({
            'transform': 'translate(' + top * -0.3 + '%,' + top * -0.3 + '%) scale(' + scale + ')'
        });
        $('.hero-img3').css({
            'transform': 'translate(' + top * 0.7 + '%,' + top * -0.7 + '%) scale(' + scale + ')'
        });
        $('.hero-img4').css({
            'transform': 'translate(' + top * 0.2 + '%,' + top * -0.2 + '%) scale(' + scale + ')'
        });
        if (top < 1000) {
            $('.btn_dwn .whiteBg').css({
                'width': top * 5 + '%',
                'height': top * 5 + '%',
                'left': top * -2.5 + 50 + '%',
                'top': top * -2.5 + 50 + '%'
            });
        } else {
            $('.btn_dwn .whiteBg').css({
                'width': '4825%',
                'height': '4825%',
                'left': '-2362.5%',
                'top': '-2362.5%'
            });
        }
        if (top > 70) {
            $('.header-landing').addClass('scroll');
        } else if (top <= 70) {
            $('.header-landing').removeClass('scroll');
        }
    }

    $(document).scroll(() => {
        topOffset = $(document).scrollTop();
        anim(topOffset);
    });
    let topOffset = $(document).scrollTop();
    anim(topOffset);


    let countStatus = false;
    let j = 0;

    $(document).scroll(() => {
        let countBlock = $('.section4__wrapper__count');
        if (countBlock.length) {
            let topOffset = $(document).scrollTop();
            let topElem = countBlock.offset().top;
            if (countStatus == false) {
                if (topOffset > topElem - $(window).height()) {
                    timer = setInterval(() => {
                        if (Number(countBlock.text()) <= count) {
                            j = j + 1;
                            countBlock.text(j);
                            countStatus = true;
                        } else {
                            clearTimeout(timer);
                        }
                    }, 1);
                }
            }
        }
    });

    $('.faq__item').on('click', function () {
        $(this).toggleClass('active');
        $(this).find('p').toggle('300');
    });
});
