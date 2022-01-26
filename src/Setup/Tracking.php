<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Tracking implements SetupInterface
{

    /**
     * GA code
     * @var string
     */
	private $ga;

    /**
     * GTM code
     * @var string
     */
	private $gtm;

    /**
     * Meta headers
     * @var array
     */
    private $meta;

	/**
	 * Set Google Analytics ID
	 * @param string $id GA ID.
	 * @return self
	 */
	public function setGa(string $id)
	{
		$this->ga = $id;

        return $this;
	}

	/**
	 * Set GTM ID
	 * @param string $id GTM ID.
	 * @return self
	 */
	public function setGtm(string $id)
	{
		$this->gtm = $id;

        return $this;
	}

	/**
	 * Hook into WordPress
	 * @return void
	 */
	public function init()
	{

        // Don't load tracking scripts in local or dev mode. Based on WP_ENVIRONMENT_TYPE constant.
        // See https://make.wordpress.org/core/2020/07/24/new-wp_get_environment_type-function-in-wordpress-5-5/
        if (in_array(wp_get_environment_type(), ['local', 'development']) ) {
            return;
        }

        if ($this->gtm || $this->ga || !empty($this->meta)) {
            add_action('wp_head', array($this, 'wp_code_head'));
        }
        if( $this->gtm) {
            add_action('wp_body_open', array($this, 'wp_code_body'));
        }
	}

	/**
	 * Insert code into head
	 * @return void
	 */
	public function wp_code_head()
	{
		if ($this->gtm) {
			echo "<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{$this->gtm}');</script><!-- End Google Tag Manager -->";
		}
		if ($this->ga) {
			echo "<!-- Global site tag (gtag.js) - Google Analytics --><script async src='https://www.googletagmanager.com/gtag/js?id={$this->ga}'></script>
			<script>window.dataLayer = window.dataLayer || [];function gtag() {dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '{$this->ga}');</script>";
		}
        if ($this->meta) {
            foreach ($this->meta as $meta) {
                echo $meta;
            }
        }
	}

	/**
	 * Insert code after body tag
	 * @return void
	 */
	public function wp_code_body()
	{
		if ($this->gtm) {
			echo "<!-- Google Tag Manager (noscript) --><noscript><iframe src='https://www.googletagmanager.com/ns.html?id={$this->gtm}' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>	<!-- End Google Tag Manager (noscript) -->";
		}
	}

    /**
     * Set meta headers
     * @param string $name Name of the meta.
     * @param string $content Content.
     * @return self
     */
    public function setMeta(string $name, string $content)
    {
        $this->meta[] = '<meta name="' . \esc_attr($name) . '" content="' . \esc_attr($content) . '" />';

        return $this;
    }
}
