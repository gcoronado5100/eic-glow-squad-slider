<?php
function eic_glow_squad_cpt()
{

    /**
     * Post Type: members.
     */

    $labels = [
        "name" => esc_html__("members", "eic-glowsquad"),
        "singular_name" => esc_html__("member", "eic-glowsquad"),
        "menu_name" => esc_html__("The Glow Squad", "eic-glowsquad"),
        "all_items" => esc_html__("All Members", "eic-glowsquad"),
        "add_new" => esc_html__("Add new", "eic-glowsquad"),
        "add_new_item" => esc_html__("Add new member", "eic-glowsquad"),
        "edit_item" => esc_html__("Edit", "eic-glowsquad"),
        "new_item" => esc_html__("new", "eic-glowsquad"),
        "view_item" => esc_html__("view", "eic-glowsquad"),
    ];

    $args = [
        "label" => esc_html__("members", "eic-glowsquad"),
        "labels" => $labels,
        "description" => "Staff Member for the Glow Method ",
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "glowsquad", "with_front" => true],
        "query_var" => true,
        "menu_position" => 5,
        "menu_icon" => "dashicons-admin-users",
        "supports" => ["title", "thumbnail"],
        "taxonomies" => ["location"],
        "show_in_graphql" => false,
    ];

    register_post_type("member", $args);
}

function cptui_register_my_taxes_location()
{

    /**
     * Taxonomy: Locations.
     */

    $labels = [
        "name" => esc_html__("Locations", "astra"),
        "singular_name" => esc_html__("Location", "astra"),
    ];


    $args = [
        "label" => esc_html__("Locations", "astra"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'location', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "location",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("location", ["post"], $args);
}

add_action('init', 'cptui_register_my_taxes_location');

register_post_meta('member', 'Position', [
    'type' => 'string',
    'description' => __('Job Position for this member'),
    'single' => true,
    'default' => '',
    'show_in_rest' => true
]);

register_post_meta('member', 'Bio', [
    'type' => 'string',
    'description' => __('Biography of this member'),
    'single' => true,
    'default' => '',
    'show_in_rest' => true
]);

function eic_glowsquad_custom_metabox()
{
    add_meta_box(
        'eic_glowsquad_metabox',
        __('Member details', 'eic-glowsquad'),
        'eic_glowsquad_metabox_output',
        'member',
        'side'
    );
}

function eic_glowsquad_metabox_output($post)
{
?>
    <fieldset class="eic-fieldset">
        <label for="member-position">Member Position</label>
        <?php $member_position = get_post_meta($post->ID, '_member-position', true); ?>
        <input type="text" value="<?= esc_attr($member_position) ?>" name="member-position" placeholder="Member Position" id="position">
    </fieldset>
    <br>
    <fieldset class="eic-fieldset">
        <label for="member-bio">Member Bio</label>
        <?php $member_bio = get_post_meta($post->ID, '_member-bio', true); ?>
        <textarea name="member-bio" value=<?= esc_attr($member_bio) ?> id="bio" cols="30" rows="10" placeholder="Tell more about this person"><?= ($member_bio) ? $member_bio : '' ?></textarea>
    </fieldset>
<?php
}

function eic_save_meta_data_position($post_id)
{

    // Autosaving, bail.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // @TODO
    // You should add some additional security checks here
    // eg. nonce, user capabilities, etc, to prevent
    // malicious users from doing bad stuff.

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if (!isset($_POST['member-position'])) {
        return;
    } else {
        // Sanitize user input.
        $my_data = sanitize_text_field($_POST['member-position']);

        // Update the meta field in the database.
        update_post_meta($post_id, '_member-position', $my_data);
    }
}

function eic_save_meta_data_bio($post_id)
{

    // Autosaving, bail.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // @TODO
    // You should add some additional security checks here
    // eg. nonce, user capabilities, etc, to prevent
    // malicious users from doing bad stuff.

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if (!isset($_POST['member-bio'])) {
        return;
    } else {
        // Sanitize user input.
        $my_data = sanitize_text_field($_POST['member-bio']);

        // Update the meta field in the database.
        update_post_meta($post_id, '_member-bio', $my_data);
    }
}
