/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var slider = function (id_slider) {
    var self = this;
    this.div = $(id_slider);
    this.side = $(id_slider + ' .sideSlider');
    this.bottom = $(id_slider + ' .bottomSlider');
    this.slider = this.div.find('.tv-gallery');
    this.channel = this.div.find('.tv-channel');
    this.screen = this.screenbox.find('iframe');
    this.largeurCache = this.div.width();
    this.largeur = 0;
    this.nbvideos = 0;
    this.rand = 1;
}

$(document).ready(function () {
    $('a.more-infos').click(function () {
        $('.more-infos').each(function () {
            $(this).hide();
        });
        $('.less-infos').each(function () {
            $(this).show();
        });
    });
    $('a.less-infos').click(function () {
        $('.less-infos').each(function () {
            $(this).hide();
        });
        $('.more-infos').each(function () {
            $(this).show();
        });
    });
    $('a.less-infos').trigger('click');

    $('iframe').contents().find('.ytp-watermark').hide();
    var head = jQuery("iframe").contents().find("video").css('display', 'none'); 

});