// src/hooks/useSubmitSurvey.js

import { useCallback, useState } from 'react';
import { submitSurveyResponses } from '../services/dataService.js';
import { useLoading } from "../components/Survey/context/LoadingContext.js";
import { useSurveyContext } from "../components/Survey/context/SurveyContext.js";

const useSubmitSurvey = () => {
    const { formValues, isSubmitted, resetForm, setIsSubmitted } = useSurveyContext();
    const { startLoading, stopLoading } = useLoading();

    const [submitting, setSubmitting] = useState(false);
    const [submissionError, setSubmissionError] = useState(null);

    const handleSubmit = useCallback(async (event) => {
        event.preventDefault();

        if (isSubmitted || submitting) {
            return false;
        }

        setSubmitting(true);
        setSubmissionError(null);
        startLoading();

        try {
            const questions = Object.entries(formValues.survey.questions).reduce((acc, [key, value]) => {
                const questionNumber = key.replace('question_', '');
                acc[questionNumber] = {
                    type: value.type,
                    answer: value.answer
                };
                return acc;
            }, {});

            const dataToSave = {
                survey: {
                    survey_id: formValues.survey.survey_id,
                    locale: formValues.survey.locale,
                    questions: questions,
                },
            };

            await submitSurveyResponses(dataToSave);
            setIsSubmitted(true);
            resetForm();
            setTimeout(() => {
                window.location.reload();
            }, 5000); // 5000 milliseconds = 5 seconds
            return true;

        } catch (error) {
            console.error('Error submitting survey:', error);
            setSubmissionError(error);
            return false;

        } finally {
            setSubmitting(false);
            stopLoading();
        }
    }, [formValues, isSubmitted, submitting, startLoading, stopLoading, resetForm, setIsSubmitted]);

    return { handleSubmit, submitting, submissionError };
};

export default useSubmitSurvey;
