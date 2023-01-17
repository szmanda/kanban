import './js/jquery.instantSearch.js';

$(function() {
    $('.search-field')
        .instantSearch({
            delay: 100,
            itemTemplate: '\
                <div class="card">\
                    <h4><a href="{{ url }}">{{ title }}</a></h4>\
                </div>',
        })
        .keyup();
});