<?php

namespace Infrastructure\Middleware;

use closure;
use Infrastructure\Settings\Settings;
use Stormmore\Framework\App\IMiddleware;
use Stormmore\Framework\Configuration\JsonConfigurationLoader;
use Stormmore\Framework\Internationalization\Culture;
use Stormmore\Framework\Internationalization\I18n;
use Stormmore\Framework\Internationalization\Locale;
use Stormmore\Framework\Request\Request;

readonly class LocaleMiddleware implements IMiddleware
{
    public function __construct(private Request $request,
                                private Settings $settings,
                                private I18n $i18n,
                                private JsonConfigurationLoader $jsonConfigurationLoader)
    {
    }

    public function run(closure $next): void
    {
        $locale = $this->getAcceptedLocale();
        $culture = $this->getCulture($locale);

        $this->i18n->setLocale($locale);
        $this->i18n->setCulture($culture);

        $this->loadTranslations($locale);
        $next();
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
        $tagFilename = "@/src/i18n/{$locale->tag}.json";
        $languageFilename = "@/src/i18n/{$locale->languageCode}.json";
        if ($this->jsonConfigurationLoader->exist($tagFilename)) {
            $this->i18n->loadJsonTranslations($tagFilename);
        }
        else if ($this->jsonConfigurationLoader->exist($languageFilename)) {
            $this->i18n->loadJsonTranslations($languageFilename);
        }
    }

    private function getCulture(Locale $locale): Culture
    {
        $culture = new Culture();
        $tagFilename = "@/src/i18n/culture/{$locale->tag}.json";
        $languageFilename = "@/src/i18n/culture/{$locale->languageCode}.json";

        if ($this->jsonConfigurationLoader->exist($tagFilename)) {
            $this->jsonConfigurationLoader->load($culture, $tagFilename);
        }
        else if ($this->jsonConfigurationLoader->exist($languageFilename)) {
            $this->jsonConfigurationLoader->load($culture, $languageFilename);
        }
        return $culture;
    }
}