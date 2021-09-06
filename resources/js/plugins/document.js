
export function setDocumentDirectionPerLocale(locale) {
    if (locale === 'ar'){
        document.dir = "rtl"
    }else{
        document.dir = "ltr"
    }
}

export function setDocumentLang(lang) {
    document.documentElement.lang = lang
}
