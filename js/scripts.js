$(document).ready(function () {
    var $checkList = $('[data-check-list]');

    //Скрипты для главной страницы

    // выбор варианта в голосовании
//    $('.poll-variant-item').on('click', function (e) {
//        var $this = $(this);
//
//        if ($this.hasClass('selected')) {
//            $this.removeClass('selected')
//                .find('input').prop('checked', false);
//        } else {
//            $this.addClass('selected')
//                .find('input').prop('checked', true);
//        }
//
//        e.preventDefault();
//    });

    // Скрытие и отправки формы с результатми голосования
    $('.poll-bl-inner').on('submit', function (e) {
        $(this).closest('.poll-bl').slideUp(200);
        e.preventDefault();
    })

    // Новость с несколькими картинками на главной странице
    $('.slider-list-item-img').on('click', function(e){
        var $this = $(this),
            $container = $this.closest('.simple-slider'),
            $imgMain = $container.find('.slider-content-img');

        $imgMain.css({
            backgroundImage: 'url(' + $this.attr('href') +')'
        });

        e.preventDefault();
    })

    // Скрыть/Показать комментарии
    $('body').on('click', '.comment-toggle', function(e){
        $('.comment-all').slideToggle();
        e.preventDefault();
    })


    // Логика работы для каталога в левой части детальнйо страницы
    $checkList.length && $checkList.selectList();

    // Отметить все пункты в каталоге
    $('.sidebar-title-link').click( function(e){
        var $this = $(this),
            $selectList = $('[data-check-list]'),
            dataPlugin = $selectList.selectList().data('selectList'),
            $allCheckbox = $selectList.find('.catalog-main-check');

        if ($this.hasClass('selected')){
            $this.removeClass('selected');
            dataPlugin.unCheck($allCheckbox);
        } else {
            $this.addClass('selected');
            dataPlugin.check($allCheckbox);
        }
        e.preventDefault();
    });

    // Меняем внешний вид пункта в каталоге, если у него есть подменю
    $('.catalog-main li').each( function(){
        var $this = $(this);

        if ($this.find('ul').length){
            $this.addClass('have-submenu');
        }
    })

    // фиксируем верхнее меню
    $(window).scroll( function(){
        var windowTop = $(window).scrollTop();

        if (windowTop > 82){
            $('.header-fixed').css({
                top: '-50'
            }).addClass('fixed-position');
        } else {
            $('.header-fixed').removeClass('fixed-position').css({
                top: 0
            })
        }
    })

    // попап авторизации
    //$('.js-show-enter').on('click', function(e){
    //    $('.popup-bg').fadeIn(200, function(){
    //        $('.popup-container').fadeIn();
    //    });
    //
    //    e.preventDefault();
    //});
    //
    //$('.js-close-popup').on('click', function(e){
    //    $('.popup-container').fadeOut(200, function(){
    //        $('.popup-bg').fadeOut();
    //    });
    //
    //    e.preventDefault();
    //})

    // кроссбраузерный чекбокс
    $('.check-simple').on('click', function(e){
        var $this = $(this),
            $checkbox = $this.find('.check-simple-input');

        if ($this.hasClass('selected')){
            $checkbox.prop('checked', false);
            $this.removeClass('selected');
        } else {
            $checkbox.prop('checked', true);
            $this.addClass('selected');
        }

        e.preventDefault();
    });

    $('.check-simple').each( function(){
        var $this = $(this),
            $checkbox = $this.find('.check-simple-input');

        if ($checkbox.prop('checked')){
            $this.addClass('selected');
        }
    })
    
    //Audio & video player
    if( $('audio').size() > 0 || $('video').size() > 0 ) $('audio,video').mediaelementplayer();
    
    //Fixed crumbs
    if( $('.breadcrumbs-bl').size() > 0 ){
        var crumbs = $('.breadcrumbs-bl'),
            crumbs_top = crumbs.offset().top,
            space_plus = $('.header-fixed').outerHeight(),
            crumbs_margin = parseInt( crumbs.css('marginTop') );
        $(window).scroll(function() {
            var window_scroll = $(window).scrollTop();
            if (window_scroll > (crumbs_top - space_plus - crumbs_margin) ) {
                crumbs.addClass('fixed');
                $('.breadcrumbs-bl.fixed').css({'top': space_plus});
                if( !$('.crumbs-boofer').size() > 0 ) crumbs.after('<div class="crumbs-boofer"></div>').css({'width':'100px;'});
                crumbs.next('.crumbs-boofer').outerWidth( crumbs.outerWidth() ).outerHeight( crumbs.outerHeight() );
            } else {
                crumbs.removeClass('fixed');
                if( $('.crumbs-boofer').size() > 0 ) crumbs.next('.crumbs-boofer').remove();
            }
        });
    }
    
    //Fixed asside
    if( $('.be-fixed').size() > 0 ){
        var fixEl = $('.be-fixed'),
            fixEl_top = fixEl.offset().top,
            spaceFix_plus = $('.header-fixed').outerHeight() + $('.breadcrumbs-bl').outerHeight() + parseInt( $('.breadcrumbs-bl').css('marginTop') );
        $(window).scroll(function() {
            var window_scroll = $(window).scrollTop();
            if (window_scroll > (fixEl_top - spaceFix_plus) ) {
                fixEl.addClass('fixed');
                $('.be-fixed.fixed').css({'top': spaceFix_plus});
                if( !$('.be-fixed_boofer').size() > 0 ){ 
                    fixEl.after('<div class="be-fixed_boofer"></div>').css({'width':'100px;'});
                    setTimeout(function(){ fixHeight(fixEl, spaceFix_plus); }, 100);
                    
                }
                fixEl.next('.be-fixed_boofer').outerWidth( fixEl.outerWidth() ).outerHeight( fixEl.outerHeight() );
            } else {
                fixEl.removeClass('fixed');
                if( $('.be-fixed_boofer').size() > 0 ) fixEl.next('.be-fixed_boofer').remove();
            }
        });
        function fixHeight(el, top){
            var bottom = $('footer').outerHeight();
            var screen = $(window).height();
            var max_height = screen -top - bottom;
            
            el.children(':not(.fix-nicescroll)').each(function(){
                max_height -= $(this).outerHeight(true);
            });
            var el_scroll = el.children('.fix-nicescroll');
            el_scroll.outerHeight( max_height ).niceScroll({
                cursorcolor : "#ff7f0a",
                cursorwidth : "3px",
                cursorborder : "none",
                cursorborderradius : 0,
                horizrailenabled : false
            });
            $(window).bind('scroll', function() {
                el_scroll.getNiceScroll().resize();
            });
            
            
//             el.getNiceScroll().resize();
            console.log(max_height);
        }
    }
    
    //Category - active all block
    $('.category-block.active .category-block_body').click(function(){
        $(this).parents('.category-block.active').find('a').click();
    });
    
    //Mask input
    if( $('#phone-register').size() > 0 ) $('#phone-register').mask("8(99)99-99-999",{placeholder:"8(__)__-__-___"});
    
    //Карта google
    function initialize() {
        var options = {
            center: new google.maps.LatLng(53.933645, 27.601322),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: true,
            scaleControl: false,
            streetViewControl: false,
            
        };
        var map = new google.maps.Map(document.getElementById("map"), options);
         var image = 'images/pointer.png';
        var pointer_position = new google.maps.LatLng(53.933435, 27.590322);
        var pointer = new google.maps.Marker({
            position: pointer_position,
            map: map,
            icon: image
        });
    }
    if ($('#map').size() > 0) {
        initialize();
    }
    
    //Error input
    $('input.error').focus(function(){
        $(this).removeClass('error').parents('.standart-error').removeClass('standart-error').find('.error-text').remove();
    });
    
    //Calendar
    if( $('.datepicker').size() > 0 ){
        $( '.datepicker' ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd.mm.yy",
                yearRange: "1920:2010"
            });
    }
    
    $(document).on('click','.js-toggle-active', function(){
        $(this).toggleClass('active');
        return false;
    });
    
    //Accordeon
    $(document).on('click','.js-accordeon_head', function(){
        var acc_head = $(this),
            acc_block = acc_head.parents('.js-accordeon'),
            acc_body = acc_block.find('.js-accordeon_body');
        if( !acc_head.hasClass('active') ){
            acc_body.show();
            acc_block.addClass('active');
            acc_head.addClass('active');
        }else{
            acc_body.hide();
            acc_block.removeClass('active');
            acc_head.removeClass('active');
        }
        return false;
    });
    
    //Tabs
    $(document).on('click', '.js-tabs_head > [data-tab]', function(){
        if( !$(this).hasClass('active') ){
            var new_tab = $(this).attr('data-tab');
            var tabs_wrapper = $(this).parents('.js-tabs');
            tabs_wrapper.find('.js-tabs_head > .active').removeClass('active');
            $(this).addClass('active');
            tabs_wrapper.find('.js-tabs_body.active').removeClass('active').hide();
            tabs_wrapper.find('.js-tabs_body[data-tab="' + new_tab + '"]').addClass('active').show();
        }
        return false;
    });
    
    //Shop filtr
    $(document).on('change','.shop-filtr input[type="checkbox"]', function(){
        var check = $(this);
        if( check.parent('.js-accordeon').size() > 0 ){
            if( check.prop('checked') ){
                check.parent('.js-accordeon').find('input[type="checkbox"]').prop({'checked':true});
            }else{
                check.parent('.js-accordeon').find('input[type="checkbox"]').prop({'checked':false});
            }
        }
        if( check.parents('.js-accordeon_body').size() > 0 ){
            check.parents('.js-accordeon').children('input[type="checkbox"]').prop({'checked':false});
        }
    });
    
    //Ограничение численного инпута (колличество в корзине, попап стоимости доставки)
    var max_c = 99;                                //МАКСИМАЛЬНОЕ КОЛЛИЧЕСТВО ТОВАРОВ
    var p_m_inp = $('.tovar_action_count input');
    p_m_inp.bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
    p_m_inp.blur("change keyup input click", function() {
        if (this.value == '') {
            this.value = 1;
        }
        if (parseInt(this.value) > max_c) {
            this.value = max_c;
        }
    });
    p_m_inp.change(function() {
        var val = parseInt($(this).val());
        if (val > max_c) {
            $(this).val(max_c);
        }
        if (val <= 1) {
            $(this).val("1");
        }
    });
    p_m_inp.bind("focus", function() {
        this.value = '';
    });
    //Кнопки +-
    if( $('.tovar_action_count').size() > 0 ){
        
        $('.tovar_action_count').each(function(){
            plusminusDisabled($(this));
        });
        
    }
    $('.tovar_action_count button').click(function(){
        if( !$(this).hasClass('disabled') ){
            var input = parseInt($(this).parent().find('input').val());
            if( $(this).hasClass('minus') ) input--;
            if( $(this).hasClass('plus') ) input++;
            $(this).siblings('input').val(input).trigger('change');;
            plusminusDisabled( $(this).parent() );
        }
        return false;
    });


    function plusminusDisabled(plusminus){
        $('.tovar_action_count').each(function(){
            var input = parseInt(plusminus.find('input').val()),
                buttons = plusminus.children('button'),
                plus = plusminus.children('.plus'),
                minus = plusminus.children('.minus');
            buttons.removeClass('disabled');
            if (input >= max_c) plus.addClass('disabled');
            if (input <= 1)  minus.addClass('disabled');
        });
    }
    $('.select-wrapper select').each(function(){
        $(this).chosen({disable_search_threshold: 10});
    });
});

