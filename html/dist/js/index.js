"use strict";$(document).ready(function(){$(".footer__button").click(function(){$(".footer__hidden").slideToggle()}),$(".slider--main").slick({arrows:!1,infinite:!1,dots:!0,customPaging:function(t,e){var o=$(t.$slides[e]).data("title");return"<button>".concat(o,"</button>")},fade:!0,swipe:!1,adaptiveHeight:!0}),$(".slider--secondary").slick({infinite:!1,dots:!0,prevArrow:'<button type="button" class="slick-prev"></button>',nextArrow:'<button type="button" class="slick-next"></button>',responsive:[{breakpoint:993,settings:{arrows:!1}}]}),$(".hamburger").click(function(){$(this).toggleClass("is-active"),$(".toolbar__mobile").slideToggle()}),ymaps.ready(function(){var t=new ymaps.Map("map",{center:[53.199595,50.10561],zoom:16,controls:["smallMapDefaultSet"]});t.behaviors.disable("scrollZoom");ymaps.templateLayoutFactory.createClass("<div></div>");var e=new ymaps.Placemark(t.getCenter(),{balloonContent:"ул.Ульяновская д.19"},{iconLayout:"default#image",iconImageHref:"../img/map-mark.png",iconImageSize:[25,32],iconImageOffset:[-5,-38]});t.geoObjects.add(e)})});