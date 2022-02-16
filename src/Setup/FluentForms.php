<?php

namespace KBNT\Framework\Setups;

use KBNT\Framework\Interfaces\SetupInterface;

class FluentForms implements SetupInterface {

    /**
     * Do shortcode in Terms & Conditions
     * @var bool
     */
    private $do_shortcode_tnc;

    /**
     * Initialize.
     * @return void
     */
    function init() {

        if ($this->do_shortcode_tnc) {
            add_filter('fluentform_rendering_field_data_terms_and_condition', function ($data, $form) {
                $data['settings']['tnc_html'] = \do_shortcode($data['settings']['tnc_html']);
                return $data;
            }, 10, 3);
        }

    }


    /**
     * Set do shortcode in Terms & Conditions
     *
     * @param  bool  $do_shortcode_tnc  Do shortcode in Terms & Conditions
     *
     * @return  self
     */
    public function setDoShortcodeTnc(bool $do_shortcode_tnc = true )
    {
        $this->do_shortcode_tnc = $do_shortcode_tnc;

        return $this;
    }
}
