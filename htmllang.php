<?php
/*
Plugin Name: HTML lang attribute per post
Version: 0.0.1
Author: Nils Norman Haukås
Description: This plugin allows you to specify a html lang attribute per post to override the site-wide default.
License: GPL2
*/

if(!class_exists('Html_Lang'))
{
  class Html_Lang
  {

    public function __construct()
    {
      add_filter( 'post_class', array($this, 'htmlLang') );
      add_action( 'add_meta_boxes', array($this, 'add_my_meta_boxes') );
      add_action( 'save_post', array($this, 'save_htmllang_meta') );
      register_uninstall_hook( __FILE__, array( $this, 'on_uninstall' ) );
    }

    public function htmllang( $classes ) {
      $htmllang_stored_meta = get_post_meta( get_the_ID(), 'html-lang', true );
      $htmllang_stored_meta = sanitize_text_field( $htmllang_stored_meta );
      if( !empty( $htmllang_stored_meta ) ) {
        $classes[] = "\"lang=\"" . trim( $htmllang_stored_meta );
      }
      return $classes;
    }

    public function add_my_meta_boxes() {
      add_meta_box('htmllang-meta-box', 'Specify html=lang attribute', array($this, 'show_my_meta_box'), 'post', 'normal', 'high');
    }

    public function show_my_meta_box($post) {
      wp_nonce_field( basename( __FILE__ ), 'htmllang_nonce' );

      ?>

      <p>
        <label for="html-lang" class="htmllang-row-title"><?php _e( 'Select post lang attribute', 'htmllang-textdomain' )?></label>
        <select name="html-lang" id="html-lang">
        <?php echo $this->createSelectHtml()?>
        </select>
      </p>

      <?php
    }

    public function on_uninstall() {
      delete_metadata( 'post', null, 'html-lang', null, true );
    }

    public function save_htmllang_meta( $post_id ) {
      // Checks save status
      $is_autosave = wp_is_post_autosave( $post_id );
      $is_revision = wp_is_post_revision( $post_id );
      $is_valid_nonce = ( isset( $_POST[ 'htmllang_nonce' ] ) && wp_verify_nonce( $_POST[ 'htmllang_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

      // Exits script depending on save status
      if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
      }

      // Checks for input and sanitizes/saves if needed
      if( isset( $_POST[ 'html-lang' ] ) ) {
        update_post_meta( $post_id, 'html-lang', sanitize_text_field( $_POST[ 'html-lang' ] ) );
      }

    }

    protected function createSelectHtml( $array ) {
      $result = "";
      $htmllang_stored_meta = get_post_meta( get_the_ID(), 'html-lang', true );

      foreach ($this->localeList() as $locale => $langName) {
          ?>
          <option value="<?php echo $locale;?>" <?php if ( isset ( $htmllang_stored_meta ) ) selected( $htmllang_stored_meta, $locale ); ?>>
            <?php echo $langName . " (" . $locale . ") "; ?>
          </option>
          <?php
      }
    }

    protected function localeList() {
      return [
      "af" => "Afrikaans",
      "sq" => "Albanian",
      "ar" => "Arabic",
      "eu" => "Basque",
      "be" => "Belarusian",
      "bs" => "Bosnian",
      "bg" => "Bulgarian",
      "ca" => "Catalan",
      "hr" => "Croatian",
      "zh_cn" => " Chinese (Simplified)",
      "zh_tw" => " Chinese (Traditional)",
      "cs" => "Czech",
      "da" => "Danish",
      "nl" => "Dutch",
      "en" => "English",
      "en_us" => " English (US)",
      "et" => "Estonian",
      "fa" => "Farsi",
      "fil" => " Filipino",
      "fi" => "Finnish",
      "fr" => "French",
      "fr_ca" => " French (Canada)",
      "ga" => "Gaelic",
      "gl" => "Gallego",
      "ka" => "Georgian",
      "de" => "German",
      "de_du" => " German (Personal)",
      "el" => "Greek",
      "gu" => "Gujarati",
      "he" => "Hebrew",
      "hi" => "Hindi",
      "hu" => "Hungarian",
      "is" => "Icelandic",
      "id" => "Indonesian",
      "it" => "Italian",
      "ja" => "Japanese",
      "kn" => "Kannada",
      "km" => "Khmer",
      "ko" => "Korean",
      "lo" => "Lao",
      "lt" => "Lithuanian",
      "lv" => "Latvian",
      "ml" => "Malayalam",
      "ms" => "Malaysian",
      "mi_tn" => " Maori (Ngai Tahu)",
      "mi_wwow" => " Maori (Waikoto Uni)",
      "mn" => "Mongolian",
      "no" => "Norwegian",
      "no_gr" => " Norwegian (Primary)",
      "nn" => "Nynorsk",
      "pl" => "Polish",
      "pt" => "Portuguese",
      "pt_br" => " Portuguese (Brazil)",
      "ro" => "Romanian",
      "ru" => "Russian",
      "sm" => "Samoan",
      "sr" => "Serbian",
      "sk" => "Slovak",
      "sl" => "Slovenian",
      "so" => "Somali",
      "es" => "Spanish (International)",
      "sv" => "Swedish",
      "tl" => "Tagalog",
      "ta" => "Tamil",
      "th" => "Thai",
      "to" => "Tongan",
      "tr" => "Turkish",
      "uk" => "Ukrainian",
      "vi" => "Vietnamese",
      ];
    }

  } // END class Html_Lang
} // END if(!class_exists('Html_Lang'))

$Html_Lang = new Html_Lang();

?>