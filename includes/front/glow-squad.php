<?php


function eic_glow_squad_slider()
{
    $args = [
        'post_type' => 'member',
        'posts_per_page' => 100
    ];

    $membersQuery = new WP_Query($args);

    $locations = get_terms([
        'taxonomy' => 'location',
        'order' => 'DSC'
    ]);

    $counter = 0;

    ob_start();
?>
    <section id="glowSquadSlider">

        <div id="swiper_allLocations" class="swiper-eic-slider">
            <div class="swiper-wrapper">
                <?php while ($membersQuery->have_posts()) : $membersQuery->the_post(); ?>
                    <div class="swiper-slide">
                    <div class="slide ">
                        <?php if (get_the_post_thumbnail_url() != null) : ?>
                            <div class="img-box">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_title() . ' photograph' ?>">
                            </div>
                        <?php endif; ?>
                        <div class="info-box">
                            <h3 class="slide-title"><?= the_title(); ?></h3>
                            <h5 class="position-title"><?= get_post_meta(get_the_ID(), '_member-position', true); ?></h5>
                            <p><?= get_post_meta(get_the_ID(), '_member-bio', true); ?></p>
                        </div>
                    </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <?php foreach($locations as $location ): ?>

            <div id="<?= 'swiper_' . $location->slug ?>" class="swiper-eic-slider">


                <div class="swiper-wrapper ">

                    <?php while($membersQuery->have_posts()) : $membersQuery->the_post(); ?>
                        <?php if(has_term( $location->term_id , 'location', get_the_ID() )) :?>
                            <div class="swiper-slide">
                                <div class="slide ">
                                    <?php if (get_the_post_thumbnail_url() != null) : ?>
                                        <div class="img-box">
                                            <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_title() . ' photograph' ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="info-box">
                                        <h3 class="slide-title"><?= the_title(); ?></h3>
                                        <h5 class="position-title"><?= get_post_meta(get_the_ID(), '_member-position', true); ?></h5>
                                        <p><?= get_post_meta(get_the_ID(), '_member-bio', true); ?></p>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endif;?>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            

        <?php endforeach; ?>


        <div class="row-nav-pos">
            <ul>
                <li class="active-location" id="allLocations"><i class="fas fa-map-marker-alt"></i> All Locations</li>

                <?php foreach ($locations as $location) : ?>
                    <li id="<?= $location->slug ?>"><i class="fas fa-map-marker-alt"></i><?= $location->name ?></li>
                <?php endforeach; ?>

            </ul>
        </div>
    </section>


<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}


function locations_as_classes($terms)
{
    foreach ($terms as $term) {
        echo $term->slug . ' ';
    }
}