(function($){
    function SelectionList(options, element) {
        this.options = $.extend({}, options);
        this.$el = $(element);

        this.init();
    }

    SelectionList.prototype.init = function () {
        var self = this,
            $allCheckbox = this.$el.find('.catalog-main-check-inner'),
            $allSubmenu = this.$el.find('ul');

        this.$el
            .on('click', '.catalog-main-check', function (e) {
                self.toggleCheck(this);
                e.preventDefault();
            })
            .on('click', '.catalog-main-link', function (e) {
                self.toggleSubmenu(this);
                e.preventDefault();
            });

        $allCheckbox.each( function(){
            var $this = $(this);

            if ($this.is(':checked')){
                $this.closest('.catalog-main-check').addClass('selected');
            }
        })

        $allSubmenu.slideUp();

    }

    SelectionList.prototype.toggleSubmenu = function(element){
        var $el = $(element),
            $elContainer = $el.closest('li').find('ul'),
            $checkboxCon;

        if ($elContainer.length){
            $elContainer.slideToggle()
        } else {
            $checkboxCon = $el.closest('li').find('.catalog-main-check').first();
            this.toggleCheck($checkboxCon.eq(0));
        }
    }

    SelectionList.prototype.toggleCheck = function (element) {
        var $el = $(element),
            $check = $el.find('input'),
            $otherInnercheckbox;

        if ($check.is(':checked')) {
            this.unCheck($el);
            $otherInnercheckbox = $el.closest('li').find('.catalog-main-check').not($el);
            this.unCheck($otherInnercheckbox);

        } else {
            this.check($el);
            $otherInnercheckbox = $el.closest('li').find('.catalog-main-check').not($el);
            this.check($otherInnercheckbox);
        }
    }

    SelectionList.prototype.unCheck = function ($elements) {
        $elements.each(function () {
            $(this).removeClass('selected')
                .find('input').prop('checked', false)
        })
    }

    SelectionList.prototype.check = function ($elements) {
        $elements.each(function () {
            $(this).addClass('selected')
                .find('input').prop('checked', true);
        })
    }

    $.fn['selectList'] = function (options) {
        return this.each(function () {
            var $this = this,
                data = $.data(this, 'selectList');

            if (!data) {
                data = new SelectionList(options, this);
                $.data(this, 'selectList', data);
            }

            if (typeof options == "string"){
                data[options] && data[options]();
            }
        });
    }

})(jQuery)

