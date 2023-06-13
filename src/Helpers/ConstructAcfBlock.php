<?php

namespace KBNT\Framework\Helpers;

class ConstructAcfBlock
{

    /**
     * Params
     * @var array
     */
    private $params = [];

    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * Mode
     * @var string
     */
    private $mode = 'view';

    /**
     * Construct
     * @param string $name Name.
     * @return self
     */
    public function __construct($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * setParam
     * @param string $slug Param slug.
     * @param string $value Value.
     * @return self
     */
    public function setParam($slug, $value) {
        $this->params[$slug] = $value;
        return $this;
    }
    /**
     * Set mode
     * @param string $mode Mode.
     * @return self
     */
    public function setMode($mode) {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get
     * @return string
     */
    public function get() {
        $params = [
            'name' => 'acf/' . $this->name,
            'data' => [],
            'mode' => $this->mode,
        ];

        foreach ($this->params as $key => $value) {
			$params['data'][$key] = $value;
            $params['data']['_' . $key] = 'field_' . uniqid();
		}

        return '<!-- wp:acf/'. $this->name . ' ' .\wp_json_encode($params) .' /-->';
    }

}
