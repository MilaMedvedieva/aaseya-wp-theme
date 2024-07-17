<?php /* Template Name: Contact page */ ?>
<?php get_header(); ?>
    <?php
        $is_show_testi = get_field('is_visible_testimonials');
        $paralax_img = '';
        if (has_post_thumbnail()) {
            $paralax_img = '<div class="parallax-window" data-parallax="scroll" data-image-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"></div>';
        }

        $locations_list = get_field('locations_list');
        $locations_title = get_field('locations_title');
    ?>
    <section class="paget">
        <?php echo $paralax_img; ?>
        <div class="paget-inner">
            <div class="paget-top">
                <div class="container">
                    <?php the_crumbs(); ?>
                </div>
            </div>
            <div class="paget-bottom">
                <div class="container">
                    <h1 class="paget-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageb contpage-pageb">
        <div class="container">
            <div class="pageb-row">
                <div class="pageb-col pageb-col-l">
                    <?php if (get_field('addition_title')) { ?>
                        <p class="pageb-title title title-2"><?php the_field('addition_title'); ?></p>
                    <?php } else { ?>
                        <p class="pageb-title title title-2"><?php the_title(); ?></p>
                    <?php } ?>
                </div>
                <div class="pageb-col pageb-col-r">
                    <div class="pageb-content content">
                        <?php the_content(); ?>
                    </div>
                    <p class="contpage-email"><?php the_field('email_field'); ?></p>
                    <div class="contpage-form form">
                        <?php echo do_shortcode('[contact-form-7 id="58" title="Contact form" html_class="use-floating-validation-tip"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(isset($locations_list) && !empty($locations_list)): ?>
    <section class="pabeb contpage-location">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="pageb-title title title-2"><?php echo $locations_title;?></p>
                </div>

                <div class="col-12">
                    <div id='map' class='contpage-location-map col-12 map'></div>
                </div>
                <div class="col-12">
                    <div class="contpage-location-list">
                        <?php foreach ($locations_list as $value): ?>
                            <div class="item">
                                <p class="pageb-title title title-2"><?php echo $value['name'];?></p>
                                <div class="row">
                                    <?php foreach ($value['location'] as $location): ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 content">
                                            <?php echo $location['content'];?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if($is_show_testi): get_template_part( 'partials/testimonials' ); endif; ?>
    <?php get_template_part( 'partials/lookingFor' );  ?>
    <?php get_template_part( 'partials/ourCustomers' );  ?>


<?php get_footer(); ?>

<script type="text/javascript">
    var cities = [ <?php $i = 1; foreach ($locations_list as $value): foreach ($value['location'] as $location):?>{"model": "locations.location", "fields": {"map_display": true, "office_address": "<?php echo $location['address_popap'];?>", "office_city": "<?php echo $location['city'];?>", "office_country": "<?php echo $location['country'];?>", "latitude": "<?php echo $location['latitude'];?>", "longitude": "<?php echo $location['longitude'];?>"}},<?php $i++; endforeach; endforeach; ?>];
</script>
<script type="text/javascript">
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXNqb2huc2NvdHQiLCJhIjoiY2twNzFuMmw2MGE0bjJ1bXR5M3lvaWJobCJ9.Ico6jdFAKaM8ZhzoDAvEVw';
    var start = [-74.5, 40];
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/chrisjohnscott/ckp73u8uq3f8n18ojhkm4h0dr',
        center: start,
        zoom: 1,
        scrollZoom: true
    });
    var isAtStart = true;

    map.addControl(new mapboxgl.NavigationControl());
    cities.forEach(function (store, i) {
        store.id = i;
    });
    map.on('load', function (e) {
        map.addSource("places", {
            "type": "geojson",
            "data": cities
        });
        addMarkers();
    });

    function setZoomDefault(){
        var target = isAtStart ? '' : start;
        map.flyTo({
            center: target,
            zoom: 1,
            bearing: 0,
            speed: 3,
            curve: 1,
            easing: function (t) {
                return t;
            },
            essential: true
        });
    }
    function addMarkers() {
        cities.forEach(function (marker) {
            /* Create a div element for the marker. */
            var el = document.createElement('div');
            /* Assign a unique `id` to the marker. */

            el.id = "marker-" + marker.id;
            /* Assign the `marker` class to each marker for styling. */

            el.className = 'marker grown';

            new mapboxgl.Marker(el, {
                offset: [0, -23]
            }).setLngLat([marker.fields.longitude, marker.fields.latitude]).addTo(map);
            var pin = document.createElement('div');
            document.getElementById("marker-" + marker.id).appendChild(pin);
            /* Assign the `pin` class to each marker for styling. */

            pin.className = 'pin';

            el.addEventListener('click', function (e) {
                /* Fly to the point */
                flyToStore(marker);
                /* Close all other popups and display popup for clicked store */

                createPopUp(marker);
                /* Highlight listing in sidebar */

                var activeItem = document.getElementsByClassName('active');
                e.stopPropagation();

                if (activeItem[0]) {
                    activeItem[0].classList.remove('active');
                } // var listing = document.getElementById('listing-' + marker.id);
                // listing.classList.add('active');

            });

        });
    }

    function flyToStore(currentFeature) {
        map.flyTo({
            center: [currentFeature.fields.longitude, currentFeature.fields.latitude],
            zoom: 17
        });
    }

    function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();
        var popup = new mapboxgl.Popup({
            closeOnClick: false
        }).setLngLat([currentFeature.fields.longitude, currentFeature.fields.latitude]).setHTML('<h4>' + currentFeature.fields.office_city  + '</h4>' + '<div class="inner">' + (currentFeature.fields.office_address ? '<p>' + currentFeature.fields.office_address + '<p>' : "") + (currentFeature.fields.office_country ? '<p>' + currentFeature.fields.office_country + '<p>' : "")  + '</div>').addTo(map);

        document.querySelector('.mapboxgl-popup-close-button').onclick = function(e) {
            setZoomDefault();
        }
    }
</script>
