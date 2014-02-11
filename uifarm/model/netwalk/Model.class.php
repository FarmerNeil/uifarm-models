<?php

namespace uifarm\model\netwalk;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\netwalk\NetwalkHelper as NetwalkHelper;
use uifarm\wp\Debug as Debug;

class Model extends BaseModel {

    private function getFirstName() {
        return $this->getData()->fname;
    }

    private function getLastName() {
        return $this->getData()->lname;
    }

    private function getShareModelName() {
        return ucwords( strtolower( $this->getFirstName() ) ) . " " . ucwords( strtolower( $this->getLastName() ) );
    }

    private function getShareModelURLName() {
        return strtolower( $this->getFirstName() )  . "-" . strtolower( $this->getLastName() );
    }

    public function getFullName() {
        return NetwalkHelper::getFullName( $this->getFirstName(), $this->getLastName() );
    }

    public function hasSecondaryBook() {
        return (count($this->getData()->books) > 1);
    }

    private function getPortfolioBook( $type ) {
        $portfolio = array();
        try {
            foreach ( $this->getData()->books[$type]->pages as $portfolioItem ) {
                $imageSrc = $portfolioItem->picture->url;
                $w = $portfolioItem->picture->w;
                $h = $portfolioItem->picture->h;
                $credit = $portfolioItem->picture->note;
                array_push($portfolio, new ModelPhoto($imageSrc,$w,$h,$credit));
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        return $portfolio;
    }

    public function getPortfolio() {
        return $this->getPortfolioBook(NetwalkConstants::NETWALK_BOOK_TYPE_MAIN);
    }

    public function getSecondaryBook() {
        return $this->getPortfolioBook(NetwalkConstants::NETWALK_BOOK_TYPE_POLAROIDS);
    }

    public function getSecondaryBookTitle() {
        $title = $this->getData()->books[NetwalkConstants::NETWALK_BOOK_TYPE_POLAROIDS]->title;
        return !(strlen($title) === 0) ? ucwords(strtolower($title)) : NetwalkConstants::NETWALK_LABEL_SECONDARY_BOOK_TITLE;
    }

    public function getStats() {
        $stats = array();
        foreach ( $this->getData()->features as $stat ) {
            array_push($stats, new ModelStat($stat->name,$stat->value));
        }
        return $stats;
    }

    public function getFacebookShareURL() {
        $baseURL = 'https://www.facebook.com/sharer/sharer.php';
        $uVal = urlencode( WP_SITEURL . "model/" . $this->getData()->id . "/" . $this->getShareModelURLName() );
        $tVal = urlencode( $this->getShareModelName() );
        return $baseURL . '?u=' . $uVal . '&t=' . $tVal;
    }

    public function getTwitterShareURL() {
        $baseURL = 'https://twitter.com/intent/tweet?source=webclient&text=';
        $shareQuery = WP_SITEURL . "model/" . $this->getData()->id . "/" . $this->getShareModelURLName() . "/ " . $this->getShareModelName();
        return $baseURL . urlencode( $shareQuery );
    }

    public function getEmailFriendURL() {
        $baseURL = 'mailto:?subject=' . $this->getShareModelName() . '&amp;body=';
        $shareQuery = WP_SITEURL . "model/" . $this->getData()->id . "/" . $this->getShareModelURLName() . "/";
        return $baseURL . urlencode( $shareQuery );
    }

    public function getCoverPhoto() {
        $coverSrc = $this->getData()->cover;
        if( Debug::isDebugMode() ) {
            $coverSrc = WP_SITEURL . "assets/model/model.jpg";
        }
        $coverPhoto = new ModelPhoto( $coverSrc, null, null, null );
        return $coverPhoto->getImageSrc();
    }

    public function getPrintBookURL() {
        return '/book/' . $this->getShareModelURLName();
    }

    public function getPrintBookDownloadFilename() {
        return $this->getShareModelURLName() . '.pdf';
    }

}

?>