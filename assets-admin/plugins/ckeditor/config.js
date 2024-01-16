/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

var AdminSiteUrl = $('input#hidden_admin_site_url_input').val();
CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    // config.bodyClass = 'article-editor';
    config.extraPlugins = 'filebrowser,html5audio';
    // config.uiColor = '#fe7c04';
    config.fullPage = false;
    config.allowedContent = false;
    config.disallowedContent = 'script; *[on*]';
    config.filebrowserBrowseUrl = AdminSiteUrl + '/ckeditor-upload?type=Files';
    config.filebrowserUploadMethod = "form";
    config.filebrowserUploadUrl = AdminSiteUrl + '/ckeditor-upload/';


    // Remove the redundant buttons from toolbar groups defined above.
    config.removeButtons = 'Save,NewPage,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About';

    config.height = 300;
};