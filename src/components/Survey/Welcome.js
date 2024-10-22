import React, { useState, useCallback } from 'react';
import { useLoading } from "./context/LoadingContext.js";
import i18n from "i18next";
import LanguageButtons from "./components/LanguageButton.js";
import logo from "../../assets/images/New Project (2).png";
import SurveyForm from "./SurveyForm.js";
import Loader from "../common/Loader.js";

const Welcome = () => {
  const { isLoading, startLoading, stopLoading } = useLoading();
  const [showSurvey, setShowSurvey] = useState(false);
  const [selectedLanguage, setSelectedLanguage] = useState(i18n.language);

  const handleLanguageSelection = (lang) => {
    setSelectedLanguage(lang);
    i18n.changeLanguage(lang);
  };

  const handleStartSurvey = useCallback(() => {
    startLoading();
    // Simulate a shorter loading time (adjust as needed)
    setTimeout(() => {
      stopLoading();
      setShowSurvey(true);
    }, 2000); // Reduced to 2 seconds
  }, [startLoading, stopLoading]);

  if (showSurvey) {
    return <SurveyForm />;
  }

  if (isLoading) {
    return <Loader />;
  }

  return (
    <WelcomeScreen
      handleLanguageSelection={handleLanguageSelection}
      selectedLanguage={selectedLanguage}
      handleStartSurvey={handleStartSurvey}
    />
  );
};

const WelcomeScreen = React.memo(
  ({ handleLanguageSelection, selectedLanguage, handleStartSurvey }) => (
    <div className="bg-white w-full h-screen relative flex flex-col justify-between items-center overflow-hidden">
      <div className="absolute inset-0 from-yellow-100 to-yellow-200 opacity-20 z-0"></div>
      <div className="relative z-10 flex flex-col justify-between items-center w-full h-full">
        <div className="w-full flex flex-col justify-center items-center px-4 py-8 flex-grow">
          <LogoSection />
          <div className="text-center mb-8"> {/* Simplified Content */}
            <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 text-center mb-4 md:mb-8"
                style={{lineHeight: '1.2'}}>

              <br className="hidden sm:block"/> {/* Line break for smaller screens */}
              <span
                  className="text-transparent bg-clip-text bg-gradient-to-r from-[#CA8A04] to-[#F7B237] font-extrabold animate-text-shimmer">
          Al Yalayis
        </span>
              <br className="hidden sm:block md:hidden lg:block"/>
              <span className="block animate-fade-in-up">
    Government Transaction Center
  </span>
            </h1>
            <p className="text-lg sm:text-xl text-gray-600 max-w-xl mx-auto">
              Your feedback is valuable to us. Please take a moment to share your experience.
            </p>
          </div>
          <LanguageButtons
              onLanguageSelect={handleLanguageSelection}
              selectedLanguage={selectedLanguage}
              onStartSurvey={handleStartSurvey}
          />
        </div>
      </div>
    </div>
  )
);

const LogoSection = React.memo(() => (
    <img
        src={logo}
        alt="Al Yalayis Logo"
        className="max-w-[250px] sm:max-w-[300px] md:max-w-[350px] mb-6 md:mb-12 animate-fade-in" // Reduced max-width
    />
));


export default Welcome;
