<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: LanguagesManager
 *
 * @see http://piwik.org/translations/
 *
 * The LanguagesManager API lets you access existing Piwik translations, and
 * change Users languages preferences. "getTranslationsForLanguage" will return
 * all translation strings for a given language, so you can leverage Piwik
 * translations in your application (and automatically benefit from the 40+
 * translations!). This is mostly useful to developers who integrate Piwik API
 * results in their own application. You can also request the default language
 * to load for a user via "getLanguageForUser", or update it via
 * "setLanguageForUser".
 */
class LanguagesManager extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'LanguagesManager' );
    }

    /**
     * Proofe if language is available
     *
     * @param string $languageCode
     */
    public function isLanguageAvailable( $languageCode )
    {
        $this->setQuery( 'isLanguageAvailable' );
        $this->setParameter( 'languageCode', $languageCode );

        return $this->execute();
    }

    /**
     * Get all available languages
     */
    public function getAvailableLanguages()
    {
        $this->setQuery( 'getAvailableLanguages' );

        return $this->execute();
    }

    /**
     * Get all available languages with information
     */
    public function getAvailableLanguagesInfo()
    {
        $this->setQuery( 'getAvailableLanguagesInfo' );

        return $this->execute();
    }

    /**
     * Get all available languages with their names
     */
    public function getAvailableLanguageNames()
    {
        $this->setQuery( 'getAvailableLanguageNames' );

        return $this->execute();
    }

    /**
     * Get translations for a language
     *
     * @param string $languageCode
     */
    public function getTranslationsForLanguage( $languageCode )
    {
        $this->setQuery( 'getTranslationsForLanguage' );
        $this->setParameter( 'languageCode', $languageCode );

        return $this->execute();
    }

    /**
     * Get the language for the user with the login $login
     *
     * @param string $login
     */
    public function getLanguageForUser( $login )
    {
        $this->setQuery( 'getLanguageForUser' );
        $this->setParameter( 'login', $login );

        return $this->execute();
    }

    /**
     * Set the language for the user with the login $login
     *
     * @param string $login
     * @param string $languageCode
     */
    public function setLanguageForUser( $login, $languageCode )
    {
        $this->setQuery( 'setLanguageForUser' );
        $this->setParameters( array(
            'login'         => $login,
            'languageCode'  => $languageCode,
        ));

        return $this->execute();
    }
}