//import jQuery from 'jquery';
import * as bootstrap from 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import '../less/style.less';
// import Swiper, { Pagination, Navigation } from 'swiper';
// Swiper.use([Pagination, Navigation]);
import 'swiper/swiper.less';
import 'swiper/components/navigation/navigation.less';
import 'swiper/components/pagination/pagination.less';

(function($) {

    var Defaults = $.fn.select2.amd.require('select2/defaults');

    $.extend(Defaults.defaults, {
        dropdownPosition: 'auto'
    });

    var AttachBody = $.fn.select2.amd.require('select2/dropdown/attachBody');

    var _positionDropdown = AttachBody.prototype._positionDropdown;

    AttachBody.prototype._positionDropdown = function() {

        var $window = $(window);

        var isCurrentlyAbove = this.$dropdown.hasClass('select2-dropdown--above');
        var isCurrentlyBelow = this.$dropdown.hasClass('select2-dropdown--below');

        var newDirection = null;

        var offset = this.$container.offset();

        offset.bottom = offset.top + this.$container.outerHeight(false);

        var container = {
            height: this.$container.outerHeight(false)
        };

        container.top = offset.top;
        container.bottom = offset.top + container.height;

        var dropdown = {
            height: this.$dropdown.outerHeight(false)
        };

        var viewport = {
            top: $window.scrollTop(),
            bottom: $window.scrollTop() + $window.height()
        };

        var enoughRoomAbove = viewport.top < (offset.top - dropdown.height);
        var enoughRoomBelow = viewport.bottom > (offset.bottom + dropdown.height);

        var css = {
            left: offset.left,
            top: container.bottom
        };

        // Determine what the parent element is to use for calciulating the offset
        var $offsetParent = this.$dropdownParent;

        // For statically positoned elements, we need to get the element
        // that is determining the offset
        if ($offsetParent.css('position') === 'static') {
            $offsetParent = $offsetParent.offsetParent();
        }

        var parentOffset = $offsetParent.offset();

        css.top -= parentOffset.top
        css.left -= parentOffset.left;

        var dropdownPositionOption = this.options.get('dropdownPosition');

        if (dropdownPositionOption === 'above' || dropdownPositionOption === 'below') {
            newDirection = dropdownPositionOption;
        } else {

            if (!isCurrentlyAbove && !isCurrentlyBelow) {
                newDirection = 'below';
            }

            if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
                newDirection = 'above';
            } else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
                newDirection = 'below';
            }

        }

        if (newDirection == 'above' ||
            (isCurrentlyAbove && newDirection !== 'below')) {
            css.top = container.top - parentOffset.top - dropdown.height;
        }

        if (newDirection != null) {
            this.$dropdown
                .removeClass('select2-dropdown--below select2-dropdown--above')
                .addClass('select2-dropdown--' + newDirection);
            this.$container
                .removeClass('select2-container--below select2-container--above')
                .addClass('select2-container--' + newDirection);
        }

        this.$dropdownContainer.css(css);

    };

})(window.jQuery);


