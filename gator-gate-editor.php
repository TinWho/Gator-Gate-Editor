/*
 * Plugin Name:       Gator-Gate Editor for bbPress
 * Description:         Forked/Modified version of the bbPress Visual Editor.
 * Version:                 0.1.0 Alpha
 * License:                 GPL-2.0-or-later
 *
 * AI-generated/AI-assisted code provided AS-IS.
 * User assumes all risk and responsibility for use.
 */



/* ==========================================================================
   Module 1: Base TinyMCE Arguments & Canvas Options
   ========================================================================= */

// 1. Enable Full TinyMCE Editor for bbPress
function ultralight_editor_enable_full_tinymce_args( $args = array() ) {
    $args['tinymce']       = true; 
    $args['teeny']         = false; 
    $args['quicktags']     = true; 
    $args['textarea_rows'] = 25; 
    $args['media_buttons'] = false; 
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'ultralight_editor_enable_full_tinymce_args', 99 );

// 2. Set default WordPress editor mode to TinyMCE
add_filter( 'wp_default_editor', function() { return 'tinymce'; }, 9999 );

// 3. Inject Left-Hand Tab Buttons for Editor Modes
function ultralight_editor_inject_mirrored_left_tabs() {
    ?>
    <div class="bbp-safe-standalone-actions-row" style="display: block; clear: both; width: 100%; margin-bottom: -1px; position: relative; z-index: 999;">
        <div class="wp-editor-tabs" style="display: flex; gap: 4px; justify-content: flex-start; align-items: flex-end; float: left; margin: 0; padding: 0;">
            
            <!-- Mirrored Visual Mode Active Tab Button -->
            <button type="button" id="bbp_custom_mirror_visual_tab" class="wp-switch-editor switch-tmce" style="float: none; display: inline-block; margin: 5px 0 0 0; padding: 3px 8px; font-weight: 600; background: #f0f0f1; color: #1d2327; border: 1px solid #dcdcde; border-bottom: 1px solid #f0f0f1; border-radius: 4px 4px 0 0; cursor: pointer; outline: none;">
                Visual
            </button>
            
            <!-- Mirrored Code/Text Mode Inactive Tab Button -->
            <button type="button" id="bbp_custom_mirror_code_tab" class="wp-switch-editor switch-html" style="float: none; display: inline-block; margin: 5px 0 0 0; padding: 3px 8px; font-weight: 400; background: #eaeaea; color: #646970; border: 1px solid #dcdcde; border-bottom: none; border-radius: 4px 4px 0 0; cursor: pointer; outline: none;">
                Text
            </button>
            
        </div>
        <div style="clear: both;"></div>
    </div>

    <style type="text/css">
        .wp-editor-wrap:not(.bbp-debug-mode-active) .wp-editor-tools .wp-editor-tabs { 
            display: none !important; 
            visibility: hidden !important; 
            pointer-events: none !important; 
        }
    </style>
    <?php
}
add_action( 'bbp_theme_before_reply_form_content', 'ultralight_editor_inject_mirrored_left_tabs', 1 );
add_action( 'bbp_theme_before_topic_form_content', 'ultralight_editor_inject_mirrored_left_tabs', 1 );

// 4. Populate Row 1 Core TinyMCE Buttons
function ultralight_editor_add_buttons_row_one( $buttons ) {
    if ( ! is_array( $buttons ) ) { $buttons = array(); }
    if ( ! in_array( 'image', $buttons ) ) { $buttons[] = 'image'; }
    if ( ! in_array( 'media', $buttons ) ) { $buttons[] = 'media'; } 
    return $buttons;
}
add_filter( 'mce_buttons', 'ultralight_editor_add_buttons_row_one', 99 );

// 5. Populate Row 2 Core TinyMCE Font & Sizing Dropdowns
function ultralight_editor_add_dropdowns_to_row_two( $buttons ) {
    if ( ! is_array( $buttons ) ) { $buttons = array(); }
    $buttons[] = 'fontselect'; 
    $buttons[] = 'fontsizeselect'; 
    return $buttons;
}
add_filter( 'mce_buttons_2', 'ultralight_editor_add_dropdowns_to_row_two', 20 );

