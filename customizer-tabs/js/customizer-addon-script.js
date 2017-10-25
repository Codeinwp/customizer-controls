/* global wp */

/**
 * Script fort the customizer tabs control focus function.
 *
 * @since    1.1.43
 * @package Hestia
 *
 * @author    ThemeIsle
 */
var customize_tabs_focus = function ( $ ) {
    'use strict';
    $( function () {
        var customize = wp.customize;
        $( '.customize-partial-edit-shortcut' ).live( 'DOMNodeInserted', function () {
            $( this ).on( 'click', function() {
                var controlId = $( this ).attr( 'class' );
                var tabToActivate = '';

                if ( controlId.indexOf( 'widget' ) !== -1 ) {
                    tabToActivate = $( '.customizer-tab>.widgets' );
                } else {
                    var controlFinalId = controlId.split( ' ' ).pop().split( '-' ).pop();
                    tabToActivate = $( '.customizer-tab>.' + controlFinalId );
                }

                customize.preview.send( 'tab-previewer-edit', tabToActivate );
            } );
        } );
    } );
};

customize_tabs_focus( jQuery );