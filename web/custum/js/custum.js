/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tv_controll = function (id_controll, id_screen, id_header) {
    var self = this;
    this.div = $(id_controll);
    this.screenbox = $(id_screen);
    this.title = $(id_header);
    this.slider = this.div.find('.tv-gallery');
    this.channel = this.div.find('.tv-channel');
    this.screen = this.screenbox.find('iframe');
    this.largeurCache = this.div.width();
    this.largeur = 0;


    this.div.find('a').each(function (index) {
        self.largeur += $(this).width();
        self.largeur += parseInt($(this).css('margin-left'));
        self.largeur += parseInt($(this).css('padding-left'));
        self.largeur += parseInt($(this).css('margin-right'));
        self.largeur += parseInt($(this).css('padding-right'));
    });

    this.next = this.div.find('.tv-next');
    this.previous = this.div.find('.tv-previous');

    this.saut = this.largeurCache / 2;
    this.nbetapes = Math.ceil(this.largeur / this.saut - this.largeurCache / this.saut);
    this.courant = 0;

    this.next.click(function () {
        if (self.nbetapes >= self.courant) {
            self.courant++;
            self.slider.animate({
                left: -self.saut * self.courant
            }, 1000);
        }
    });

    this.previous.click(function () {
        if (self.courant > 0) {
            self.courant--;
            self.slider.animate({
                left: -self.saut * self.courant
            }, 1000);
        }
    });

    this.channel.click(function () {
        
        var title = self.title.find('h1 a');
        var youtube_key = $(this).attr('data-key');
        var data_title = $(this).attr('data-title');
        var data_link = $(this).attr('data-link');
        title.attr('href', data_link);
        title.html(data_title);
        self.screen.attr('src', 'http://www.youtube.com/embed/' + youtube_key + '?autoplay=1&modestbranding=1&rel=0&showinfo=0');
        self.screen.empty();
        self.screen.load();
    });
    
    $('.tv-channel:first').trigger('click');
}

$(document).ready(function () {

    $("#header").click(function () {
        $("#branding").velocity("fadeIn", {duration: 1500})
                .velocity("fadeOut", {delay: 500, duration: 1500});
    });

    var tv = new tv_controll("#tv-controll", "#tv-screen", "#tv-header")



});