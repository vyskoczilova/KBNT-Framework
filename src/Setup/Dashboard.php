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
     * Remove widget from dashboard
     */
    public function removeWidget(string $widget, $context = "normal") {
        $this->remove_widgets[] = [
            'widget' => $widget,
            'context' => $context
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

        $this->removeWelcomePanel();
    }

    /**
     * Init
     * @return void
     */
    public function init() {

        if (!empty($this->remove_widgets) || $this->remove_welcome_panel) {
            add_action('wp_dashboard_setup', function() {

                // Remove welcome panel.
                if ($this->remove_welcome_panel) {
                    remove_action('welcome_panel', 'wp_welcome_panel');
                }

                // Remove widgets.
                foreach ($this->remove_widgets as $widget) {
                    remove_meta_box($widget['widget'], 'dashboard', $widget['context']);

                }
            });
        }
    }

}
