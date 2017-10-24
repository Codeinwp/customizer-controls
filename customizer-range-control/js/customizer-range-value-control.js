/* global wp */
/* global jQuery */
wp.customize.controlConstructor['range-value'] = wp.customize.Control.extend({

	ready: function(){
		'use strict';

		jQuery.fn.exists = function(){return this.length>0;};
		var control = this,
			changeAction;
		var theme_controls = jQuery('#customize-theme-controls');

		function syncRangeText( slider, input, from ){
			switch (from){
				case 'slider':
					input.val( slider.val());
					break;
				case 'input':
					slider.val( input.val() );
					break;
			}
		}

		function updateValues( control ){
			var collector = control.find('.range-collector');
			var values = getSliderValues( control );
			var have_queries = Object.keys(values).length > 1;
			if( have_queries ){
				collector.val(JSON.stringify(values));
			} else {
				collector.val(values.desktop);
			}
			collector.trigger( 'change' );

		}

		function getSliderValues( control ) {
			var values = {};
			var desktopSelector = control.find('.range-slider__range[data-query="desktop"]'),
				tabletSelector = control.find('.range-slider__range[data-query="tablet"]') ,
				mobileSelector = control.find('.range-slider__range[data-query="mobile"]'),
				desktopValue, tabletValue, mobileValue;

			if( desktopSelector.exists() ){
				desktopValue = desktopSelector.val();
				if( desktopValue !== 'undefined' && desktopValue !== '' ){
					values.desktop = desktopValue;
				}
			}

			if( tabletSelector.exists() ){
				tabletValue = tabletSelector.val();
				if( tabletValue !== 'undefined' && tabletValue !== '' ){
					values.tablet = tabletValue;
				}
			}

			if( mobileSelector.exists() ){
				mobileValue = mobileSelector.val();
				if( mobileValue !== 'undefined' && mobileValue !== '' ){
					values.mobile = mobileValue;
				}
			}

			return values;
		}

		function responsiveSwitcher(){
			// Responsive switchers
			jQuery( '.customize-control .responsive-switchers button' ).on( 'click', function( event ) {
				event.preventDefault();
				// Set up variables
				var $devices 	= jQuery( '.responsive-switchers' ),
					$device 	= jQuery( event.currentTarget ).data( 'device' ),
					$body 		= jQuery( '.wp-full-overlay' ),
					$footer_devices = jQuery( '.wp-full-overlay-footer .devices' );

				// Button class
				$devices.find( 'button' ).removeClass( 'active' );
				$devices.find( 'button.preview-' + $device ).addClass( 'active' );

				var control = jQuery('.range-slider.has-media-queries');
				control.find('.desktop-range').removeClass('active');
				control.find('.tablet-range').removeClass('active');
				control.find('.mobile-range').removeClass('active');
				control.find('.' + $device + '-range').addClass('active');

				// Wrapper class
				$body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + $device );

				// Panel footer buttons
				$footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
				$footer_devices.find( 'button.preview-' + $device ).addClass( 'active' ).attr( 'aria-pressed', true );

			} );

            jQuery('#customize-footer-actions .devices button').on( 'click', function( event ) {
                event.preventDefault();
                var device = jQuery(this).data('device');
                var queries 	= jQuery( '.responsive-switchers' );

				queries.find( 'button' ).removeClass( 'active' );
                queries.find( 'button.preview-' + device ).addClass( 'active' );

                var control = jQuery('.range-slider.has-media-queries');
                control.find('.desktop-range').removeClass('active');
                control.find('.tablet-range').removeClass('active');
                control.find('.mobile-range').removeClass('active');
                control.find('.' + device + '-range').addClass('active');
            });
		}



		theme_controls.unbind().on('click', '.preview-desktop.active', function () {
			jQuery( this ).parent().parent().toggleClass( 'responsive-switchers-open' );
		});
        
		theme_controls.on('input', '.range-slider__range', function () {
			var slider = jQuery(this);
			var input = jQuery(this).next();
			var control = jQuery(this).parent().parent();
			syncRangeText( slider, input, 'slider');
			updateValues( control );
		});

		theme_controls.on('keyup', '.range-slider-value', function(){
			var control = jQuery(this).parent().parent();
			updateValues( control );
		});
		theme_controls.on('keydown', '.range-slider-value', function(){
			var slider = jQuery(this).prev();
			var input = jQuery(this);
			syncRangeText( slider, input, 'input');
		});


		theme_controls.on('click', '.range-reset-slider', function (event) {
			event.preventDefault();
			var input = jQuery(this).prev();
			var slider = input.prev();
			var control = jQuery(this).parent().parent();
			var defaultValue = slider.data('default');
			input.val( defaultValue );
			slider.val( defaultValue );
			updateValues( control );
		});

		responsiveSwitcher();

		if ( 'postMessage' === control.setting.transport ) {
			changeAction = 'mousemove change';
		} else {
			changeAction = 'change';
		}

		// Change the value
		this.container.on( changeAction, '.range-collector', function() {
			control.setting.set( jQuery( this ).val() );
		});
	}
});


