<?php

namespace MediaWiki\Extension\MW_EXT_Src;

use OutputPage, Parser, PPFrame, Skin;
use MediaWiki\Extension\MW_EXT_Core\MW_EXT_Core;

/**
 * Class MW_EXT_Src
 * ------------------------------------------------------------------------------------------------------------------ */
class MW_EXT_Src {

	/**
	 * Register tag function.
	 *
	 * @param Parser $parser
	 *
	 * @return bool
	 * @throws \MWException
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onParserFirstCallInit( Parser $parser ) {
		$parser->setHook( 'src', [ __CLASS__, 'onRenderTag' ] );

		return true;
	}

	/**
	 * Render tag function.
	 *
	 * @param $input
	 * @param array $args
	 * @param Parser $parser
	 * @param PPFrame $frame
	 *
	 * @return null|string
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onRenderTag( $input, $args = [], Parser $parser, PPFrame $frame ) {
		// Message: block title.
		$msgTitle = MW_EXT_Core::getMessageText( 'src', 'block-title' );

		// Argument: type.
		$getType = MW_EXT_Core::outClear( $args['type'] ?? '' ?: 'block' );
		$outType = $getType;

		// Argument: title.
		$getTitle = MW_EXT_Core::outClear( $args['title'] ?? '' ?: $msgTitle );
		$outTitle = $getTitle;

		// Argument: lang.
		$getLang = MW_EXT_Core::outClear( $args['lang'] ?? '' ?: 'none' );
		$outLang = $getLang;

		// Get content.
		$getContent = MW_EXT_Core::outClear( $input );
		$outContent = $getContent;

		// Out code class.
		$outClass = ' class="language-' . $outLang . '"';

		// Out HTML.
		if ( $outType === 'block' ) {
			$outHTML = '<div class="mw-ext-src mw-ext-src-block navigation-not-searchable">';
			$outHTML .= '<div class="mw-ext-src-header"><div class="mw-ext-src-title">' . $outTitle . '</div><div class="mw-ext-src-lang">' . $outLang . '</div></div>';
			$outHTML .= '<div class="mw-ext-src-content"><pre><code' . $outClass . '>' . $outContent . '</code></pre></div>';
			$outHTML .= '</div>';
		} elseif ( $outType === 'inline' ) {
			$outHTML = '<span class="mw-ext-src mw-ext-src-inline"><code' . $outClass . '>' . $outContent . '</code></span>';
		} else {
			$parser->addTrackingCategory( 'mw-ext-src-error-category' );

			return null;
		}

		// Out parser.
		$outParser = $outHTML;

		return $outParser;
	}

	/**
	 * Load resource function.
	 *
	 * @param OutputPage $out
	 * @param Skin $skin
	 *
	 * @return bool
	 * -------------------------------------------------------------------------------------------------------------- */

	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		$out->addModuleStyles( [ 'ext.mw.src.styles' ] );
		$out->addModules( [ 'ext.mw.src' ] );

		return true;
	}
}
