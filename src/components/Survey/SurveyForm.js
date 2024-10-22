import React, {useCallback, useMemo} from 'react';
import { useTranslation } from 'react-i18next';
import SurveyStepPanel from './SurveyStepPanel.js';
import useSurveyQuestions from '../../hooks/useSurveyQuestions.js';
import {useSurveyContext} from "./context/SurveyContext.js";
import Loader from "../common/Loader.js";
import ContactComponent from "./components/ContactComponent.js";
import RadioComponent from "./components/RadioComponent.js";
import RatingComponent from "./components/RatingComponent.js";

const SurveyForm = () => {
    const { t, i18n } = useTranslation();
    const {
        formValues,
        currentStep,
        setCurrentStep,
        handleInputChange,
    } = useSurveyContext();

    const language = i18n.language;
    const { surveyQuestions, loading } = useSurveyQuestions(language);
    const totalSteps = useMemo(() => surveyQuestions.length, [surveyQuestions]);

    const step = useMemo(() => surveyQuestions.find(q => q.step_number === currentStep) || {},
        [currentStep, surveyQuestions]);

    const currentTranslation = step?.translations?.find(t => t.locale === language);


    const componentMap = useMemo(() => ({
        radio: RadioComponent,
        rating: RatingComponent,
        contact: ContactComponent,
    }), []);


    const renderOptions = useCallback(() => {
        const Component = componentMap[step.type];
        return Component ? (
            <Component
                step={step}
                value={formValues[step.step_number] || ''}
            />
        ) : null;
    }, [step, componentMap, formValues]);

    const handlePrevStep = () => {
        setCurrentStep(prev => Math.max(prev - 1, 1));
    };

    const handleNextStep = () => {
        setCurrentStep(prev => Math.min(prev + 1, totalSteps));
    };

    const translatedQuestionText = currentTranslation?.question_text;

    return (
        <SurveyStepPanel
            currentStep={currentStep}
            totalSteps={totalSteps}
            handlePrevStep={handlePrevStep}
            handleNextStep={handleNextStep}
            title={currentTranslation?.title || 'Default Title'}
            description={currentTranslation?.description || 'Default Description'}
        >
            <div className="survey-header">
                <div className="jw-top-title">
                    <span>{currentStep} {t('survey.of')} {totalSteps} {t('survey.steps')}</span>
                    <h2>{translatedQuestionText || 'Default Question Text'}</h2>
                </div>
            </div>

            {renderOptions()}

            {step?.hasTextarea && (
                <div className="service-textbox">
                     <textarea
                         value={formValues.survey.questions[`question_${currentStep}`]?.answer?.textarea || ''} // Correct access
                         placeholder={t('survey.additionalMessage')}
                         onChange={(e) => handleInputChange(step.step_number, 'textarea', e.target.value)}
                     />
                </div>
            )}
        </SurveyStepPanel>
    );
};


export default SurveyForm;
