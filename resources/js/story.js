function update(jscolor) {
    // 'jscolor' instance can be used as a string
    document.getElementById('storyBox').style.backgroundColor = '#' + jscolor;
}

function resizeText(multiplier) {
    if (document.getElementById('storyBox').style.fontSize == "") {
        document.getElementById('storyBox').style.fontSize = "1.0em";
    }
    document.getElementById('storyBox').style.fontSize = parseFloat(document.getElementById('storyBox').style.fontSize) + (multiplier * 0.2) + "em";
}