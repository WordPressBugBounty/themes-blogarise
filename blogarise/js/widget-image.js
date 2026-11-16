jQuery(document).ready(function ($) {
    'use strict';

    // Handle Upload / Select Image
    $(document).on('click', '.custom_media_button_team', function (e) {
        e.preventDefault();

        var $button = $(this);
        var $container = $button.closest('.author-image-wrap');
        var $urlInput = $container.find('.custom_media_url_team');
        var $previewImg = $container.find('.custom_media_image_team');
        var $removeBtn = $container.find('.custom_media_remove_team');

        // Create an isolated media modal
        var frame = wp.media({
            title: 'Select or Upload Author Image',
            button: { text: 'Use this image' },
            library: { type: 'image' },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $urlInput.val(attachment.url).trigger('change');
            $previewImg.attr('src', attachment.url).show();
            $removeBtn.show();
        });

        frame.open();
    });

    // Handle Remove Image
    $(document).on('click', '.custom_media_remove_team', function (e) {
        e.preventDefault();

        var $button = $(this);
        var $container = $button.closest('.author-image-wrap');

        $container.find('.custom_media_url_team').val('').trigger('change');
        $container.find('.custom_media_image_team').attr('src', '').hide();
        $button.hide();
    });
});