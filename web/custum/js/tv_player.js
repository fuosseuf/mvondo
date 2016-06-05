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
    this.nbvideos = 0;
    this.rand = 1;


    this.div.find('a').each(function (index) {
        self.nbvideos += 1;
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
        var title = self.title.find('h1 a.tv-clip');
        var youtube_key = $(this).attr('data-key');
        var data_title = $(this).attr('data-title');
        var data_link = $(this).attr('data-link');
        var data_duree = $(this).attr('data-duree');
        title.attr('href', data_link);
        title.html(data_title);
        self.screen.attr('src', 'http://www.youtube.com/embed/' + youtube_key + '?autoplay=1&modestbranding=1&rel=0&showinfo=0');
        self.screen.empty();
        self.screen.load
        $('.tv-channel').each(function(){$(this).removeClass('active');});
        $(this).addClass('active');
    });

    $('.tv-channel:first').trigger('click');


//
//    setTimeout(function () {
//        $('.tv-channel:nth-child(' + this.rand + ')').trigger('click');
//        this.rand = Math.floor((Math.random() * self.nbvideos) + 1);
//        console.log(this.rand);
//    }, 10000);


}

var webtv_controll = function (id_controll, id_screen, id_header) {
    var self = this;
    this.div = $(id_controll);
    this.screenbox = $(id_screen);
    this.title = $(id_header);
    this.channel = this.div.find('.webtv-channel a');
    this.screen = this.screenbox.find('iframe');

    this.nbvideos = 0;
    this.rand = 1;
    this.videos = null;
    this.played = [];

    this.getVideos = function (link) {
        $.ajax({
            type: "GET",
            url: link,
            cache: false,
            success: function (data) {
                self.videos = data;
                self.nbvideos = data.length;
                self.rand = Math.floor((Math.random() * self.nbvideos) + 1); console.log(self.videos);
                self.launchtv(self.rand)
            }
        });
    }

    this.decodeDuration = function (duree) {
        var tab = duree.split("M");
        var sec = jQuery.grep(arr, function (n, i) {
            return (n !== 5 && i > 4);
        });
        tab.reverse();
        //PT1H28M52S
        var sec = 0;
    }

    $('.display-controll').click(function () {
        self.div.toggle();
    });


    this.channel.click(function () {
        var link = $(this).attr('data-href');
        self.getVideos(link);
    });

    this.launchtv = function (id) { console.log(id)
        var artist = self.title.find('.webtv-artist');
        var title = self.title.find('.webtv-song');
        var youtube_key = self.videos[id]['data-key'];
        var data_title = self.videos[id]['data-title'];
        var data_link = self.videos[id]['data-link'];
        var data_duree = self.videos[id]['data-duree'];
        var data_artist = self.videos[id]['data-artist'];

        title.attr('href', data_link);
        title.html(data_title);
        artist.html(data_artist);
        self.screen.attr('src', 'http://www.youtube.com/embed/' + youtube_key + '?autoplay=1&modestbranding=1&rel=0&showinfo=0');
        self.screen.empty();
        self.screen.load();
        self.played.push(id);
    }


//    setTimeout(function () {
//        while (self.played.indexOf(self.rand) != null) {
//            self.rand = Math.floor((Math.random() * self.nbvideos) + 1);
//        }
//        self.launchtv(self.rand);
//        console.log(self.rand, self.played);
//    }, 50000);


}


$(document).ready(function () {
    var tv = new tv_controll("#tv-controll", "#tv-screen", "#tv-header");
    var webtv = new webtv_controll(".webtv-controll", ".webtv-screen", ".webtv-current");
});