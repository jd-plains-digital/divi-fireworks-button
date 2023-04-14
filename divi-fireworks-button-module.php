<?php
class Divi_Fireworks_Button_Module extends ET_Builder_Module_Button {
    public $vb_support = 'on';
    public function __construct() {
        parent::__construct();
        add_action('wp_enqueue_scripts', array($this, '_enqueue_scripts'));
    }

    public function init() {
        $this->name = esc_html__('Fireworks Button', 'custom-divi-modules');
        $this->slug = 'et_pb_fireworks_button';

        // Add any other properties or methods as needed.
    }
    
    public function _enqueue_scripts() {
        wp_enqueue_script('particles-js', plugin_dir_url(__FILE__) . 'particles.min.js', array('jquery'), '2.0.0', true);
        wp_enqueue_script('fireworks-js', plugin_dir_url(__FILE__) . 'fireworks.js', array('jquery'), '1.0', true);
        wp_enqueue_style('fireworks-css', plugin_dir_url(__FILE__) . 'fireworks.css', array(), '1.0');
    }

    public function get_fields() {
    // Get the parent class's fields
    $fields = parent::get_fields();

    // Add a new field for particle colors
    $fields['particle_colors'] = array(
        'label' => esc_html__('Particle Colors', 'custom-divi-modules'),
        'type' => 'multiple_checkboxes',
        'options' => array(
            'red' => esc_html__('Red', 'custom-divi-modules'),
            'orange' => esc_html__('Orange', 'custom-divi-modules'),
            'green' => esc_html__('Green', 'custom-divi-modules'),
            'blue' => esc_html__('Blue', 'custom-divi-modules'),
            'purple' => esc_html__('Purple', 'custom-divi-modules'),
        ),
        'option_category' => 'basic_option',
        'description' => esc_html__('Select the particle colors for the fireworks effect.', 'custom-divi-modules'),
        'toggle_slug' => 'fireworks',
    );

    // Add a new field for particle opacity
    $fields['particle_opacity'] = array(
        'label' => esc_html__('Particle Opacity', 'custom-divi-modules'),
        'type' => 'range',
        'option_category' => 'basic_option',
        'description' => esc_html__('Adjust the opacity of the particles in the fireworks effect.', 'custom-divi-modules'),
        'toggle_slug' => 'fireworks',
        'default' => '1',
        'range_settings' => array(
            'min' => '0',
            'max' => '1',
            'step' => '0.1',
        ),
    );

    // Add a new field for particle speed
    $fields['particle_speed'] = array(
        'label' => esc_html__('Particle Speed', 'custom-divi-modules'),
        'type' => 'range',
        'option_category' => 'basic_option',
        'description' => esc_html__('Adjust the speed of the particles in the fireworks effect.', 'custom-divi-modules'),
        'toggle_slug' => 'fireworks',
        'default' => '1',
        'range_settings' => array(
            'min' => '0',
            'max' => '5',
            'step' => '0.1',
        ),
    );

    return $fields;
}


    public function render($attrs, $content = null, $render_slug) {
        // Add a custom class to the button.
        $this->add_classname('fireworks-button');
        
        // Get the selected particle colors, opacity and speed values.
        $particle_colors = isset($attrs['particle_colors']) ? explode('|', $attrs['particle_colors']) : array();
        $particle_opacity = isset($attrs['particle_opacity']) ? $attrs['particle_opacity'] : '1';
        $particle_speed = isset($attrs['particle_speed']) ? $attrs['particle_speed'] : '1';

        // Map the selected colors to their corresponding hex values.
        $color_map = array(
            'red' => '#ff5a5a',
            'orange' => '#ffac5a',
            'green' => '#5aff5a',
            'blue' => '#5ad4ff',
            'purple' => '#d45aff',
        );
        $selected_colors = array_map(function ($color) use ($color_map) {
            return $color_map[$color];
        }, $particle_colors);

        // Pass the selected colors as a JavaScript variable to the frontend.
        wp_localize_script('fireworks-js', 'diviFireworks', array(
            'particleColors' => $selected_colors,
        ));

        // Get the particle size value.
        $particle_size = isset($attrs['particle_size']) ? $attrs['particle_size'] : '3';

        // Pass the particle size value as a JavaScript variable to the frontend.
        wp_localize_script('fireworks-js', 'diviFireworks', array(
            'particleColors' => $selected_colors,
            'particleSize' => $particle_size,
            'particleOpacity' => $particle_opacity,
            'particleSpeed' => $particle_speed,
        ));

        // Call the parent class's render method.
        return parent::render($attrs, $content, $render_slug);
}

}

new Divi_Fireworks_Button_Module;