//Security data
var max_lenght = 0;
function getSelectedText(){
    var text = "";
    if (window.getSelection) {
        text = window.getSelection();
    }else if (document.getSelection) {
        text = document.getSelection();
    }else if (document.selection) {
        text = document.selection.createRange().text;
    }
    return text.toString();
}
function addLink() {
    var body_element = document.getElementsByTagName('body')[0];
    var selection;
    var pagelink;
    selection = window.getSelection();
    pagelink = "Копирование информации разрешено только с согласия администрации портала LSGA";
    
    var copytext = pagelink;
    var newdiv = document.createElement('div');
    newdiv.style.position = 'absolute';
    newdiv.style.left = '-99999px';
    body_element.appendChild(newdiv);
    newdiv.innerHTML = copytext;
    selection.selectAllChildren(newdiv);
    window.setTimeout(function() {
        body_element.removeChild(newdiv);
    }, 0);
}
document.onkeyup = function(e) {
    if (e.keyCode == 44) {
        document.getElementsByTagName('html')[0].hidden = true;
        window.setTimeout(function() {
            document.getElementsByTagName('html')[0].hidden = false;
        }, 50);
    }
};
document.oncopy = addLink;



var document_scroll = 0;
function popUp(type){
    var popup = $('.popup#' + type),
        popup_body = popup.find('article');
    document_scroll = $(window).scrollTop();
    popup.css({
        'opacity': 0,
        'display': 'block'
    });
    var popup_height = popup.height();
    popup.css({
        'margin-top': -(popup_height/2)
    });
    $('.mask_popup').fadeIn(250);
    popup.animate({'opacity': 1}, 200).addClass('active');
    $(document).bind('click.myEvent', function(e) {
        if ($(e.target).closest(popup_body).length == 0  ) {
            if( $('.ui-datepicker').size()>0 && !$('.ui-datepicker').is(':hidden') )return false;
            closePopUp();
            $(document).unbind('click.myEvent');
        }
    });
    popupControlHeight();
    return false;
}
    
