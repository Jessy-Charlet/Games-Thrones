document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.buttonAcordeon');
    var buttonsIn = document.querySelectorAll('.buttonAcordeonIn');
    var contents = document.querySelectorAll('.acordeonContent');
    var contentsIn = document.querySelectorAll('.acordeonContentIn');

    buttons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            var content = contents[index];
            content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'grid' : 'none';
            adjustButtonArrow(button.querySelector('.buttonAcrodeonRightContent'), content.style.display);
            if(content.style.display === 'grid') {
                content.style.width = '100%';
                content.style.GridTemplateColumns = '10fr 1fr';
                content.style.alignItems = 'center';
                content.style.justifyItems = 'center';
                content.style.alignContents = 'center';
                content.style.gap = '10px';
            }
        });
    });

    buttonsIn.forEach(function(buttonIn, index) { // Change buttonsIn to buttonIn
        buttonIn.addEventListener('click', function() {
            var contentIn = contentsIn[index]; // Change contentsIn to contentIn
            contentIn.style.display = (contentIn.style.display === 'none' || contentIn.style.display === '') ? 'grid' : 'none';
            adjustButtonArrow(buttonIn.querySelector('.buttonAcrodeonRightContent'), contentIn.style.display); // Change .buttonAcrodeonRightContentIn to span
        });
    });

    function adjustButtonArrow(arrowElement, displayValue) {
        if (displayValue === 'grid') {
            arrowElement.innerHTML = '▼';
        } else {
            arrowElement.innerHTML = '►';
        }
    }
});