<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Micemade_WC_Products_Slider extends Widget_Base {

	public function get_name() {
		return 'micemade-wc-products-slider';
	}

	public function get_title() {
		return __( 'Micemade WC products slider', 'micemade-elements' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'micemade_elements' ];
	}

	public function get_script_depends() {
		return [ 'jquery-swiper' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_main',
			[
				'label' => esc_html__( 'Micemade products slider', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'heading_product_query_basic',
			[
				'label'     => __( 'Basic product query options', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Total products', 'micemade-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Enter total number of products to show', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => __( 'Offset', 'micemade-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Offset is number of skipped products', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'heading_filtering',
			[
				'label'     => __( 'Additional query options', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select product categories', 'micemade-elements' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'micemade_elements_terms', 'product_cat' ),
				'multiple' => true,
			]
		);

		$this->add_control(
			'exclude_cats',
			[
				'label'    => esc_html__( 'Exclude product categories', 'micemade-elements' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'micemade_elements_terms', 'product_cat' ),
				'multiple' => true,
				/* 'condition' => [
					'categories' => '',
				], */
			]
		);

		$this->add_control(
			'filters',
			[
				'label'   => __( 'Products filters', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'       => __( 'Latest products', 'micemade-elements' ),
					'featured'     => __( 'Featured products', 'micemade-elements' ),
					'best_sellers' => __( 'Best selling products', 'micemade-elements' ),
					'best_rated'   => __( 'Best rated products', 'micemade-elements' ),
					'on_sale'      => __( 'Products on sale', 'micemade-elements' ),
					'random'       => __( 'Random products', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'products_in',
			[
				'label'    => esc_html__( 'Select products', 'micemade-elements' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => 3,
				'options'  => apply_filters( 'micemade_posts_array', 'product' ),
				'multiple' => true,
			]
		);

		$this->add_control(
			'heading_slider',
			[
				'label'     => __( 'Slider options', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'posts_per_slide',
			[
				'label'   => __( 'Products per slide', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => __( 'One', 'micemade-elements' ),
					2 => __( 'Two', 'micemade-elements' ),
					3 => __( 'Three', 'micemade-elements' ),
					4 => __( 'Four', 'micemade-elements' ),
					6 => __( 'Six', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'posts_per_slide_tab',
			[
				'label'   => __( 'Products per slide (tablets)', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1 => __( 'One', 'micemade-elements' ),
					2 => __( 'Two', 'micemade-elements' ),
					3 => __( 'Three', 'micemade-elements' ),
					4 => __( 'Four', 'micemade-elements' ),
					6 => __( 'Six', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'posts_per_slide_mob',
			[
				'label'   => __( 'Products per slide (mobiles)', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => __( 'One', 'micemade-elements' ),
					2 => __( 'Two', 'micemade-elements' ),
					3 => __( 'Three', 'micemade-elements' ),
					4 => __( 'Four', 'micemade-elements' ),
					6 => __( 'Six', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'space',
			[
				'label'   => __( 'Space between slides', 'micemade-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 30,
				'min'     => 0,
				'step'    => 10,
			]
		);

		// Pagination.
		$this->add_control(
			'pagination',
			[
				'label'   => __( 'Slider pagination', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'none'        => __( 'None', 'micemade-elements' ),
					'bullets'     => __( 'Bullets', 'micemade-elements' ),
					'progressbar' => __( 'Progress bar', 'micemade-elements' ),
					'fraction'    => __( 'Fraction', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar-fill'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-fraction'      => 'color: {{VALUE}};',
				],
				'condition' => [
					'pagination!' => 'none',
				],
			]
		);

		// Slider navigation.
		$this->add_control(
			'buttons',
			[
				'label'     => esc_html__( 'Show navigation buttons', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'buttons_color',
			[
				'label'     => __( 'Navigation buttons color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'buttons!' => '',
				],
			]
		);
		// Autoplay.
		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay speed', 'micemade-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'step'    => 1000,
				'title'   => __( 'Enter value in miliseconds (1s. = 1000ms.). Leave 0 (zero) do discard autoplay', 'micemade-elements' ),
			]
		);
		// Loop the slider.
		$this->add_control(
			'loop',
			[
				'label'     => esc_html__( 'Loop slides', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

		// TAB 2 - STYLES FOR POSTS.
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Slider items base', 'micemade-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => __( 'Product base style', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'catalog' => __( 'WC Catalog style', 'micemade-elements' ),
					'style_1' => __( 'Style one', 'micemade-elements' ),
					'style_2' => __( 'Style two', 'micemade-elements' ),
					'style_3' => __( 'Style three', 'micemade-elements' ),
					'style_4' => __( 'Style four', 'micemade-elements' ),
				],
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'     => esc_html__( 'Product image format', 'micemade-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'thumbnail',
				'options'   => apply_filters( 'micemade_elements_image_sizes', '' ),
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_responsive_control(
			'product_text_height',
			[
				'label'     => __( 'Product height', 'micemade-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 400,
				],
				'range'     => [
					'px' => [
						'max'  => 800,
						'min'  => 0,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .inner-wrap' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_control(
			'slider_items_padding_border',
			[
				'label'     => __( 'Slider items padding and border', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_responsive_control(
			'slider_items_padding',
			[
				'label'      => esc_html__( 'Slider items padding', 'micemade-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'label'     => __( 'Slider items border' ),
				'name'      => 'productslider_post_border',
				'selector'  => '{{WRAPPER}} .inner-wrap',
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->end_controls_section();

		// Section product info elements.
		$this->start_controls_section(
			'section_info_elements',
			[
				'label'     => esc_html__( 'Product info elements', 'micemade-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label'     => esc_html__( 'Show price', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'add_to_cart',
			[
				'label'     => esc_html__( 'Show "Add to cart"', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'short_desc',
			[
				'label'     => esc_html__( 'Show product short description', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				//'default' => 'yes',
			]
		);

		$this->add_control(
			'posted_in',
			[
				'label'     => esc_html__( 'Show product categories (posted in)', 'micemade-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_responsive_control(
			'product_elements_spacing',
			[
				'label'     => __( 'Elements vertical spacing', 'micemade-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-text h4'          => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .meta'       => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .price-wrap' => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .add-to-cart-wrap' => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text p'           => 'padding: 0 0 {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();
		// end product info elements.

		// Section product info box styling.
		$this->start_controls_section(
			'section_info_styling',
			[
				'label'     => esc_html__( 'Product info box styling', 'micemade-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_product_background' );
		$this->start_controls_tab(
			'tab_product_background_normal',
			[
				'label' => __( 'Normal', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'post_info_background_color',
			[
				'label'     => __( 'Product info back color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_control(
			'post_overlay_color',
			[
				'label'     => __( 'Product overlay color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->end_controls_tab();
		// HOVER.
		$this->start_controls_tab(
			'tab_product_background_hover',
			[
				'label' => __( 'Hover', 'micemade-elements' ),
			]
		);
		$this->add_control(
			'post_info_background_color_hover',
			[
				'label'     => __( 'Hover product info background', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => [ 'style_3' ],
				],
			]
		);

		$this->add_control(
			'post_overlay_hover_color',
			[
				'label'     => __( 'Hover product overlay color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover .post-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_3' ],
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'content_vertical_alignment',
			[
				'label'     => __( 'Vertical Align Product Info', 'micemade-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => __( 'Top', 'micemade-elements' ),
					'center'     => __( 'Middle', 'micemade-elements' ),
					'flex-end'   => __( 'Bottom', 'micemade-elements' ),
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .post-text' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_responsive_control(
			'product_info_align',
			[
				'label'     => __( 'Product info alignment', 'micemade-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'micemade-elements' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'micemade-elements' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'micemade-elements' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .post-text' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_info_padding',
			[
				'label'      => esc_html__( 'Product info box padding', 'micemade-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// end product info styling.

		$this->start_controls_section(
			'section_product_thumb_settings',
			[
				'label'     => __( 'Product image settings', 'micemade-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label'     => __( 'Image container width', 'elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 100,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .post-thumb-back' => 'width: {{VALUE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_as_back_height',
			[
				'label'     => esc_html__( 'Image container height', 'micemade-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 100,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .post-thumb-back' => 'height: {{VALUE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'img_container_pos',
			[
				'label'   => esc_html__( 'Image container position', 'micemade-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top__left',
				'options' => [
					'top__left'      => esc_html__( 'Top left', 'micemade-elements' ),
					'top__center'    => esc_html__( 'Top center', 'micemade-elements' ),
					'top__right'     => esc_html__( 'Top right', 'micemade-elements' ),
					'middle__left'   => esc_html__( 'Middle Left ', 'micemade-elements' ),
					'middle'         => esc_html__( 'Middle', 'micemade-elements' ),
					'middle__right'  => esc_html__( 'Middle right ', 'micemade-elements' ),
					'bottom__left'   => esc_html__( 'Bottom left ', 'micemade-elements' ),
					'bottom__center' => esc_html__( 'Bottom center ', 'micemade-elements' ),
					'bottom__right'  => esc_html__( 'Bottom right ', 'micemade-elements' ),
				],
			]
		);
		$this->add_responsive_control(
			'back_image_position',
			[
				'label'     => esc_html__( 'Image background position', 'micemade-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => [
					'left top'      => esc_html__( 'Top left', 'micemade-elements' ),
					'center top'    => esc_html__( 'Top center', 'micemade-elements' ),
					'right top'     => esc_html__( 'Top right', 'micemade-elements' ),
					'left center'   => esc_html__( 'Middle Left ', 'micemade-elements' ),
					'center'        => esc_html__( 'Middle', 'micemade-elements' ),
					'right center'  => esc_html__( 'Middle right ', 'micemade-elements' ),
					'left bottom'   => esc_html__( 'Bottom left ', 'micemade-elements' ),
					'center bottom' => esc_html__( 'Bottom center ', 'micemade-elements' ),
					'right bottom'  => esc_html__( 'Bottom right ', 'micemade-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumb-back' => 'background-position: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_size',
			[
				'label'     => esc_html__( 'Image background size', 'micemade-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => [
					'auto'    => esc_html__( 'Auto', 'micemade-elements' ),
					'cover'   => esc_html__( 'Cover', 'micemade-elements' ),
					'contain' => esc_html__( 'Contain', 'micemade-elements' ),
					'custom'  => esc_html__( 'Custom', 'micemade-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumb-back' => 'background-size: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_size_custom',
			[
				'label'     => esc_html__( 'Custom image size', 'micemade-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 200,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .post-thumb-back' => 'background-size: {{VALUE}}% !important;',
				],
				'condition' => [
					//'layout' => 'image_background',
					'thumb_background_size' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		// TITLE STYLES.
		$this->start_controls_section(
			'section_title',
			[
				'label'     => __( 'Title', 'micemade-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		// HOVER TABS.
		$this->start_controls_tabs( 'tabs_button_style' );
		// NORMAL.
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Title Color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .post-text h4 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_back_color',
			[
				'label'     => __( 'Title Back Color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .post-text h4' => 'background-color: {{VALUE}};padding-left:0.5em;padding-right:0.5em;',
				],
			]
		);

		$this->end_controls_tab();

		// HOVER.
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'micemade-elements' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Color on Hover', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text h4:hover a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_back_color_hover',
			[
				'label'     => __( 'Title Back Color on Hover', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .post-text h4:hover' => 'background-color: {{VALUE}};padding-left:0.5em;padding-right:0.5em;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		// end tabs.

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'productslider_title_border',
				'label'       => __( 'Title Border', 'micemade-elements' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .post-text h4',
			]
		);

		$this->add_responsive_control(
			'productslider_title_padding',
			[
				'label'      => esc_html__( 'Title padding', 'micemade-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Title typohraphy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'micemade-elements' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .post-text h4',
			]
		);

		$this->end_controls_section();

		// PRODUCT DETAILS.
		$this->start_controls_section(
			'section_text',
			[
				'label'     => __( 'Product info typography', 'micemade-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_control(
			'categories_typo',
			[
				'label'     => __( 'Categories', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'categories_text_color',
			[
				'label'     => __( 'Categories Text Color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta span, {{WRAPPER}} .post-text .meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'categories_font_size',
			[
				'label'     => esc_html__( 'Categories font size (%)', 'micemade-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],

			]
		);

		$this->add_control(
			'short_desc_options',
			[
				'label'     => __( 'Short description', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'excerpt_text_color',
			[
				'label'     => __( 'Short description text Color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .post-text .micemade-elements-readmore' => 'color: {{VALUE}};',
				],
			]
		);

		// Short desc typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __( 'Short description typography', 'micemade-elements' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .post-text p',
			]
		);

		// Price controls.
		$this->add_control(
			'price_options',
			[
				'label'     => __( 'Price', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label'     => __( 'Price text Color', 'micemade-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta span, {{WRAPPER}} .post-text .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_font_size',
			[
				'label'     => esc_html__( 'Price font size (%)', 'micemade-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .post-text .price' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],

			]
		);

		$this->add_control(
			'prod_det_button_options',
			[
				'label'     => __( '"Product details" link', 'micemade-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'css_class',
			[
				'label'   => __( 'CSS for "Product details"', 'micemade-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'title'   => __( 'Style the "Product details" with css class(es) defined in your theme, plugin or customizer', 'micemade-elements' ),
			]
		);

		$this->end_controls_section();
		// end of section_text.
	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();

		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
		$offset         = ! empty( $settings['offset'] ) ? (int) $settings['offset'] : 0;
		$pps            = ! empty( $settings['posts_per_slide'] ) ? (int) $settings['posts_per_slide'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$exclude_cats   = ! empty( $settings['exclude_cats'] ) ? $settings['exclude_cats'] : array();
		$filters        = ! empty( $settings['filters'] ) ? $settings['filters'] : '';
		$products_in    = ! empty( $settings['products_in'] ) ? $settings['products_in'] : '';
		$img_format     = ! empty( $settings['img_format'] ) ? $settings['img_format'] : 'thumbnail';
		$style          = ! empty( $settings['style'] ) ? $settings['style'] : 'style_1';
		$short_desc     = ! empty( $settings['short_desc'] ) ? $settings['short_desc'] : '';
		$price          = ! empty( $settings['price'] ) ? $settings['price'] : '';
		$add_to_cart    = ! empty( $settings['add_to_cart'] ) ? $settings['add_to_cart'] : '';
		$posted_in      = ! empty( $settings['posted_in'] ) ? $settings['posted_in'] : '';
		$css_class      = ! empty( $settings['css_class'] ) ? $settings['css_class'] : '';
		$img_cont_pos   = ! empty( $settings['img_container_pos'] ) ? $settings['img_container_pos'] : 'center';

		global $post;

		$grid = micemade_elements_grid_class( intval( $pps ), intval( $pps_tab ), intval( $pps_mob ) );

		// Query posts: ( hook in includes/wc-functions.php ).
		$args     = apply_filters( 'micemade_elements_wc_query_args', $posts_per_page, $categories, $exclude_cats, $filters, $offset, $products_in );
		$products = get_posts( $args );

		if ( ! empty( $products ) ) {

			// CSS classes for main slider container.
			$this->add_render_attribute( 'container', 'class', 'micemade-elements_products_slider swiper-container' );
			$this->add_render_attribute( 'container', 'class', $style );
			$this->add_render_attribute( 'container', 'class', 'container-' . $img_cont_pos );

			echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';

			// Slider settings for JS function.
			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">';

			echo '<ul class="swiper-wrapper products woocommerce">';

			// If style as in WC content-product template.
			if ( 'catalog' === $style ) {
				add_filter(
					'post_class', function( $classes ) {
						$classes[] = 'swiper-slide';
						$classes[] = 'item';
						return $classes;
					}, 10
				);
			}

			foreach ( $products as $post ) {

				setup_postdata( $post );

				// If style as in WC content-product template.
				if ( 'catalog' === $style ) {
					wc_get_template_part( 'content', 'product' );
					// else, use plugin styling.
				} else {
					apply_filters( 'micemade_elements_loop_product', $style, $img_format, $posted_in, $short_desc, $price, $add_to_cart, $css_class );// hook in includes/wc-functions.php.
				}
			}

			echo '</ul>'; // .swipper-wrapper.

			// If style as in WC content-product template.
			if ( 'catalog' === $style ) {
				// "Clean" or "reset" post_class
				// avoid conflict with other "post_class" functions
				add_filter(
					'post_class', function( $classes ) {
						$classes_to_clean = array( 'swiper-slide', 'item' );
						$classes          = array_diff( $classes, $classes_to_clean );
						return $classes;
					}, 10
				);
			}

			if ( 'none' !== $pagination ) {
				echo '<div class="swiper-pagination"></div>';
			}

			if ( $buttons ) {
				echo '<div class="swiper-button-next" screen-reader>' . esc_html__( 'Next', 'micemade-elements' ) . '</div>';
				echo '<div class="swiper-button-prev" screen-reader>' . esc_html__( 'Previous', 'micemade-elements' ) . '</div>';
			}
			echo '</div>';
		}

		wp_reset_postdata();

		echo '
		<script type=text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				var products_slider = window.micemade_elements_swiper();
			});
		})( jQuery );
		</script>';

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Micemade_WC_Products_Slider() );
