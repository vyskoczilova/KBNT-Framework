<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Dashboard implements SetupInterface
{

    /**
     * Remove widgets from dashboard
     * @var array
     */
    private $remove_widgets = [];

    /**
     * Remove welcome panel from dashboard
     * @var boolean
     */
    private $remove_welcome_panel;

    /**
     * Add widgets to dashboard
     * @var array
     */
    private $add_widgets = [];

    /** 
     * Remove widget from dashboard
     */
    public function removeWidget(string $widget, $context = "normal") {
        $this->remove_widgets[] = [
            'widget' => $widget,
            'context' => $context
        ];
    }

    /**
     * Add widget to dashboard
     * @param string $widget_id Widget ID.
     * @param string $widget_name Widget name.
     * @param callable $callback Function that fills the widget with the desired content. The function should echo its output.
     * @param callable $control_callback Function that outputs controls for the widget.
     * @param array $callback_args Data that should be set as the $args property of the widget array (which is the second parameter passed to your callback).
     * @param string $context The context within the screen where the box should display. Accepts 'normal', 'side', 'column3', or 'column4'. Default 'normal'.
     * @param string $priority The priority within the context where the box should show. Accepts 'high', 'core', 'default', or 'low'. Default 'core'
     * @return void 
     */
    public function addWidget( string $widget_id, string $widget_name, callable  $callback, callable $control_callback = \null, array  $callback_args = \null, string $context = 'normal', string $priority = 'core') {
        $this->add_widgets[] = [
            $widget_id,
            $widget_name,
            $callback,
            $control_callback,
            $callback_args,
            $context,
            $priority
        ];
    }

    /**
     * Remove welcome panel from dashboard
     * @param boolean $remove Remove welcome panel.
     */
    public function removeWelcomePanel(bool $remove = true) {
        $this->remove_welcome_panel = $remove;
    }

    /**
     * Default theme settings.
     */
    public function setDefault() {

        $this->removeWidget('dashboard_primary', 'side');
        $this->removeWidget('dashboard_quick_press', 'side');
        $this->removeWidget('dashboard_activity', 'normal');
        $this->removeWidget('dashboard_right_now', 'normal');

        $this->removeWelcomePanel();
    }

    // Get author string - Karolína Vyskočilová (+420 737 87 87 26)
    public static function getAuthorContact() {
        return sprintf(
            '<p>Autorka šablony a kontakt: <a href="%s" target="_blank">%s</a>.</p>',
            'https://kyberanut.cz/kontakt/',
            'Karolína Vyskočilová'
        );
    }

    /**
     * Init
     * @return void
     */
    public function init() {

        if (!empty($this->remove_widgets) || $this->remove_welcome_panel || !empty($this->add_widgets)) {
            add_action('wp_dashboard_setup', function() {

                // Remove welcome panel.
                if ($this->remove_welcome_panel) {
                    remove_action('welcome_panel', 'wp_welcome_panel');
                }

                // Remove widgets.
                foreach ($this->remove_widgets as $widget) {
                    remove_meta_box($widget['widget'], 'dashboard', $widget['context']);

                }

                // Add widgets.
                foreach ($this->add_widgets as $widget) {
                    wp_add_dashboard_widget(...$widget);
                }
            });
        }
    }

}
