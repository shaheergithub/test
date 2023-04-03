jQuery(document).ready(function($) {
    $.ajax({
        type: 'POST',
        url: my_ajax_obj.ajax_url,
        dataType: 'json',
        data: {
            action: 'get_latest_projects'
        },
        success: function(response) {
            if ( response.success ) {
                // Loop through the projects and display them
                for ( var i = 0; i < response.data.length; i++ ) {
                    var project = response.data[i];
                    var html = '<div>';
                    html += '<a href="' + project.link + '">' + project.title + '</a>';
                    html += '</div>';
                    $('.projects_result').append(html);
                }
            } else {
                // Display an error message
                alert(response.message);
            }
        }
    });
});
jQuery(document).ready(function($) {
    var container = $('.quotes_result');

    for (var i = 0; i < 5; i++) {
        $.getJSON('https://api.kanye.rest/', function(data) {
            container.append('<p>"' + data.quote + '"</p>');
        });
    }
});
