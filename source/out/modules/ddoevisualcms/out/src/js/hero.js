var $heroContainers = document.querySelectorAll('.dd-hero-fixed');
if ($heroContainers.length) {
    var windowHeight = window.innerHeight;

    $heroContainers.forEach(function (element) {
        var elementHeight = element.clientHeight;

        element.style.height = ((windowHeight > elementHeight) ? windowHeight : elementHeight) + 'px';
    });
}