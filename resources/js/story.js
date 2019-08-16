function update(jscolor) {
    let box = jscolor.valueElement.attributes[0].value;
    // 'jscolor' instance can be used as a string
    document.getElementById(box).style.backgroundColor = '#' + jscolor;
}

function resizeText(multiplier, box) {
    if (document.getElementById(box).style.fontSize == "") {
        document.getElementById(box).style.fontSize = "1.0em";
    }
    document.getElementById(box).style.fontSize = parseFloat(document.getElementById(box).style.fontSize) + (multiplier * 0.2) + "em";
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

function publishStory(element) {
    console.log(element);
}