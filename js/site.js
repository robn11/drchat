$(function() {

    var url = window.location.href;
    console.log(url);
    element = $('ul.navbar-nav li a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();
    
});