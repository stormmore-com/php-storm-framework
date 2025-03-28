<?php

namespace Infrastructure\Configuration;

use Infrastructure\Settings\Settings;
use Stormmore\Framework\Configuration\Configuration;
use Stormmore\Framework\Configuration\IConfiguration;
use Stormmore\Framework\Configuration\JsonConfigurationLoader;
use Stormmore\Framework\Internationalization\Culture;
use Stormmore\Framework\Internationalization\I18n;
use Stormmore\Framework\Internationalization\Locale;
use Stormmore\Framework\Mvc\IO\Request\Request;

readonly class LocaleConfigure implements IConfiguration
{
    public function __construct(private Request $request,
                                private Settings $settings,
                                private I18n $i18n)
    {
    }

    public function configure(): void
    {
        $locale = $this->getAcceptedLocale();

        $this->i18n->setLocale($locale);

        $this->loadTranslations($locale);
        $this->loadCulture($locale);
    }

    private function getAcceptedLocale(): Locale
    {
        if ($this->request->cookies->has('locale')) {
            $tag = $this->request->cookies->get('locale');
            if ($this->settings->i18n->localeExists($tag)) {
                return new Locale($tag);
            }
        }
        $defaultLocale = $this->settings->i18n->defaultLocale;
        $supportedLocales = $this->settings->i18n->locales;
        return $this->request->getFirstAcceptedLocale($supportedLocales) ?? $defaultLocale;
    }

    private function loadTranslations(Locale $locale): void
    {
        $tagFilename = "@/i18n/$locale->tag.conf";
        $languageFilename = "@/i18n/$locale->languageCode.conf";
        if (file_path_exist($tagFilename)) {
            $this->i18n->loadTranslations($tagFilename);
        }
        if (file_path_exist($languageFilename)) {
            $this->i18n->loadTranslations($languageFilename);
        }
    }

    private function loadCulture(Locale $locale): void
    {
        $tagFilename = "@/i18n/culture/{$locale->tag}.conf";
        $languageFilename = "@/i18n/culture/{$locale->languageCode}.conf";
        if (file_path_exist($tagFilename)) {
            $this->i18n->loadCulture($tagFilename);
        }
        if (file_path_exist($languageFilename)) {
            $this->i18n->loadCulture($languageFilename);
        }
    }
}