function closePopUp(){
    var popup = $('.popup.active');
    popupControlHeight_Clear();
    popup.removeClass('active').animate({'opacity': 0}, 200, function(){
        popup.css({
            'display': 'none'
        });
        $(document).unbind('click.myEvent');
    });
    $('.mask_popup').fadeOut(250);
    if( document_scroll > 0 ) $('html,body').scrollTop(document_scroll);
    return false;
}
function changePopUp(type){
    var popup = $('.popup.active');
    popup.removeClass('active').animate({'opacity': 0}, 200, function(){
        popup.css({
            'display': 'none'
        });
        $(document).unbind('click.myEvent');
        popUp(type);
    });
    
    return false;
}

function popupControlHeight(){
//    var popup = $('.popup.active'),
//        window_height = $(window).height();
//    $('body').addClass('freeze');
//    $('body > *:not(.mask_popup, .popup)').each(function() {
//        var block = $(this);
//        if (!(block.css('position') == 'absolute') && !(block.css('position') == 'fixed')) {
//            var top = (block.offset().top - document_scroll),
//                    left = block.offset().left;
//            block.css({'top': top, 'left': left});
//            setTimeout(function() {
//                block.addClass('fixed-block');
//            }, 250);
//        }
//    });
//    if( popup.height() > window_height ){
//        popup.addClass('popup-absolute');
//    }else if( popup.hasClass('popup-absolute') ){
//        popup.removeClass('popup-absolute');
//    }
}
function popupControlHeight_Clear(){
//    var popup = $('.popup.active');
//    popup.removeClass('popup-absolute');
//    $('body').removeClass('freeze');
//    $('body > *.fixed-block').each(function() {
//        var block = $(this);
//        block.css({'top': '', 'left': ''});
//        block.removeClass('fixed-block');
//    });
}

