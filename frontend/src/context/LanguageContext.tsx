"use client";

import React, { createContext, useContext, useState, useEffect } from 'react';

type Language = 'ar' | 'he' | 'en';

interface LanguageContextType {
    language: Language;
    direction: 'rtl' | 'ltr';
    setLanguage: (lang: Language) => void;
    t: (key: string) => string;
}

const LanguageContext = createContext<LanguageContextType | undefined>(undefined);

export const LanguageProvider = ({ children }: { children: React.ReactNode }) => {
    const [language, setLanguageState] = useState<Language>('ar');

    useEffect(() => {
        const savedLang = localStorage.getItem('language') as Language;
        if (savedLang && ['ar', 'he', 'en'].includes(savedLang)) {
            setLanguageState(savedLang);
        }
    }, []);

    const setLanguage = (lang: Language) => {
        setLanguageState(lang);
        localStorage.setItem('language', lang);
        document.documentElement.dir = (lang === 'ar' || lang === 'he') ? 'rtl' : 'ltr';
        document.documentElement.lang = lang;
    };

    useEffect(() => {
        document.documentElement.dir = (language === 'ar' || language === 'he') ? 'rtl' : 'ltr';
        document.documentElement.lang = language;
    }, [language]);

    const direction = (language === 'ar' || language === 'he') ? 'rtl' : 'ltr';

    // Simplified t function for UI elements, landing page content comes from API
    const translations: Record<Language, Record<string, string>> = {
        ar: { 'nav_home': 'الرئيسية', 'nav_products': 'المنتجات', 'nav_about': 'عن الشركة', 'nav_contact': 'اتصل بنا', 'nav_admin': 'لوحة التحكم' },
        he: { 'nav_home': 'דף הבית', 'nav_products': 'מוצרים', 'nav_about': 'אודות', 'nav_contact': 'צור קשר', 'nav_admin': 'ניהול' },
        en: { 'nav_home': 'Home', 'nav_products': 'Products', 'nav_about': 'About', 'nav_contact': 'Contact Us', 'nav_admin': 'Admin' },
    };

    const t = (key: string) => translations[language][key] || key;

    return (
        <LanguageContext.Provider value={{ language, direction, setLanguage, t }}>
            {children}
        </LanguageContext.Provider>
    );
};

export const useLanguage = () => {
    const context = useContext(LanguageContext);
    if (!context) throw new Error('useLanguage must be used within LanguageProvider');
    return context;
};
