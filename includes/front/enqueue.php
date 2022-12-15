<?php

function eic_glowsquad_enqueue()
{
    //Styles for the slider
    wp_enqueue_style('eic-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [], null, 'all');
    wp_enqueue_style('eic-glider', EIC_GLOW_DIR . 'assets/swiper/swiper-bundle.min.css', [], null, 'all');
    wp_enqueue_style('ldb-roi-styles', EIC_GLOW_DIR . 'assets/styles.css', [], null, 'all');

    // Scripts
    wp_enqueue_script('eic-swiper-js', EIC_GLOW_DIR . 'assets/swiper/swiper-bundle.min.js', [], null, true);
    wp_enqueue_script('eic-swiper-settings', EIC_GLOW_DIR . 'assets/eic-squad.js', ['eic-swiper-js'], null, true);
    wp_enqueue_script('eic-selectors', EIC_GLOW_DIR . 'assets/slider-app.js', [], null, true);
}
