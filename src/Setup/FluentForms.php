<?php

namespace KBNT\Framework\Setups;

use KBNT\Framework\Interfaces\SetupInterface;

class FluentForms implements SetupInterface
{

    /**
     * Do shortcode in Terms & Conditions
     * @var bool
     */
    private $do_shortcode_tnc;

    /**
     * Keep one IP instead of multiple commaseparated IPs by default (needs to be revised in further Fluent Forms versions)
     * @var bool
     */
    private $keep_one_ip_only;

    /**
     * Initialize.
     * @return void
     */
    function init()
    {

        if ($this->do_shortcode_tnc) {
            add_filter('fluentform/rendering_field_data_terms_and_condition', function ($data, $form) {
                $data['settings']['tnc_html'] = \do_shortcode($data['settings']['tnc_html']);
                return $data;
            }, 10, 3);
        }

        if ($this->keep_one_ip_only) {
            add_filter('fluentform/filter_insert_data', function ($response) {
                if (isset($response['ip'])) {
                    $response['ip'] = explode(',', $response['ip'])[0]; // Keep only first IP address (remove all others).
                }
                return $response;
            }, 10, 1);
        }
    }


    /**
     * Set do shortcode in Terms & Conditions
     *
     * @param  bool  $do_shortcode_tnc  Do shortcode in Terms & Conditions
     *
     * @return  self
     */
    public function setDoShortcodeTnc(bool $do_shortcode_tnc = true)
    {
        $this->do_shortcode_tnc = $do_shortcode_tnc;

        return $this;
    }

    /**
     * Set keep one IP instead of multiple commaseparated IPs by default (needs to be revised in further Fluent Forms versions)
     * @param bool $keep_one_ip_only Enable/disable settings.
     * @return self
     */
    public function setKeepOneIpOnly(bool $keep_one_ip_only = true)
    {
        $this->keep_one_ip_only = $keep_one_ip_only;

        return $this;
    }
}
