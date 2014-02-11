<?php

namespace uifarm\helper;
    
class StickyPostHelper {

    public static function getEmailShareLink( $title, $link ) {
        echo 'mailto:?subject=' . $title . '&amp;body=' . $title . ' &mdash; ' . $link;
    }

    public static function getFacebookShareLink( $title, $link ) {
        echo 'https://www.facebook.com/sharer/sharer.php?u=' .
            urlencode( $link ) . '&t=' . urlencode( $title );
    }

    public static function getTwitterShareLink( $title, $link ) {
        echo 'https://twitter.com/intent/tweet?source=webclient&text=' .
            urlencode( $link . ' ' . $title );
    }

    public static function isShowStickyPost() {

        $showStickyPostVal = get_option( 'show_sticky_post' );
        if( !empty( $showStickyPostVal ) && strtolower( $showStickyPostVal ) === 'true' ) {
            return true;
        } 
        return false;

    }    
    
}

?>