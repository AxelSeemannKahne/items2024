var setFullWidthContainer = function () {
    var fullwidthElements = document.querySelectorAll('.dd-fullwidth');
    fullwidthElements.forEach(function (element) {
        element.closest('div[class^="col-"]').style.position = 'static'; // Chrome Fix
    });

    var containerWidth = (document.querySelector('.dd-ve-container')).clientWidth;
    var gap = Math.floor((document.body.clientWidth - containerWidth) / 2);

    fullwidthElements.forEach(function (element) {
        element.style.margin = '0 -' + gap + 'px';

        if (!element.querySelector('.dd-hero-box, .dd-image-box')) {
            element.style.padding = '0 ' + gap + 'px';
        }
    });
};

if (!document.querySelector('.dd-boxed-container')) {
    window.addEventListener('load', setFullWidthContainer);
    window.addEventListener('resize', setFullWidthContainer);
}