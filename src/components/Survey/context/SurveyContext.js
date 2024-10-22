import { createContext, useState, useMemo, useContext, useEffect, useCallback} from 'react';
import { v4 as uuidv4 } from 'uuid';
import { QUESTION_TYPES } from '../../../utils/constants.js';
import {useTranslation} from "react-i18next";

const SurveyContext = createContext();

export const SurveyProvider = ({ children }) => {
    const [formValues, setFormValues] = useState({
        survey: {
            survey_id: uuidv4(),
            questions: {},
            locale: null,
        },
    });
    const [currentStep, setCurrentStep] = useState(1);
    const [isSubmitted, setIsSubmitted] = useState(false);
    const { i18n } = useTranslation();
    const locale = i18n.language;

    // Reset form on load
    const resetForm = useCallback(() => {
        setFormValues({
            survey: {
                survey_id: uuidv4(),
                questions: {},
                locale,
            },
        });
        setCurrentStep(1);
        setIsSubmitted(false);
    }, [locale]);
    useEffect(() => {
        resetForm();
    }, [resetForm]); 

    const updateAnswer = (stepNumber, answerType, value) => {
        setFormValues((prevValues) => ({
            ...prevValues,
            survey: {
                ...prevValues.survey,
                questions: {
                    ...prevValues.survey.questions,
                    [`question_${stepNumber}`]: {
                        answer: {
                            ...prevValues.survey.questions[`question_${stepNumber}`]?.answer,
                            [answerType]: value,  
                        },
                    },
                },
            },
        }));
    };

    const handleInputChange = (stepNumber, inputType, value) => {
        switch (inputType) {
            case QUESTION_TYPES.CONTACT: {
                // Update contact information
                setFormValues((prevValues) => ({
                    ...prevValues,
                    survey: {
                        ...prevValues.survey,
                        questions: {
                            ...prevValues.survey.questions,
                            [`question_${stepNumber}`]: {
                                answer: {
                                    ...prevValues.survey.questions[`question_${stepNumber}`]?.answer,
                                    contact: {
                                        ...prevValues.survey.questions[`question_${stepNumber}`]?.answer?.contact,
                                        ...value // Spread the new contact data
                                    },
                                },
                            },
                        },
                    },
                }));
                break;
            }
            case QUESTION_TYPES.RATING:
                updateAnswer(stepNumber, 'rating', value);
                break;
            case QUESTION_TYPES.RADIO:
                updateAnswer(stepNumber, 'radio', value);
                break;
            case 'textarea':
                updateAnswer(stepNumber, 'textarea', value);
                break;
            default:
                break;
        }
    };
    // Submission logic
    const getContactDataForStep = (stepNumber) => {
        return formValues.survey.questions[`question_${stepNumber}`]?.answer?.contact || {};
    };

    const contextValue = useMemo(() => ({
        formValues,
        currentStep,
        setCurrentStep,
        handleInputChange,
        isSubmitted,
        setIsSubmitted,
        resetForm,
        getContactDataForStep,
    }), [formValues, currentStep, isSubmitted, resetForm]);

    return (
        <SurveyContext.Provider value={contextValue}>
            {children}
        </SurveyContext.Provider>
    );
};

export const useSurveyContext = () => {
    return useContext(SurveyContext);
};