jQuery.noConflict();
(function($) {


    function ThemeScript() {

        let self = this;
        const body = $('body');
        const wind = $(window);

        function initSliders() {
            if ($('.testi-slider').length) {
                new Swiper('.testi-slider .swiper-container', {
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.testi-slider .swiper-button-next',
                        prevEl: '.testi-slider .swiper-button-prev',
                    },
                    pagination: {
                        el: '.testi-slider .swiper-pagination',
                        clickable: true
                    },
                });
            }
            if ($('.testimonials-slider').length) {
                new Swiper('.testimonials-slider .swiper-container', {
                    slidesPerView: 1,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.testimonials-slider .swiper-button-next',
                        prevEl: '.testimonials-slider .swiper-button-prev',
                    },
                    pagination: {
                        el: '.testimonials-slider .swiper-pagination',
                        clickable: true
                    },
                });
            }
            if ($('.ourCustomers-slider').length) {
                new Swiper('.ourCustomers-slider .swiper-container', {
                    slidesPerView: 1,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        575: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        640: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 30,
                        },
                    },
                    spaceBetween: 30,
                    navigation: {
                        nextEl: '.ourCustomers-slider .swiper-button-next',
                        prevEl: '.ourCustomers-slider .swiper-button-prev',
                    },

                });
            }

        }

        function initToTopBtn() {
            if (wind.scrollTop() > 60) {
                body.addClass('header-small');
            }
            wind.on('scroll', function() {
                if (wind.scrollTop() > 60) {
                    body.addClass('header-small');
                } else {
                    body.removeClass('header-small');
                }
            });
        }

        function initMatchHeight() {
            $('.about-team-block-top').matchHeight();
            $('.serv-services-item-title').matchHeight();
            $('.block-lookingFor-item-title').matchHeight();
            $('.serv-services-item-cont').matchHeight();

        }
        function initMatchHeightPost() {
            $('.articles-list .post-data').matchHeight();
            $('.articles-list .post-content').matchHeight();
        }

        function intiSelect(){

            if ($('.filter_by_locations').length) {
                $(".filter_by_locations").select2({
                    placeholder: "Select location",
                    allowClear: false,
                    dropdownPosition: 'below'
                });
            }

            if ($('.filter_by_category').length) {
                $(".filter_by_category").select2({
                    placeholder: "Select category",
                    allowClear: false,
                    dropdownPosition: 'below'
                });
            }
            if ($('#filter_by_date').length) {
                $('#filter_by_date').select2({
                    minimumResultsForSearch: -1,
                    placeholder: "Select month",
                    dropdownPosition: 'below'
                });
            }

            if ($('#date_event').length) {
                $( "#date_event" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    onClose: function(dateText, inst) {
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    }
                });
            }

            $('.btn-select').on('click', function() {
                $('.file').trigger('click');
            });

            $('.file').on('change', function() {
                var fileName = $(this)[0].files[0].name;
                $('#file-name').val(fileName);
            });

        }

        function initFilterPost(){
            const ajaxurl = '/wp-admin/admin-ajax.php';
            let categoryFilter = $('#filter_by_category');
            let categoryDate = $('#filter_by_date');
            let current_category = [];

            $('.btn-loadmore').click(function(){
                let button = $(this);
                let offset = $(document).find("#posts_offset").val();
                let post_count = $(document).find("#posts_count").val();
                let post_type = $(document).find("#posts_type").val();
                // console.log(offset,post_count);
                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_loadmore',
                        offset: offset,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Loading...');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            // console.log(answer.new_offset);
                            button.text( 'More posts' );
                            $(document).find("#posts_offset").val(answer.new_offset);
                            $(document).find('.render_area').append(answer.render);
                            initMatchHeightPost();
                            if(answer.new_offset >= post_count ){
                                button.remove();
                            }
                        } else {
                            button.remove();
                        }
                    }
                });
            });

            $('#post_load_more_with_filter').click(function(){
                let button = $(this);
                let offset = $(document).find("#post_load_more_offset_with_filter").val();
                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#filter_by_date').val().split("/");
                let y = dateArray[4];
                let m = dateArray[5];
                let category = $('#filter_by_category').val();

                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_loadmore_with_filter',
                        offset: offset,
                        post_type: post_type,
                        y: y,
                        m: m,
                        category: category
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Loading...');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            // console.log(answer.new_offset);
                            button.text( 'More posts' );
                            $(document).find("#post_load_more_offset_with_filter").val(answer.new_offset);
                            $(document).find('.render_area').append(answer.render);
                            initMatchHeightPost();
                            if(answer.new_offset >= answer.post_count ){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });
            });

            categoryFilter.on("select2:select select2:unselect", function (e) {
                let items= $(this).val();
                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#filter_by_date').val().split("/");
                let y = dateArray[4];
                let m = dateArray[5];
                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_filter_post',
                        y: y,
                        m: m,
                        category: items,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {

                        $(document).find('.loader_post').show();
                        $(document).find('.post_load_more_with_filter').text('Loading...');
                        $(document).find('.render_area').html('');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            $(document).find('.btn-loadmore').remove();
                            $(document).find('.render_area').append(answer.render);
                            $(document).find('.loader_post').hide();
                            initMatchHeightPost();
                            $(document).find("#post_load_more_offset_with_filter").val(6);
                            console.log(answer.post_count );
                            if( answer.post_count <= 6){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }else{
                                $(document).find('.with_filter_load_more').css("display", "block");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });

            })

            categoryDate.on("select2:select", function (e) {

                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#filter_by_date').val().split("/");
                let y = dateArray[4];
                let m = dateArray[5];
                if (typeof y === 'undefined') {
                    $("#filter_by_date").val('').trigger('change');
                }
                let category = $('#filter_by_category').val();
                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_filter_post',
                        y: y,
                        m: m,
                        category: category,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        $(document).find('.post_load_more_with_filter').text('Loading...');
                        $(document).find('.loader_post').show();
                        $(document).find('.render_area').html('');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            $(document).find('.btn-loadmore').remove();
                            $(document).find('.with_filter_load_more').css("display", "block");
                            $(document).find('.render_area').append(answer.render);
                            $(document).find('.loader_post').hide();
                            initMatchHeightPost();
                            $(document).find("#post_load_more_offset_with_filter").val(6);
                            // console.log(answer.post_count);
                            if( answer.post_count <= 6){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });
            })
        }

        function initHeaderSearch(){
            $('.search-show').click(function(){
                $('header .search-form').show();
                $(this).hide();
                $('.search-close').show();
            });

            $('.search-close').click(function(){
                $('header .search-form').hide();
                $(this).hide();
                $('.search-show').show();
            });

            $(".collapsed").click(function() {
                // toggle the class after half second
                setTimeout(function() {
                    $("header.header").toggleClass("active");
                }, 500);
            });
        }

        function initSubjectApply(){
            let data = $('.pageb-title').data("job-title");
            if (data) {
                $('input[name="subject-info"]').val(data);
            }else{
                $('input[name="subject-info"]').val('New application');
            }
        }

        function initFilterEvent(){
            const ajaxurl = '/wp-admin/admin-ajax.php';
            let locationFilter = $('#filter_by_location');
            let locationDate = $('#date_event');
            let current_category = [];

            $('.btn-loadmore_event').click(function(){
                let button = $(this);
                let offset = $(document).find("#posts_offset").val();
                let post_count = $(document).find("#posts_count").val();
                let post_type = $(document).find("#posts_type").val();

               // console.log(offset, post_count,post_type);

                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_loadmore_event',
                        offset: offset,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Loading...');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                           // console.log(answer.new_offset);
                            button.text( 'More posts' );
                            $(document).find("#posts_offset").val(answer.new_offset);
                            $(document).find('.render_area').append(answer.render);
                            if(answer.new_offset >= post_count ){
                                button.remove();
                            }
                        } else {
                            button.remove();
                        }
                    }
                });
            });

            $('#post_load_more_with_filter').click(function(){
                let button = $(this);
                let offset = $(document).find("#post_load_more_offset_with_filter").val();
                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#filter_by_date').val().split("/");
                let y = dateArray[4];
                let m = dateArray[5];
                let category = $('#filter_by_category').val();

                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_loadmore_with_filter',
                        offset: offset,
                        post_type: post_type,
                        y: y,
                        m: m,
                        category: category
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Loading...');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            //console.log(answer.new_offset);
                            button.text( 'More posts' );
                            $(document).find("#post_load_more_offset_with_filter").val(answer.new_offset);
                            $(document).find('.render_area').append(answer.render);
                            if(answer.new_offset >= answer.post_count ){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });
            });

            locationFilter.on("select2:select select2:unselect", function (e) {
                let items= $(this).val();
                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#date_event').val().split(" ");
                let y = dateArray[0];
                let m = dateArray[1];


                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_locations_filter_post_event',
                        y: y,
                        m: m,
                        location: items,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        $(document).find('.with_filter_load_more').css("display", "none");
                        $(document).find('.btn-loadmore').remove();

                        $(document).find('.post_load_more_with_filter').text('Loading...');
                        $(document).find('.render_area').html('');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            $(document).find('.btn-loadmore').remove();
                            $(document).find('.with_filter_load_more').css("display", "block");
                            $(document).find('.render_area').append(answer.render);
                            $(document).find("#post_load_more_offset_with_filter").val(6);
                           // console.log(answer.post_count );
                            if( answer.post_count <= 3){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });

            })

            categoryDate.on("select2:select", function (e) {

                let post_type = $(document).find("#posts_type").val();
                let dateArray = $('#filter_by_date').val().split("/");
                let y = dateArray[4];
                let m = dateArray[5];
                let category = $('#filter_by_category').val();
                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'aaseya_filter_post',
                        y: y,
                        m: m,
                        category: category,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        $(document).find('.post_load_more_with_filter').text('Loading...');
                        $(document).find('.render_area').html('');
                    },
                    success : function( data ){
                        if( data ) {
                            var answer = JSON.parse(data);
                            $(document).find('.btn-loadmore').remove();
                            $(document).find('.with_filter_load_more').css("display", "block");
                            $(document).find('.render_area').append(answer.render);
                            $(document).find("#post_load_more_offset_with_filter").val(6);
                        //    console.log(answer.post_count);
                            if( answer.post_count <= 6){
                                $(document).find('.with_filter_load_more').css("display", "none");
                            }
                        } else {
                            $(document).find('.with_filter_load_more').css("display", "none");
                        }
                    }
                });
            })
        }

        self.run = function() {
            initSliders();
            initToTopBtn();
            initMatchHeight();
            initMatchHeightPost();
            intiSelect();
            initHeaderSearch();
            initFilterPost();
            initSubjectApply();
            // initFilterEvent();
        }

    }


    $(function() {
        let ts = new ThemeScript();
        ts.run();
    });

})(jQuery);


