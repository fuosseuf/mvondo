/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('a.more-infos').click(function(){
        $('.more-infos').each(function(){ 
            $(this).hide();
        });
        $('.less-infos').each(function(){ 
            $(this).show();
        });
    });
    $('a.less-infos').click(function(){
        $('.less-infos').each(function(){ 
            $(this).hide();
        });
        $('.more-infos').each(function(){ 
            $(this).show();
        });
    });
    $('a.less-infos').trigger('click');

});