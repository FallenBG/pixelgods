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

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

/**
 * Ugly way to handle and mostly update the story Published and Finished buttons
 *
 * @param field - string (published|finished)
 * @param value - bool
 * @param url   - onclick event url to which we post the request
 * @returns {Promise<any>}
 */
function publishFinishStory(field, value, url) {
    // console.log(url);
    return new Promise((resolve, reject) => {
        axios['post'](url, {name: field, value: value})
            .then(response => {
                if (field == 'finished' && value == 1) {
                    document.getElementById(field).innerHTML = 'Unfinish the Story';
                    document.getElementById(field).setAttribute( "onClick", "publishFinishStory('"+field+"', '0', '"+url+"')");
                } else if (field == 'finished' && value == 0) {
                    document.getElementById(field).innerHTML = 'Finish the Story';
                    document.getElementById(field).setAttribute( "onClick", "publishFinishStory('"+field+"', '1', '"+url+"')");
                } else if (field == 'published' && value == 1) {
                    document.getElementById(field).innerHTML = 'Unpublish the Story';
                    document.getElementById(field).setAttribute( "onClick", "publishFinishStory('"+field+"', '0', '"+url+"')");
                } else {
                    document.getElementById(field).innerHTML = 'Publish the Story';
                    document.getElementById(field).setAttribute( "onClick", "publishFinishStory('"+field+"', '1', '"+url+"')");
                }

                resolve(response.data);
            })
            .catch(error => {
                console.log(error);
// console.log(field);
                // reject(error.response.data);
            })
        // .catch(this.onFail.bind(this))
        // .catch(error => this.errors.record(error.response.data.errors));
    });
}


function publishStory(element) {
    console.log(element);
}