// 6. Define Core Editor Advanced Options and Content Styles
function ultralight_editor_populate_options( $init_array ) {
    $init_array['font_formats'] =  
        'Arial=arial,helvetica,sans-serif;' .
        'Helvetica=helvetica,sans-serif;' .
        'Montserrat=Montserrat,sans-serif;' .
        'Roboto=Roboto,sans-serif;' .
        'Tahoma=tahoma,arial,sans-serif;' .
        'Verdana=verdana,geneva,sans-serif;' .
        'Georgia=georgia,palatino,serif;' .
        'Playfair Display=Playfair Display,serif;' .
        'Times New Roman=times new roman,times,serif;' .
        'Comic Sans MS=comic sans ms,sans-serif;' .
        'Courier New=courier new,courier,monospace;' .
        'Impact=impact,chicago,sans-serif;' .
        'Trebuchet MS=trebuchet ms,geneva,sans-serif';
                                  
    $init_array['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 22px 24px 28px 36px';
    $init_array['forced_root_block'] = 'p';
    $init_array['paste_as_text'] = false;
    $init_array['paste_remove_styles'] = false;
    
    $init_array['remove_linebreaks'] = false;
    $init_array['convert_newlines_to_brs'] = false;
    $init_array['apply_source_formatting'] = true; 
    $init_array['remove_trailing_brs'] = true;
    $init_array['verify_html'] = true;
    
    $init_array['media_live_embeds'] = true; 
    $init_array['media_alt_source']  = false;
    $init_array['media_poster']      = false;
    $init_array['media_dimensions']  = true; 
    $init_array['media_filter_html'] = false; 
    
    $default_styles = 'body.mce-content-body { font-family: Roboto, sans-serif !important; font-size: 14px !important; line-height: 1.2 !important; } ' .
                      'body.mce-content-body p { font-size: 14px !important; margin: 0 0 1px 0 !important; padding: 0 !important; line-height: 1.2 !important; min-height: 1.2em !important; } ' .
                      'body.mce-content-body img.alignright, body.mce-content-body img.alignleft { display: block !important; clear: both !important; float: none !important; margin-top: 6px !important; margin-bottom: 12px !important; } ' .
                      'body.mce-content-body img.alignright { margin-left: auto !important; margin-right: 0px !important; } ' .
                      'body.mce-content-body img.alignleft { margin-left: 0px !important; margin-right: auto !important; }' .
                      'body.mce-content-body iframe { border: 2px solid #2ecc71 !important; background: #000000 !important; max-width: 100% !important; pointer-events: auto !important; }';
    
    if ( isset( $init_array['content_style'] ) ) {
        $init_array['content_style'] .= ' ' . $default_styles;
    } else {
        $init_array['content_style'] = $default_styles;
    }

    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'ultralight_editor_populate_options', 25 );
/* ==========================================================================
   Module 1.1: Dialogue Interceptors & Live View Canvas Mirror Toggle System
   ========================================================================== */

// 1. Inject dialogue firewalls inside TinyMCE configuration initialization layers
function ultralight_editor_inject_dialogue_firewalls( $init_array ) {
    $init_array['setup'] = "function(editor) {
        editor.on('init', function() {
            this.execCommand('fontSize', false, '14px');
        });

        editor.on('OpenWindow', function(e) {
            setTimeout(function() {
                var dialogueTextareas = document.querySelectorAll('.mce-window textarea, .tox-dialog textarea, .mce-formitem textarea');
                dialogueTextareas.forEach(function(textareaElement) {
                    if (textareaElement.getAttribute('name') === 'html_source_code_field') { return; }
                    
                    textareaElement.readOnly = true;
                    textareaElement.setAttribute('placeholder', 'Please click the GENERAL tab above and paste clean video page URLs into the Source box instead.');
                    textareaElement.style.setProperty('background-color', '#f0f0f1', 'important');
                    textareaElement.style.setProperty('cursor', 'not-allowed', 'important');
                    textareaElement.style.setProperty('color', '#a7aaad', 'important');

                    var blockEmbedInput = function(cancelEvent) {
                        if (cancelEvent.isTrusted) {
                            cancelEvent.preventDefault();
                            cancelEvent.stopPropagation();
                            alert(
                                'NOTICE: Direct iframe embed codes are locked.\\n\\n' +
                                '• Please use the GENERAL tab to insert a plain video link URL instead.\\n' +
                                '• This prevents code duplication and keeps your forum layout responsive.'
                            );
                            return false;
                        }
                    };
                    textareaElement.addEventListener('paste', blockEmbedInput, true);
                    textareaElement.addEventListener('keydown', blockEmbedInput, true);
                });
            }, 100);
        });
    }";

    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'ultralight_editor_inject_dialogue_firewalls', 30 );

