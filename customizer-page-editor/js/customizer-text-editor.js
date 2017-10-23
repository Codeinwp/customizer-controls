/* global tinyMCE */
/* global wp */

/* exported WPEditorWidget */
var WPEditorWidget = {

    /**
     * @var string
     */
    currentContentId: '',

    /**
     * @var int
     */
    wpFullOverlayOriginalZIndex: 0,

    /**
     * @var bool
     */
    isVisible: false,

    /**
     * Toggle editor.
     * @param string contentId
     */
    toggleEditor: function(contentId){
       if ( this.isVisible === true ) {
           this.hideEditor();
       } else {
           this.showEditor(contentId);
       }
    },

    /**
     * Show the editor
     * @param string contentId
     */
    showEditor: function(contentId) {
        this.isVisible = true;
        var overlay = jQuery('.wp-full-overlay');
        
        jQuery('body.wp-customizer #wp-editor-widget-container').fadeIn(100).animate({'bottom':'0'});

        this.currentContentId = contentId;
        this.wpFullOverlayOriginalZIndex = parseInt( overlay.css('zIndex') );
        overlay.css({ zIndex: 49000 });

        this.setEditorContent(contentId);
    },

    /**
     * Hide editor
     */
    hideEditor: function() {
        this.isVisible = false;
        jQuery('body.wp-customizer #wp-editor-widget-container').animate({'bottom':'-650px'}).fadeOut();
        jQuery('.wp-full-overlay').css({ zIndex: this.wpFullOverlayOriginalZIndex });
    },

    /**
     * Set editor content
     */
    setEditorContent: function(contentId) {
        var editor = tinyMCE.EditorManager.get('wpeditorwidget');
        var content = jQuery('#'+ contentId).val();

        if (typeof editor === 'object' && editor !== null) {
            editor.setContent(content);
        }
        jQuery('#wpeditorwidget').val(content);
    },

    /**
     * Update widget and close the editor
     */
    updateWidgetAndCloseEditor: function() {

        jQuery('#wpeditorwidget-tmce').trigger('click');
        var editor = tinyMCE.EditorManager.get('wpeditorwidget');
        var content = editor.getContent();

        if (typeof editor === 'undefined' || editor === null || editor.isHidden()) {
            content = jQuery('#wpeditorwidget').val();
        }

        var contentId = jQuery('#'+ this.currentContentId);
        contentId.val(content);


        if ( contentId.attr('class') === 'editorfield') {
            var controlid = contentId.data('customize-setting-link');
            setTimeout(function(){
                wp.customize(controlid, function(obj) {
                    obj.set(editor.getContent());
                } );
            }, 1000);
        }

        this.hideEditor();
    }

};

jQuery( document ).ready(function() {
    jQuery('.customize-section-back').on('click',function(){
        WPEditorWidget.hideEditor();
    });

    var customize = wp.customize;
    customize.previewer.bind( 'trigger-close-editor', function( data ) {
        if( data === true ){
            WPEditorWidget.hideEditor();
        }
    });

});