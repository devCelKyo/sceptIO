function descendre_rideau() {
    $('#red-wrapper').animate({top: "0%"}, 1000);
}

function monter_rideau() {
    $('#red-wrapper').animate({top: "-100%"}, 1000);
}

function switchTo(page_name) {
    var url = page_name + '.html';
    $.ajax({
        url: url,
        dataType: 'html',
        success: function(data) {
            document.getElementById('app').innerHTML = data;
        }
    });
    navigationClickHook();
}

function navigationClickHook() {
    $(".navigation-button").click(function() {
        var destination = $(this).attr('destination');
        var load = $(this).attr('load');

        console.log('cece');
    
        PREVIOUS_PAGE = ACTIVE_PAGE;
        ACTIVE_PAGE = destination;
    
        if (load == 'true') {
            switchAndLoad(destination);
        }
        else {
            switchTo(page_name);
        }
    });
}

function switchAndLoad(page_name) {
    descendre_rideau();
    setTimeout(function() { switchTo(page_name);
                            setTimeout(function() {
                                monter_rideau();
                            }, 1000)}, 1100);
}

var ACTIVE_PAGE = 'main-page';
var PREVIOUS_PAGE;

$(document).ready(function() {
navigationClickHook();

});