// 2. Bind the user interaction layers for custom mirrored canvas tabs
function ultralight_editor_bind_mirrored_tabs_via_jquery() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document).on('click', '#bbp_custom_mirror_visual_tab', function(e) {
                e.preventDefault();
                var targetEditorId = $('.wp-editor-area').first().attr('id');
                var activeEditorInstance = tinyMCE.get(targetEditorId);
                if (activeEditorInstance && activeEditorInstance.isHidden()) {
                    tinymce.execCommand('mceToggleEditor', false, targetEditorId);
                }
                $('#bbp_custom_mirror_code_tab').css({'background': '#eaeaea', 'color': '#646970', 'border-bottom': 'none', 'font-weight': '400'});
                $(this).css({'background': '#f0f0f1', 'color': '#1d2327', 'border-bottom': '1px solid #f0f0f1', 'font-weight': '600'});
            });

            $(document).on('click', '#bbp_custom_mirror_code_tab', function(e) {
                e.preventDefault();
                var targetEditorId = $('.wp-editor-area').first().attr('id');
                var activeEditorInstance = tinyMCE.get(targetEditorId);
                if (activeEditorInstance && !activeEditorInstance.isHidden()) {
                    activeEditorInstance.save();
                    tinymce.execCommand('mceToggleEditor', false, targetEditorId);
                    $('#' + targetEditorId).css({
                        'font-family': 'monospace',
                        'font-size': '13px',
                        'line-height': '1.4',
                        'padding': '10px',
                        'background': '#ffffff',
                        'color': '#1d2327',
                        'outline': 'none'
                    });
                }
                $('#bbp_custom_mirror_visual_tab').css({'background': '#eaeaea', 'color': '#646970', 'border-bottom': 'none', 'font-weight': '400'});
                $(this).css({'background': '#f0f0f1', 'color': '#1d2327', 'border-bottom': '1px solid #f0f0f1', 'font-weight': '600'});
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'ultralight_editor_bind_mirrored_tabs_via_jquery', 9999 );

/* ==========================================================================
   Module 1.2: Shortcode Engine Translators & Data-Binding Gatekeeper (FIXED)
   ========================================================================== */

// Compile final setup loop using the unified project prefix
function ultralight_editor_compile_final_setup_loop( $init_array ) {
    
    $engine_translators = "
        // FIXED: Only block image extensions if inside a dedicated media/video window title
        editor.settings.urlconverter_callback = function(url, node, on_save, name) {
            if (url) {
                var checkedString = url.toLowerCase().trim();
                var hasImageExtension = /\.(jpg|jpeg|png|gif|webp|svg)/i.test(checkedString);
                var hasHtmlBlock = checkedString.indexOf('<iframe') !== -1 || checkedString.indexOf('<video') !== -1;

                if (hasImageExtension || hasHtmlBlock) {
                    if (on_save) {
                        var activeDialog = document.querySelector('.mce-window, .tox-dialog');
                        if (activeDialog) {
                            var dialogHeader = activeDialog.querySelector('.mce-title, .tox-dialog__title');
                            var dialogTitleText = dialogHeader ? dialogHeader.textContent.toLowerCase() : '';
                            var hasVideoContent = activeDialog.innerHTML.toLowerCase().indexOf('video') !== -1;
                            
                            var isMediaDialog = dialogTitleText.indexOf('video') !== -1 || 
                                                dialogTitleText.indexOf('media') !== -1 || 
                                                (hasVideoContent && dialogTitleText.indexOf('image') === -1);
                            
                            if (isMediaDialog) {
                                var rawInputField = activeDialog.querySelector('input');
                                if (rawInputField) { rawInputField.value = ''; }
                                
                                if (hasImageExtension) {
                                    alert('ERROR: You cannot submit an image link inside the video tool. Please close this window and use the INSERT IMAGE button instead!');
                                } else {
                                    alert('CRITICAL ERROR: Please do NOT submit iframe or video embed code inside the Source URL field. Provide a plain video link URL here instead.');
                                }
                                return '';
                            }
                        }
                    }
                }
            }
            return url;
        };

        editor.on('PostProcess', function(e) {
            if (e.content && e.content.indexOf('<iframe') !== -1) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(e.content, 'text/html');
                var iframes = doc.querySelectorAll('iframe');
                var changed = false;

                iframes.forEach(function(iframe) {
                    var srcUrl = iframe.getAttribute('src') || '';
                    if (srcUrl.indexOf('//') === 0) { srcUrl = 'https:' + srcUrl; }

                    var rawW = iframe.getAttribute('width') || '';
                    var rawH = iframe.getAttribute('height') || '';
                    
                    var cleanW = parseInt(rawW.replace(/[^0-9]/g, ''), 10) || 560;
                    var cleanH = parseInt(rawH.replace(/[^0-9]/g, ''), 10) || 314;

                    if (srcUrl.indexOf('dai.ly/') !== -1) {
                        srcUrl = srcUrl.replace('dai.ly/', '://dailymotion.com');
                    }

                    var shortcodeText = '[embed width=\"' + cleanW + '\" height=\"' + cleanH + '\"]' + srcUrl + '[/embed]';
                    var textNode = doc.createTextNode(shortcodeText);
                    iframe.parentNode.replaceChild(textNode, iframe);
                    changed = true;
                });

                if (changed) { e.content = doc.body.innerHTML; }
            }
        });

        editor.on('BeforeSetContent', function(e) {
            if (e.content && e.content.indexOf('[embed') !== -1) {
                var updatedContent = e.content.replace(/\[embed([^\]]*)\](https?:\/\/[^\s\[\]\"\'><]+)\[\/embed\]/gi, function(match, attributes, url) {
                    var wMatch = attributes.match(/width=[\"\']([^\"\'\']+)[\"\']/i) || attributes.match(/width=([0-9]+)/i);
                    var hMatch = attributes.match(/height=[\"\']([^\"\'\']+)[\"\']/i) || attributes.match(/height=([0-9]+)/i);
                    
                    var width = (wMatch && wMatch[1]) ? wMatch[1] : '560';
                    var height = (hMatch && hMatch[1]) ? hMatch[1] : '314';
                    
                    return '<iframe src=\"' + url.trim() + '\" width=\"' + width + '\" height=\"' + height + '\" frameborder=\"0\" allowfullscreen=\"true\"></iframe>';
                });

                if (updatedContent !== e.content) { e.content = updatedContent; }
            }
        });
    ";

    // Safely append functions to the TinyMCE setup stack to prevent breaking other plugins
    if ( ! empty( $init_array['setup'] ) ) {
        $existing_setup = trim( $init_array['setup'] );
        $init_array['setup'] = "function(editor) {
            (" . $existing_setup . ")(editor);
            (function(editor) { " . $engine_translators . " })(editor);
        }";
    } else {
        $init_array['setup'] = "function(editor) { " . $engine_translators . " }";
    }

    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'ultralight_editor_compile_final_setup_loop', 95 );
/* ==========================================================================
   Module 1.3: Modular Debugger Tool — Native Tab Toggle Override
   ========================================================================== */

// 1. Inject the debug toggle button to the actions row
function ultralight_editor_inject_modular_debug_toggle_button() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var debugToggleHtml = '<button type="button" id="bbp_custom_debug_native_toggle_btn" class="wp-switch-editor" style="float: none; display: inline-block; margin: 5px 0 0 8px; padding: 3px 10px; font-weight: 500; background: #fff2f2; color: #d63638; border: 1px dashed #d63638; border-radius: 4px; cursor: pointer; outline: none; font-size: 12px;">' +
                                  '<span class="dashicons dashicons-admin-tools" style="font-size: 14px; width: 14px; height: 14px; margin-top: 1px; vertical-align: text-top; margin-right: 4px; color: inherit;"></span>' +
                                  'Toggle Native Tabs [Debug]' +
                                  '</button>';

            $('.bbp-safe-standalone-actions-row .wp-editor-tabs').append(debugToggleHtml);
        });
    </script>
    <?php
}
add_action( 'bbp_theme_before_reply_form_content', 'ultralight_editor_inject_modular_debug_toggle_button', 2 );
add_action( 'bbp_theme_before_topic_form_content', 'ultralight_editor_inject_modular_debug_toggle_button', 2 );