jQuery(function ($) {
    $('.popup-open').bind('click', function(){
        var type = $(this).attr('data-key');
        popUp(type);
        return false;
    });
    $('.close-popup, .popup .close').bind('click', function(){
        closePopUp();
        return false;
    });
    $('.popup-change').bind('click', function(){
        var type = $(this).attr('name');
        changePopUp(type);
        return false;
    });
    
    $(window).resize(function() {
        if( $('.popup.active').size() > 0 ) popupControlHeight();
    }).resize();
    
});

jQuery(function($){
    if( $( ".datepicker" ).size()>0 ){
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '&#x3C;Пред',
		nextText: 'След&#x3E;',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Нед',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
    }
});


function addToCartIndex(element, goods_id, count)
{
    $.ajax({
        data: { goods_id : goods_id, count:count },
        dataType: 'json',
        type: 'POST',
        url: '/shop/addToCart',
        success: function (data) {
            if (data.success == 1) {
                $(element).parents('.tovar').addClass("active");
                $(element).addClass("hidden");
                $(element).siblings("span").removeClass("hidden");
                $(element).siblings("a").removeClass("hidden");
            }
            else {
                alert("Произошла ошибка добавления товара в корзину.")
            }
        }
    });
}

function addToCartGoodsPage(element, goods_id)
{
    var count = $('.tovar_action_count input').val();

    $.ajax({
        data: { goods_id : goods_id, count:count },
        dataType: 'json',
        type: 'POST',
        url: '/shop/addToCart',
        success: function (data) {
            if (data.success == 1) {
                var parent = $(element).parent();
                $(element).remove();
                $('div.tovar_action_count').remove();
                parent.append('<a href="/shop/cart" class="btn-simple pull-right tovar_action_buy"><span>Оформить</span></a>');
            }
            else {
                alert("Произошла ошибка добавления товара в корзину.")
            }
        }
    });
}

function changeValCountCart(col){
    document.body.style.cursor = 'wait';
    var price = $(col).parents("tr").find(".tovar_cost input:hidden").val();
    var count = $(col).val();

    var id = $(col).parents("tr").prop('id');
    $.ajax({
        data: { id : id, count:count },
        dataType: 'json',
        type: 'POST',
        url: '/shop/changeCountCart',
        success: function (data) {
            if (data.success == 1) {
                document.body.style.cursor = 'default';
                $(col).parents("tr").find(".tovar_cost strong").text(price*count);
                var all = $(".tovar_cost strong");
                var allsum = 0;
                for (var i=0; i<all.length; i++){
                    allsum += parseInt(all.eq(i).text());
                }
                $("tr:last").find(".summary-cost strong").text(allsum);

                CalculateDiscount();
            }
            else {
                alert("Произошла ошибка")
            }
        }
    });

}
function CalculateDiscount(){
    /**
     *
     Если у клиента до 100 кредитов он получает скидку по принципу:
     Количество кредитов за которые клиент хочет получить скидку / (цена товара в корзине/100)/4.
     Если у клиента больше 100 кредитов он получает скидку по принципу:
     Количество кредитов за которые клиент хочет получить скидку / (цена товара в корзине/100)/1,2
     */

  var credits = $('.sale_credits').text();
  var credits_input = $('.sale_input input').val();
    var allsum = $("tr:last").find(".summary-cost strong").text();
    var discount =0;
    //if (credits<credits_input)
    //{
    //    alert("У вас не хватает кредитов")
    //}
    //else
    //{
            if (credits >= 100)
            {
              discount = credits_input/(allsum/100)/4;
            }
        else
        {
            discount = credits_input/(allsum/100)/1.2;
        }
    //}
        var procent_discount = Math.floor(discount*Math.pow(10, 2))/Math.pow(10, 2); //округление до 2 знаков
        $('.summary-sale').text(procent_discount+'%');
    var new_price = Math.floor(allsum-((allsum*procent_discount)/100))//округление
    $(".summary-cost.pull-right strong").text(new_price);

}

function RemoveFromBasket(col){
    var id = $(col).parents("tr").prop('id');
    document.body.style.cursor = 'wait';
    $.ajax({
        data: { id : id },
        dataType: 'json',
        type: 'POST',
        url: '/shop/delete',
        success: function (data) {
            if (data.success == 1) {
                document.body.style.cursor = 'default';
                //$('.basket table tr#'+id).remove();
            location.reload();
            }
            else {
                alert("Произошла ошибка")
            }
        }
    });
        console.log(id)
}