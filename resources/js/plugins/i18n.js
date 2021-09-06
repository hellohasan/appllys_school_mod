import Vue from 'vue'
import VueI18n from 'vue-i18n'
import Cookies from 'js-cookie'
import enLocale from '../lang/en';
import bnLocale from '../lang/bn';
import arLocale from '../lang/ar';

Vue.use(VueI18n)

const messages = {
    en: {
        ...enLocale,
    },
    bn: {
        ...bnLocale,
    },
    ar: {
        ...arLocale,
    },
};

const i18n = new VueI18n({
    locale: getLanguage(),
    messages,
})

export function getLanguage() {
    const chooseLanguage = Cookies.get('locale');
    if (chooseLanguage) {
        return chooseLanguage;
    }
    // if has not choose language
    const language = (navigator.language || navigator.browserLanguage).toLowerCase();
    const locales = Object.keys(messages);
    for (const locale of locales) {
        if (language.indexOf(locale) > -1) {
            return locale;
        }
    }
    return 'en';
}

export default i18n