// 2. Bind the click behaviour for the debug engine toggle
function ultralight_editor_bind_modular_debug_toggle_javascript() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document).on('click', '#bbp_custom_debug_native_toggle_btn', function(e) {
                e.preventDefault();
                var editorWrap = $(this).closest('.bbp-safe-standalone-actions-row').nextAll('.wp-editor-wrap').first();
                if (editorWrap.length === 0) {
                    editorWrap = $(this).closest('.bbp-safe-standalone-actions-row').parent().find('.wp-editor-wrap');
                }

                if (!editorWrap.hasClass('bbp-debug-mode-active')) {
                    editorWrap.addClass('bbp-debug-mode-active');
                    editorWrap.find('.wp-editor-tools .wp-editor-tabs').css({
                        'display': 'block',
                        'visibility': 'visible',
                        'pointer-events': 'auto',
                        'border': '2px dotted #d63638',
                        'padding': '2px',
                        'background': '#fff2f2'
                    });
                    $(this).css({'background': '#d63638', 'color': '#ffffff', 'border-style': 'solid'});
                } else {
                    editorWrap.removeClass('bbp-debug-mode-active');
                    editorWrap.find('.wp-editor-tools .wp-editor-tabs').css({
                        'display': 'none',
                        'visibility': 'hidden',
                        'pointer-events': 'none'
                    });
                    $(this).css({'background': '#fff2f2', 'color': '#d63638', 'border-style': 'dashed'});
                }
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'ultralight_editor_bind_modular_debug_toggle_javascript', 9999 );
/* ==========================================================================
   Module 2: Media Structure Security & Alignment Filter for bbPress
   ========================================================================== */

// Wrap forum alignments safely and validate image sources using the unified project prefix
function ultralight_editor_wrap_forum_alignments_safely( $content ) {
    if ( empty( $content ) ) {
        return $content;
    }

    if ( strpos( $content, '<img' ) !== false ) {
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $img_matches);
        if ( ! empty( $img_matches ) && isset( $img_matches[1] ) && is_array( $img_matches[1] ) ) {
            foreach ( $img_matches[1] as $src ) {
                $safe_src = esc_url_raw( $src );
                $url      = wp_parse_url( $safe_src );
                $is_safe  = true;
                
                if ( ! isset( $url['scheme'] ) || strtolower( $url['scheme'] ) !== 'https' ) {
                    $is_safe = false;
                }
                if ( isset( $url['host'] ) && is_string( $url['host'] ) ) {
                    $host_lowercase = strtolower( $url['host'] );
                    if ( in_array( $host_lowercase, array('localhost', '127.0.0.1', '::1'), true ) ) {
                        $is_safe = false;
                    }
                }
                if ( isset( $url['path'] ) && ( strpos( $url['path'], 'wp-admin' ) !== false || strpos( $url['path'], 'wp-login' ) !== false ) ) {
                    $is_safe = false;
                }
                if ( ! $is_safe ) {
                    $content = preg_replace('/<img[^>]+src=["\']' . preg_quote($src, '/') . '["\'][^>]*>/is', '', $content);
                }
            }
        }
    }

    if ( strpos( $content, 'text-align' ) !== false ) {
        $content = preg_replace_callback(
            '/<(p|div|span)\s+[^>]*style=["\'][^"\']*text-align:\s*(left|center|right|justify);?[^"\']*["\'][^>]*>(?!\s*\[embed)(.*?)<\/\1>/is', 
            function($matches) {
                $align = strtolower($matches[2]);
                $inner = $matches[3];
                if ($align === 'justify') { $align = 'left'; }
                return '<div class="bbp-align-box align-' . $align . '">' . $inner . '</div>';
            }, 
            $content
        );
    }

    return $content;
}
add_filter( 'bbp_get_reply_content', 'ultralight_editor_wrap_forum_alignments_safely', 15, 1 );
add_filter( 'bbp_get_topic_content', 'ultralight_editor_wrap_forum_alignments_safely', 15, 1 );
/* ==========================================================================
   Module 3: Compact Style & Aspect Reset Engine
   ========================================================================== */

