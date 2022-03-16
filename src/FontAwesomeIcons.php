<?php

namespace KBNT\Framework;

/**
 * Get Font awesome 5 icon
 * @package KBNT\Helpers
 */
class FontAwesomeIcons {

    /**
     * Color
     * @var string
     */
    private $color = 'currentColor';

    /**
     * Default style
     * @var string
     */
    private $style = 'regular';

    /**
     * Set icons color
     * @param string $color HEX color.
     * @return void
     */
    public function setColor( $color ) {
        $this->color = $color;
    }

    /**
     * Set default style
     *
     * @param  string  $style  Default style (regular|solid|light|duotone)
     *
     * @return  self
     */
    public function setStyle(string $style)
    {

        $this->style = $this->checkStyleValue($style);

        return $this;
    }

    /**
     * Check style vylue
     * @param string $style Style (regular|solid|light|duotone)
     * @return string
     */
    private function checkStyleValue(string $style) {
        if (\in_array($style,['regular', 'solid', 'light', 'duotone'])) {
            return $style;
        }
        return 'regular';
    }

    /**
     * Arrows H
     * @see https://fontawesome.com/v5.15/icons/arrows-h?style=regular
     * @param string $style Style of icon (regular|solid|light|duotone).
     * @return string
     */
    public function getArrowsH($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrows-h" class="svg-inline--fa fa-arrows-h fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="' . $this->color . '" d="M347.404 142.86c-4.753 4.753-4.675 12.484.173 17.14l73.203 70H91.22l73.203-70c4.849-4.656 4.927-12.387.173-17.14l-19.626-19.626c-4.686-4.686-12.284-4.686-16.971 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971L128 388.766c4.686 4.686 12.284 4.686 16.971 0l19.626-19.626c4.753-4.753 4.675-12.484-.173-17.14L91.22 282h329.56l-73.203 70c-4.849 4.656-4.927 12.387-.173 17.14l19.626 19.626c4.686 4.686 12.284 4.686 16.971 0l124.485-124.281c4.686-4.686 4.686-12.284 0-16.971L384 123.234c-4.686-4.686-12.284-4.686-16.971 0l-19.625 19.626z"></path></svg>';
        }

    }

    /**
     * Download H
     * @see https://fontawesome.com/v5.15/icons/download?style=regular
     * @param string $style Style of icon (regular|solid|light|duotone).
     * @return string
     */
    public function getDownload($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="' . $this->color . '" d="M528 288h-92.1l46.1-46.1c30.1-30.1 8.8-81.9-33.9-81.9h-64V48c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v112h-64c-42.6 0-64.2 51.7-33.9 81.9l46.1 46.1H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80h112V48h96v160h112L288 368 128 208zm400 256H48V336h140.1l65.9 65.9c18.8 18.8 49.1 18.7 67.9 0l65.9-65.9H528v128zm-88-64c0-13.3 10.7-24 24-24s24 10.7 24 24-10.7 24-24 24-24-10.7-24-24z"/></svg>';
        }

    }

    /**
     * Indent
     * @see https://fontawesome.com/v5.15/icons/indent?style=duotone
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getIndent($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }


        switch ($style) {
            case 'duotone':
            return '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="indent" class="svg-inline--fa fa-indent fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><g class="fa-group"><path class="fa-secondary" fill="'.$this->color.'" d="M432 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm3.17-128H204.83A12.82 12.82 0 0 0 192 300.83v38.34A12.82 12.82 0 0 0 204.83 352h230.34A12.82 12.82 0 0 0 448 339.17v-38.34A12.82 12.82 0 0 0 435.17 288zm0-128H204.83A12.82 12.82 0 0 0 192 172.83v38.34A12.82 12.82 0 0 0 204.83 224h230.34A12.82 12.82 0 0 0 448 211.17v-38.34A12.82 12.82 0 0 0 435.17 160zM432 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z" opacity="0.4"></path><path class="fa-primary" fill="'.$this->color.'" d="M27.31 363.3l96-96a16 16 0 0 0 0-22.62l-96-96C17.27 138.66 0 145.78 0 160v192c0 14.31 17.33 21.3 27.31 11.3z"></path></g></svg>';
        }

    }

    /**
     * Lightbulb dollar
     * @see https://fontawesome.com/icons/lightbulb-dollar?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getLightbulbDollar($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }


        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="lightbulb-dollar" class="svg-inline--fa fa-lightbulb-dollar fa-w-11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="'. $this->color .'" d="M168 296h16c4.42 0 8-3.58 8-8v-16.12c23.62-.63 42.67-20.54 42.67-45.07 0-19.97-12.98-37.81-31.58-43.39l-45-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V96c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.62.63-42.67 20.55-42.67 45.07 0 19.97 12.98 37.81 31.58 43.39l45 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.11c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V288c0 4.42 3.58 8 8 8zM96.06 459.17c0 3.15.93 6.22 2.68 8.84l24.51 36.84c2.97 4.46 7.97 7.14 13.32 7.14h78.85c5.36 0 10.36-2.68 13.32-7.14l24.51-36.84c1.74-2.62 2.67-5.7 2.68-8.84l.05-43.18H96.02l.04 43.18zM176 0C73.72 0 0 82.97 0 176c0 44.37 16.45 84.85 43.56 115.78 16.64 18.99 42.74 58.8 52.42 92.16v.06h48v-.12c-.01-4.77-.72-9.51-2.15-14.07-5.59-17.81-22.82-64.77-62.17-109.67-20.54-23.43-31.52-53.15-31.61-84.14-.2-73.64 59.67-128 127.95-128 70.58 0 128 57.42 128 128 0 30.97-11.24 60.85-31.65 84.14-39.11 44.61-56.42 91.47-62.1 109.46a47.507 47.507 0 00-2.22 14.3v.1h48v-.05c9.68-33.37 35.78-73.18 52.42-92.16C335.55 260.85 352 220.37 352 176 352 78.8 273.2 0 176 0z"/></svg>';
        }
    }

    /**
     * Highlighter
     * @see https://fontawesome.com/icons/highlighter?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getHighlighter($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="highlighter" class="svg-inline--fa fa-highlighter fa-w-17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512"><path fill="'. $this->color .'" d="M0 479.98L99.88 512l35.56-35.58-67.01-67.04L0 479.98zM527.93 79.27l-63.17-63.2C454.09 5.39 440.04 0 425.97 0c-12.93 0-25.88 4.55-36.28 13.73L124.8 239.96a36.598 36.598 0 00-10.79 38.1l13.05 42.83-33.95 33.97c-9.37 9.37-9.37 24.56 0 33.93l62.26 62.29c9.37 9.38 24.58 9.38 33.95 0l33.86-33.88 42.72 13.08a36.54 36.54 0 0010.7 1.61 36.57 36.57 0 0027.43-12.38l226.25-265.13c19.16-21.72 18.14-54.61-2.35-75.11zM272.78 382.18l-35.55-10.89-27.59-8.45-20.4 20.41-16.89 16.9-28.31-28.32 16.97-16.98 20.37-20.38-8.4-27.57-10.86-35.66 38.23-32.65 105.18 105.23-32.75 38.36zm220.99-258.97L326.36 319.39l-101.6-101.65 196.68-168c1.29-1.14 2.82-1.72 4.53-1.72 1.3 0 3.2.35 4.86 2.01l63.17 63.2c2.54 2.56 2.67 6.68-.23 9.98z"/></svg>';
        }
    }

    /**
     * Address card
     * @see https://fontawesome.com/icons/address-card?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getAddressCard($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }


        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="address-card" class="svg-inline--fa fa-address-card fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="'. $this->color .'" d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm0 400H48V80h480v352zM208 256c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm-89.6 128h179.2c12.4 0 22.4-8.6 22.4-19.2v-19.2c0-31.8-30.1-57.6-67.2-57.6-10.8 0-18.7 8-44.8 8-26.9 0-33.4-8-44.8-8-37.1 0-67.2 25.8-67.2 57.6v19.2c0 10.6 10 19.2 22.4 19.2zM360 320h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0-64h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0-64h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8z"/></svg>';
        }
    }

    /**
     * Tally
     * @see https://fontawesome.com/icons/tally?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getTally($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="tally" class="svg-inline--fa fa-tally fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="'. $this->color .'" d="M639.25 171.91l-4.84-15.25c-2.67-8.42-11.66-13.09-20.09-10.42L536 171.08V48c0-8.84-7.16-16-16-16h-16c-8.84 0-16 7.16-16 16v138.3l-80 25.37V48c0-8.84-7.16-16-16-16h-16c-8.84 0-16 7.16-16 16v178.89l-80 25.37V48c0-8.84-7.16-16-16-16h-16c-8.84 0-16 7.16-16 16v219.47l-80 25.37V48c0-8.84-7.16-16-16-16h-16c-8.84 0-16 7.16-16 16v260.06L11.17 337.5C2.75 340.17-1.92 349.16.75 357.59l4.84 15.25c2.67 8.42 11.67 13.09 20.09 10.41L104 358.41V464c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16V343.19l80-25.37V464c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16V302.61l80-25.37V464c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16V262.02l80-25.37V464c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16V221.44L628.83 192c8.43-2.67 13.09-11.66 10.42-20.09z"/></svg>';
        }
    }

    /**
     * Address card
     * @see https://fontawesome.com/icons/address-card?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getCompass($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="compass" class="svg-inline--fa fa-compass fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="'. $this->color .'" d="M347.94 129.86L203.6 195.83a31.938 31.938 0 00-15.77 15.77l-65.97 144.34c-7.61 16.65 9.54 33.81 26.2 26.2l144.34-65.97a31.938 31.938 0 0015.77-15.77l65.97-144.34c7.61-16.66-9.54-33.81-26.2-26.2zm-77.36 148.72c-12.47 12.47-32.69 12.47-45.16 0-12.47-12.47-12.47-32.69 0-45.16 12.47-12.47 32.69-12.47 45.16 0 12.47 12.47 12.47 32.69 0 45.16zM248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm0 448c-110.28 0-200-89.72-200-200S137.72 56 248 56s200 89.72 200 200-89.72 200-200 200z"/></svg>';
        }
    }

    /**
     * list-alt
     * @see https://fontawesome.com/icons/list-alt-far?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getListAlt($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
            return '<svg aria-hidden="true" data-prefix="far" data-icon="list-alt" class="svg-inline--fa fa-list-alt fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 01-6-6V86a6 6 0 016-6h404a6 6 0 016 6v340a6 6 0 01-6 6zm-42-92v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm0-96v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm0-96v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm-252 12c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36zm0 96c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36zm0 96c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36z"/></svg>';
        }
    }

    /**
     * Question circle
     * @see https://fontawesome.com/icons/quesetion-circle?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getQuestionCircles($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="question-circle" class="svg-inline--fa fa-question-circle fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z"/></svg>';
        }
    }

    /**
     * Callendar star
     * @see https://fontawesome.com/icons/callendar-star?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getCallendarStar($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="calendar-star" class="svg-inline--fa fa-calendar-star fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="'. $this->color .'" d="M167 331.4l-9.4 54.6c-1.7 9.9 8.7 17.2 17.4 12.6l48.9-25.8 48.9 25.8c8.7 4.6 19.1-2.8 17.4-12.6l-9.4-54.6 39.6-38.6c7.1-6.9 3.2-19-6.6-20.5l-54.7-8-24.5-49.6c-4.4-8.8-17.1-9-21.5 0l-24.5 49.6-54.7 8c-9.8 1.4-13.7 13.5-6.6 20.5l39.7 38.6zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm0 394c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V160h352v298z"/></svg>';
        }
    }

    /**
     * thumbtack
     * @see https://fontawesome.com/icons/thumbtack?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getThumbtack($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
            return '<svg aria-hidden="true" data-prefix="far" data-icon="thumbtack" class="svg-inline--fa fa-thumbtack fa-w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="'. $this->color .'" d="M306.5 186.6l-5.7-42.6H328c13.2 0 24-10.8 24-24V24c0-13.2-10.8-24-24-24H56C42.8 0 32 10.8 32 24v96c0 13.2 10.8 24 24 24h27.2l-5.7 42.6C29.6 219.4 0 270.7 0 328c0 13.2 10.8 24 24 24h144v104c0 .9.1 1.7.4 2.5l16 48c2.4 7.3 12.8 7.3 15.2 0l16-48c.3-.8.4-1.7.4-2.5V352h144c13.2 0 24-10.8 24-24 0-57.3-29.6-108.6-77.5-141.4zM50.5 304c8.3-38.5 35.6-70 71.5-87.8L138 96H80V48h224v48h-58l16 120.2c35.8 17.8 63.2 49.4 71.5 87.8z"/></svg>';
        }
    }

    /**
     * Copyright
     * @see https://fontawesome.com/icons/copyright?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getCopyright($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="copyright" class="svg-inline--fa fa-copyright fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 011.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 01-1.152 15.518z"/></svg>';
        }
    }

    /**
     * Chart Line
     * @see https://fontawesome.com/v5.15/icons/chart-line?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getChartLine($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="chart-line" class="svg-inline--fa fa-chart-line fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="' . $this->color . '" d="M117.65 277.65c6.25 6.25 16.38 6.25 22.63 0L192 225.94l84.69 84.69c6.25 6.25 16.38 6.25 22.63 0L409.54 200.4l29.49 29.5c15.12 15.12 40.97 4.41 40.97-16.97V112c0-8.84-7.16-16-16-16H363.07c-21.38 0-32.09 25.85-16.97 40.97l29.5 29.49-87.6 87.6-84.69-84.69c-6.25-6.25-16.38-6.25-22.63 0l-74.34 74.34c-6.25 6.25-6.25 16.38 0 22.63l11.31 11.31zM496 400H48V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16z"/></svg>';
        }
    }

    /**
     * Grip horizontal
     * @see https://fontawesome.com/icons/grip-horizontal?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getGripHorizontal($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="grip-horizontal" class="svg-inline--fa fa-grip-horizontal fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M488 96h-96c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96h-48v-48h48v48zm24 80h-96c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96h-48v-48h48v48zM120 96H24c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96H48v-48h48v48zm24 80H24c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96H48v-48h48v48zM304 96h-96c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96h-48v-48h48v48zm24 80h-96c-13.25 0-24 10.74-24 24v96c0 13.25 10.75 24 24 24h96c13.25 0 24-10.75 24-24v-96c0-13.26-10.75-24-24-24zm-24 96h-48v-48h48v48z"/></svg>';
        }
    }

    /**
     * Ellipsis h
     * @see https://fontawesome.com/icons/ellipsis-h?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getEllipsisH($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="ellipsis-h" class="svg-inline--fa fa-ellipsis-h fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M304 256c0 26.5-21.5 48-48 48s-48-21.5-48-48 21.5-48 48-48 48 21.5 48 48zm120-48c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zm-336 0c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg>';
        }
    }

    /**
     * Quote right
     * @see https://fontawesome.com/icons/quote-right?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getQuoteRight($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="quote-right" class="svg-inline--fa fa-quote-right fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="'. $this->color .'" d="M200 32H72C32.3 32 0 64.3 0 104v112c0 39.7 32.3 72 72 72h56v8c0 22.1-17.9 40-40 40h-8c-26.5 0-48 21.5-48 48v48c0 26.5 21.5 48 48 48h8c101.5 0 184-82.5 184-184V104c0-39.7-32.3-72-72-72zm24 264c0 75-61 136-136 136h-8v-48h8c48.5 0 88-39.5 88-88v-56H72c-13.2 0-24-10.8-24-24V104c0-13.2 10.8-24 24-24h128c13.2 0 24 10.8 24 24v192zM504 32H376c-39.7 0-72 32.3-72 72v112c0 39.7 32.3 72 72 72h56v8c0 22.1-17.9 40-40 40h-8c-26.5 0-48 21.5-48 48v48c0 26.5 21.5 48 48 48h8c101.5 0 184-82.5 184-184V104c0-39.7-32.3-72-72-72zm24 264c0 75-61 136-136 136h-8v-48h8c48.5 0 88-39.5 88-88v-56H376c-13.2 0-24-10.8-24-24V104c0-13.2 10.8-24 24-24h128c13.2 0 24 10.8 24 24v192z"/></svg>';
        }
    }

    /**
     * unicorn
     * @see https://fontawesome.com/icons/unicorn?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getUnicorn($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="unicorn" class="svg-inline--fa fa-unicorn fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="'. $this->color .'" d="M631.98 64H526.61l-15.28-18.57c16.37-5.23 29.03-18.72 32.51-35.79C544.85 4.68 540.96 0 535.9 0H399.95c-68.41 0-125.83 47.95-140.42 112H176c-38.13 0-71.77 19.22-92.01 48.4C37.36 162.55 0 200.84 0 248v56c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16v-56c0-13.22 6.87-24.39 16.78-31.68-.18 2.59-.78 5.05-.78 7.68 0 30.13 11.9 58.09 32.16 78.58l-12.95 43.76a78.913 78.913 0 00-1.05 40.84l24.12 100.29c3.46 14.38 16.32 24.52 31.11 24.52h74.7c20.86 0 36.14-19.64 31.02-39.86l-25.53-100.76 8.51-23.71L256 356.2V480c0 17.67 14.33 32 32 32h80c17.67 0 32-14.33 32-32V324.35c20.57-23.15 32-52.8 32-84.35v-5.62c20.95 6.97 38.32.72 40.93-.17l31.03-10.59c23.96-8.18 40.06-30.7 40.04-56.01l-.04-52.27 92.46-36.67c6.59-4.4 3.48-14.67-4.44-14.67zM488.46 178.19l-31.02 10.59c-1.51.52-9.71 2.95-16.48-3.83L416 160h-32v80c0 26.09-12.68 49.03-32 63.64V464h-48V320l-107.91-30.83-28.65 79.78L191.53 464H150l-21.13-87.86a31.698 31.698 0 01.37-16.18l22.7-76.72C128.54 273.72 112 250.83 112 224c0-35.35 28.65-64 64-64h127.95v-16c0-53.02 42.98-96 96-96h51.33l44.67 54.28.05 65.35c0 4.77-3.03 9.02-7.54 10.56zM432 80c-8.84 0-16 7.16-16 16s7.16 16 16 16 16-7.16 16-16-7.16-16-16-16z"/></svg>';
        }
    }

    /**
     * game-board-alt
     * @see https://fontawesome.com/icons/game-board-alt?style=light
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getGameBoardAlt($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            case 'light':
                return '<svg aria-hidden="true" data-prefix="fal" data-icon="game-board-alt" class="svg-inline--fa fa-game-board-alt fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M480 0H32A32 32 0 000 32v448a32 32 0 0032 32h448a32 32 0 0032-32V32a32 32 0 00-32-32zm0 480H32V32h448zm-32-32V256H256v192zM288 288h128v128H288zM256 64H64v192h192zm-32 160H96V96h128z"/></svg>';
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="game-board-alt" class="svg-inline--fa fa-game-board-alt fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="'. $this->color .'" d="M480 0H32A32 32 0 000 32v448a32 32 0 0032 32h448a32 32 0 0032-32V32a32 32 0 00-32-32zm-16 464H48V48h416zm-48-48V256H256v160zM256 96H96v160h160z"/></svg>';
        }
    }

    /**
     * grip-lines
     * @see https://fontawesome.com/icons/grip-lines?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getGripLines($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="grip-lines" class="svg-inline--fa fa-grip-lines fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="'. $this->color .'" d="M432 288H16c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm0-112H16c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"/></svg>';
        }
    }

    /**
     * boxes-alt
     * @see https://fontawesome.com/icons/boxes-alt?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getBoxesAlt($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="boxes-alt" class="svg-inline--fa fa-boxes-alt fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="' . $this->color . '" d="M592 224H480V48c0-26.5-21.5-48-48-48H208c-26.5 0-48 21.5-48 48v176H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h544c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zM208 48h80v72c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V48h80v176H208V48zm88 416H48V272h96v72c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-72h88v192zm296 0H344V272h88v72c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-72h96v192z"/></svg>';
        }
    }

    /**
     * traffic-light
     * @see https://fontawesome.com/icons/traffic-light?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getTrafficLight($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="traffic-light" class="svg-inline--fa fa-traffic-light fa-w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="' . $this->color . '" d="M384 192h-48v-45.31c28.57-16.63 48-47.24 48-82.69h-48V32c0-17.67-14.33-32-32-32H80C62.33 0 48 14.33 48 32v32H0c0 35.44 19.43 66.05 48 82.69V192H0c0 35.44 19.43 66.05 48 82.69V320H0c0 37.73 21.97 70.05 53.63 85.74C70.3 466.84 125.62 512 192 512s121.7-45.16 138.37-106.26C362.03 390.05 384 357.73 384 320h-48v-45.31c28.57-16.64 48-47.25 48-82.69zm-96 176c0 52.93-43.06 96-96 96-52.93 0-96-43.07-96-96V48h192v320zm-96-192c26.51 0 48-21.49 48-48s-21.49-48-48-48-48 21.49-48 48 21.49 48 48 48zm0 128c26.51 0 48-21.49 48-48s-21.49-48-48-48-48 21.49-48 48 21.49 48 48 48zm0 128c26.51 0 48-21.49 48-48s-21.49-48-48-48-48 21.49-48 48 21.49 48 48 48z"/></svg>';
        }
    }

    /**
     * Person with sign
     * @see https://fontawesome.com/v5.15/icons/person-sign?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getPersonSign($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="person-sign" class="svg-inline--fa fa-person-sign fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="' . $this->color . '" d="m501.5 66.7-67.6-24.6 5.5-15c3-8.3-1.3-17.5-9.6-20.5l-15-5.5c-8.3-3-17.5 1.3-20.5 9.6l-5.5 15-67.7-24.6C310-3 302.5 5.6 300.6 10.6l-43.8 120.3c-3 8.3 1.3 17.5 9.6 20.5L334 176l-15.8 43.5s-49.9-17.1-49.5-16.5l-50.5-58.6C207.8 134 193.4 128 178.6 128h-62.9c-21.4 0-40.5 11.9-50.1 30.9L2.5 285.3c-5.9 11.9-1.1 26.3 10.7 32.2 14.1 7 27.4-1.3 32.2-10.7L96 205.7v96.7L72.2 484.9c-1.7 13.2 7.6 25.2 20.7 26.9 1 .1 2.1.2 3.1.2 11.9 0 22.2-8.8 23.8-20.9L141 328h14l51.2 78.2c1.1 1.4 1.7 3.2 1.7 5V488c0 13.2 10.7 24 24 24 13.2 0 24-10.7 24-24v-76.8c0-12.7-4.3-25.1-10.9-33.1l-53.1-81.2V187.3l41.6 48.3c6.1 6.1 13.6 10.8 21.9 13.6l46.3 15.4-13.9 38.3c-3 8.3 1.3 17.5 9.6 20.5l15 5.5c8.3 3 17.5-1.3 20.5-9.6l46.2-126.9 67.6 24.6c11.3 4.1 18.7-4.7 20.5-9.6L511 87.2c3.1-8.3-1.2-17.5-9.5-20.5zM433.1 161l-120.2-43.8 21.9-60.1L455 100.9 433.1 161zM144 96.1c26.5 0 48-21.5 48-48s-21.5-48-48-48-48 21.5-48 48 21.5 48 48 48z"/></svg>';
        }
    }

    /**
     * Map marked Alt
     * @see https://fontawesome.com/v5.15/icons/map-marked-alt?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getMapMarkedAlt($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="map-marked-alt" class="svg-inline--fa fa-map-marked-alt fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="' . $this->color . '" d="M344 126c0-13.3-10.7-24-24-24s-24 10.7-24 24c0 13.2 10.7 24 24 24s24-10.8 24-24zm-24 226c5 0 10-2 13.5-6.1 35.3-40 127.3-150.1 127.3-210.6C460.8 60.6 397.8 0 320 0S179.2 60.6 179.2 135.3c0 60.4 92 170.6 127.3 210.6C310 350 315 352 320 352zm0-304c51.2 0 92.8 39.2 92.8 87.3 0 21.4-31.8 79.1-92.8 152.6-61-73.5-92.8-131.2-92.8-152.6 0-48.1 41.6-87.3 92.8-87.3zm240 112c-2 0-4 .4-6 1.2l-73.5 27.2c-8.2 20.4-20.2 42-34.2 63.8L528 222v193l-128 44.5V316.3c-13.7 17.3-27.9 34.3-42.5 50.8-1.7 1.9-3.6 3.5-5.5 5.1v81.4l-128-45.2v-113c-18.1-24.1-34.8-48.8-48-72.8v180.2l-.6.2L48 450V257l123.6-43c-8-15.4-14.1-30.3-18.3-44.5L20.1 216C8 220.8 0 232.6 0 245.7V496c0 9.2 7.5 16 16 16 2 0 4-.4 6-1.2L192 448l172 60.7c13 4.3 27 4.4 40 .2L555.9 456c12.2-4.9 20.1-16.6 20.1-29.7V176c0-9.2-7.5-16-16-16z"/></svg>';
        }
    }

    /**
     * get Icons
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getIcons($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="' . $this->color . '" d="M144 343.78a48 48 0 1 0 48 48 48 48 0 0 0-48-48zM101.74 213a37 37 0 0 0 52.36 0l78.56-78.44A79.06 79.06 0 0 0 227 17.49c-28.08-23.13-69.54-22.82-99-.86-29.45-22-71-22.3-99.05.89a79.11 79.11 0 0 0-5.77 117.08zM59.42 54.53A29.54 29.54 0 0 1 78.35 48 35.08 35.08 0 0 1 103 58.32l25 24.89 24.93-24.89c12.25-12.15 31.43-13.83 43.58-3.82a31.09 31.09 0 0 1 2.31 46.15l-70.85 70.71-70.87-70.69a31.13 31.13 0 0 1 2.32-46.14zm337.93 305.24 32.27-69.89a24 24 0 1 0-43.54-20.12l-63.7 138h109.27l-36.92 68.58A24 24 0 1 0 437 499.05l75-139.28zm-141.44-72h-27.42l-7.09-14.17a27.36 27.36 0 0 0-25.64-17.76H92.08a27.39 27.39 0 0 0-25.65 17.76l-7 14.21H32a32 32 0 0 0-32 32V480a32 32 0 0 0 32 32h223.91a32 32 0 0 0 32-32V319.79a32 32 0 0 0-32-31.98zm-16 176.23H48V335.79h41.22l13.21-26.73 2.57-5.26h77.83l2.69 5.4 13.24 26.59h41.13zm112-256V68.24L463.83 51v78.58a84 84 0 0 0-16-1.69c-35.34 0-64 21.47-64 48s28.64 48 64 48 64-21.48 64-48V32c0-17.9-13.54-32-29.64-32a28.08 28.08 0 0 0-4.26.33L329.39 23.17c-14.63 2.25-25.5 15.74-25.5 31.66V161.6a83.25 83.25 0 0 0-16-1.7c-35.33 0-64 21.55-64 48.13s28.64 48.13 64 48.13 63.98-21.55 63.98-48.16z"/></svg>';
        }
    }

    /**
     * get browser
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getBrowser($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="' . $this->color . '" d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM48 92c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V92zm416 334c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V168h416v258zm0-310c0 6.6-5.4 12-12 12H172c-6.6 0-12-5.4-12-12V92c0-6.6 5.4-12 12-12h280c6.6 0 12 5.4 12 12v24z"/></svg>';
        }
    }

    /**
     * get newspaper
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getNewspaper($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="' . $this->color . '" d="M552 64H112c-20.858 0-38.643 13.377-45.248 32H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h496c13.255 0 24-10.745 24-24V88c0-13.255-10.745-24-24-24zM48 392V144h16v248c0 4.411-3.589 8-8 8s-8-3.589-8-8zm480 8H111.422c.374-2.614.578-5.283.578-8V112h416v288zM172 280h136c6.627 0 12-5.373 12-12v-96c0-6.627-5.373-12-12-12H172c-6.627 0-12 5.373-12 12v96c0 6.627 5.373 12 12 12zm28-80h80v40h-80v-40zm-40 140v-24c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H172c-6.627 0-12-5.373-12-12zm192 0v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-144v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0 72v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12z"/></svg>';
        }
    }

    /**
     * get align left
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getAlignLeft($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="' . $this->color . '" d="M12.83 344h262.34A12.82 12.82 0 0 0 288 331.17v-22.34A12.82 12.82 0 0 0 275.17 296H12.83A12.82 12.82 0 0 0 0 308.83v22.34A12.82 12.82 0 0 0 12.83 344zm0-256h262.34A12.82 12.82 0 0 0 288 75.17V52.83A12.82 12.82 0 0 0 275.17 40H12.83A12.82 12.82 0 0 0 0 52.83v22.34A12.82 12.82 0 0 0 12.83 88zM432 168H16a16 16 0 0 0-16 16v16a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-16a16 16 0 0 0-16-16zm0 256H16a16 16 0 0 0-16 16v16a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-16a16 16 0 0 0-16-16z"/></svg>';
        }
    }

    /**
     * get photo video
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getPhotoVideo($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            default:
                return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="' . $this->color . '" d="M608 0H160c-17.67 0-32 13.13-32 29.33V112h48V48h48v64h48V48h224v304h112c17.67 0 32-13.13 32-29.33V29.33C640 13.13 625.67 0 608 0zm-16 304h-48v-56h48zm0-104h-48v-48h48zm0-96h-48V48h48zM128 320a32 32 0 1 0-32-32 32 32 0 0 0 32 32zm288-160H32a32 32 0 0 0-32 32v288a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32zm-16 240L299.31 299.31a16 16 0 0 0-22.62 0L176 400l-36.69-36.69a16 16 0 0 0-22.62 0L48 432V208h352z"/></svg>';
        }
    }

    /**
     * Rectangle wide
     * @see https://fontawesome.com/v5.15/icons/rectangle-wide?style=regular
     * @param string $style Style of icon (regulat|solid|light|duotone).
     * @return string
     */
    public function getRectangleWide($style = null) {

        // Load default style if not set.
        if (! $style ) {
            $style = $this->style;
        }

        switch ($style) {
            case 'light':
                return '<svg aria-hidden="true" data-prefix="fal" data-icon="rectangle-wide" class="svg-inline--fa fa-rectangle-wide fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="' . $this->color . '" d="M592 96H48c-26.5 0-48 21.5-48 48v224c0 26.5 21.5 48 48 48h544c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48zm16 272c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h544c8.8 0 16 7.2 16 16v224z"/></svg>';
            case 'solid':
                return '<svg aria-hidden="true" data-prefix="fas" data-icon="rectangle-wide" class="svg-inline--fa fa-rectangle-wide fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="' . $this->color . '" d="M592 416H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h544c26.5 0 48 21.5 48 48v224c0 26.5-21.5 48-48 48z"/></svg>';
            case 'duotone':
                return '<svg aria-hidden="true" data-prefix="fad" data-icon="rectangle-wide" class="svg-inline--fa fa-rectangle-wide fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><g class="fa-group"><path class="fa-secondary" fill="' . $this->color . '" d="M592 96H48a48 48 0 0 0-48 48v224a48 48 0 0 0 48 48h544a48 48 0 0 0 48-48V144a48 48 0 0 0-48-48zm-16 240a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V176a16 16 0 0 1 16-16h480a16 16 0 0 1 16 16z" opacity=".4"/><path class="fa-primary" fill="' . $this->color . '" d="M64 336V176a16 16 0 0 1 16-16h480a16 16 0 0 1 16 16v160a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16z"/></g></svg>';
            default:
                return '<svg aria-hidden="true" data-prefix="far" data-icon="rectangle-wide" class="svg-inline--fa fa-rectangle-wide fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="' . $this->color . '" d="M592 96.5H48c-26.5 0-48 21.5-48 48v223c0 26.5 21.5 48 48 48h544c26.5 0 48-21.5 48-48v-223c0-26.5-21.5-48-48-48zm-6 271H54c-3.3 0-6-2.7-6-6v-211c0-3.3 2.7-6 6-6h532c3.3 0 6 2.7 6 6v211c0 3.3-2.7 6-6 6z"/></svg>';
        }
    }

}
