import React, { useState } from 'react';
import PropTypes from 'prop-types';
import Button from '../../common/Button.js';
import { useTranslation } from "react-i18next";

const LanguageButtons = ({ onLanguageSelect, selectedLanguage, onStartSurvey }) => {
    const { t, i18n } = useTranslation();
    const [showStartSurvey, setShowStartSurvey] = useState(true);

    const handleLanguageChange = (lang) => {
        onLanguageSelect(lang);
        setShowStartSurvey(true);
    };

    return (
        <div className="bg-white flex space-x-4" id="buttonContainer">
            <Button
                type="english"
                text={t('English')}
                onClick={() => { handleLanguageChange('en'); }}
                title={t('English')}
                buttonType="button"
                className={`bg-yellow-600 text-white py-2 px-6 rounded text-sm sm:text-lg font-medium transition duration-300 hover:bg-yellow-700 shadow-md ${selectedLanguage === 'en'
                        ? 'bg-yellow-800 font-bold after:content-["✓"] after:ml-2 ring-2 ring-yellow-400 ring-offset-2 transform scale-105 shadow-lg'
                        : 'hover:scale-102'
                    }`}
                id="englishButton"
                useLi={false}
            />
            <Button
                type="arabic"
                text={t('Arabic')}
                onClick={() => handleLanguageChange('ar')}
                title={t('Arabic')}
                buttonType="button"
                className={`bg-yellow-600 text-white py-2 px-6 rounded text-sm sm:text-lg font-medium transition duration-300 hover:bg-yellow-700 shadow-md ${selectedLanguage === 'ar'
                        ? 'bg-yellow-800 font-bold after:content-["✓"] after:ml-2 ring-2 ring-yellow-400 ring-offset-2 transform scale-105 shadow-lg'
                        : 'hover:scale-102'
                    }`}
                id="arabicButton"
                useLi={false}
            />

            {showStartSurvey && (
                <Button
                    type="start-survey"
                    text={t('Start Survey')}
                    title={t('Start Survey')}
                    buttonType="button"
                    className="bg-yellow-600 text-white py-2 px-6 rounded text-sm sm:text-lg font-medium transition duration-300 hover:bg-yellow-700 shadow-md  "
                    onClick={onStartSurvey}
                    id="startSurveyButton"
                    useLi={false} // Use div instead of li
                />
            )}
        </div>
    );
};

LanguageButtons.propTypes = {
    onLanguageSelect: PropTypes.func.isRequired,
    selectedLanguage: PropTypes.string,
    onStartSurvey: PropTypes.func.isRequired,
};

export default LanguageButtons;