// Sync iframe components to TinyMCE alignment configurations via the unified project prefix
function ultralight_editor_sync_iframe_to_tinymce_alignment() {
    if ( ! function_exists( 'is_bbpress' ) ) { return; }
    if ( ! is_bbpress() && ! is_singular( array( 'forum', 'topic', 'reply' ) ) ) { return; }
    ?>
    <style type="text/css">
        .bbp-reply-content, .bbp-topic-content { 
            display: grid !important; 
            grid-template-columns: 100% !important; 
            row-gap: 0px !important; 
        }
        .bbp-reply-content > p, .bbp-topic-content > p { 
            margin-top: 0px !important; 
            margin-bottom: 6px !important; 
        }
        .bbp-align-box { 
            width: 100% !important; 
            display: flex !important; 
            flex-direction: row !important;
            flex-wrap: wrap !important;
            clear: both !important; 
            margin-top: 6px !important; 
            margin-bottom: 12px !important; 
        }
        .bbp-reply-content img[style*="float: right"], .bbp-topic-content img[style*="float: right"],
        .bbp-reply-content img[style*="float: left"], .bbp-topic-content img[style*="float: left"],
        .bbp-reply-content img.alignright, .bbp-topic-content img.alignright,
        .bbp-reply-content img.alignleft, .bbp-topic-content img.alignleft {
            display: block !important; clear: both !important; float: none !important; margin-top: 6px !important; margin-bottom: 12px !important;
        }
        .bbp-reply-content img[style*="float: right"], .bbp-topic-content img[style*="float: right"],
        .bbp-reply-content img.alignright, .bbp-topic-content img.alignright {
            margin-left: auto !important; margin-right: 0px !important;
        }
        .bbp-reply-content img[style*="float: left"], .bbp-topic-content img[style*="float: left"],
        .bbp-reply-content img.alignleft, .bbp-topic-content img.alignleft {
            margin-left: 0px !important; margin-right: auto !important;
        }
        .bbp-align-box iframe, .bbp-align-box .wp-video, .bbp-align-box .embed-youtube, .bbp-align-box .td-fluid-video-wrapper { 
            max-width: 100% !important; margin-top: 0px !important; margin-bottom: 0px !important; 
        }
        .bbp-align-box iframe, .bbp-align-box .wp-video {
            width: var(--player-width, 560px) !important;
            height: var(--player-height, 314px) !important;
            max-width: 100% !important;
            aspect-ratio: var(--player-width, 560) / var(--player-height, 314) !important;
        }
        .bbp-align-box img { max-width: 100% !important; height: auto !important; margin-top: 0px !important; margin-bottom: 0px !important; }
        .bbp-align-box.align-left { justify-content: flex-start !important; text-align: left !important; }
        .bbp-align-box.align-left iframe { margin-left: 0px !important; margin-right: auto !important; }
        .bbp-align-box.align-center { justify-content: center !important; text-align: center !important; }
        .bbp-align-box.align-center iframe { margin-left: auto !important; margin-right: auto !important; }
        .bbp-align-box.align-right { justify-content: flex-end !important; text-align: right !important; }
        .bbp-align-box.align-right iframe { margin-left: auto !important; margin-right: 0px !important; }
        .mce-content-body iframe { 
            display: inline-block !important; background: #000000 !important; border: 2px dashed #3498db !important; vertical-align: middle !important; max-width: 100% !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ultralight_editor_sync_iframe_to_tinymce_alignment', 99999 );

/* ==========================================================================
   Module 4: Unified Frontend Layout Styling Engine
   ========================================================================== */

// Inject unified frontend layout modifications via the structural project prefix
function ultralight_editor_frontend_layout_styling() {
    if ( ! function_exists( 'is_bbpress' ) ) { return; }
    if ( ! is_bbpress() && ! is_singular( array( 'forum', 'topic', 'reply' ) ) ) { return; }
    ?>
    <style type="text/css">
        div.bbp-topic-content, div.bbp-reply-content, .bbp-reply-content, .bbp-topic-content { 
            font-size: 14px !important; display: grid !important; grid-template-columns: 100% !important; row-gap: 0px !important; 
        }
        div.bbp-topic-content p, div.bbp-reply-content p, li.bbp-topic-content p, li.bbp-reply-content p, .bbp-reply-content p, .bbp-topic-content p {
            margin: 0 0 6px 0 !important; padding: 0 !important; line-height: 1.2 !important; font-size: 14px !important;
        }
        .bbp-reply-content ul li, .bbp-topic-content ul li, .bbp-reply-content ol li, .bbp-topic-content ol li {
            line-height: 1.2 !important; margin-bottom: 2px !important; font-size: 14px !important;
        }
        .bbp-reply-content table, .bbp-topic-content table {
            width: 100% !important; max-width: 100% !important; border-collapse: collapse !important; margin: 8px 0 !important; font-size: 14px !important;
        }
        .bbp-reply-content td, .bbp-topic-content td, .bbp-reply-content th, .bbp-topic-content th {
            border: 1px solid #ccc !important; padding: 4px 6px !important; line-height: 1.2 !important; text-align: left;
        }
        .bbp-reply-content span:not([class*="bbp-"]), .bbp-topic-content span:not([class*="bbp-"]), 
        .bbp-reply-content p span:not([class*="bbp-"]), .bbp-topic-content p span:not([class*="bbp-"]),
        .bbp-reply-content strong, .bbp-topic-content strong,
        .bbp-reply-content em, .bbp-topic-content em { 
            display: inline !important; line-height: 1.2 !important;
        }
        .bbp-reply-content a:not([class]), .bbp-topic-content a:not([class]) {
            display: inline !important; line-height: 1.2 !important;
        }
        .bbp-reply-content p:empty, .bbp-topic-content p:empty { display: block !important; min-height: 1.2em !important; }
        .bbp-reply-content p:empty::before, .bbp-topic-content p:empty::before { content: "\00a0" !important; }
    </style>
    <?php
}
add_action( 'wp_head', 'ultralight_editor_frontend_layout_styling', 99998 );
/* ==========================================================================
   Module 5: Paste Scrubber, Filter Sanitiser & Link Auto-Preview Killer

   Module 5 is alive and grew up to become Gator-Gate and move out to become
   its own (what will be known in time as a) plugin. This rem block is left
   as a tribute to its beginnings.
   ========================================================================== */

/* ==========================================================================
   Module 6: Public Forum Google Fonts CDN Asset Downloader
   ========================================================================== */

// Safely bundle and load font styles for display rendering on frontend pages
function ultralight_editor_load_google_fonts_on_frontend() {
    if ( function_exists('is_bbpress') && is_bbpress() ) {
        // FIXED: Replaced invalid domain with proper Google Fonts delivery stylesheet url
        $fonts_url = 'https://googleapis.com';
        
        wp_enqueue_style( 
            'ultralight-editor-google-fonts', 
            $fonts_url, 
            array(), 
            '1.0.0' 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ultralight_editor_load_google_fonts_on_frontend', 10 );

/* ==========================================================================
   Module 7: Force bbPress Core Front-End Display Filters to Permit Font Selections
   ========================================================================== */

// Bypass standard tag restrictions to persist inline layout settings
function ultralight_editor_bbpress_allow_fonts_on_frontend_display( $allowed_tags ) {
    if ( isset( $allowed_tags['span'] ) && is_array( $allowed_tags['span'] ) ) {
        $allowed_tags['span']['style'] = true;
    }
    if ( isset( $allowed_tags['p'] ) && is_array( $allowed_tags['p'] ) ) {
        $allowed_tags['p']['style'] = true;
    }
    return $allowed_tags;
}
add_filter( 'bbp_kses_allowed_tags', 'ultralight_editor_bbpress_allow_fonts_on_frontend_display', 9999 );

/* ==========================================================================
   Module 8: Un-Block Font Family Properties Inside WordPress Core CSS Filters
   ========================================================================== */

// Whitelist the font family attribute inside WordPress core security filters
function ultralight_editor_allow_font_family_in_inline_styles( $allowed_attr ) {
    if ( ! in_array( 'font-family', $allowed_attr, true ) ) {
        $allowed_attr[] = 'font-family';
    }
    return $allowed_attr;
}
add_filter( 'safe_style_css', 'ultralight_editor_allow_font_family_in_inline_styles', 999 );

/* ==========================================================================
   Module 9: Automated Server-Side Typography & Font Family Force Decoder
   ========================================================================== */

// Sanitize and append clean typography maps to server data blocks
function ultralight_editor_normalize_bbp_font_families_server_side( $content ) {
    if ( empty( $content ) || strpos( $content, 'font-family' ) === false ) {
        return $content;
    }

    $font_map = array(
        'arial'            => 'Arial, helvetica, sans-serif',
        'helvetica'        => 'Helvetica, sans-serif',
        'montserrat'       => 'Montserrat, sans-serif',
        'roboto'           => 'Roboto, sans-serif',
        'tahoma'           => 'Tahoma, arial, sans-serif',
        'verdana'          => 'Verdana, geneva, sans-serif',
        'georgia'          => 'Georgia, palatino, serif',
        'playfair display' => 'Playfair Display, serif',
        'times new roman'  => 'Times New Roman, times, serif',
        'comic sans ms'    => 'Comic Sans MS, sans-serif',
        'courier new'      => 'Courier New, courier, monospace',
        'impact'           => 'Impact, chicago, sans-serif',
        'trebuchet ms'     => 'Trebuchet MS, geneva, sans-serif'
    );

    return preg_replace_callback( '/(font-family\s*:\s*([^;\"\']+);?)/i', function( $matches ) use ( $font_map ) {
        $full_declaration = $matches[1];
        $raw_font_value   = trim( strtolower( $matches[2] ) );

        foreach ( $font_map as $key => $fallback_string ) {
            if ( $raw_font_value === $key || strpos( $raw_font_value, $key . ',' ) === 0 ) {
                return 'font-family: ' . $fallback_string . ';';
            }
        }

        return $full_declaration;
    }, $content );
}
add_filter( 'bbp_get_reply_content', 'ultralight_editor_normalize_bbp_font_families_server_side', 30, 1 );
add_filter( 'bbp_get_topic_content', 'ultralight_editor_normalize_bbp_font_families_server_side', 30, 1 );
/* ==========================================================================
   Module 10: Live Post Shortcode Execution Filter & Alignment Parser
   ========================================================================== */

function ultralight_editor_render_custom_embed_shortcode_classic( $atts, $content = null ) {
    if ( empty( $content ) ) {
        return '';
    }

    $pairs = array(
        'width'  => '560',
        'height' => '314'
    );
    $attributes = shortcode_atts( $pairs, $atts );
    
    $src_url = esc_url_raw( trim( strip_tags( $content ) ) );
    if ( empty( $src_url ) ) {
        return '';
    }

    if ( preg_match( '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/i', $src_url, $yt_matches ) ) {
        $src_url = 'https://youtube.com' . $yt_matches[1];
    } elseif ( preg_match( '/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]+)/i', $src_url, $yt_short_matches ) ) {
        $src_url = 'https://youtube.com' . $yt_short_matches[1];
    } elseif ( preg_match( '/(?:https?:\/\/)?(?:www\.)?dailymotion\.com\/video\/([a-zA-Z0-9]+)/i', $src_url, $dm_matches ) ) {
        $src_url = 'https://dailymotion.com' . $dm_matches[1];
    }

    $w_val = intval( $attributes['width'] ) > 0 ? intval( $attributes['width'] ) : 560;
    $h_val = intval( $attributes['height'] ) > 0 ? intval( $attributes['height'] ) : 314;

    return '##BBP_VIDEO_PLAYER_START##' . 
           '|width:' . $w_val . 
           '|height:' . $h_val . 
           '|src:' . esc_url( $src_url ) . 
           '##BBP_VIDEO_PLAYER_END##';
}

function ultralight_editor_register_custom_embed_shortcode_system_classic() {
    add_shortcode( 'embed', 'ultralight_editor_render_custom_embed_shortcode_classic' );
}
add_action( 'init', 'ultralight_editor_register_custom_embed_shortcode_system_classic', 10 );

add_filter( 'bbp_get_reply_content', 'do_shortcode', 11 );
add_filter( 'bbp_get_topic_content', 'do_shortcode', 11 );

function ultralight_editor_process_video_alignments_and_sizes( $content ) {
    if ( empty( $content ) || strpos( $content, '##BBP_VIDEO_PLAYER_START##' ) === false ) {
        return $content;
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors( true );
    $dom->loadHTML( '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>' . $content . '</body></html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
    libxml_clear_errors();

    $xpath = new DOMXPath( $dom );
    $text_nodes = $xpath->query( '//text()[contains(., "##BBP_VIDEO_PLAYER_START##")]' );

    foreach ( $text_nodes as $node ) {
        $text_value = $node->nodeValue;
        
        $regex = '/##BBP_VIDEO_PLAYER_START##\|width:(\d+)\|height:(\d+)\|src:([^#]+)##BBP_VIDEO_PLAYER_END##/i';
        
        if ( preg_match( $regex, $text_value, $matches ) ) {
            $width   = $matches[1];
            $height  = $matches[2];
            $src     = $matches[3];

            $alignment = 'align-left'; 
            $parent = $node->parentNode;
            
            if ( $parent && strtolower( $parent->nodeName ) === 'p' ) {
                $style = $parent->getAttribute( 'style' );
                if ( ! empty( $style ) && preg_match( '/text-align\s*:\s*(left|center|right)/i', $style, $align_match ) ) {
                    $alignment = 'align-' . strtolower( $align_match[1] );
                }
            }

            $div_box = $dom->createElement( 'div' );
            $div_box->setAttribute( 'class', 'bbp-align-box ' . $alignment );
            $div_box->setAttribute( 'style', '--player-width: ' . $width . 'px; --player-height: ' . $height . 'px; max-width:100%; width:' . $width . 'px;' );

            $iframe = $dom->createElement( 'iframe' );
            $iframe->setAttribute( 'src', $src );
            $iframe->setAttribute( 'width', $width );
            $iframe->setAttribute( 'height', $height );
            $iframe->setAttribute( 'frameborder', '0' );
            $iframe->setAttribute( 'allowfullscreen', 'true' );
            $iframe->setAttribute( 'style', 'border:0; margin:0; width:100%; height:100%;' );
            $div_box->appendChild( $iframe );

            $parts = preg_split( $regex, $text_value );
            $text_before = isset( $parts[0] ) ? $parts[0] : '';
            $text_after  = isset( $parts[1] ) ? $parts[1] : '';

            $fragment = $dom->createDocumentFragment();
            
            if ( ! empty( $text_before ) ) {
                $fragment->appendChild( $dom->createTextNode( $text_before ) );
            }
            
            $fragment->appendChild( $div_box );
            
            if ( ! empty( $text_after ) ) {
                $fragment->appendChild( $dom->createTextNode( $text_after ) );
            }

            if ( $parent && strtolower( $parent->nodeName ) === 'p' && trim( $parent->textContent ) === trim( $text_value ) && empty( $text_before ) && empty( $text_after ) ) {
                $parent->parentNode->replaceChild( $div_box, $parent );
            } else {
                $node->parentNode->replaceChild( $fragment, $node );
            }
        }
    }

    $body_node = $dom->getElementsByTagName('body')->item(0);
    $cleaned_html = '';
    if ( $body_node ) {
        foreach ( $body_node->childNodes as $child ) {
            $cleaned_html .= $dom->saveHTML( $child );
        }
    } else {
        $cleaned_html = $dom->saveHTML();
    }
    
    return $cleaned_html;
}
add_filter( 'bbp_get_reply_content', 'ultralight_editor_process_video_alignments_and_sizes', 12 );
add_filter( 'bbp_get_topic_content', 'ultralight_editor_process_video_alignments_and_sizes', 12 );
